.. _string-anchor:

string
******

C'est l'assertion dédiée aux chaînes de caractères.

.. _string-contains:

contains
========

``contains`` checks that a string contains another given string.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->contains('ll')    // passes
           ->contains(' ')     // passes
           ->contains('php')   // fails
   ;


.. _string-endwith:

endWith
=======

``endWith`` checks that a string ends with another given string.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->endWith('world')     // passes
           ->endWith('lo world')  // passes
           ->endWith('Hello')     // fails
           ->endWith(' ')         // fails
   ;


.. _string-has-length:

hasLength
=========

``hasLength`` checks the string size.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLength(11)     // passes
           ->hasLength(20)     // fails
   ;

.. _string-has-length-greater-than:

hasLengthGreaterThan
====================

``hasLengthGreaterThan`` checks that the string size is greater that the given one.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLengthGreaterThan(10)     // passes
           ->hasLengthGreaterThan(20)     // fails
   ;

.. _string-has-length-less-than:

hasLengthLessThan
=================

``hasLengthLessThan`` checks that the string size is lower that the given one.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLengthLessThan(20)     // passes
           ->hasLengthLessThan(10)     // fails
   ;

.. _string-is-empty:

isEmpty
=======

``isEmpty`` checks that the string is empty.

.. code-block:: php

   <?php
   $emptyString    = '';
   $nonEmptyString = 'atoum';

   $this
       ->string($emptyString)
           ->isEmpty()             // passes

       ->string($nonEmptyString)
           ->isEmpty()             // fails
   ;

.. _string-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _string-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

``isEqualToContentsOfFile`` checks that the string is equal to the content of a file given by its path.

.. code-block:: php

   <?php
   $this
       ->string($string)
           ->isEqualToContentsOfFile('/path/to/file')
   ;

.. note::
   if the file doesn't exist, the test will fails.


.. _string-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _string-is-not-empty:

isNotEmpty
==========

``isNotEmpty`` checks that the string is not empty.

.. code-block:: php

   <?php
   $emptyString    = '';
   $nonEmptyString = 'atoum';

   $this
       ->string($emptyString)
           ->isNotEmpty()          // fails

       ->string($nonEmptyString)
           ->isNotEmpty()          // passes
   ;

.. _string-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _string-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _length-anchor:

length
======

``length`` allows you to get an asserter of type :ref:`integer <integer-anchor>` that contains the string's size.

.. code-block:: php

   <?php
   $string = 'atoum'

   $this
       ->string($string)
           ->length
               ->isGreaterThanOrEqualTo(5)
   ;


.. _string-match:

match
=====

.. hint::
   ``match`` is an alias of the ``matches`` method.
   For more information, refer to the documentation of :ref:`string::matches <string-matches>`


.. _string-matches:

matches
=======

``matches`` checks that a regular expression match the tested string.

.. code-block:: php

   <?php
   $phone = '0102030405';
   $vdm   = "Today at 57 years, my father got a tatoot of a Unicorn on his shoulder. VDM";

   $this
       ->string($phone)
           ->matches('#^0[1-9]\d{8}$#')

       ->string($vdm)
           ->matches("#^Today.*VDM$#")
   ;

.. _string-not-contains:

notContains
===========

``notContains`` checks that the tested string doesn't contains another string.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->notContains('php')   // passes
           ->notContains(';')     // passes
           ->notContains('ll')    // fails
           ->notContains(' ')     // fails
   ;


.. _string-not-end-with:

notEndWith
==========

``notEndWith`` checks that the tested string doesn't ends with another string.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->notEndWith('Hello')     // passes
           ->notEndWith(' ')         // passes
           ->notEndWith('world')  // fails
           ->notEndWith('lo world')        // fails
   ;


.. _string-not-start-with:

notStartWith
============

``notStartWith`` checks that the tested string doesn't starts with another string.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->notStartWith('world')    // passes
           ->notStartWith(' ')        // passes
           ->notStartWith('Hello wo')  // fails
           ->notStartWith('He')       // fails
   ;

.. _string-start-with:

startWith
=========

``startWith`` checks that the tested string starts with another string.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->startWith('Hello wo') // passes
           ->startWith('He')       // passes
           ->startWith('world')    // fails
           ->startWith(' ')        // fails

   ;
