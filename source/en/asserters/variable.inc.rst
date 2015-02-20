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
   | If you want also to check the type, use :ref:`isIdenticalTo <variable-is-identical-to>`.


.. _variable-is-identical-to:

isIdenticalTo
=============

``isIdenticalTo`` checks that the variable has the same value and the same type than the given data. Inthe case of an object, ``isIdenticalTo`` checks that the data is referencing the on the same instance.

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
   | If you doesn't want its type, use :ref:`isEqualTo <variable-is-equal-to>`.


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

``isNotEqualTo`` checks that the variable is not the same value the the given one.

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
   | ``isNotEqualTo`` ne teste pas le type de la variable.
   | Si vous souhaitez vérifier également son type, utilisez :ref:`isNotIdenticalTo <variable-is-not-identical-to>`.


.. _variable-is-not-identical-to:

isNotIdenticalTo
================

``isNotIdenticalTo`` vérifie que la variable n'a ni le même type ni la même valeur qu'une certaine donnée.

Dans le cas d'objets, ``isNotIdenticalTo`` vérifie que les données ne pointent pas sur la même instance.

.. code-block:: php

   <?php
   $a = '1';

   $this
       ->variable($a)
           ->isNotIdenticalTo(1)           // passe
   ;

   $stdClass1 = new \StdClass();
   $stdClass2 = new \StdClass();
   $stdClass3 = $stdClass1;

   $this
       ->variable($stdClass1)
           ->isNotIdenticalTo(stdClass2)   // passe
           ->isNotIdenticalTo(stdClass3)   // échoue
   ;

.. warning::
   | ``isNotIdenticalTo`` teste le type de la variable.
   | Si vous ne souhaitez pas vérifier son type, utilisez :ref:`isNotEqualTo <variable-is-not-equal-to>`.


.. _is-null:

isNull
======

``isNull`` vérifie que la variable est nulle.

.. code-block:: php

   <?php
   $emptyString = '';
   $null        = null;

   $this
       ->variable($emptyString)
           ->isNull()              // échoue
                                   // (c'est vide mais pas null)

       ->variable($null)
           ->isNull()              // passe
   ;

.. _is-not-null:

isNotNull
=========

``isNotNull`` vérifie que la variable n'est pas nulle.

.. code-block:: php

   <?php
   $emptyString = '';
   $null        = null;

   $this
       ->variable($emptyString)
           ->isNotNull()           // passe (c'est vide mais pas null)

       ->variable($null)
           ->isNotNull()           // échoue
   ;
