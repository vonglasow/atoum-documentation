
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
