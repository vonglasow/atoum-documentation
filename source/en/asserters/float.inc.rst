.. _float-anchor:

float
*****

It's the assertion dedicated to decimal numbers.

If you try to test a variable that is not a decimal number with this assertion, it will fail.

.. note::
   ``null`` is not a decimal number. Refer to the PHP manual to know what `is_float <http://php.net/is_float>`_ considered or not as a float.


.. _float-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _float-is-greater-than:

isGreaterThan
=============

.. hint::
   ``isGreaterThan`` is a method inherited from the ``integer`` asserter.
   For more information, refer to the documentation of :ref:`integer::isGreaterThan <integer-is-greater-than>`


.. _float-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

.. hint::
   ``isGreaterThanOrEqualTo`` is a method inherited from the ``integer`` asserter.
   For more information, refer to the documentation of :ref:`integer::isGreaterThanOrEqualTo <integer-is-greater-than-or-equal-to>`


.. _float-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _float-is-less-than:

isLessThan
==========

.. hint::
   ``isLessThan`` is a method inherited from the ``integer`` asserter.
   For more informations, refer to the documentation of :ref:`integer::isLessThan <integer-is-less-than>`


.. _float-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

.. hint::
   ``isLessThanOrEqualTo`` is a method inherited from the ``integer`` asserter.
   For more information, refer to the documentation of :ref:`integer::isLessThanOrEqualTo <integer-is-less-than-or-equal-to>`


.. _is-nearly-equal-to:

isNearlyEqualTo
===============

``isNearlyEqualTo`` checks that the float is approximately equal to the value received as an argument.

Indeed, in computer science, decimal numbers are managed in a way that does not allow for accurate comparisons without the use of specialized tools. Try for example to run the following command:

.. code-block:: shell

   $ php -r 'var_dump(1 - 0.97 === 0.03);'
   bool(false)

The result should be "true".

.. note::
   For more information on this topics, read the PHP documentation on `the float precision <http://php.net/types.float>`_.


This method is therefore seeking to reduce this problem.

.. code-block:: php

   <?php
   $float = 1 - 0.97;

   $this
       ->float($float)
           ->isNearlyEqualTo(0.03) // passes
           ->isEqualTo(0.03)       // fails
   ;

.. note::
   For more information about the algorithm used, see the `floating point guide <http://www.floating-point-gui.de/errors/comparison/>`_.


.. _float-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _float-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _float-is-zero:

isZero
======

.. hint::
   ``isZero`` is a method inherited from the ``integer`` asserter.
   For more information, refer to the documentation of :ref:`integer::isZero <integer-is-zero>`
