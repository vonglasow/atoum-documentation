.. _array-anchor:

array
*****

It's the assertion dedicated to arrays.

.. note::
   ``array`` is a reserved word in PHP, it hasn't been possible to create an ``array`` assertion. It's therefore called ``phpArray`` and an alias ``array`` was created. So, you can meet either``->phpArray()`` or ``->array()``.


It's recommended to use only ``->array()`` in order to simplify the reading of tests.


.. _sucre-syntaxique:

Syntactic sugar
=================

In order to simplify the writing of tests with arrays, some syntactic sugar is available. It allows to make various assertions directly on the keys of the tested array.

.. code-block:: php

	$a = [
		'foo' => 42,
		'bar' => '1337' 
	];

	$this
		->array($a)
			->integer['foo']->isEqualTo(42)
			->string['bar']->isEqualTo('1337')
	;

.. note::
   This writing form is available from PHP 5.4.


.. _array-contains:

contains
========

``contains`` check that array contains some data.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->contains('1')     // succeed
           ->contains(1)       // succeed, but data type...
           ->contains('2')     // ... is not checked
           ->contains(10)      // failed
   ;

.. note::
   ``contains`` doesn't check recursively.


.. warning::
   | ``contains`` doesn't check the data type.
   | If you want also to check its type, use :ref:`strictlyContains <strictly-contains>`.


.. _contains-values:

containsValues
==============

``containsValues`` checks that an array contains all data from a given array.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->containsValues(array(1, 2, 3))        // succeed
           ->containsValues(array('5', '8', '13')) // succeed
           ->containsValues(array(0, 1, 2))        // failed
   ;

.. note::
   ``containsValues`` doesn't search recursively.


.. warning::
   | ``containsValues`` doesn't test data type.
   | If you  also want to check their types, use :ref:`strictlyContainsValues <strictly-contains-values>`.


.. _has-key:

hasKey
======

``hasKey`` check that the table contains a given key.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'        => 'atoum',
       'owner'       => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->hasKey(0)         // passes
           ->hasKey(1)         // passes
           ->hasKey('1')       // passes
           ->hasKey(10)        // failed

       ->array($atoum)
           ->hasKey('name')    // passes
           ->hasKey('price')   // fails
   ;

.. note::
   ``hasKey`` doesn't search recursively.


.. warning::
   ``hasKey`` doesn't test the key type.


.. _has-keys:

hasKeys
=======

``hasKeys`` checks that an array contains all given keys.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'        => 'atoum',
       'owner'       => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->hasKeys(array(0, 2, 4))           // passes
           ->hasKeys(array('0', 2))            // passes
           ->hasKeys(array('4', 0, 3))         // passes
           ->hasKeys(array(0, 3, 10))          // fails

       ->array($atoum)
           ->hasKeys(array('name', 'owner'))   // passes
           ->hasKeys(array('name', 'price'))   // fails
   ;

.. note::
   ``hasKeys`` doesn't search recursively.


.. warning::
   ``hasKeys`` doesn't test the keys type.


.. _array-has-size:

hasSize
=======

``hasSize`` checks the size of an array.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->hasSize(7)        // passes
           ->hasSize(10)       // fails
   ;

.. note::
   ``hasSize`` is not recursive.


.. _array-is-empty:

isEmpty
=======

``isEmpty`` checks that an array is empty.

.. code-block:: php

   <?php
   $emptyArray    = array();
   $nonEmptyArray = array(null, null);

   $this
       ->array($emptyArray)
           ->isEmpty()         // passes

       ->array($nonEmptyArray)
           ->isEmpty()         // fails
   ;

.. _array-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _array-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _array-is-not-empty:

isNotEmpty
==========

``isNotEmpty`` checks that an array is not empty.

.. code-block:: php

   <?php
   $emptyArray    = array();
   $nonEmptyArray = array(null, null);

   $this
       ->array($emptyArray)
           ->isNotEmpty()      // fails

       ->array($nonEmptyArray)
           ->isNotEmpty()      // passes
   ;

.. _array-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _array-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _keys-anchor:

keys
====

``keys`` allows you to retrieve an asserter :ref:`array <array-anchor>` containing the tested table keys.

.. code-block:: php

   <?php
   $atoum = array(
       'name'  => 'atoum',
       'owner' => 'mageekguy',
   );

   $this
       ->array($atoum)
           ->keys
               ->isEqualTo(
                   array(
                       'name',
                       'owner',
                   )
               )
   ;

.. _array-not-contains:

notContains
===========

``notContains`` checks that an array doesn't contains a given data.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->notContains(null)         // passes
           ->notContains(1)            // fails
           ->notContains(10)           // passes
   ;

.. note::
   ``notContains`` doesn't search recursively.


.. warning::
   | ``notContains`` doesn't check the data type.
   | If you want also to check its type, use :ref:`strictlyNotContains <strictly-not-contains>`.


.. _not-contains-values:

notContainsValues
=================

``notContainsValues`` checks that an array doesn't contains any data from a given array.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->notContainsValues(array(1, 4, 10))    // fails
           ->notContainsValues(array(4, 10, 34))   // passes
           ->notContainsValues(array(1, '2', 3))   // fails
   ;

.. note::
   ``notContainsValues`` doesn't search recursively.


.. warning::
   | ``notContainsValues`` doesn't test the data type.
   | If you  also want to check their types, use :ref:`strictlyNotContainsValues <strictly-not-contains-values>`.


.. _not-has-key:

notHasKey
=========

``notHasKey`` checks that an array doesn't contains a given key.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'  => 'atoum',
       'owner' => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->notHasKey(0)          // fails
           ->notHasKey(1)          // fails
           ->notHasKey('1')        // fails
           ->notHasKey(10)         // passes

       ->array($atoum)
           ->notHasKey('name')     // fails
           ->notHasKey('price')    // passes
   ;

.. note::
   ``notHasKey`` doesn't search recursively.


.. warning::
   ``notHasKey`` doesn't test keys type.


.. _not-has-keys:

notHasKeys
==========

``notHasKeys`` checks that an array doesn't contains any keys from a given array.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'        => 'atoum',
       'owner'       => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->notHasKeys(array(0, 2, 4))            // fails
           ->notHasKeys(array('0', 2))             // fails
           ->notHasKeys(array('4', 0, 3))          // fails
           ->notHasKeys(array(10, 11, 12))         // passes

       ->array($atoum)
           ->notHasKeys(array('name', 'owner'))    // fails
           ->notHasKeys(array('foo', 'price'))     // passes
   ;

.. note::
   ``notHasKeys`` doesn't search recursively.


.. warning::
   ``notHasKeys`` doesn't test keys type.


.. _size-anchor:

size
====

``size`` allow you to retrieve an  :ref:`integer <integer-anchor>` containing the size of tested array.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->size
               ->isGreaterThan(5)
   ;

.. _strictly-contains:

strictlyContains
================

``strictlyContains`` checks that an array contains some data (same value and same type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->strictlyContains('1')     // passes
           ->strictlyContains(1)       // fails
           ->strictlyContains('2')     // fails
           ->strictlyContains(2)       // passes
           ->strictlyContains(10)      // fails
   ;

.. note::
   ``strictlyContains`` doesn't search recursively.


.. warning::
   | ``strictlyContains`` test data type.
   | If you don't want to check the type, use :ref:`contains <array-contains>`.


.. _strictly-contains-values:

strictlyContainsValues
======================

``strictlyContainsValues`` checks that an array contains all given data (same value and same type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->strictlyContainsValues(array('1', 2, '3'))    // passes
           ->strictlyContainsValues(array(1, 2, 3))        // fails
           ->strictlyContainsValues(array(5, '8', 13))     // passes
           ->strictlyContainsValues(array('5', '8', '13')) // fails
           ->strictlyContainsValues(array(0, '1', 2))      // fails
   ;

.. note::
   ``strictlyContainsValue`` doesn't search recursively.


.. warning::
   | ``strictlyContainsValues`` test data type.
   | If you don't want to check the types, use :ref:`containsValues <contains-values>`.


.. _strictly-not-contains:

strictlyNotContains
===================

``strictlyNotContains`` check that an array doesn't contains a data (same value and same type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->strictlyNotContains(null)         // passes
           ->strictlyNotContains('1')          // fails
           ->strictlyNotContains(1)            // passes
           ->strictlyNotContains(10)           // passes
   ;

.. note::
   ``strictlyNotContains`` doesn't search recursively.


.. warning::
   | ``strictlyNotContains`` test data type.
   | If you don't want to check the type, use :ref:`contains <array-not-contains>`.


.. _strictly-not-contains-values:

strictlyNotContainsValues
=========================

``strictlyNotContainsValues`` checks that an array doesn't contains any of given data (same value and same type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->strictlyNotContainsValues(array('1', 4, 10))  // fails
           ->strictlyNotContainsValues(array(1, 4, 10))    // passes
           ->strictlyNotContainsValues(array(4, 10, 34))   // passes
           ->strictlyNotContainsValues(array('1', 2, '3')) // fails
           ->strictlyNotContainsValues(array(1, '2', 3))   // passes
   ;

.. note::
   ``strictlyNotContainsValues`` doesn't search recursively.


.. warning::
   | ``strictlyNotContainsValues`` tests data type.
   | If you don't want to check the types, use :ref:`notContainsValues <not-contains-values>`.
