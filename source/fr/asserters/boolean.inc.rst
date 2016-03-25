.. _boolean-anchor:

boolean
*******

This is the assertion dedicated to booleans.

Si vous essayez de tester une variable qui n'est pas un booléen avec cette assertion, cela échouera.

.. note::
   ``null`` is not a boolean. Reportez-vous au manuel de PHP pour savoir ce que `is_bool <http://php.net/is_bool>`_ considère ou non comme un booléen.


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
   ``isIdenticalTo`` is a method inherited from ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _boolean-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _boolean-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from ``variable`` asserter.
   For more information, refer to the documentation of  :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _is-true:

isTrue
======

``isTrue`` checks that the boolean is strictly equal to ``true``.

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
