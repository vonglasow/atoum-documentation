.. _boolean-anchor:

boolean
*******

This is the assertion dedicated to the booleans.

If you try to test a variable that is not a boolean with this assertion, this will fail.

.. note::
   ``null`` is not a boolean. Report the the PHP manual to know what `is_bool <http://php.net/is_bool>`_ considers or not to be a boolean.


.. _boolean-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _is-false:

isFalse
=======

``isFalse`` check that the boolean is strictly equal to ``false``.

.. code-block:: php

   <?php
   $true  = true;
   $false = false;

   $this
       ->boolean($true)
           ->isFalse()     // fails

       ->boolean($false)
           ->isFalse()     // succeed
   ;

.. _boolean-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _boolean-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _boolean-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _is-true:

isTrue
======

``isTrue`` vérifie que le booléen est strictement égal à ``true``.

.. code-block:: php

   <?php
   $true  = true;
   $false = false;

   $this
       ->boolean($true)
           ->isTrue()      // succeed

       ->boolean($false)
           ->isTrue()      // fails
   ;
