.. _class-anchor:

class
*****

It's the assertion dedicated to classes.

.. code-block:: php

   <?php
   $object = new \StdClass;

   $this
       ->class(get_class($object))

       ->class('\StdClass')
   ;

.. note::
   The keyword ``class`` is a reserved word in PHP, it wasn't possible to create a ``class`` asserter. It's therefore called ``phpClass`` and an alias ``class`` has been created. You can meet both ``->phpClass()`` or ``->class()``.


But it's recommended to only use ``->class()``.

.. _has-interface:

hasInterface
============

``hasInterface`` checks that the class implements a given interface.

.. code-block:: php

   <?php
   $this
       ->class('\ArrayIterator')
           ->hasInterface('Countable')     // passes

       ->class('\StdClass')
           ->hasInterface('Countable')     // fails
   ;

.. _has-method:

hasMethod
=========

``hasMethod`` checks that the class contains a given method.

.. code-block:: php

   <?php
   $this
       ->class('\ArrayIterator')
           ->hasMethod('count')    // passes

       ->class('\StdClass')
           ->hasMethod('count')    // fails
   ;

.. _has-no-parent:

hasNoParent
===========

``hasNoParent`` checks that the class doesn't  inherit from any class.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasNoParent()     // passes

       ->class('\FilesystemIterator')
           ->hasNoParent()     // fails
   ;

.. warning::
   | A class can implement one or more interfaces, and inherit from no class.
   | ``hasNoParent`` doesn't check interfaces, only the inherited classes.


.. _has-parent:

hasParent
=========

``hasParent`` checks that the class inherits from a given class.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasParent()       // fails

       ->class('\FilesystemIterator')
           ->hasParent()       // passes
   ;

.. warning::
   | A class can implement one or more interfaces, and inherit from no class.
   | ``hasParent`` doesn't check interfaces, only the inherited classes.


.. _is-abstract:

isAbstract
==========

``isAbstract`` checks that the class is abstract.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->isAbstract()       // fails
   ;

.. _is-subclass-of:

isSubclassOf
============

``isSubclassOf`` checks that the class inherit from the given class.

.. code-block:: php

   <?php
   $this
       ->class('\FilesystemIterator')
           ->isSubclassOf('\DirectoryIterator')    // passes
           ->isSubclassOf('\SplFileInfo')          // passes
           ->isSubclassOf('\StdClass')             // fails
   ;
