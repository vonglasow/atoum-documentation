
.. _le-mode-debug:

Debugging test cases
##########################

Sometimes tests fail and it's hard to find why.

In this case, one of the techniques available to solve the problem is to trace the behaviour of the concerned code, or directly inside the tested class using a debugger or a functions like ``var_dump()`` or ``print_r()``, or directly inside the unit test of the class.

atoum provides some tools to help you in this process, debugging directly in unit tests.

Those tools are only available when you run atoum and enable the debug mode using the``--debug`` command line argument, this is to avoid unexpected debug output when running in standard mode.
When the developer enables the debug mode (``--debug``), three methods can be used:

* ``dump()`` to dump the content of a variable ;
* ``stop()`` to stop a running test ;
* ``executeOnFailure()`` to set a closure to be executed when an assertion fails.

Those three method are accessible through the atoum fluent interface.

.. _dump:

dump
****

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

It's also possible to pass several arguments to ``dump()``, as the following way :

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
   The ``dump`` method is enabled only if you launch the tests with the ``--debug`` argument. Otherwise, this method will be totally ignored.

.. _stop:

stop
****

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
   The ``stop`` method is enabled only if you launch the tests with the ``--debug`` argument. Otherwise, this method will be totally ignored.


.. _executeOnFailure:

executeOnFailure
****************

The method ``executeOnFailure()`` is very powerful and also simple to use.

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
   The method ``executeOnFailure`` is enabled only if you run the tests with the argument ``--debug``. Otherwise, this method will be totally ignored.

