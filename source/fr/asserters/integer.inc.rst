.. _integer-anchor:

integer
*******

It's the assertion dedicated to integers.

If you try to test a variable that is not an integer with this assertion, it will fail.

.. note::
   ``null`` isn't an integer. Refer to the PHP's manual  `is_int <http://php.net/is_int>`_ to known what's considered as an integer or not.


.. _integer-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _integer-is-greater-than:

isGreaterThan
=============

``isGreaterThan`` checks that the integer is strictly higher than given one.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isGreaterThan(-1)     // passes
           ->isGreaterThan('-1')   // fails because "-1"
                                   // isn't an integer
           ->isGreaterThan(0)      // fails
   ;

.. _integer-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

``isGreaterThanOrEqualTo`` checks that an integer is higher or equal to a given one.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isGreaterThanOrEqualTo(-1)    // passes
           ->isGreaterThanOrEqualTo(0)     // passes
           ->isGreaterThanOrEqualTo('-1')  // fails because "-1"
                                           // isn't an integer
   ;

.. _integer-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _integer-is-less-than:

isLessThan
==========

``isLessThan`` checks that the integer is strictly lower than a given one.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isLessThan(10)    // passes
           ->isLessThan('10')  // fails because"10" isn't an integer
           ->isLessThan(0)     // fails
   ;

.. _integer-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

``isLessThanOrEqualTo`` checks that an integer is lower or equal to a given one.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isLessThanOrEqualTo(10)       // passes
           ->isLessThanOrEqualTo(0)        // passes
           ->isLessThanOrEqualTo('10')     // fails because "10"
                                           // isn't an integer
   ;

.. _integer-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _integer-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _integer-is-zero:

isZero
======

``isZero`` checks that the integer is equal to 0.

.. code-block:: php

   <?php
   $zero    = 0;
   $notZero = -1;

   $this
       ->integer($zero)
           ->isZero()          // passes

       ->integer($notZero)
           ->isZero()          // fails
   ;

.. note::
   ``isZero`` is equivalent to ``isEqualTo(0)``.
