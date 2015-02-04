.. _after-destruction-of:

afterDestructionOf
******************

It's the assertion that is dedicated to object's destruction.

This assertion verify that the given object is valid and check that the ``__destruct()`` method is well-defined then invokes it.

If ``__destruct()`` exists and if his call goes without any error or exception, then the test succeed.

.. code-block:: php

   <?php
   $this
       ->afterDestructionOf($objectWithDestructor)     // succeed
       ->afterDestructionOf($objectWithoutDestructor)  // fails
   ;
