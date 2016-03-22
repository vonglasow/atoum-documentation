
.. _asserter:

assert
******

Finally, there is the keyword ``assert`` which also has a somewhat unusual operation.

To illustrate its operation, the following test will be used :

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

The previous test has a disadvantage in terms of maintenance, because if the developer needs to add one or more new calls to bar::doOtherThing() between the two calls already made, it will have to update the value of the argument passed to exactly().
To resolve this problem, you can reset a mock in 2 different ways :

* either by using $mock->getMockController()->resetCalls() ;
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

The keyword ``assert`` avoids the need for explicit all to ``resetCalls()`` or ``resetMock`` and also it will erase the memory of adapters and mock's controllers defined at the time of  use.

Thanks to it, it's possible to write the previous test in a simpler and more readable way, especially as it is possible to pass a string to assert that explain the role of the following assertions :

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

Moreover the given string will be included in the messages generated by atoum if one of the assertions is not successful.