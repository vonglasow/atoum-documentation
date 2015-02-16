.. _size-of:

sizeOf
******

It's the assertion dedicated to tests on the size of the arrays and objects implementing the interface ``Countable``.

.. code-block:: php

   <?php
   $array           = array(1, 2, 3);
   $countableObject = new GlobIterator('*');

   $this
       ->sizeOf($array)
           ->isEqualTo(3)

       ->sizeOf($countableObject)
           ->isGreaterThan(0)
   ;

.. _size-of-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _size-of-is-greater-than:

isGreaterThan
=============

.. hint::
   ``isGreaterThan`` is a method inherited from the ``integer`` asserter.
   For more informations, refer to the documentation of  :ref:```integer::isGreaterThan`` <integer-is-greater-than>`


.. _size-of-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

.. hint::
   ``isGreaterThanOrEqualTo`` is a method inherited from the ``integer`` asserter.
   For more information, refer to the documentation of :ref:```integer::isGreaterThanOrEqualTo`` <integer-is-greater-than-or-equal-to>`


.. _size-of-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _size-of-is-less-than:

isLessThan
==========

.. hint::
   ``isLessThan`` is a method inherited from the ``integer`` asserter.
   For more informations, refer to the documentation of  :ref:```integer::isLessThan`` <integer-is-less-than>`


.. _size-of-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

.. hint::
   ``isLessThanOrEqualTo`` is a method inherited from the ``integer`` asserter.
   For more information, refer to the documentation of :ref:```integer::isLessThanOrEqualTo`` <integer-is-less-than-or-equal-to>`


.. _size-of-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _size-of-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _size-of-is-zero:

isZero
======

.. hint::
   ``isZero`` is a method inherited from the ``integer`` asserter.
   For more informations, refer to the documentation of :ref:```integer::isZero`` <integer-is-zero>`
