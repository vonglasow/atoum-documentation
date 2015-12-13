Writing help
#################

.. include:: written_help/given-if-and-then.inc.rst
.. include:: written_help/asserter.inc.rst
.. include:: written_help/newTestedInstance.inc.rst
.. include:: written_help/mode-loop.inc.rst
.. include:: written_help/mode-debug.inc.rst
.. include:: written_help/initialization_method.inc.rst
.. include:: written_help/data-provider.inc.rst
.. include:: written_help/mocks.inc.rst
.. include:: written_help/engine.inc.rst

There are several ways to write unit test with atoum, one of them is to use keywords like ``given``, ``if``, ``and`` and even ``then``, ``when``  or ``assert`` so you can structure the tests, making them more readable.

.. _given-if-and-then:

``given``, ``if``, ``and`` and ``then``
****************************************

You can use these keywords very intuitively:

.. code-block:: php

   <?php
   $this
       ->given($computer = new computer())
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

As a result, the developer has to use the keywords wisely in order to make the test as readable as possible. Wrongly used, you could end up with tests written like the following:

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

Notice that you can write the exact same test without using any of the previous keywords:

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

.. _when:

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

.. _asserter:

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

.. _newTestedInstance:

newTestedInstance & testedInstance
********************************************

When performing tests, we must often create a new instance of the class and pass it through parameters. Writing helper are available for this specific case, it's ``newTestedInstance`` and ``testedInstance``

Here's an example :

.. code-block:: php

   namespace jubianchi\atoum\preview\tests\units;
   
   use atoum;
   use jubianchi\atoum\preview\foo as testedClass;
   
   class foo extends atoum
   {
       public function testBar()
       {
           $this
               ->if($foo = new testedClass())
               ->then
                   ->object($foo->bar())->isIdenticalTo($foo)
           ;
       }
   }

This can be simplified with a new syntax:

.. code-block:: php

   namespace jubianchi\atoum\preview\tests\units;
   
   use atoum;
   
   class foo extends atoum
   {
       public function testBar()
       {
           $this
               ->if($this->newTestedInstance)
               ->then
                   ->object($this->testedInstance->bar())
                       ->isTestedInstance()
           ;
       }
   }


As seen, it's slightly simpler but especially this has two advantages:

* We are not manipulate the name of the tested class
* We are not manipulate the tested instance

Furthermore, we can easily validate that the instance is available with "isTestedInstance", as explained in the previous example.

To pass some arguments to the constructor, it's easy through "newTestedInstance":

.. code-block:: php

   $this->newTestedInstance($argument1, $argument2)


If you want to test a static method of your class, you can retrieve the tested class with this syntax:

.. code-block::
   namespace jubianchi\atoum\preview\tests\units;
   
   use atoum;
   
   class foo extends atoum
   {
       public function testBar()
       {
         $this
           ->if($class = $this->testedClass->getClass())
           ->then
             ->object($class::bar())
  ```


.. _mode-loop:

The loop mode
****************

When a developer doing TDD (test-driven development), it usually works as following:

# He start writing test corresponding to what he wants to develop ;
# then runs the test created;
# then writes the code to pass the test;
# then amends or complete his test and go back to step 2.

In practice, this means that he must:

* create its code in his favourite editor;
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

.. _le-mode-debug:

The debug mode
******************

Sometimes tests fail and it's hard to find why.

In this case, one of the techniques available to solve the problem is to trace the behavior of the concerned code, or directly inside the tested class using a debuger or a functions like ``var_dump()`` or ``print_r()``, or directly inside the unit test of the class.

atoum provides some tools to help you in this process, debugging directly in unit tests.

Those tools are only available when you run atoum and enable the debug mode using the``--debug`` command line argument, this is to avoid unexpected debug output when running in standard mode.
When the developer enables the debug mode (``--debug``), three methods can be used :

* ``dump()`` to dump the content of a variable;
* ``stop()`` to stop a running test;
* ``executeOnFailure()`` to set a closure to be executed when an assertion fails.

Those three method are accessible through the atoum fluent interface.

.. _dump:

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

It's also possible to pass several arguments to ``dump()``, as the following way:

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

.. _stop:

stop
====

The ``stop()`` method is also easy to use:

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


.. _executeOnFailure:

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


.. _initialization_method:

The initialization methods
*****************************

Here is the process, when atoum executes the test methods of a class with the default engine (``concurrent``):

#. call of the ``setUp()`` method from the tested class;
#. launch of a PHP sub-process for **each test method**;
#. in the PHP sub-process, call of the ``beforeTestMethod()`` method of the test class;
#. in the PHP sub-process, call of the test method;
#. in the PHP sub-process, call of the ``afterTestMethod()`` method of the test class;
#. once the PHP sub-process finished, call of the ``tearDown()`` method from thze test class.

.. note::
   For more information on the execution engine of test in atoum, you can read the section about the annotation `@engine`_.

The methods ``setUp()`` and ``tearDown()`` allow respectively to initialize and clean up the test environment for all the test method of the running class.

The methods ``beforeTestMethod()`` and ``afterTestMethod()`` allows respectively to initialize and clean up the execution environment of the individual tests for all test method of the class. Since they are executed in the same subprocess, in contrast of ``setUp()`` and ``tearDown()``.

It's also the reason why the methods  ``beforeTestMethod()`` and ``afterTestMethod()`` accept as argument the name of the test method executed, in order to adjust the treatment accordingly.

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
           // Executed *before all* test methods.
           // global initialization.
       }

       public function beforeTestMethod($method)
       {
           // Executed *before each* test method.

           switch ($method)
           {
               case 'testGetOwner':
                   // Initialization for testGetOwner().
               break;

               case 'testGetOperations':
                   // Initialization for testGetOperations().
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
           // Executed *after each* test method.

           switch ($method)
           {
               case 'testGetOwner':
                   // Cleaning for testGetOwner().
               break;

               case 'testGetOperations':
                   // Cleaning for testGetOperations().
               break;
           }
       }

       public function tearDown()
       {
           // Executed after all the test methods.
           // Overall cleaning.
       }
   }

By default, the ``setUp()``, ``beforeTestMethod()``, ``afterTestMethod()`` and ``tearDown()`` methods does absolutely nothing.

It is therefore the responsibility of the programmer to overload when needed in the test classes concerned.

.. _data-provider:

Data providers
***************************************

To help you to effectively test your classes, atoum puts data providers at your disposal.

A data provider is a method in class test which generate arguments for et test method, arguments that will be used by the methode to validate assertions.

If a test method ``testFoo`` takes arguments and no annotation on a data provider is set, atoum will automatically seek the protected ``testFooDataProvider`` method.

However, you can manually set the method name of the data provider through the ``@dataProvider`` annotation applied to the relevant test method, as follows:

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

Of course, do not forget to define, at the level of the test method, the arguments that correspond to those that will be returned by the data provider. If not, atoum will generate an error when running the tests.

The data provider method is a single protected method that returns an array or an iterator containing data:

.. code-block:: php

   <?php
   class calculator extends atoum
   {
       ...

       // Provides data for testSum().
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

When running the tests, atoum will call test method ``testSum()`` with the arguments ``(1, 1)``, ``(1, 2)``, ``(-1, 1)`` and ``(-1, 2)`` returned by the method ``sumDataProvider()``.

.. warning::
   The insulation of the tests will not be used in this context, which means that each successive call to the method ``testSum()`` will be realized in the same PHP process.



.. _les-bouchons-mock:

The mocks
*******************

atoum has a powerful mock system and easy-to-implement allowing you to generate mocks from (existing, nonexistent, abstract or not) classes or interfaces. With these mocks, you can simulate behaviors by redefining the public methods of your classes.


Generate a mock
==================

There are several ways to create a mock from an interface or a class.

The simplest is to create an object with the absolute name is prefixed by "mock":

.. code-block:: php

   <?php
   // creation of a mock of the interface \Countable
   $countableMock = new \mock\Countable;

   // creation of a mock from the abstract class
   // \Vendor\Project\AbstractClass
   $vendorAppMock = new \mock\Vendor\Project\AbstractClass;

   // creation of mock of the \StdClass class
   $stdObject     = new \mock\StdClass;

   // creation of a mock from a non-existing class
   $anonymousMock = new \mock\My\Unknown\Class;


The mock generator
========================

atoum relies on a specialized component to generate the mock: the ``mockGenerator``. You have access to the latter in your tests in order to modify the procedure for generation of the mocks.

By default, the mock will be generated in the "mock" namespace and behave exactly in the same way as instances of the original class (mock inherits directly from the original class).


Change the name of the class
-----------------------------

If you wish to change the name of the class or its namespace, you must use the ``mockGenerator``.

Its method ``generate`` takes 3 parameters :

* the name of the interface or class to mock;
* the new namespace, optional;
* the new name of class, optional.

.. code-block:: php

   <?php
   // creation of a mock of the interface \Countable to \MyMock\Countable
   We only changes the namespace
   $this->mockGenerator->generate('\Countable', '\MyMock');

   // creation of a mock from the abstract class
   // \Vendor\Project\AbstractClass to \MyMock\AClass
   // change the namespace and class name
   $this->mockGenerator->generate('\Vendor\Project\AbstractClass', '\MyMock', 'AClass');

   // creation of a mock of \StdClass to \mock\OneClass
   // We only changes the name of the class
   $this->mockGenerator->generate('\StdClass', null, 'OneClass');

   We can now instantiate these mocks
   $vendorAppMock = new \myMock\AClass;
   $countableMock = new \myMock\Countable;
   $stdObject     = new \mock\OneClass;

.. note::
   If you use only the first argument and do not change the namespace or the name of the class, then the first solution is equivalent, easiest to read and recommended.
   
.. note::
   You can access to the code from the class generated by the mock generator by calling ``$this->mockGenerator->getMockedClassCode()``, in order to debug, for example. This method takes the same arguments as the method ``generate``.

.. code-block:: php

   <?php
   $countableMock = new \mock\Countable;

   // is equivalent to:

   $this->mockGenerator->generate('\Countable');   // useless
   $countableMock = new \mock\Countable;


Shunt calls to parent methods
----------------------------------------

A mock inherits from the class from which it was generated, its methods therefore behave exactly the same way.

In some cases, it may be useful to shunt calls to parent methods so that their code is not run. The ``mockGenerator`` offers several methods to achieve this:

.. code-block:: php

   <?php
   // The mock will not call the parent class
   $this->mockGenerator->shuntParentClassCalls();

   $mock = new \mock\OneClass;

   // the mock will again call the parent class
   $this->mockGenerator->unshuntParentClassCalls();

Here, all mock methods will behave as if they had no implementation however they will keep the signature of the original methods. You can also specify the methods you want to shunt:

.. code-block:: php

   <?php
   // the mock will not call the parent class for the method firstMethod…
   $this->mockGenerator->shunt('firstMethod');
   // ... nor for the method secondMethod
   $this->mockGenerator->shunt('secondMethod');

   $countableMock = new \mock\OneClass;


Make an orphan method
----------------------------

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
=====================================

Once the mock created and instantiated, it is often useful to be able to change the behavior of its methods.

To do this, you must use its controller using one of the following methods:

.. code-block:: php

   <?php
   $mockDbClient = new \mock\Database\Client();

   $mockDbClient->getMockController()->connect = function() {};
   // Equivalent to
   $this->calling($mockDbClient)->connect = function() {};

The ``mockController`` allows you to redefine **only public and abstract methods protected** and puts at your disposal several methods:

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

As you can see, it is possible to use several methods to get the desired behavior:

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
* All subsequent calls will have the default behavior, i.e. random numbers.

If you want several methods of the mock have the same behavior, you can use the `methods`_ or `methodsMatching`_.


methods
-------

``methods`` allows you, thanks to the anonymous function passed as an argument, to define to what methods the behavior must be modified:

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


In the case of the last example, you should instead use `methodsMatching`_.

.. note::
   The syntax uses anonymous functions (also called closures) introduced in PHP 5.3. Refer to `PHP manual <http://php.net/functions.anonymous>`__ for more information on the subject.


methodsMatching
--------------------------------

``methodsMatching`` allows you to set the methods where the behavior must be modified using the regular expression passed as an argument:

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
===================================

To mock the constructor of a class, you need:

* create an instance of the \atoum\mock\controller class before you call the constructor of the mock;
* set via this control the behavior of the constructor of the mock using an anonymous function;
* inject the controller during the instantiation of the mock in the last argument.

.. code-block:: php

   <?php
   $controller = new \atoum\mock\controller();
   $controller->__construct = function() {};

   $mockDbClient = new \mock\Database\Client(DB_HOST, DB_USER, DB_PASS, $controller);


Test mock
=================

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
   The \\ is not allowed before any functions to simulate because atoum take the resolution mechanism of PHP's namespace.
   
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


.. _@engine:

Execution engine
***********************

Several execution engines to run the tests (at the level of the class or methods) are available. These are configurable via the annotation ``@engine``. By default, the different tests run in parallel in sub-processes of PHP, this is the ``concurrent`` mode.

Currently, there is three execution modes:
* *inline*: tests run in the same process, this is the same behaviour as PHPUnit. Although this mode is very fast, there's no insulation of the tests.
* *isolate*: tests run sequentially in a subprocess of PHP. This form of execution is quite slow.
* *concurrent*: the default mode, the tests run in parallel, in PHP sub-processes. 

Here's an example :

.. code-block:: php

  <?php
  
  /**
   * @engine concurrent
   */
  class Foo extends \atoum
  {
  	public function testBarWithBaz()
  	{
  		sleep(1);
  		$this->newTestedInstance;
  		$baz = new \Baz();
  		$this->object($this->testedInstance->setBaz($baz))
  			->isIdenticalTo($this->testedInstance);
  			
  		$this->string($this->testedInstance->bar())
  			->isIdenticalTo('baz');
  	}
  	
  	public function testBarWithoutBaz()
  	{
  		sleep(1);
  		$this->newTestedInstance;
  		$this->string($this->testedInstance->bar())
  			->isIdenticalTo('foo');
  	}
  }

In ``concurent`` mode:

.. code-block:: shell

=> Test duration: 2.01 seconds.
=> Memory usage: 0.50 Mb.
> Total test duration: 2.01 seconds.
> Total test memory usage: 0.50 Mb.
> Running duration: 1.08 seconds.


In ``inline`` mode:

.. code-block:: shell

=> Test duration: 2.01 seconds.
=> Memory usage: 0.25 Mb.
> Total test duration: 2.01 seconds.
> Total test memory usage: 0.25 Mb.
> Running duration: 2.01 seconds.


In ``isolate`` mode:

.. code-block:: shell

=> Test duration: 2.00 seconds.
=> Memory usage: 0.50 Mb.
> Total test duration: 2.00 seconds.
> Total test memory usage: 0.50 Mb.
> Running duration: 2.10 seconds.

