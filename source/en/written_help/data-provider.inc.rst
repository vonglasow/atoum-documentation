
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


