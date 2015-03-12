Aide à l'écriture
#################

Il est possible d'écrire des tests unitaires avec atoum de plusieurs manières, et l'une d'elle est d'utiliser des mots-clefs tels que ``given``, ``if``, ``and`` ou bien encore ``then``, ``when`` ou ``assert`` qui permettent de mieux organiser et de rendre plus lisible les tests.


``given``, ``if``, ``and`` et ``then``
****************************************

L'utilisation de ces mots-clefs est très intuitive :

.. code-block:: php

   <?php
   $this
       ->given($computer = new computer()))
       ->if($computer->prepare())
       ->and(
           $computer->setFirstOperand(2),
           $computer->setSecondOperand(2)
       )
       ->then
           ->object($computer->add())
               ->isIdenticalTo($computer)
           ->integer($computer->getResult())
               ->isEqualTo(4)
   ;

Il est important de noter que ces mots-clefs n'apportent rien techniquement ou fonctionnellement parlant, car ils n'ont pas d'autre but que de faciliter la compréhension du test et donc sa maintenance en y ajoutant de la sémantique compréhensible facilement par l'humain et plus particulièrement un développeur.

Ainsi, ``given``, ``if`` et ``and`` permettent de définir les conditions préalables pour que les assertions qui suivent le mot-clef ``then`` passent avec succès.

Cependant, il n'y a pas de grammaire régissant l'ordre d'utilisation de ces mots-clefs et aucune vérification syntaxique n'est effectuée par atoum.

En conséquence, il est de la responsabilité du développeur de les utiliser de façon à ce que le test soit lisible, même s'il est par exemple tout à fait possible d'écrire le test de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->and($computer = new computer()))
       ->if($computer->setFirstOperand(2))
       ->then
       ->given($computer->setSecondOperand(2))
           ->object($computer->add())
               ->isIdenticalTo($computer)
           ->integer($computer->getResult())
               ->isEqualTo(4)
   ;

Pour les mêmes raisons, l'utilisation de ``then`` est facultative.

Il est également important de noter qu'il est tout à fait possible d'écrire le même test en n'utilisant aucun mot-clef :

.. code-block:: php

   <?php
   $computer = new computer();
   $computer->setFirstOperand(2);
   $computer->setSecondOperand(2);

   $this
       ->object($computer->add())
           ->isIdenticalTo($computer)
       ->integer($computer->getResult())
           ->isEqualTo(4)
   ;

Le test ne sera pas plus lent ou plus rapide à exécuter et il n'y a aucun avantage à utiliser une notation ou une autre, l'important étant d'en choisir une et de s'y tenir pour faciliter la maintenance des tests (la problématique est exactement la même que celle des conventions de codage).


when
****

En plus de ``given``, ``if``, ``and`` et ``then``, il existe également d'autres mots-clefs.

L'un d'entre eux est ``when``. Il dispose d'une fonctionnalité spécifique introduite pour contourner le fait qu'il est illégal d'écrire en PHP le code suivant :

.. code-block:: php

   <?php
   $this
       ->if($array = array(uniqid()))
       ->and(unset($array[0]))
       ->then
           ->sizeOf($array)
               ->isZero()
   ;

Le langage génère en effet dans ce cas l'erreur fatale : ``Parse error: syntax error, unexpected 'unset' (T_UNSET), expecting ')'``

Il est en effet impossible d'utiliser ``unset()`` comme argument d'une fonction.

Pour résoudre ce problème, le mot-clef ``when`` est capable d'interpréter l'éventuelle fonction anonyme qui lui est passée en argument, ce qui permet d'écrire le test précédent de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($array = array(uniqid()))
       ->when(
           function() use ($array) {
               unset($array[0]);
           }
       )
       ->then
         ->sizeOf($array)
           ->isZero()
   ;

Bien évidemment, si ``when`` ne reçoit pas de fonction anonyme en argument, il se comporte exactement comme ``given``, ``if``, ``and`` et ``then``, à savoir qu'il ne fait absolument rien fonctionnellement parlant.


assert
******

Enfin, il existe le mot-clef ``assert`` qui a également un fonctionnement un peu particulier.

Pour illustrer son fonctionnement, le test suivant va être utilisé :

.. code-block:: php

   <?php
   $this
       ->given($foo = new \mock\foo())
       ->and($bar = new bar($foo))
       ->if($bar->doSomething())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()

       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->exactly(2)
   ;

Le test précédent présente un inconvénient en terme de maintenance, car si le développeur a besoin d'intercaler un ou plusieurs nouveaux appels à bar::doOtherThing() entre les deux appels déjà effectués, il sera obligé de mettre à jour en conséquence la valeur de l'argument passé à exactly().
Pour remédier à ce problème, vous pouvez remettre à zéro un mock de 2 manières différentes :

* soit en utilisant $mock->getMockController()->resetCalls() ;
* soit en utilisant $this->resetMock($mock).

.. code-block:: php

   <?php
   $this
       ->given($foo = new \mock\foo())
       ->and($bar = new bar($foo))
       ->if($bar->doSomething())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()

       // 1ère manière
       ->given($foo->getMockController()->resetCalls())
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()

       // 2ème manière
       ->given($this->resetMock($foo))
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   ;

Ces méthodes effacent la mémoire du contrôleur, il est donc possible d'écrire l'assertion suivante comme si le bouchon n'avait jamais été utilisé.

Le mot-clef ``assert`` permet de se passer de l'appel explicite à ``resetCalls()`` ou ``resetMock`` et de plus il provoque l'effacement de la mémoire de l'ensemble des adaptateurs et des contrôleurs de mock définis au moment de son utilisation.

Grâce à lui, il est donc possible d'écrire le test précédent d'une façon plus simple et plus lisible, d'autant qu'il est possible de passer une chaîne de caractère à assert afin d'expliquer le rôle des assertions suivantes :

.. code-block:: php

   <?php
   $this
       ->assert("Bar n'a pas de valeur")
           ->given($foo = new \mock\foo())
           ->and($bar = new bar($foo))
           ->if($bar->doSomething())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()

       ->assert('Bar a une valeur')
           ->if($bar->setValue(uniqid())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()
   ;

La chaîne de caractères sera de plus reprise dans les messages générés par atoum si l'une des assertions ne passe pas avec succès.


Le mode loop
**************

Lorsqu'un développeur fait du développement piloté par les tests, il travaille généralement de la manière suivante :

# il commence par créer le test correspondant à ce qu'il veut développer ;
# il exécute le test qu'il vient de créer ;
# il écrit le code permettant au test de passer avec succès ;
# il modifie ou complète son test et repars à l'étape 2.

Concrètement, cela signifie qu'il doit :

* créer son code dans son éditeur favori ;
* quitter son éditeur puis exécuter son test dans une console ;
* revenir à son éditeur pour écrire le code permettant au test de passer avec succès ;
* revenir à la console afin de relancer l'exécution de son test ;
* revenir à son éditeur afin de modifier ou compléter son test ;

Il y a donc bien un cycle qui se répétera tant que la fonctionnalité n'aura pas été développée dans son intégralité.

On peut remarquer que, durant ce cycle, le développeur devra saisir de manière récurrente la même commande dans le terminal afin de lancer l'exécution des tests unitaires.

atoum propose le mode ``loop`` disponible via les arguments ``-l`` ou ``--loop``, qui permet au développeur de ne pas avoir à relancer manuellement les tests et permet donc de fluidifier le processus de développement.

Dans ce mode, atoum commence par exécuter une première fois les tests qui lui sont demandés.

Une fois les tests terminés, si les tests ont été passés avec succès par le code, atoum se met simplement en attente :

.. code-block:: shell

   $ php tests/units/classes/adapter.php -l
   > PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > mageekguy\atoum\tests\units\adapter...
   [SS__________________________________________________________][2/2]
   => Test duration: 0.00 second.
   => Memory usage: 0.50 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.50 Mb.
   > Running duration: 0.05 second.
   Success (1 test, 2/2 methods, 0 void method, 0 skipped method, 4 assertions)!
   Press <Enter> to reexecute, press any other key and <Enter> to stop...


Si le développeur presse ``Enter``, atoum réexécutera à nouveau les mêmes tests, sans aucune autre action de la part du développeur.

Dans le cas où le code ne passe pas les tests avec succès, c'est-à-dire si des assertions ne sont pas vérifiées ou s'il y a eu des erreurs ou des exceptions, atoum se met également en attente :

.. code-block:: shell

   $ php tests/units/classes/adapter.php -l> PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > mageekguy\atoum\tests\units\adapter...
   [FS__________________________________________________________][2/2]
   => Test duration: 0.00 second.
   => Memory usage: 0.25 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.25 Mb.
   > Running duration: 0.05 second.
   Failure (1 test, 2/2 methods, 0 void method, 0 skipped method, 0 uncompleted method, 1 failure, 0 error, 0 exception)!
   > There is 1 failure:
   => mageekguy\atoum\tests\units\adapter::test__call():
   In file /media/data/dev/atoum-documentation/tests/vendor/atoum/atoum/tests/units/classes/adapter.php on line 16, mageekguy\atoum\asserters\string() failed: strings are not equal
   -Expected
   +Actual
   @@ -1 +1 @@
   -string(32) "1305beaa8f3f2f932f508d4af7f89094"
   +string(32) "d905c0b86bf89f9a57d4da6101f93648"
   Press <Enter> to reexecute, press any other key and <Enter> to stop...


Si le développeur presse la touche ``Enter``, au lieu de rejouer les mêmes tests comme dans le cas où les tests ont été passés avec succès, atoum n'exécutera que les tests en échec, au lieu de les rejouer dans leur intégralité.

Le développeur pourra alors dépiler les problèmes et rejouer les tests en erreur autant de fois que nécessaire simplement en appuyant sur ``Enter``.

De plus, une fois que tous les tests en échec passeront à nouveau avec succès, atoum exécutera automatiquement la totalité de la suite de tests afin de détecter les éventuelles régressions introduites par la ou les corrections effectuées par le développeur.

.. code-block:: shell

   Press <Enter> to reexecute, press any other key and <Enter> to stop...
   > PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > mageekguy\atoum\tests\units\adapter...
   [S___________________________________________________________][1/1]
   => Test duration: 0.00 second.
   => Memory usage: 0.25 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.25 Mb.
   > Running duration: 0.05 second.
   Success (1 test, 1/1 method, 0 void method, 0 skipped method, 2 assertions)!
   > PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > mageekguy\atoum\tests\units\adapter...
   [SS__________________________________________________________][2/2]
   => Test duration: 0.00 second.
   => Memory usage: 0.50 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.50 Mb.
   > Running duration: 0.05 second.
   Success (1 test, 2/2 methods, 0 void method, 0 skipped method, 4 assertions)!
   Press <Enter> to reexecute, press any other key and <Enter> to stop...


Bien évidemment, le mode ``loop`` ne prend en compte que :ref:`le ou les fichiers de tests unitaires lancés <fichiers-a-executer>` par atoum.


Le mode debug
*************

Parfois, un test ne passe pas et il est difficile d'en découvrir la raison.

Dans ce cas, l'une des techniques possibles pour remédier au problème est de tracer le comportement du code concerné, soit directement au cœur de la classe testée à l'aide d'un déboggueur ou de fonctions du type de ``var_dump()`` ou ``print_r()``, soit au niveau du test unitaire.

Et il se trouve que atoum dispose d'un certain nombre d'outils pour faciliter la tâche du développeur dans ce dernier contexte.

Ces outils ne sont cependant actif que lorsque atoum est exécuté à l'aide de l'argument ``--debug``, afin que l'exécution des tests unitaires ne soit pas perturbée par les instructions relatives au débogage hors de ce contexte.
Lorsque l'argument ``--debug`` est utilisé, trois méthodes peuvent être activée :

* ``dump()`` qui permet de connaître le contenu d'une variable ;
* ``stop()`` qui permet d'arrêter l'exécution d'un test ;
* ``executeOnFailure()`` qui permet de définir une fonction anonyme qui ne sera exécutée qu'en cas d'échec d'une assertion.

Ces trois méthodes s'intègrent parfaitement dans l'interface fluide qui caractérise atoum.


dump
====
La méthode ``dump()`` peut s'utiliser de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->dump($foo->getBar())
   ;

Lors de l'exécution du test, le retour de la méthode ``foo::getBar()`` sera affiché sur la sortie standard.

Il est également possible de passer plusieurs arguments à ``dump()``, de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->dump($foo->getBar(), $bar)
   ;

.. important::
   La méthode ``dump`` n'est activée que si vous lancez les tests avec l'argument ``--debug``. Dans le cas contraire, cette méthode sera totalement ignorée.

stop
====

L'utilisation de la méthode ``stop()`` est également très simple :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->stop() // le test s'arrêtera ici si --debug est utilisé
           ->object($foo->getBar())
               ->isIdenticalTo($bar)
   ;

Si ``--debug`` est utilisé, les 2 dernières lignes ne seront pas exécutées.

.. important::
   La méthode ``stop`` n'est activée que si vous lancez les tests avec l'argument ``--debug``. Dans le cas contraire, cette méthode sera totalement ignorée.


executeOnFailure
================

La méthode ``executeOnFailure()`` est très puissante et tout aussi simple à utiliser.

Elle prend en effet en argument une fonction anonyme qui sera exécutée si et seulement si l'une des assertions composant le test n'est pas vérifiée. Elle s'utilise de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->executeOnFailure(
           function() use ($foo) {
               var_dump($foo);
           }
       )
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->object($foo->getBar())
               ->isIdenticalTo($bar)
   ;

Dans l'exemple précédent, contrairement à ``dump()`` qui provoque systématiquement l'affichage sur la sortie standard le contenu des variables qui lui sont passées en argument, la fonction anonyme passée en argument ne provoquera l'affichage du contenu de la variable ``foo`` que si l'une des assertions suivantes est en échec.

Bien évidemment, il est possible de faire appel plusieurs fois à ``executeOnFailure()`` dans une même méthode de test pour définir plusieurs fonctions anonymes différentes devant être exécutées en cas d'échec du test.

.. important::
   La méthode ``executeOnFailure`` n'est activée que si vous lancez les tests avec l'argument ``--debug``. Dans le cas contraire, cette méthode sera totalement ignorée.


Les méthodes d'initialisation
*****************************

Voici le processus, lorsque atoum exécute les méthodes de test d'une classe avec le moteur par défaut (``concurrent``) :

#. appel de la méthode ``setUp()`` de la classe de test ;
#. lancement d'un sous-processus PHP pour exécuter **chaque méthode** de test ;
#. dans le sous-processus PHP, appel de la méthode ``beforeTestMethod()`` de la classe de test ;
#. dans le sous-processus PHP, appel de la méthode de test ;
#. dans le sous-processus PHP, appel de la méthode ``afterTestMethod()`` de la classe de test ;
#. une fois le sous-processus PHP terminé, appel de la méthode ``tearDown()`` de la classe de test.

.. note::
   Pour plus d'informations sur les moteurs d'exécution des tests d'atoum, vous pouvez lire le paragraphe sur l'annotation `@engine`_.

Les méthodes ``setUp()`` et ``tearDown()`` permettent donc respectivement d'initialiser et de nettoyer l'environnement de test pour l'ensemble des méthodes de test de la classe exécutée.

Les méthodes ``beforeTestMethod()`` et ``afterTestMethod()`` permettent respectivement d'initialiser et de nettoyer l'environnement d'exécution des tests individuellement pour chacune des méthodes de test de la classe, puisqu'elles sont exécutées dans le même sous-processus, au contraire de ``setUp()`` et ``tearDown()``.

C'est d'ailleurs la raison pour laquelle les méthodes ``beforeTestMethod()`` et ``afterTestMethod()`` acceptent comme argument le nom de la méthode de test exécutée, afin de pouvoir ajuster les traitements en conséquence.

.. code-block:: php

   <?php
   namespace vendor\project\tests\units;

   use
       mageekguy\atoum,
       vendor\project
   ;

   require __DIR__ . '/mageekguy.atoum.phar';

   class bankAccount extends atoum
   {
       public function setUp()
       {
           // Exécutée *avant l'ensemble* des méthodes de test.
           // Initialisation globale.
       }

       public function beforeTestMethod($method)
       {
           // Exécutée *avant chaque* méthode de test.

           switch ($method)
           {
               case 'testGetOwner':
                   // Initialisation pour testGetOwner().
               break;

               case 'testGetOperations':
                   // Initialisation pour testGetOperations().
               break;
           }
       }

       public function testGetOwner()
       {
           ...
       }

       public function testGetOperations()
       {
           ...
       }

       public function afterTestMethod($method)
       {
           // Exécutée *après chaque* méthode de test.

           switch ($method)
           {
               case 'testGetOwner':
                   // Nettoyage pour testGetOwner().
               break;

               case 'testGetOperations':
                   // Nettoyage pour testGetOperations().
               break;
           }
       }

       public function tearDown()
       {
           // Exécutée après l'ensemble des méthodes de test.
           // Nettoyage global.
       }
   }

Par défaut, les méthodes ``setUp()``, ``beforeTestMethod()``, ``afterTestMethod()`` et ``tearDown()`` ne font absolument rien.

Il est donc de la responsabilité du programmeur de les surcharger lorsque c'est nécessaire dans les classes de test concerné.


Fournisseurs de données (data provider)
***************************************

Pour vous aider à tester efficacement vos classes, atoum met à votre disposition des fournisseurs de données (data provider en anglais).

Un fournisseur de données est une méthode d'une classe de test chargée de générer des arguments pour une méthode de test, arguments qui seront utilisés par ladite méthode pour valider des assertions.

Si une méthode de test ``testFoo`` prend des arguments et qu'aucune annotation relative à un fournisseur de données n'est définie, atoum cherchera automatiquement la méthode protected ``testFooDataProvider``.

Vous pouvez néanmoins définir manuellement le nom de la méthode du fournisseur de données grâce à l'annotation ``@dataProvider`` appliquée à la méthode de test concernée, de la manière suivante :

.. code-block:: php

   <?php
   class calculator extends atoum
   {
       /**
        * @dataProvider sumDataProvider
        */
       public function testSum($a, $b)
       {
           $this
               ->if($calculator = new project\calculator())
               ->then
                   ->integer($calculator->sum($a, $b))->isEqualTo($a + $b)
           ;
       }

       ...
   }

Évidemment, il ne faut pas oublier de définir, au niveau de la méthode de test, les arguments correspondant à ceux qui seront retournés par le fournisseur de données. Si ce n'est pas le cas, atoum générera une erreur lors de l'exécution des tests.

La méthode du fournisseur de données est une simple méthode protected qui retourne un tableau ou un itérateur contenant des données :

.. code-block:: php

   <?php
   class calculator extends atoum
   {
       ...

       // Fournisseur de données de testSum().
       protected function sumDataProvider()
       {
           return array(
               array( 1, 1),
               array( 1, 2),
               array(-1, 1),
               array(-1, 2),
           );
       }
   }

Lors de l'exécution des tests, atoum appellera la méthode de test ``testSum()`` successivement avec les arguments ``(1, 1)``, ``(1, 2)``, ``(-1, 1)`` et ``(-1, 2)`` renvoyés par la méthode ``sumDataProvider()``.

.. warning::
   L'isolation des tests ne sera pas utilisée dans ce contexte, ce qui veut dire que chacun des appels successifs à la méthode ``testSum()`` sera réalisé dans le même processus PHP.



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

atoum s'appuie sur un composant spécialisé pour générer les bouchons : le ``mockGenerator``. Vous avez accès à ce dernier dans vos tests afin de modifier la procédure de génération des mocks.

Par défaut, les bouchons seront générés dans le namespace ``mock`` et se comporteront exactement de la même manière que les instances de la classe originale (le bouchon hérite directement de la classe originale).


Changer le nom de la classe
---------------------------

Si vous désirez changer le nom de la classe ou son espace de nom, vous devez utiliser le ``mockGenerator``.

Sa méthode ``generate`` prend 3 paramètres :

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

Dans certains cas, il peut être utile de shunter les appels aux méthodes parentes afin que leur code ne soit plus exécuté. Le ``mockGenerator`` met à votre disposition plusieurs méthodes pour y parvenir :

.. code-block:: php

   <?php
   // le bouchon ne fera pas appel à la classe parente
   $this->mockGenerator->shuntParentClassCalls();

   $mock = new \mock\OneClass;

   // le bouchon fera à nouveau appel à la classe parente
   $this->mockGenerator->unshuntParentClassCalls();

Ici, toutes les méthodes du bouchon se comporteront comme si elles n'avaient pas d'implémentation par contre elles conserveront la signature des méthodes originales. Vous pouvez également préciser les méthodes que vous souhaitez shunter :

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

Pour cela, il faut passer par son contrôleur en utilisant l'une des méthodes suivantes :

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   $mockDbClient->getMockController()->connect = function() {};
   // Équivalent à
   $this->calling($mockDbClient)->connect = function() {};

Le ``mockController`` vous permet de redéfinir **uniquement les méthodes publiques et abstraites protégées** et met à votre disposition plusieurs méthodes :

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   // redéfinie la méthode connect : elle retournera toujours true
   $this->calling($mockDbClient)->connect = true;

   // redéfinie la méthode select : elle exécutera la fonction anonyme passée
   $this->calling($mockDbClient)->select = function() {
       return array();
   };

   // redéfinie la méthode query avec des arguments
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
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3. Reportez-vous au `manuel de PHP <http://php.net/functions.anonymous>`_ pour avoir plus d'informations sur le sujet.

Comme vous pouvez le voir, il est possible d'utiliser plusieurs méthodes afin d'obtenir le comportement souhaité :

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
* Le second aura le comportement par défaut, c'est à dire un nombre aléatoire.
* Le troisième appel retournera 42.
* Tous les appels suivants auront le comportement par défaut, c'est à dire des nombres aléatoires.

Si vous souhaitez que plusieurs méthodes du bouchon aient le même comportement, vous pouvez utiliser les méthodes `methods`_ ou `methodsMatching`_.


methods
-------

``methods`` vous permet, grâce à la fonction anonyme passée en argument, de définir pour quelles méthodes le comportement doit être modifié :

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
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3. Reportez-vous au `manuel de PHP <http://php.net/functions.anonymous>`_ pour avoir plus d'informations sur le sujet.


methodsMatching
-----------------

``methodsMatching`` vous permet de définir les méthodes où le comportement doit être modifié grâce à l'expression rationnelle passée en argument :

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
   ``methodsMatching`` utilise `preg_match <http://php.net/preg_match>`_ et les expressions rationnelles. Reportez-vous au `manuel de PHP <http://php.net/pcre>`_ pour avoir plus d'informations sur le sujet.


Cas particulier du constructeur
===============================

Pour bouchonner le constructeur d'une classe, il faut :

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
   On ne peut pas mettre de \ devant les fonctions a simulé car atoum s’appuie sur le mécanisme de résolution des espaces de nom de PHP.
   
.. important::
   Pour la meme raison, si une fonction native a déjà été appelée son bouchonnage sera sans effet.

.. code-block:: php

   <?php
   
   $this
      ->given($this->newTestedInstance())
      ->exception(function() { $this->testedInstance->loadConfigFile(); }) //la fonction file_exists est appelée avant son bouchonnage
         
      ->if($this->function->file_exists = true ) // le bouchonnage ne pourra pas prendre la place de la fonction native file_exists
      ->object($this->testedInstance->loadConfigFile()) 
         ->isTestedInstance()
   ;

Les annotations
***************

@dataProvider
=============

.. important::
   We need help to write this section !

@engine
=======

.. important::
   We need help to write this section !

.. <mageekguy> par défaut atoum exécute chaque méthode de test dans un sous-processus php séparée, et en parallèle
   <mageekguy> mais ça n'a rien d'obligatoire
   <mageekguy> nativement, tu peux lui dire d'exécuter les tests avec son moteur par défaut (donc, concurrent, que j'ai décrits ci-dessus)
   <mageekguy> ou alors avec isolate, qui exécute dans un sous-processus mais séquentiellement
   <mageekguy> ou alors inline, donc tout dans le même processus PHP
   <mageekguy> (à la PHPUnit par défaut, en clair)
   <mageekguy> inline est très très rapide mais il n'y alors plus d'isolation des tests
   <mageekguy> isolate apporte l'isolation mais est très lent, et sert à que dalle de mon point de vue (c'est pour moi juste un poc)
   <mageekguy> concurrent est le meilleur compromis entre l'isolation et les perf
   <mageekguy> tout ça se commande à l'aide de l'annotation @engine sur la classe ou sur une méthode spécifique
