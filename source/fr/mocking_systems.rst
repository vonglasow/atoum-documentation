.. _mocking_systems:

Mocking systems
#########################

TODO get mock parts from everywhere + add stuff from issues



.. _les-bouchons-mock:

Les bouchons (mock)
*******************

atoum dispose d'un système de bouchonnage (mock en anglais) puissant et simple à mettre en œuvre qui vous permettra de générer des mocks à partir de classes (existantes, inexistantes, abstraites ou non) ou d'interfaces. Grâce à ces bouchons, vous pourrez simuler des comportements en redéfinissant les méthodes publiques de vos classes.


Générer un bouchon
===============

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

La méthode ``generate`` prend trois paramètres :

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


Shunt calls to parent methods
-----------------------------

A mock inherits from the class from which it was generated, its methods therefore behave exactly the same way.

In some cases, it may be useful to shunt calls to parent methods so that their code is not run. The ``mockGenerator`` offers several methods to achieve this :

.. code-block:: php

   <?php
   // The mock will not call the parent class
   $this->mockGenerator->shuntParentClassCalls();

   $mock = new \mock\OneClass;

   // the mock will again call the parent class
   $this->mockGenerator->unshuntParentClassCalls();

Here, all mock methods will behave as if they had no implementation however they will keep the signature of the original methods. You can also specify the methods you want to shunt :

.. code-block:: php

   <?php
   // the mock will not call the parent class for the method firstMethod…...
   $this->mockGenerator->shunt('firstMethod');
   // ... nor for the method secondMethod
   $this->mockGenerator->shunt('secondMethod');

   $countableMock = new \mock\OneClass;


Make an orphan method
---------------------

It may be interesting to make an orphan method, that is, give him a signature and implementation empty. This can be particularly useful for generating mocks without having to instantiate all their dependencies.

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

   // We can instantiate the mock without injecting dependencies
   $mock = new \mock\SecondClass();

   $object = new FirstClass($mock);


Modify the behavior of a mock
=============================

Once the mock created and instantiated, it is often useful to be able to change the behaviour of its methods.

To do this, you must use its controller using one of the following methods:

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   $mockDbClient->getMockController()->connect = function() {};
   // Equivalent to
   $this->calling($mockDbClient)->connect = function() {};

The ``mockController`` allows you to redefine **only public and abstract protected methods** and puts at your disposal several methods :

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   // Redefine the method connect: it will always return true
   $this->calling($mockDbClient)->connect = true;

   // Redefine the method select: it will execute the given anonymous function
   $this->calling($mockDbClient)->select = function() {
       return array();
   };

   // redefine the method query with arguments
   $result = array();
   $this->calling($mockDbClient)->query = function(Query $query) use($result) {
       switch($query->type) {
           case Query::SELECT:
               return $result

           default;
               return null;
       }
   };

   // the method connect will throw an exception
   $this->calling($mockDbClient)->connect->throw = new \Database\Client\Exception();

.. note::
   The syntax uses anonymous functions (also called closures) introduced in PHP 5.3. Refer to `PHP manual <http://php.net/functions.anonymous>`__ for more information on the subject.

As you can see, it is possible to use several methods to get the desired behaviour:

* Use a static value that will be returned by the method
* Use a short implementation thanks to anonymous functions of PHP
* Use the ``throw`` keyword to throw an exception

You can also specify multiple values based on the order of call:

.. code-block:: php

   <?php
   // default
   $this->calling($mockDbClient)->count = rand(0, 10);
   // equivalent to
   $this->calling($mockDbClient)->count[0] = rand(0, 10);

   // 1st call
   $this->calling($mockDbClient)->count[1] = 13;

   // 3rd call
   $this->calling($mockDbClient)->count[3] = 42;

* The first call will return 13.
* The second will be the default behavior, it means a random number.
* The third call will return 42.
* All subsequent calls will have the default behaviour, i.e. random numbers.

If you want several methods of the mock have the same behavior, you can use the `methods`_ or `methodsMatching`_.


methods
-------

``methods`` allows you, thanks to the anonymous function passed as an argument, to define to what methods the behaviour must be modified :

.. code-block:: php

   <?php
   // if the method has such and such name,
   // we redefines its behavior
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

   // we redefines the behavior of all methods
   $this
       ->calling($mock)
           ->methods()
               ->return = null
   ;

   // if the method begins by "get",
   // we redefines its behavior
   $this
       ->calling($mock)
           ->methods(
               function($method) {
                   return substr($method, 0, 3) == 'get';
               }
           )
               ->return = uniqid()
   ;


In the last example, you should instead use `methodsMatching`_.

.. note::
   The syntax uses anonymous functions (also called closures) introduced in PHP 5.3. Refer to `PHP manual <http://php.net/functions.anonymous>`__ for more information on the subject.


methodsMatching
-----------------

``methodsMatching`` allows you to set the methods where the behaviour must be modified using the regular expression passed as an argument :

.. code-block:: php

   <?php
   // if the method begins by "is",
   // we redefines its behavior
   $this
       ->calling($mock)
           ->methodsMatching('/^is/')
               ->return = true
   ;

   // if the method starts by "get" (case insensitive),
   // we redefines its behavior
   $this
       ->calling($mock)
           ->methodsMatching('/^get/i')
               ->throw = new \exception
   ;

.. note::
   ``methodsMatching`` use `preg_match <http://php.net/preg_match>`_ and regular expressions. Refer to the `PHP manual <http://php.net/pcre>`__ for more information on the subject.


Particular case of the constructor
==================================

To mock class constructor, you need:

* create an instance of \atoum\mock\controller class before you call the constructor of the mock ;
* set via this control the behaviour of the constructor of the mock using an anonymous function ;
* inject the controller during the instantiation of the mock in the last argument.

.. code-block:: php

   <?php
   $controller = new \atoum\mock\controller();
   $controller->__construct = function() {};

   $mockDbClient = new \mock\Database\Client(DB_HOST, DB_USER, DB_PASS, $controller);


Test mock
=========

atoum lets you verify that a mock was used properly.

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();
   $mockDbClient->getMockController()->connect = function() {};
   $mockDbClient->getMockController()->query   = array();

   $bankAccount = new \Vendor\Project\Bank\Account();
   $this
       // use of the mock via another object
       ->array($bankAccount->getOperations($mockDbClient))
           ->isEmpty()

       // test of the mock
       ->mock($mockDbClient)
           ->call('query')
               ->once() // check that the query method
                               // has been called only once
   ;

.. note::
   Refer to the documentation on the :ref:`mock-asserter` for more information on testing mocks.


The mocking (mock) of native PHP functions
**************************************************

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
   The \\ is not allowed before any functions to simulate because atoum take the resolution mechanism of PHP's namespace.

.. important::
   For the same reason, if a native function was already called before, his mocking will be without any effect.

.. code-block:: php

   <?php

   $this
      ->given($this->newTestedInstance())
      ->exception(function() { $this->testedInstance->loadConfigFile(); }) // the function file_exists and is called before is mocking

      ->if($this->function->file_exists = true ) // the mocking can take the place of the native function file_exists
      ->object($this->testedInstance->loadConfigFile())
         ->isTestedInstance()
   ;
