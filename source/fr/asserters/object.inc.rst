.. _object-anchor:

object
******

It's the assertion dedicated to objects.

If you try to test a variable that is not an object with this assertion, it will fail.

.. note::
   ``null`` isn't an object. Refer to the PHP's manual `is_object <http://php.net/is_object>`_  to know what is considered as an object or not.


.. _object-has-size:

hasSize
=======

``hasSize`` checks the size of an object that implements the interface ``Countable``.

.. code-block:: php

   <?php
   $countableObject = new GlobIterator('*');

   $this
       ->object($countableObject)
           ->hasSize(3)
   ;

.. _object-is-callable:

isCallable
==========

.. code-block:: php

   <?php
   class foo
   {
       public function __invoke()
       {
           // code
       }
   }

   $this
       ->object(new foo)
           ->isCallable()  // passes

       ->object(new StdClass)
           ->isCallable()  // fails
   ;

.. note::
   To be identified as ``callable``, your objects should be instantiated from classes that implements the magic `__invoke <http://www.php.net/manual/fr/language.oop5.magic.php#object.invoke>`_.


.. hint::
   ``isCallable`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isCallable <variable-is-callable>`


.. _object-is-clone-of:

isCloneOf
=========

``isCloneOf`` checks an object is clone of a given one, that is the objects are equal but are not the same instance.

.. code-block:: php

   <?php
   $object1 = new \StdClass;
   $object2 = new \StdClass;
   $object3 = clone($object1);
   $object4 = new \StdClass;
   $object4->foo = 'bar';

   $this
       ->object($object1)
           ->isCloneOf($object2)   // passes
           ->isCloneOf($object3)   // passes
           ->isCloneOf($object4)   // fails
   ;

.. note::
   For more details, read the PHP's documentation about `comparing objects <http://php.net/language.oop5.object-comparison>`_.


.. _object-is-empty:

isEmpty
=======

``isEmpty`` checks the size of an object that implements the ``Countable`` interface is equal to 0.

.. code-block:: php

   <?php
   $countableObject = new GlobIterator('atoum.php');

   $this
       ->object($countableObject)
           ->isEmpty()
   ;

.. note::
   ``isEmpty`` is equivalent to ``hasSize(0)``.


.. _object-is-equal-to:

isEqualTo
=========

``isEqualTo`` checks that an object is equal to another.
Two objects are consider equals when they have the same attributes and values, and they are instances of the same class.

.. note::
   For more details, read the PHP's documentation about `comparing objects <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _object-is-identical-to:

isIdenticalTo
=============

``isIdenticalTo`` checks that two objects are identical.
Two objects are considered identical when they refer to the same instance of the same class.

.. note::
   For more details, read the PHP's documentation about `comparing objects <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _object-is-instance-of:

isInstanceOf
============
``isInstanceOf`` checks that an object is:

* an instance of the given class,
* a subclass from the given class (abstract or not),
* an instance of class that implements a given interface.

.. code-block:: php

   <?php
   $object = new \StdClass();

   $this
       ->object($object)
           ->isInstanceOf('\StdClass')     // passes
           ->isInstanceOf('\Iterator')     // fails
   ;


   interface FooInterface
   {
       public function foo();
   }

   class FooClass implements FooInterface
   {
       public function foo()
       {
           echo "foo";
       }
   }

   class BarClass extends FooClass
   {
   }

   $foo = new FooClass;
   $bar = new BarClass;

   $this
       ->object($foo)
           ->isInstanceOf('\FooClass')     // passes
           ->isInstanceOf('\FooInterface') // passes
           ->isInstanceOf('\BarClass')     // fails
           ->isInstanceOf('\StdClass')     // fails

       ->object($bar)
           ->isInstanceOf('\FooClass')     // passes
           ->isInstanceOf('\FooInterface') // passes
           ->isInstanceOf('\BarClass')     // passes
           ->isInstanceOf('\StdClass')     // fails
   ;

.. note::
   The name of the classes and the interfaces must be absolute, because any namespace imports are ignored.

.. hint::
   Notice that with PHP ``>= 5.5`` you can use the keyword ``class`` to get the absolute class names, for example ``$this->object($foo)->isInstanceOf(FooClass::class)``.


.. _object-is-not-callable:

isNotCallable
=============

.. code-block:: php

   <?php
   class foo
   {
       public function __invoke()
       {
           // code
       }
   }

   $this
       ->variable(new foo)
           ->isNotCallable()   // fails

       ->variable(new StdClass)
           ->isNotCallable()   // passes
   ;

.. hint::
   ``isNotCallable`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotCallable <variable-is-not-callable>`


.. _object-is-not-equal-to:

isNotEqualTo
============

``isEqualTo`` checks that an object is not equal to another.
Two objects are consider equals when they have the same attributes and values, and they are instance of the same class.

.. note::
   For more details, read the PHP's documentation about `comparing objects <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _object-is-not-identical-to:

isNotIdenticalTo
================

``isIdenticalTo`` checks the two objects are not identical.
Two objects are considered identical when they refer to the same instance of same class.

.. note::
   For more details, read the PHP's documentation about `comparing objects <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`
