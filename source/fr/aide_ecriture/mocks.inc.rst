
.. _les-bouchons-mock:

Les bouchons (mock)
*******************

atoum dispose d'un système de bouchonnage (mock en anglais) puissant et simple à mettre en œuvre qui vous permettra de générer des mocks à partir de classes (existantes, inexistantes, abstraites ou non) ou d'interfaces. Grâce à ces bouchons, vous pourrez simuler des comportements en redéfinissant les méthodes publiques de vos classes.


Générer un bouchon
==================

Il y a plusieurs manières de créer un bouchon à partir d'une interface ou d'une classe.

La plus simple est de créer un objet dont le nom absolu est préfixé par ``mock``:

.. code-block:: php

   <?php
   // création d'un bouchon de l'interface \Countable
   $countableMock = new \mock\Countable;

   // création d'un bouchon de la classe abstraite
   // \Vendor\Project\AbstractClass
   $vendorAppMock = new \mock\Vendor\Project\AbstractClass;

   // création d'un bouchon de la classe \StdClass
   $stdObject     = new \mock\StdClass;

   // création d'un bouchon à partir d'une classe inexistante
   $anonymousMock = new \mock\My\Unknown\Class;


Le générateur de bouchon
========================

atoum s'appuie sur un composant spécialisé pour générer les bouchons : le ``mockGenerator``. Vous avez accès à ce dernier dans vos tests afin de modifier la procédure de génération des mocks.

Par défaut, les bouchons seront générés dans le namespace ``mock`` et se comporteront exactement de la même manière que les instances de la classe originale (le bouchon hérite directement de la classe originale).


Changer le nom de la classe
---------------------------

Si vous désirez changer le nom de la classe ou son espace de nom, vous devez utiliser le ``mockGenerator``.

Sa méthode ``generate`` prend 3 paramètres :

* le nom de l'interface ou de la classe à bouchonner ;
* le nouvel espace de nom, optionnel ;
* le nouveau nom de la classe, optionnel.

.. code-block:: php

   <?php
   // création d'un bouchon de l'interface \Countable vers \MyMock\Countable
   // on ne change que l'espace de nom
   $this->mockGenerator->generate('\Countable', '\MyMock');

   // création d'un bouchon de la classe abstraite
   // \Vendor\Project\AbstractClass vers \MyMock\AClass
   // on change l'espace de nom et le nom de la classe
   $this->mockGenerator->generate('\Vendor\Project\AbstractClass', '\MyMock', 'AClass');

   // création d'un bouchon de la classe \StdClass vers \mock\OneClass
   // on ne change que le nom de la classe
   $this->mockGenerator->generate('\StdClass', null, 'OneClass');

   // on peut maintenant instancier ces mocks
   $vendorAppMock = new \myMock\AClass;
   $countableMock = new \myMock\Countable;
   $stdObject     = new \mock\OneClass;

.. note::
   Si vous n'utilisez que le premier argument et ne changez ni l'espace de nommage ni le nom de la classe, alors la première solution est équivalente, plus simple à lire et recommandée.
   
.. note::
   Vous pouvez accéder au code de la classe générée par le générateur de mock en appelant ``$this->mockGenerator->getMockedClassCode()``, afin de débugger, par exemple. Cette méthode prend les mêmes arguments que la méthode ``generate``.

.. code-block:: php

   <?php
   $countableMock = new \mock\Countable;

   // est équivalent à:

   $this->mockGenerator->generate('\Countable');   // inutile
   $countableMock = new \mock\Countable;


Shunter les appels aux méthodes parentes
----------------------------------------

Un bouchon hérite directement de la classe à partir de laquelle il a été généré, ses méthodes se comportent donc exactement de la même manière.

Dans certains cas, il peut être utile de shunter les appels aux méthodes parentes afin que leur code ne soit plus exécuté. Le ``mockGenerator`` met à votre disposition plusieurs méthodes pour y parvenir :

.. code-block:: php

   <?php
   // le bouchon ne fera pas appel à la classe parente
   $this->mockGenerator->shuntParentClassCalls();

   $mock = new \mock\OneClass;

   // le bouchon fera à nouveau appel à la classe parente
   $this->mockGenerator->unshuntParentClassCalls();

Ici, toutes les méthodes du bouchon se comporteront comme si elles n'avaient pas d'implémentation par contre elles conserveront la signature des méthodes originales. Vous pouvez également préciser les méthodes que vous souhaitez shunter :

.. code-block:: php

   <?php
   // le bouchon ne fera pas appel à la classe parente pour la méthode firstMethod...
   $this->mockGenerator->shunt('firstMethod');
   // ... ni pour la méthode secondMethod
   $this->mockGenerator->shunt('secondMethod');

   $countableMock = new \mock\OneClass;


Rendre une méthode orpheline
----------------------------

Il peut parfois être intéressant de rendre une méthode orpheline, c'est-à-dire, lui donner une signature et une implémentation vide. Cela peut être particulièrement utile pour générer des bouchons sans avoir à instancier toutes leurs dépendances.

.. code-block:: php

   <?php
   class FirstClass {
       protected $dep;

       public function __construct(SecondClass $dep) {
           $this->dep = $dep;
       }
   }

   class SecondClass {
       protected $deps;

       public function __construct(ThirdClass $a, FourthClass $b) {
           $this->deps = array($a, $b);
       }
   }

   $this->mockGenerator->orphanize('__construct');
   $this->mockGenerator->shuntParentClassCalls();

   // Nous pouvons instancier le bouchon sans injecter ses dépendances
   $mock = new \mock\SecondClass();

   $object = new FirstClass($mock);


Modifier le comportement d'un bouchon
=====================================

Une fois le bouchon créé et instancié, il est souvent utile de pouvoir modifier le comportement de ses méthodes.

Pour cela, il faut passer par son contrôleur en utilisant l'une des méthodes suivantes :

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   $mockDbClient->getMockController()->connect = function() {};
   // Équivalent à
   $this->calling($mockDbClient)->connect = function() {};

Le ``mockController`` vous permet de redéfinir **uniquement les méthodes publiques et abstraites protégées** et met à votre disposition plusieurs méthodes :

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   // redéfinit la méthode connect : elle retournera toujours true
   $this->calling($mockDbClient)->connect = true;

   // redéfinit la méthode select : elle exécutera la fonction anonyme passée
   $this->calling($mockDbClient)->select = function() {
       return array();
   };

   // redéfinit la méthode query avec des arguments
   $result = array();
   $this->calling($mockDbClient)->query = function(Query $query) use($result) {
       switch($query->type) {
           case Query::SELECT:
               return $result

           default;
               return null;
       }
   };

   // la méthode connect lèvera une exception
   $this->calling($mockDbClient)->connect->throw = new \Database\Client\Exception();

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3. Reportez-vous au `manuel de PHP <http://php.net/functions.anonymous>`__ pour avoir plus d'informations sur le sujet.

Comme vous pouvez le voir, il est possible d'utiliser plusieurs méthodes afin d'obtenir le comportement souhaité :

* Utiliser une valeur statique qui sera retournée par la méthode
* Utiliser une implémentation courte grâce aux fonctions anonymes de PHP
* Utiliser le mot-clef ``throw`` pour lever une exception

Vous pouvez également spécifier plusieurs valeurs en fonction de l'ordre d'appel:

.. code-block:: php

   <?php
   // défaut
   $this->calling($mockDbClient)->count = rand(0, 10);
   // équivalent à
   $this->calling($mockDbClient)->count[0] = rand(0, 10);

   // 1er appel
   $this->calling($mockDbClient)->count[1] = 13;

   // 3ème appel
   $this->calling($mockDbClient)->count[3] = 42;

* Le premier appel retournera 13.
* Le second aura le comportement par défaut, c'est-à-dire un nombre aléatoire.
* Le troisième appel retournera 42.
* Tous les appels suivants auront le comportement par défaut, c'est à dire des nombres aléatoires.

Si vous souhaitez que plusieurs méthodes du bouchon aient le même comportement, vous pouvez utiliser les méthodes `methods`_ ou `methodsMatching`_.


methods
-------

``methods`` vous permet, grâce à la fonction anonyme passée en argument, de définir pour quelles méthodes le comportement doit être modifié :

.. code-block:: php

   <?php
   // si la méthode a tel ou tel nom,
   // on redéfinit son comportement
   $this
       ->calling($mock)
           ->methods(
               function($method) {
                   return in_array(
                       $method,
                       array(
                           'getOneThing',
                           'getAnOtherThing'
                       )
                   );
               }
           )
               ->return = uniqid()
   ;

   // on redéfinit le comportement de toutes les méthodes
   $this
       ->calling($mock)
           ->methods()
               ->return = null
   ;

   // si la méthode commence par "get",
   // on redéfinit son comportement
   $this
       ->calling($mock)
           ->methods(
               function($method) {
                   return substr($method, 0, 3) == 'get';
               }
           )
               ->return = uniqid()
   ;


Dans le cas du dernier exemple, vous devriez plutôt utiliser `methodsMatching`_.

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3. Reportez-vous au `manuel de PHP <http://php.net/functions.anonymous>`__ pour avoir plus d'informations sur le sujet.


methodsMatching
-----------------

``methodsMatching`` vous permet de définir les méthodes où le comportement doit être modifié grâce à l'expression rationnelle passée en argument :

.. code-block:: php

   <?php
   // si la méthode commence par "is",
   // on redéfinit son comportement
   $this
       ->calling($mock)
           ->methodsMatching('/^is/')
               ->return = true
   ;

   // si la méthode commence par "get" (insensible à la casse),
   // on redéfinit son comportement
   $this
       ->calling($mock)
           ->methodsMatching('/^get/i')
               ->throw = new \exception
   ;

.. note::
   ``methodsMatching`` utilise `preg_match <http://php.net/preg_match>`_ et les expressions rationnelles. Reportez-vous au `manuel de PHP <http://php.net/pcre>`__ pour avoir plus d'informations sur le sujet.


Cas particulier du constructeur
===============================

Pour bouchonner le constructeur d'une classe, il faut :

* créer une instance de la classe \atoum\mock\controller avant d'appeler le constructeur du bouchon ;
* définir via ce contrôleur le comportement du constructeur du bouchon à l'aide d'une fonction anonyme ;
* injecter le contrôleur lors de l'instanciation du bouchon en dernier argument.

.. code-block:: php

   <?php
   $controller = new \atoum\mock\controller();
   $controller->__construct = function() {};

   $mockDbClient = new \mock\Database\Client(DB_HOST, DB_USER, DB_PASS, $controller);


Tester un bouchon
=================

atoum vous permet de vérifier qu'un bouchon a été utilisé correctement.

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();
   $mockDbClient->getMockController()->connect = function() {};
   $mockDbClient->getMockController()->query   = array();

   $bankAccount = new \Vendor\Project\Bank\Account();
   $this
       // utilisation du bouchon via un autre objet
       ->array($bankAccount->getOperations($mockDbClient))
           ->isEmpty()

       // test du bouchon
       ->mock($mockDbClient)
           ->call('query')
               ->once()        // vérifie que la méthode query
                               // n'a été appelé qu'une seule fois
   ;

.. note::
   Reportez-vous à la documentation sur l'assertion :ref:`mock-asserter` pour obtenir plus d'informations sur les tests des bouchons.


Le bouchonnage (mock) des fonctions natives de PHP
**************************************************
atoum permet de très facilement simuler le comportement des fonctions natives de PHP.

.. code-block:: php

   <?php
   
   $this
      ->assert('le fichier nexiste')
         ->given($this->newTestedInstance())
         ->if($this->function->file_exists = true)
         ->then
         ->object($this->testedInstance->loadConfigFile())
            ->isTestedInstance()
            ->function('file_exists')->wasCalled()->once()

      ->assert('le fichier nexiste pas')
         ->given($this->newTestedInstance())
         ->if($this->function->file_exists = false )
         ->then
         ->exception(function() { $this->testedInstance->loadConfigFile(); })
   ;

.. important::
   On ne peut pas mettre de \\ devant les fonctions à simuler, car atoum s’appuie sur le mécanisme de résolution des espaces de nom de PHP.
   
.. important::
   Pour la même raison, si une fonction native a déjà été appelée, son bouchonnage sera sans effet.

.. code-block:: php

   <?php
   
   $this
      ->given($this->newTestedInstance())
      ->exception(function() { $this->testedInstance->loadConfigFile(); }) //la fonction file_exists est appelée avant son bouchonnage
         
      ->if($this->function->file_exists = true ) // le bouchonnage ne pourra pas prendre la place de la fonction native file_exists
      ->object($this->testedInstance->loadConfigFile()) 
         ->isTestedInstance()
   ;
