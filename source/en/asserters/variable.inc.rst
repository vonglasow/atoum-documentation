.. _variable-anchor:

variable
********

It's the basic assertion of all variables. It contains the necessary tests for any type of variable.

.. _variable-is-callable:

isCallable
==========

``isCallable`` verifies that the variable can be called as a function.

.. code-block:: php

   <?php
   $f = function() {
       // code
   };

   $this
       ->variable($f)
           ->isCallable()  // succeed

       ->variable('\Vendor\Project\foobar')
           ->isCallable()

       ->variable(array('\Vendor\Project\Foo', 'bar'))
           ->isCallable()

       ->variable('\Vendor\Project\Foo::bar')
           ->isCallable()
   ;

.. _variable-is-equal-to:

isEqualTo
=========

``isEqualTo`` verifies that the variable is equal to a given data.

.. code-block:: php

   <?php
   $a = 'a';

   $this
       ->variable($a)
           ->isEqualTo('a')    // passes
   ;


.. warning::
   | ``isEqualTo`` doesn't test the type of variable.
   | If you also want to check the type, use :ref:`isIdenticalTo <variable-is-identical-to>`.


.. _variable-is-identical-to:

isIdenticalTo
=============

``isIdenticalTo`` checks that the variable has the same value and the same type than the given data. Inthe case of an object, ``isIdenticalTo`` checks that the data is referencing the same instance.

.. code-block:: php

   <?php
   $a = '1';

   $this
       ->variable($a)
           ->isIdenticalTo(1)          // fails
   ;

   $stdClass1 = new \StdClass();
   $stdClass2 = new \StdClass();
   $stdClass3 = $stdClass1;

   $this
       ->variable($stdClass1)
           ->isIdenticalTo(stdClass3)  // passes
           ->isIdenticalTo(stdClass2)  // fails
   ;

.. warning::
   | ``isIdenticalTo`` test the type of variable.
   | If you don't want to check its type, use :ref:`isEqualTo <variable-is-equal-to>`.


.. _variable-is-not-callable:

isNotCallable
=============

``isNotCallable`` checks that the variable can't be called like a function.

.. code-block:: php

   <?php
   $f = function() {
       // code
   };
   $int    = 1;
   $string = 'nonExistingMethod';

   $this
       ->variable($f)
           ->isNotCallable()   // fails

       ->variable($int)
           ->isNotCallable()   // passes

       ->variable($string)
           ->isNotCallable()   // passes

       ->variable(new StdClass)
           ->isNotCallable()   // passes
   ;

.. _variable-is-not-equal-to:

isNotEqualTo
============

``isNotEqualTo`` checks that the variable does not have the same value as the given one.

.. code-block:: php

   <?php
   $a       = 'a';
   $aString = '1';

   $this
       ->variable($a)
           ->isNotEqualTo('b')     // passes
           ->isNotEqualTo('a')     // fails

       ->variable($aString)
           ->isNotEqualTo($1)      // fails
   ;

.. warning::
   | ``isNotEqualTo`` doesn't test the type of variable.
   | If you also want to check the type, use :ref:`isNotIdenticalTo <variable-is-not-identical-to>`.


.. _variable-is-not-identical-to:

isNotIdenticalTo
================

``isNotIdenticalTo`` checks that the variable does not have the same type nor the same value than the given one.

In the case of an object, ``isNotIdenticalTo`` checks that the data isn't referencing on the same instance.

.. code-block:: php

   <?php
   $a = '1';

   $this
       ->variable($a)
           ->isNotIdenticalTo(1)           // passes
   ;

   $stdClass1 = new \StdClass();
   $stdClass2 = new \StdClass();
   $stdClass3 = $stdClass1;

   $this
       ->variable($stdClass1)
           ->isNotIdenticalTo(stdClass2)   // passes
           ->isNotIdenticalTo(stdClass3)   // fails
   ;

.. warning::
   | ``isNotIdenticalTo`` test the type of variable.
   | If you don't want to check its type, use :ref:`isNotEqualTo <variable-is-not-equal-to>`.


.. _is-null:

isNull
======

``isNull`` checks that the variable is null.

.. code-block:: php

   <?php
   $emptyString = '';
   $null        = null;

   $this
       ->variable($emptyString)
           ->isNull()              // fails
                                   // (it's empty but not null)

       ->variable($null)
           ->isNull()              // passes
   ;

.. _is-not-null:

isNotNull
=========

``isNotNull`` checks that the variable is not null.

.. code-block:: php

   <?php
   $emptyString = '';
   $null        = null;

   $this
       ->variable($emptyString)
           ->isNotNull()           // passes (it's empty but not null)

       ->variable($null)
           ->isNotNull()           // fails
   ;

.. _is-not-true:

isNotTrue
=========

``isNotTrue`` check that the variable is strictly not equal to ``true``.

.. code-block:: php

   <?php
   $true  = true;
   $false = false;
   $this
       ->variable($true)
           ->isNotTrue()     // fails

       ->variable($false)
           ->isNotTrue()     // succeed
   ;


.. _is-not-false:

isNotFalse
==========

``isNotFalse`` check that the variable is strictly not equal to ``false``.

.. code-block:: php

   <?php
   $true  = true;
   $false = false;
   $this
       ->variable($false)
           ->isNotFalse()     // fails

       ->variable($true)
           ->isNotFalse()     // succeed
   ;
