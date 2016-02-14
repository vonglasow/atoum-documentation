.. _date-time:

dateTime
********

It's the assertion dedicated to `DateTime <http://php.net/datetime>`_  object.

If you try to test a value that is not a ``DateTime`` (or a child class) with this assertion it will fail.

.. _date-time-has-date:

hasDate
=======

``hasDate`` checks the date part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasDate('1981', '02', '13')   // passes
           ->hasDate('1981', '2',  '13')   // passes
           ->hasDate(1981,   2,    13)     // passes
   ;

.. _date-time-has-date-and-time:

hasDateAndTime
==============

``hasDateAndTime`` checks date and hour part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13 01:02:03');

   $this
       ->dateTime($dt)
           // passes
           ->hasDateAndTime('1981', '02', '13', '01', '02', '03')
           // passes
           ->hasDateAndTime('1981', '2',  '13', '1',  '2',  '3')
           // passes
           ->hasDateAndTime(1981,   2,    13,   1,    2,    3)
   ;

.. _date-time-has-day:

hasDay
======

``hasDay`` checks day part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasDay(13)        // passes
   ;

.. _date-time-has-hours:

hasHours
========

``hasHours`` checks time part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasHours('01')    // passes
           ->hasHours('1')     // passes
           ->hasHours(1)       // passes
   ;

.. _date-time-has-minutes:

hasMinutes
==========

``hasMinutes`` checks minutes part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasMinutes('02')  // passes
           ->hasMinutes('2')   // passes
           ->hasMinutes(2)     // passes
   ;

.. _date-time-has-month:

hasMonth
========

``hasMonth`` checks month part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasMonth(2)       // passes
   ;

.. _date-time-has-seconds:

hasSeconds
==========

``hasSeconds`` checks seconds part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasSeconds('03')    // passes
           ->hasSeconds('3')     // passes
           ->hasSeconds(3)       // passes
   ;

.. _date-time-has-time:

hasTime
=======

``hasTime`` checks time part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasTime('01', '02', '03')     // passes
           ->hasTime('1',  '2',  '3')      // passes
           ->hasTime(1,    2,    3)        // passes
   ;

.. _date-time-has-timezone:

hasTimezone
===========

``hasTimezone`` checks timezone part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime();

   $this
       ->dateTime($dt)
           ->hasTimezone('Europe/Paris')
   ;

.. _date-time-has-year:

hasYear
=======

``hasYear`` checks year part of the ``DateTime`` object.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasYear(1981)     // passes
   ;

.. _date-time-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` is a method inherited from asserter ``object``.
   For more information, refer to the documentation of :ref:`object::isCloneOf <object-is-clone-of>`


.. _date-time-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from ``object`` asserter.
   For more information, refer to the documentation of :ref:`object::isEqualTo <object-is-equal-to>`


.. _dat-time-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is an inherited method from ``object`` asserter.
   For more information, refer to the documentation of :ref:`object::isIdenticalTo <object-is-identical-to>`


.. _date-time-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` is a method inherited from asserter ``object``.
   For more information, refer to the documentation of :ref:`object::isInstanceOf <object-is-instance-of>`


.. _date-time-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from ``object`` asserter.
   For more information, refer to the documentation of :ref:`object::isNotEqualTo <object-is-not-equal-to>`


.. _date-time-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is an inherited method from ``object`` asserter.
   For more information, refer to the documentation of :ref:`object::isNotIdenticalTo <object-is-not-identical-to>`
