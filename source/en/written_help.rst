Writing help
#################

There are several ways to write unit test with atoum, one of them is to use keywords like ``given``, ``if``, ``and`` or  ``then``, ``when`` or ``assert`` so you can structure the tests, making them more readable.


``given``, ``if``, ``and`` and ``then``
****************************************

You can use these keywords intuitively:

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

It's important to note that these keywords don't have any another purpose than giving the test a more readable form. They don't supplement the test with any technical effect. The only goal here is to help the reader, human or more specificaly developper, to understand what's happening in the test.

Thus, ``given``, ``if`` and ``and`` specify the prerequisites assertions that follows the keyword ``then`` pass.

However, no grammar is ruling the order nor the syntax of these keywords in atoum.

As a result, the developer has to use the keywords wisely in order to make the test as readable as possible, even if it's possible to write the like the following:

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

For the same reason, the use of ``then`` is also optional.

It's also important to note that you can write the exact same test without using any of the previous keywords:

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

The test will not be slower or faster to run and there is no advantage to use one notation or another, the important thing is to choose one and stick to it. In this way it will facilitate maintenance of the tests (the problem is exactly the same as coding conventions).


when
****

In addition to ``given``, ``if``, ``and`` and ``then``, there are also other keywords.

One of them is ``when``. It has a specific feature introduced to work around that it is illegal to write the following PHP code:

.. code-block:: php

   <?php
   $this
       ->if($array = array(uniqid()))
       ->and(unset($array[0]))
       ->then
           ->sizeOf($array)
               ->isZero()
   ;

Indeed, the language generate in this case a fatal error: ``Parse error: syntax error, unexpected 'unset' (T_UNSET), expecting ')'``

It is impossible to use ``unset()`` as an argument of a function.

To resolve this problem, the keyword ``when`` is able to interpret the possible anonymous function that is passed as an argument, allowing us to write the previous test in the following way:

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

Of course, if ``when`` doesn't received an anonymous function as an argument, it behaves exactly as ``given``, ``if``, ``and`` and ``then``, namely that it does absolutely nothing functionally speaking.


assert
******

Finally, there is the keyword ``assert`` which also has a somewhat unusual operation.

To illustrate its operation, the following test will be used:

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

The previous test has a disadvantage in terms of maintenance, because if the developer needs to add one or more new calls to bar::doOtherThing() betweenthe  two calls already made, it will have to update the value of the argument passed to exactly().
To resolve this problem, you can reset a mock in 2 different ways:

* either by using $mock->getMockController()->resetCalls();
* or by using $this->resetMock($mock).

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

       // first way
       ->given($foo->getMockController()->resetCalls())
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()

       // 2nd way
       ->given($this->resetMock($foo))
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   ;

These methods erase the memory of the controller, so it's now possible to write the next assertion like if the mock was never used.

The keyword ``assert`` avoids the need for explicitcall to ``resetCalls()`` or ``esetMock`` and also it 'll erase the memory of adapters and mock's controllers defined at the time of  use.

Thanks to him, it's possible to write the previous test in a simpler and more readable way, especially as it is possible to pass a string to assert that explain the role of the following assertions:

.. code-block:: php

   <?php
   $this
       ->assert("Bar has no value")
           ->given($foo = new \mock\foo())
           ->and($bar = new bar($foo))
           ->if($bar->doSomething())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()

       ->assert('Bar has a value')
           ->if($bar->setValue(uniqid())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()
   ;

Moreover the given string will be included in the messages generated by atoum if one of the assertions is not successfull.


The loop mode
**************

When a developer doing TDD (test-driven development), it usually works as following:

# He start writing test corresponding to what he wants to develop ;
# then runs the test created;
# then writes the code to pass the test;
# then amends or complete his test and go back to step 2.

In practice, this means that he must:

* create its code in his favorite editor;
* exit the editor and then run its test in a console;
* return to his editor to write the code that enables the test to pass ;
* return to the console to restart its test execution;
* return to his publisher in order to amend or supplement its test;

There is therefore a cycle that will be repeated as long as the functionality haven't been developed entirely.

We can notice that, during this cycle, the developer must seize recurrently the same command in the terminal to run the unit tests.

atoum offers the available ``loop`` mode  via the arguments ``-l`` or ``--loop``, which allows the developer to not restart manually the test and thus to streamline the development process.

In this mode, atoum begins run once the tests that are requested.

Once the tests are complete, if tests successfully pass, atoum simply wait:

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


If the developer press the ``Enter`` key, atoum will reexecute the same test again, without any other action from the developer.

In the case where the code doesn't pass the tests successfully, i.e. If assertions fails or if there were errors or exceptions, atoum also start waiting:

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


If the developer press the ``Enter`` key, instead of replay the same tests again like if the tests have been passed successfully, atoum will only execute the tests that have failed, rather than replay them all.

The developer can pops issues and replay error tests as many times as necessary simply by pressing ``Enter``.

Moreover, once all failed tests pass again successfully, atoum will automatically run all of the test suite to detect any regressions introduced by the corrections made by the developer.

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


Of course, the ``loop`` mode will take only :ref:`the files with unit tests launch <fichiers-a-executer>` by atoum.


Debug mode
*************

Sometimes tests fail and it's hard to find why.

In this case, one of the techniques available to solve the problem is to trace the behavior of the concerned code, or directly inside the tested class using a debuger or a functions like ``var_dump()`` or ``print_r()``, or directly inside the unit test of the class.

atoum provides some tools to help you in this process, debugging directly in unit tests.

Those tools are only available when you run atoum and enable the debug mode using the``--debug`` command line argument, this is to avoid unexpected debug output when running in standard mode.
When the developer enables the debug mode (``--debug``), three methods can be used:

* ``dump()`` to dump the content of a variable;
* ``stop()`` to stop a running test;
* ``executeOnFailure()`` to set a closure to be executed when an assertion fails.

Those three method are accessible through the atoum fluent interface.


dump
====
The ``dump()`` method can be used as follows:

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->dump($foo->getBar())
   ;

When the test is running, the return of the method ``foo::getBar()`` will be displayed through the standard output.

It's also possible to pass several argments to ``dump()``, as the following way:

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
   The ``dump`` method is enabled only if you launch the tests with the ``--debug`` argument. Ontherwise, this method will be totally ignored.

stop
====

The ``stop()``method is also easy to use:

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->stop() // the test will stop here if --debug is used
           ->object($foo->getBar())
               ->isIdenticalTo($bar)
   ;

If ``--debug`` is used, the last two lines will not be executed.

.. important::
   The ``stop`` method is enabled only if you launch the tests with the ``--debug`` argument. Ontherwise, this method will be totally ignored.


executeOnFailure
================

The method ``executeOnFailure()`` is very powerfull and also simple to use.

Indeed it takes a closure in argument that will be executed if one of the assertions inside the test doesn't pass. It can be used as follows:

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

In the previous example, unlike ``dump()`` that  systematically causing the display to standard output of the contents of the variables that are passed as argument, the anonymous function passed as an argument will cause the display of the contents of the variable ``foo`` if one of the assertions is in failure.

Of course, it's possible to call several times ``executeOnFailure()`` in the same test method to defined several closure to be executed if the test fails.

.. important::
   The method ``executeOnFailure`` is enabled only if you run the tests with the argument ``--debug``. Ontherwise, this method will be totally ignored.


The initialization methods
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

It is therefore the responsibility of the programmer to overload when needed in the test classes concerned.


Fournisseurs de données (data provider)
***************************************

Pour vous aider à tester efficacement vos classes, atoum met à votre disposition des fournisseurs de données (data provider en anglais).

A data provider is a method in class test which generate arguments for et test method, arguments that will be used by the methode to validate assertions.

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


The mocking (mock) of native PHP functions
******************************************
atoum allow to easyly simulate the behavious of native PHP functions.

.. code-block:: php

   <?php
   
   $this
      ->assert('the file exist')
         ->given($this->newTestedInstance())
         ->if($this->function->file_exists = true)
         ->then
         ->object($this->testedInstance->loadConfigFile())
            ->isTestedInstance()
            ->function('file_exists')->wasCalled()->once()

      ->assert('le fichier does not exist')
         ->given($this->newTestedInstance())
         ->if($this->function->file_exists = false )
         ->then
         ->exception(function() { $this->testedInstance->loadConfigFile(); })
   ;

.. important::
   The \ is not allowed before any functions to simulate because atoum take the resolution mecanisme of PHP's namespace.
   
.. important::
   For the same reason, if a native function was already called before, his mocking will be without any effect.

.. code-block:: php

   <?php
   
   $this
      ->given($this->newTestedInstance())
      ->exception(function() { $this->testedInstance->loadConfigFile(); }) // the function file_exists and is called before is mocking
         
      ->if($this->function->file_exists = true ) // the mocking can tak the place of the native function file_exists
      ->object($this->testedInstance->loadConfigFile()) 
         ->isTestedInstance()
   ;

The annotations
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
