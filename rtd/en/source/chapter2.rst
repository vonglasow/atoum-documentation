.. _writing-tests:

Writing tests
=============

.. _asserters:

Asserters
---------

.. _variable:

variable
~~~~~~~~

The base asserter for all variables. It contains all the tests you would need for any kind of variable.

.. _iscallable----variableiscallable:

isCallable====variableIsCallable
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isCallable`` checks that the variable call be called like a function

.. code-block:: php

   $f = function() {
       // code
   };
   
   $this
       ->variable($f)
           ->isCallable()  // passes
   
       ->variable('\Vendor\Project\foobar')
           ->isCallable()
   
       ->variable(array('\Vendor\Project\Foo', 'bar'))
           ->isCallable()
   
       ->variable('\Vendor\Project\Foo::bar')
           ->isCallable()
   ;

.. _isequalto----variableisequalto:

isEqualTo====variableIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isEqualTo`` checks that the variable is equal to an expected value

.. code-block:: php

   $a = 'a';
   
   $this
       ->variable($a)
           ->isEqualTo('a')    // passes
   ;

.. note::
   ``isEqualTo`` does not check the variable type. If you want to also check the type, use ``:ref:`isIdenticalTo <variableisidenticalto>```.

.. _isidenticalto----variableisidenticalto:

isIdenticalTo====variableIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isIdenticalTo`` checks that the variable is equal to the expected value, and also checks that the types are the same. With objects, ``isIdenticalTo`` checks that both values are references to the same object

.. code-block:: php

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

.. note::
   ``isIdenticalTo`` checks the variable type. If you do not want to check the type, use``:ref:`isEqualTo <variableisequalto>```.

.. _isnotcallable----variableisnotcallable:

isNotCallable====variableIsNotCallable
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isNotCallable`` checks the variable cannot be called like a function.

.. code-block:: php

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

.. _isnotequalto----variableisnotequalto:

isNotEqualTo====variableIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isNotEqualTo`` checks that the variable is not the same as the given value

.. code-block:: php

   $a       = 'a';
   $aString = '1';
   
   $this
       ->variable($a)
           ->isNotEqualTo('b')     // passes
           ->isNotEqualTo('a')     // fails
   
       ->variable($aString)
           ->isNotEqualTo($1)      // fails
   ;

.. note::
   ``isNotEqualTo`` does not check the variable type. If you also want to check the type, use ``:ref:`isNotIdenticalTo <variableisnotidenticalto>```.

.. _isnotidenticalto----variableisnotidenticalto:

isNotIdenticalTo====variableIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isNotIdenticalTo`` checks that the variable has neither the same type nor the same value as the given value

With objects, ``isNotIdenticalTo`` checks that both values do not reference the same instance.

.. code-block:: php

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

.. note::
   ``isNotIdenticalTo`` checks the variable type. If you do not want to check the variable type, use ``:ref:`isNotEqualTo <variableisnotequalto>```.

.. _isnull:

isNull
^^^^^^

``isNull`` checks that the variable is null.

.. code-block:: php

   $emptyString = '';
   $null        = null;
   
   $this
       ->variable($emptyString)
           ->isNull()              // fails
                                   // (it is empty but not null)
   
       ->variable($null)
           ->isNull()              // passes
   ;

.. _isnotnull:

isNotNull
^^^^^^^^^

``isNotNull`` checks that the variable is not null.

.. code-block:: php

   $emptyString = '';
   $null        = null;
   
   $this
       ->variable($emptyString)
           ->isNotNull()           // passe (it is empty but not null)
   
       ->variable($null)
           ->isNotNull()           // fails
   ;



.. _boolean:

boolean
~~~~~~~

This is the asserter for booleans.

The check will fail if you pass a non boolean value.

.. note::
   ``null`` is not a boolean. You can read the PHP manual to know what ```is_bool <http://php.net/is_bool>`_`` considers a boolean or not.

.. _isequalto----booleanisequalto:

isEqualTo====booleanIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isfalse:

isFalse
^^^^^^^

``isFalse`` checks that the boolean is strictly equal to ``false``.

.. code-block:: php

   $true  = true;
   $false = false;
   
   $this
       ->boolean($true)
           ->isFalse()     // fails
   
       ->boolean($false)
           ->isFalse()     // passes
   ;

.. _isidenticalto----booleanisidenticalto:

isIdenticalTo====booleanIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isnotequalto----booleanisnotequalto:

isNotEqualTo====booleanIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----booleanisnotidenticalto:

isNotIdenticalTo====booleanIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _istrue:

isTrue
^^^^^^

``isTrue`` checks that the boolean is strictly equal to ``true``.

.. code-block:: php

   $true  = true;
   $false = false;
   
   $this
       ->boolean($true)
           ->isTrue()      // passes
   
       ->boolean($false)
           ->isTrue()      // fails
   ;



.. _integer:

integer
~~~~~~~

This is the asserter for integers.

The check will fail if pass a non integer value.

.. note::
   ``null`` is not an integer. You can read the PHP manual to know what ```is_int <http://php.net/is_int>`_`` considers an integer or not.

.. _isequalto----integerisequalto:

isEqualTo====integerIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isgreaterthan----integerisgreaterthan:

isGreaterThan====integerIsGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isGreaterThan`` checks that the integer is strictly greater then the given value.

.. code-block:: php

   $zero = 0;
   
   $this
       ->integer($zero)
           ->isGreaterThan(-1)     // passes
           ->isGreaterThan('-1')   // fails because "-1"
                                   // is not an integer (string)
           ->isGreaterThan(0)      // fails
   ;

.. _isgreaterthanorequalto----integerisgreaterthanorequalto:

isGreaterThanOrEqualTo====integerIsGreaterThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isGreaterThanOrEqualTo`` checks that the integer is greater or equal to the given value.

.. code-block:: php

   $zero = 0;
   
   $this
       ->integer($zero)
           ->isGreaterThanOrEqualTo(-1)    // passes
           ->isGreaterThanOrEqualTo(0)     // passes
           ->isGreaterThanOrEqualTo('-1')  // fails because "-1"
                                           // is not an integer (string)
   ;

.. _isidenticalto----integerisidenticalto:

isIdenticalTo====integerIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _islessthan----integerislessthan:

isLessThan====integerIsLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isLessThan`` checks that the integer is strictly lower than the given value.

.. code-block:: php

   $zero = 0;
   
   $this
       ->integer($zero)
           ->isLessThan(10)    // passes
           ->isLessThan('10')  // fails because "10" is not an integer (string)
           ->isLessThan(0)     // fails
   ;

.. _islessthanorequalto----integerislessthanorequalto:

isLessThanOrEqualTo====integerIsLessThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isLessThanOrEqualTo`` checks that the integer is less or equal than the given value.

.. code-block:: php

   $zero = 0;
   
   $this
       ->integer($zero)
           ->isLessThanOrEqualTo(10)       // passes
           ->isLessThanOrEqualTo(0)        // passes
           ->isLessThanOrEqualTo('10')     // fails because "10"
                                           // is not an integer
   ;

.. _isnotequalto----integerisnotequalto:

isNotEqualTo====integerIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----integerisnotidenticalto:

isNotIdenticalTo====integerIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _iszero----integeriszero:

isZero====integerIsZero
^^^^^^^^^^^^^^^^^^^^^^^

``isZero`` checks that the integer is equal to 0.

.. code-block:: php

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



.. _float:

float
~~~~~

This is the asserter for floats.

The check will fail if you pass a non float value.

.. note::
   ``null`` is not a float. Read the PHP manual to know what ```is_float <http://php.net/is_float>`_`` considers a float or not.

.. _isequalto----floatisequalto:

isEqualTo====floatIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isgreaterthan----floatisgreaterthan:

isGreaterThan====floatIsGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isGreaterThan`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isGreaterThan`` <integerisgreaterthan>` documentation
}}}

.. _isgreaterthanorequalto----floatisgreaterthanorequalto:

isGreaterThanOrEqualTo====floatIsGreaterThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isGreaterThanOrEqualTo`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isGreaterThanOrEqualTo`` <integerisgreaterthanorequalto>` documentation
}}}

.. _isidenticalto----floatisidenticalto:

isIdenticalTo====floatIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _islessthan----floatislessthan:

isLessThan====floatIsLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isLessThan`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isLessThan`` <integerislessthan>` documentation
}}}

.. _islessthanorequalto----floatislessthanorequalto:

isLessThanOrEqualTo====floatIsLessThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isLessThanOrEqualTo`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isLessThanOrEqualoo`` <integerislessthanorequalto>` documentation
}}}

.. _isnearlyequalto:

isNearlyEqualTo
^^^^^^^^^^^^^^^

``isNearlyEqualTo`` checks that the float is approximately equal to the given value.

Computers handle floats in a way that makes precise comparisons impossible without using advanced tools. Try for example the following command:

.. code-block:: shell

   $ php -r 'var_dump(1 - 0.97 === 0.03);'
   bool(false)

The result should be ``true`` though.

.. note::
   For more information about this behavior, read `the PHP manual <http://php.net/types.float>`_

This method tries to avoid this issue.

.. code-block:: php

   $float = 1 - 0.97;
   
   $this
       ->float($float)
           ->isNearlyEqualTo(0.03) // passes
           ->isEqualTo(0.03)       // fails
   ;

.. note::
   For more information about the algorithm used, read the `floating point guide <http://www.floating-point-gui.de/errors/comparison/>`_.

.. _isnotequalto----floatisnotequalto:

isNotEqualTo====floatIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----floatisnotidenticalto:

isNotIdenticalTo====floatIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _iszero----floatiszero:

isZero====floatIsZero
^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isZero`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isZero`` <integeriszero>` documentation
}}}



.. _sizeof:

sizeOf
~~~~~~

This is the asserter for array sizes and objects that implements the ``Countable`` interface.

.. code-block:: php

   $array           = array(1, 2, 3);
   $countableObject = new GlobIterator('*');
   
   $this
       ->sizeOf($array)
           ->isEqualTo(3)
   
       ->sizeOf($countableObject)
           ->isGreaterThan(0)
   ;

.. _isequalto----sizeofisequalto:

isEqualTo====sizeOfIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isgreaterthan----sizeofisgreaterthan:

isGreaterThan====sizeOfIsGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isGreaterThan`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isGreaterThan`` <integerisgreaterthan>` documentation
}}}

.. _isgreaterthanorequalto----sizeofisgreaterthanorequalto:

isGreaterThanOrEqualTo====sizeOfIsGreaterThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isGreaterThanOrEqualTo`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isGreaterThanOrEqualTo`` <integerisgreaterthanorequalto>` documentation
}}}

.. _isidenticalto----sizeofisidenticalto:

isIdenticalTo====sizeOfIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _islessthan----sizeofislessthan:

isLessThan====sizeOfIsLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isLessThan`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isLessThan`` <integerislessthan>` documentation
}}}

.. _islessthanorequalto----sizeofislessthanorequalto:

isLessThanOrEqualTo====sizeOfIsLessThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isLessThanOrEqualTo`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isLessThanOrEqualoo`` <integerislessthanorequalto>` documentation
}}}

.. _isnotequalto----sizeofisnotequalto:

isNotEqualTo====sizeOfIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----sizeofisnotidenticalto:

isNotIdenticalTo====sizeOfIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _iszero----sizeofiszero:

isZero====sizeOfIsZero
^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isZero`` is an inherited method from the ``integer`` asserter.
For more information, you can read the :ref:```integer::isZero`` <integeriszero>` documentation
}}}



.. _object:

object
~~~~~~

This is the asserter for objects.

The check will fail if you pass a non object.

.. note::
   ``null`` is not an object. Read the PHP manual to know what ```is_object <http://php.net/is_object>`_`` considers an object or not.

.. _hassize----objecthassize:

hasSize====objectHasSize
^^^^^^^^^^^^^^^^^^^^^^^^

``hasSize`` checks the size of objects that implement the ``Countable`` interface.

.. code-block:: php

   $countableObject = new GlobIterator('*');
   
   $this
       ->object($countableObject)
           ->hasSize(3)
   ;

.. _iscallable----objectiscallable:

isCallable====objectIsCallable
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: php

   class foo
   {
       public function __invoke()
       {
           // code
       }
   }
   
   $this
       ->object(new foo)
           ->isCallable()  // passes
   
       ->object(new StdClass)
           ->isCallable()  // fails
   ;

.. note::
   To be ``callable``, your objects must be instantiated from classes that implement the ```__invoke``  < http://www.php.net/manual/fr/language.oop5.magic.php#object.invoke>`_ magic method.

{{{inheritance
``isCallable`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isCallable`` <variableiscallable>` documentation
}}}

.. _iscloneof----objectiscloneof:

isCloneOf====objectIsCloneOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isCloneOf`` checks that the object is the clone of the given object, that is to say the objects are equal, but are not the same instance.

.. code-block:: php

   $object1 = new \StdClass;
   $object2 = new \StdClass;
   $object3 = clone($object1);
   $object4 = new \StdClass;
   $object4->foo = 'bar';
   
   $this
       ->object($object1)
           ->isCloneOf($object2)   // passes
           ->isCloneOf($object3)   // passes
           ->isCloneOf($object4)   // fails
   ;

.. note::
   For more information on object comparison, read `the PHP manual <http://php.net/language.oop5.object-comparison>`_.

.. _isempty----objectisempty:

isEmpty====objectIsEmpty
^^^^^^^^^^^^^^^^^^^^^^^^

``isEmpty`` checks that the size of an object that implements the ``Countable`` interface is equal to 0.

.. code-block:: php

   $countableObject = new GlobIterator('atoum.php');
   
   $this
       ->object($countableObject)
           ->isEmpty()
   ;

.. note::
   ``isEmpty`` is equivalent to ``hasSize(0)``.

.. _isequalto----objectisequalto:

isEqualTo====objectIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isEqualTo`` checks that the object is equal to the given object.
Two objects are considered equal when they have the same attributes and attributes values, and that they are instances of the same class.

.. note::
   For more information on object comparison, read `the PHP manual <http://php.net/language.oop5.object-comparison>`_.

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isidenticalto----objectisidenticalto:

isIdenticalTo====objectIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isIdenticalTo`` checks that the objects are identical.
Two objects are considered identical when they are references to the same instance of the same class.

.. note::
   For more information on object comparison, read `the PHP manual <http://php.net/language.oop5.object-comparison>`_.

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isinstanceof----objectisinstanceof:

isInstanceOf====objectIsInstanceOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
``isInstanceOf`` checks that an object is :

* an instance of the given class,
* a subclass of the given class (abstract or not),
* an instance of a class that implements the given interface.

.. code-block:: php

   $object = new \StdClass();
   
   $this
       ->object($object)
           ->isInstanceOf('\StdClass')     // passes
           ->isInstanceOf('\Iterator')     // fails
   ;
   
   
   interface FooInterface
   {
       public function foo();
   }
   
   class FooClass implements FooInterface
   {
       public function foo()
       {
           echo "foo";
       }
   }
   
   class BarClass extends FooClass
   {
   }
   
   $foo = new FooClass;
   $bar = new BarClass;
   
   $this
       ->object($foo)
           ->isInstanceOf('\FooClass')     // passes
           ->isInstanceOf('\FooInterface') // passes
           ->isInstanceOf('\BarClass')     // fails
           ->isInstanceOf('\StdClass')     // fails
   
       ->object($bar)
           ->isInstanceOf('\FooClass')     // passes
           ->isInstanceOf('\FooInterface') // passes
           ->isInstanceOf('\BarClass')     // passes
           ->isInstanceOf('\StdClass')     // fails
   ;

.. note::
   Classes and interfaces names have to be absolute, because namespace import are not taken into account.

.. _isnotcallable----objectisnotcallable:

isNotCallable====objectIsNotCallable
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: php

   class foo
   {
       public function __invoke()
       {
           // code
       }
   }
   
   $this
       ->variable(new foo)
           ->isNotCallable()   // fails
   
       ->variable(new StdClass)
           ->isNotCallable()   // passes
   ;

{{{inheritance
``isNotCallable`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotCallable`` <variableisnotcallable>` documentation
}}}

.. _isnotequalto----objectisnotequalto:

isNotEqualTo====objectIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isEqualTo`` checks that the object is not equal to the given object.
Two objects are considered equal when they have the same attributes and attributes values, and that they are instances of the same class.

.. note::
   For more information on object comparison, read `the PHP manual <http://php.net/language.oop5.object-comparison>`_.

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----objectisnotidenticalto:

isNotIdenticalTo====objectIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isIdenticalTo`` checks that the object is not identical to the given object.
Two objects are considered identical when they are references to the same instance of the same class.

.. note::
   For more information on object comparison, read `the PHP manual <http://php.net/language.oop5.object-comparison>`_.

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _dateinterval:

dateInterval
~~~~~~~~~~~~

This is the asserter for the ```DateInterval <http://php.net/dateinterval>`_`` object.

The check will fail if you pass a value that is not a ``DateInterval`` instance (or an instance of a class that extends it).

.. _iscloneof----dateintervaliscloneof:

isCloneOf====dateIntervalIsCloneOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isCloneOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isCloneOf`` <objectiscloneof>` documentation
}}}

.. _isequalto----dateintervalisequalto:

isEqualTo====dateIntervalIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isEqualTo`` checks that the duration of the ``DateInterval`` object is equal to the duration of the given ``DateInterval`` object.

.. code-block:: php

   $di = new DateInterval('P1D');
   
   $this
       ->dateInterval($di)
           ->isEqualTo(                // passes
               new DateInterval('P1D')
           )
           ->isEqualTo(                // fails
               new DateInterval('P2D')
           )
   ;

.. _isgreaterthan----dateintervalisgreaterthan:

isGreaterThan====dateIntervalIsGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isGreaterThan`` checks that the duration of the ``DateInterval`` object is greater than the duration of the given ``DateInterval`` object.

.. code-block:: php

   $di = new DateInterval('P2D');
   
   $this
       ->dateInterval($di)
           ->isGreaterThan(            // passes
               new DateInterval('P1D')
           )
           ->isGreaterThan(            // fails
               new DateInterval('P2D')
           )
   ;

.. _isgreaterthanorequalto----dateintervalisgreaterthanorequalto:

isGreaterThanOrEqualTo====dateIntervalIsGreaterThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isGreaterThanOrEqualTo`` checks that the duration of the ``DateInterval`` object is greater or equal to the duration of the given ``DateInterval`` object.

.. code-block:: php

   $di = new DateInterval('P2D');
   
   $this
       ->dateInterval($di)
           ->isGreaterThanOrEqualTo(   // passes
               new DateInterval('P1D')
           )
           ->isGreaterThanOrEqualTo(   // passes
               new DateInterval('P2D')
           )
           ->isGreaterThanOrEqualTo(   // fails
               new DateInterval('P3D')
           )
   ;

.. _isidenticalto----dateintervalisidenticalto:

isIdenticalTo====dateIntervalIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isIdenticalTo`` <objectisidenticalto>` documentation
}}}

.. _isinstanceof----dateintervalisinstanceof:

isInstanceOf====dateIntervalIsInstanceOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isInstanceOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isInstanceOf`` <objectisinstanceof>` documentation
}}}

.. _islessthan----dateintervalislessthan:

isLessThan====dateIntervalIsLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isLessThan`` checks that the duration of the ``DateInterval`` object is less than the duration of the given ``DateInterval`` object.

.. code-block:: php

   $di = new DateInterval('P1D');
   
   $this
       ->dateInterval($di)
           ->isLessThan(               // passes
               new DateInterval('P2D')
           )
           ->isLessThan(               // fails
               new DateInterval('P1D')
           )
   ;

.. _islessthanorequalto----dateintervalislessthanorequalto:

isLessThanOrEqualTo====dateIntervalIsLessThanOrEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isLessThanOrEqualTo`` checks that the duration of the ``DateInterval`` object is less or equal than the duration of the given ``DateInterval`` object.

.. code-block:: php

   $di = new DateInterval('P2D');
   
   $this
       ->dateInterval($di)
           ->isLessThanOrEqualTo(      // passes
               new DateInterval('P3D')
           )
           ->isLessThanOrEqualTo(      // passes
               new DateInterval('P2D')
           )
           ->isLessThanOrEqualTo(      // fails
               new DateInterval('P1D')
           )
   ;

.. _isnotequalto----dateintervalisnotequalto:

isNotEqualTo====dateIntervalIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotEqualTo`` <objectisnotequalto>` documentation
}}}

.. _isnotidenticalto----dateintervalisnotidenticalto:

isNotIdenticalTo====dateIntervalIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotIdenticalTo`` <objectisnotidenticalto>` documentation
}}}

.. _iszero----dateintervaliszero:

isZero====dateIntervalIsZero
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isZero`` checks that the duration of the ``DateInterval`` is equal to 0.

.. code-block:: php

   $di1 = new DateInterval('P0D');
   $di2 = new DateInterval('P1D');
   
   $this
       ->dateInterval($di1)
           ->isZero()      // passes
       ->dateInterval($di2)
           ->isZero()      // fails
   ;


.. _datetime:

dateTime
~~~~~~~~

This is the asserter for the ```DateTime <http://php.net/datetime>`_`` object.

The check will fail if you pass a value that is not an instance of ``DateTime`` (or an instance of a class that extends it).

.. _hasdate----datetimehasdate:

hasDate====dateTimeHasDate
^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasDate`` checks the date part of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('1981-02-13');
   
   $this
       ->dateTime($dt)
           ->hasDate('1981', '02', '13')   // passes
           ->hasDate('1981', '2',  '13')   // passes
           ->hasDate(1981,   2,    13)     // passes
   ;

.. _hasdateandtime----datetimehasdateandtime:

hasDateAndTime====dateTimeHasDateAndTime
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasDateAndTime`` check the date and time of the ``DateTime`` object.

.. code-block:: php

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

.. _hasday----datetimehasday:

hasDay====dateTimeHasDay
^^^^^^^^^^^^^^^^^^^^^^^^

``hasDay`` checks the day of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('1981-02-13');
   
   $this
       ->dateTime($dt)
           ->hasDay(13)        // passes
   ;

.. _hashours----datetimehashours:

hasHours====dateTimeHasHours
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasHours`` checks the hours of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('01:02:03');
   
   $this
       ->dateTime($dt)
           ->hasHours('01')    // passes
           ->hasHours('1')     // passes
           ->hasHours(1)       // passes
   ;

.. _hasminutes----datetimehasminutes:

hasMinutes====dateTimeHasMinutes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasMinutes`` checks the minutes of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('01:02:03');
   
   $this
       ->dateTime($dt)
           ->hasMinutes('02')  // passes
           ->hasMinutes('2')   // passes
           ->hasMinutes(2)     // passes
   ;

.. _hasmonth----datetimehasmonth:

hasMonth====dateTimeHasMonth
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasMonth`` checks the month of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('1981-02-13');
   
   $this
       ->dateTime($dt)
           ->hasMonth(2)       // passes
   ;

.. _hasseconds----datetimehasseconds:

hasSeconds====dateTimeHasSeconds
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasSeconds`` checks the seconds of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('01:02:03');
   
   $this
       ->dateTime($dt)
           ->hasSeconds('03')    // passes
           ->hasSeconds('3')     // passes
           ->hasSeconds(3)       // passes
   ;

.. _hastime----datetimehastime:

hasTime====dateTimeHasTime
^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasTime`` checks the time part of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('01:02:03');
   
   $this
       ->dateTime($dt)
           ->hasTime('01', '02', '03')     // passes
           ->hasTime('1',  '2',  '3')      // passes
           ->hasTime(1,    2,    3)        // passes
   ;

.. _hastimezone----datetimehastimezone:

hasTimezone====dateTimeHasTimezone
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasTimezone`` checks the timezone of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime();
   
   $this
       ->dateTime($dt)
           ->hasTimezone('Europe/Paris')
   ;

.. _hasyear----datetimehasyear:

hasYear====dateTimeHasYear
^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasYear`` checks the year of the ``DateTime`` object.

.. code-block:: php

   $dt = new DateTime('1981-02-13');
   
   $this
       ->dateTime($dt)
           ->hasYear(1981)     // passes
   ;

.. _iscloneof----datetimeiscloneof:

isCloneOf====dateTimeIsCloneOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isCloneOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isCloneOf`` <objectiscloneof>` documentation
}}}

.. _isequalto----datetimeisequalto:

isEqualTo====dateTimeIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isEqualTo`` <objectisequalto>` documentation
}}}

.. _isidenticalto----dattimeisidenticalto:

isIdenticalTo====datTimeIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isIdenticalTo`` <objectisidenticalto>` documentation
}}}

.. _isinstanceof----datetimeisinstanceof:

isInstanceOf====dateTimeIsInstanceOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isInstanceOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isInstanceOf`` <objectisinstanceof>` documentation
}}}

.. _isnotequalto----datetimeisnotequalto:

isNotEqualTo====dateTimeIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotEqualTo`` <objectisnotequalto>` documentation
}}}

.. _isnotidenticalto----datetimeisnotidenticalto:

isNotIdenticalTo====dateTimeIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotIdenticalTo`` <objectisnotidenticalto>` documentation
}}}



.. _mysqldatetime:

mysqlDateTime
~~~~~~~~~~~~~

This is the asserter for objects representing a MySQL date, based on the ```DateTime <http://php.net/datetime>`_`` object.

The date must use a format compatible with MySQL and other DBMS, in particular « Y-m-d H:i:s » (for more information read the ```date() <http://php.net/date>`_`` function document on the PHP manual).

The check will fail if you pass a value that is not a ``DateTime`` object (or an instance of a class that extends it).

.. _hasdate----mysqldatetimehasdate:

hasDate====mysqlDateTimeHasDate
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasDate`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasDate`` <datetimehasdate>` documentation
}}}

.. _hasdateandtime----mysqldatetimehasdateandtime:

hasDateAndTime====mysqlDateTimeHasDateAndTime
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasDateAndTime`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasDateAndTime`` <datetimehasdateandtime>` documentation
}}}

.. _hasday----mysqldatetimehasday:

hasDay====mysqlDateTimeHasDay
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasDay`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasDay`` <datetimehasday>` documentation
}}}

.. _hashours----mysqldatetimehashours:

hasHours====mysqlDateTimeHasHours
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasHours`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasHours`` <datetimehashours>` documentation
}}}

.. _hasminutes----mysqldatetimehasminutes:

hasMinutes====mysqlDateTimeHasMinutes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasMinutes`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasMinutes`` <datetimehasminutes>` documentation
}}}

.. _hasmonth----mysqldatetimehasmonth:

hasMonth====mysqlDateTimeHasMonth
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasMonth`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasMonth`` <datetimehasmonth>` documentation
}}}

.. _hasseconds----mysqldatetimehasseconds:

hasSeconds====mysqlDateTimeHasSeconds
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasSeconds`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasSeconds`` <datetimehasseconds>` documentation
}}}

.. _hastime----mysqldatetimehastime:

hasTime====mysqlDateTimeHasTime
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasTime`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasTime`` <datetimehastime>` documentation
}}}

.. _hastimezone----mysqldatetimehastimezone:

hasTimezone====mysqlDateTimeHasTimezone
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasTimezone`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasTimezone`` <datetimehastimezone>` documentation
}}}

.. _hasyear----mysqldatetimehasyear:

hasYear====mysqlDateTimeHasYear
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasYear`` is an inherited method from the ``dateTime`` asserter.
For more information, you can read the :ref:```dateTime::hasYear`` <datetimehastimezone>` documentation
}}}

.. _iscloneof----mysqldatetimeiscloneof:

isCloneOf====mysqlDateTimeIsCloneOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isCloneOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isCloneOf`` <objectiscloneof>` documentation
}}}

.. _isequalto----mysqldatetimeisequalto:

isEqualTo====mysqlDateTimeIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isEqualTo`` <objectisequalto>` documentation
}}}

.. _isidenticalto----mysqldatetimeisidenticalto:

isIdenticalTo====mysqlDateTimeIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isIdenticalTo`` <objectisidenticalto>` documentation
}}}

.. _isinstanceof----mysqldatetimeisinstanceof:

isInstanceOf====mysqlDateTimeIsInstanceOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isInstanceOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isInstanceOf`` <objectisinstanceof>` documentation
}}}

.. _isnotequalto----mysqldatetimeisnotequalto:

isNotEqualTo====mysqlDateTimeIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotEqualTo`` <objectisnotequalto>` documentation
}}}

.. _isnotidenticalto----mysqldatetimeisnotidenticalto:

isNotIdenticalTo====mysqlDateTimeIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotIdenticalTo`` <objectisnotidenticalto>` documentation
}}}



.. _exception:

exception
~~~~~~~~~

This is the asserter for exceptions.

.. code-block:: php

   $this
       ->exception(
           function() use($myObject) {
               // this throws an exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
   ;

.. note::
   The syntax use anonymous functions (also named closures) introduced in PHP 5.3. For more information read `the PHP manual <http://php.net/functions.anonymous>`_.

.. _hascode:

hasCode
^^^^^^^

``hasCode`` checks the exception code

.. code-block:: php

   $this
       ->exception(
           function() use($myObject) {
               // this throws an exception: throw new \Exception('Message', 42);
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasCode(42)
   ;

.. _hasdefaultcode:

hasDefaultCode
^^^^^^^^^^^^^^

``hasDefaultCode`` checks that the exception code is the default value, 0.

.. code-block:: php

   $this
       ->exception(
           function() use($myObject) {
               // this throws an exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasDefaultCode()
   ;

.. note::
   ``hasDefaultCode`` is equivalent to ``hasCode(0)``.

.. _hasmessage:

hasMessage
^^^^^^^^^^

``hasMessage`` checks the exception message

.. code-block:: php

   $this
       ->exception(
           function() use($myObject) {
               // this throws an exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasMessage('Message')     // passes
           ->hasMessage('message')     // fails
   ;

.. _hasnestedexception:

hasNestedException
^^^^^^^^^^^^^^^^^^

``hasNestedException`` checks that the exception contains a reference to the previous exception. If the exception class is given, it will also check the exception class.

.. code-block:: php

   $this
       ->exception(
           function() use($myObject) {
               // this throws an exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasNestedException()      // fails
   
       ->exception(
           function() use($myObject) {
               try {
                   // this throws an exception: throw new \FirstException('Message 1', 42);
                   $myObject->doOneThing('wrongParameter');
               }
               // ... the exception is catched
               catch(\FirstException $e) {
                   // ... then thrown again, wrapped in a second exception
                   throw new \SecondException('Message 2', 24, $e);
               }
           }
       )
           ->isInstanceOf('\FirstException')           // fails
           ->isInstanceOf('\SecondException')          // passes
   
           ->hasNestedException()                      // passes
           ->hasNestedException(new \FirstException)   // passes
           ->hasNestedException(new \SecondException)  // fails
   ;

.. _iscloneof----exceptioniscloneof:

isCloneOf====exceptionIsCloneOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isCloneOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isCloneOf`` <objectiscloneof>` documentation
}}}

.. _isequalto----exceptionisequalto:

isEqualTo====exceptionIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isEqualTo`` <objectisequalto>` documentation
}}}

.. _isidenticalto----exceptionisidenticalto:

isIdenticalTo====exceptionIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isIdenticalTo`` <objectisidenticalto>` documentation
}}}

.. _isinstanceof----exceptionisinstanceof:

isInstanceOf====exceptionIsInstanceOf
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isInstanceOf`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isInstanceOf`` <objectisinstanceof>` documentation
}}}

.. _isnotequalto----exceptionisnotequalto:

isNotEqualTo====exceptionIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotEqualTo`` <objectisnotequalto>` documentation
}}}

.. _isnotidenticalto----exceptionisnotidenticalto:

isNotIdenticalTo====exceptionIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``object`` asserter.
For more information, you can read the :ref:```object::isNotIdenticalTo`` <objectisnotidenticalto>` documentation
}}}

.. _message:

message
^^^^^^^

``message`` gives you an asserter of type ``:ref:`string <string>``` containing the thrown exception message

.. code-block:: php

   $this
       ->exception(
           function() {
               throw new \Exception('My custom message to test');
           }
       )
           ->message
               ->contains('message')
   ;



.. _array:

array
~~~~~

This is the asserter for arrays.

.. note::
   ``array`` being a PHP reserved keyword, it was not possible to create an ``array`` asserter class. That's why its name is actually ``phpArray``. You may encounter some ``->phpArray()`` or des ``->array()``.

It is advised to only use ``->array()`` to simplify test reading.

.. _contains----arraycontains:

contains====arrayContains
^^^^^^^^^^^^^^^^^^^^^^^^^

``contains`` checks that an array contains the given value.

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($fibonacci)
           ->contains('1')     // passes
           ->contains(1)       // passes, because it does not ...
           ->contains('2')     // ... check the type
           ->contains(10)      // fails
   ;

.. note::
   ``contains`` does not search recursively.

.. note::
   ``contains`` does not check the type. If you want to check the type, use ``:ref:`strictlyContains <strictlycontains>```.

.. _containsvalues:

containsValues
^^^^^^^^^^^^^^

``containsValues`` checks that an array contains all the values of the given array.

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($array)
           ->containsValues(array(1, 2, 3))        // passes
           ->containsValues(array('5', '8', '13')) // passes
           ->containsValues(array(0, 1, 2))        // fails
   ;

.. note::
   ``containsValues`` does not search recursively.

.. note::
   ``containsValues`` does not check the type. If you want to check the type, use ``:ref:`strictlyContainsValues <strictlycontainsvalues>```.

.. _haskey:

hasKey
^^^^^^

``hasKey`` checks that the array contains the given key.

.. code-block:: php

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
           ->hasKey(10)        // fails
   
       ->array($atoum)
           ->hasKey('name')    // passes
           ->hasKey('price')   // fails
   ;

.. note::
   ``hasKey`` does not search recursively.

.. note::
   ``hasKey`` does not check the type..

.. _haskeys:

hasKeys
^^^^^^^

``hasKeys`` checks that the keys of the array contains all the values of the given array.

.. code-block:: php

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
   ``hasKeys`` does not search recursively.

.. note::
   ``hasKeys`` does not check the type.

.. _hassize----arrayhassize:

hasSize====arrayHasSize
^^^^^^^^^^^^^^^^^^^^^^^

``hasSize`` checks the array size.

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($fibonacci)
           ->hasSize(7)        // passes
           ->hasSize(10)       // fails
   ;

.. note::
   ``hasSize`` is not recursive.

.. _isempty----arrayisempty:

isEmpty====arrayIsEmpty
^^^^^^^^^^^^^^^^^^^^^^^

``isEmpty`` checks that the array is empty.

.. code-block:: php

   $emptyArray    = array();
   $nonEmptyArray = array(null, null);
   
   $this
       ->array($emptyArray)
           ->isEmpty()         // passes
   
       ->array($nonEmptyArray)
           ->isEmpty()         // fails
   ;

.. _isequalto----arrayisequalto:

isEqualTo====arrayIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isidenticalto----arrayisidenticalto:

isIdenticalTo====arrayIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isnotempty----arrayisnotempty:

isNotEmpty====arrayIsNotEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isNotEmpty`` checks that an array is not empty.

.. code-block:: php

   $emptyArray    = array();
   $nonEmptyArray = array(null, null);
   
   $this
       ->array($emptyArray)
           ->isNotEmpty()      // fails
   
       ->array($nonEmptyArray)
           ->isNotEmpty()      // passes
   ;

.. _isnotequalto----arrayisnotequalto:

isNotEqualTo====arrayIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----arrayisnotidenticalto:

isNotIdenticalTo====arrayIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _keys:

keys
^^^^

``keys`` gives you an ``:ref:`array <array>``` asserter containing the keys of the array.

.. code-block:: php

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

.. _notcontains----arraynotcontains:

notContains====arrayNotContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``notContains`` checks that an array does not contains the given value.

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($fibonacci)
           ->notContains(null)         // passes
           ->notContains(1)            // fails
           ->notContains(10)           // passes
   ;

.. note::
   ``notContains`` does not search recursively.

.. note::
   ``notContains`` does not check the type. If you want to also check the type, use ``:ref:`strictlyNotContains <strictlynotcontains>```.

.. _notcontainsvalues:

notContainsValues
^^^^^^^^^^^^^^^^^

``notContainsValues`` checks that the array does not contain any value of the given array.

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($array)
           ->notContainsValues(array(1, 4, 10))    // fails
           ->notContainsValues(array(4, 10, 34))   // passes
           ->notContainsValues(array(1, '2', 3))   // fails
   ;

.. note::
   ``notContainsValues`` does not search recursively.

.. note::
   ``notContainsValues`` does not check the type. If you want to also check the type, use ``:ref:`strictlyNotContainsValues <strictlynotcontainsvalues>```.

.. _nothaskey:

notHasKey
^^^^^^^^^

``notHasKey`` checks that an array does not contain the given key.

.. code-block:: php

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
   ``notHasKey`` does not search recursively.

.. note::
   ``notHasKey`` does not check the type.

.. _nothaskeys:

notHasKeys
^^^^^^^^^^

``notHasKeys`` checks that the array keys does not contain any of the given values.

.. code-block:: php

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
   ``notHasKeys`` does not search recursively.

.. note::
   ``notHasKeys`` does not check the type.

.. _size:

size
^^^^

``size`` gives you an ``:ref:`integer <integer>``` asserter containing the array size.

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($fibonacci)
           ->size
               ->isGreaterThan(5)
   ;

.. _strictlycontains:

strictlyContains
^^^^^^^^^^^^^^^^

``strictlyContains`` checks that an array strictly contains the given value (same value and type).

.. code-block:: php

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
   ``strictlyContains`` does not search recursively.

.. note::
   ``strictlyContains`` checks the type. If you do not want to check the type, use ``:ref:`contains <arraycontains>```.

.. _strictlycontainsvalues:

strictlyContainsValues
^^^^^^^^^^^^^^^^^^^^^^

``strictlyContainsValues`` checks that an array strictly contains of all the given values (same value and type).

.. code-block:: php

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
   ``strictlyContainsValues`` does not search recursively.

.. note::
   ``strictlyContainsValues`` checks the type. If you do not want to check the type, use ``:ref:`containsValues <containsvalues>```.

.. _strictlynotcontains:

strictlyNotContains
^^^^^^^^^^^^^^^^^^^

``strictlyNotContains`` checks that the array strictly does not contain the given value (same value and type).

.. code-block:: php

   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   
   $this
       ->array($fibonacci)
           ->strictlyNotContains(null)         // passes
           ->strictlyNotContains('1')          // fails
           ->strictlyNotContains(1)            // passes
           ->strictlyNotContains(10)           // passes
   ;

.. note::
   ``strictlyNotContains`` does not search recursively.

.. note::
   ``strictlyNotContains`` checks the type. If you do not want to check the type, use ``:ref:`notContains <arraynotcontains>```.

.. _strictlynotcontainsvalues:

strictlyNotContainsValues
^^^^^^^^^^^^^^^^^^^^^^^^^

``strictlyNotContainsValues`` checks that an array strictly does not contain any of the given values (same value and type).

.. code-block:: php

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
   ``strictlyNotContainsValues`` does not search recursively.

.. note::
   ``strictlyNotContainsValues`` checks the type. If you do not want to check the type, use ``:ref:`notContainsValues <notcontainsvalues>```.



.. _string:

string
~~~~~~

This is the asserter for strings.

.. _contains----stringcontains:

contains====stringContains
^^^^^^^^^^^^^^^^^^^^^^^^^^

``contains`` checks that the string contains the given string.

.. code-block:: php

   $string = 'Hello world';
   
   $this
       ->string($string)
           ->contains('ll')    // passes
           ->contains(' ')     // passes
           ->contains('php')   // fails
   ;

.. _haslength----stringhaslength:

hasLength====stringHasLength
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasLength`` checks the string length.

.. code-block:: php

   $string = 'Hello world';
   
   $this
       ->string($string)
           ->hasLength(11)     // passes
           ->hasLength(20)     // fails
   ;

.. _haslengthgreaterthan----stringhaslengthgreaterthan:

hasLengthGreaterThan====stringHasLengthGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasLengthGreaterThan`` checks that the string length is greater than the given value.

.. code-block:: php

   $string = 'Hello world';
   
   $this
       ->string($string)
           ->hasLengthGreaterThan(10)     // passes
           ->hasLengthGreaterThan(20)     // fails
   ;

.. _haslengthlessthan----stringhaslengthlessthan:

hasLengthLessThan====stringHasLengthLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``hasLengthLessThan`` checks that the string length is less than the given value.

.. code-block:: php

   $string = 'Hello world';
   
   $this
       ->string($string)
           ->hasLengthLessThan(20)     // passes
           ->hasLengthLessThan(10)     // fails
   ;

.. _isempty----stringisempty:

isEmpty====stringIsEmpty
^^^^^^^^^^^^^^^^^^^^^^^^

``isEmpty`` checks that the string is empty.

.. code-block:: php

   $emptyString    = '';
   $nonEmptyString = 'atoum';
   
   $this
       ->string($emptyString)
           ->isEmpty()             // passes
   
       ->string($nonEmptyString)
           ->isEmpty()             // fails
   ;

.. _isequalto----stringisequalto:

isEqualTo====stringIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isequaltocontentsoffile----stringisequaltocontentsoffile:

isEqualToContentsOfFile====stringIsEqualToContentsOfFile
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isEqualToContentsOfFile`` checks that the string is equal to the content of the given file path.

.. code-block:: php

   $this
       ->string($string)
           ->isEqualToContentsOfFile('/path/to/file')
   ;

.. note::
   The test fails if the file does not exist.

.. _isidenticalto----stringisidenticalto:

isIdenticalTo====stringIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isnotempty----stringisnotempty:

isNotEmpty====stringIsNotEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``isNotEmpty`` checks that the string is not empty.

.. code-block:: php

   $emptyString    = '';
   $nonEmptyString = 'atoum';
   
   $this
       ->string($emptyString)
           ->isNotEmpty()          // fails
   
       ->string($nonEmptyString)
           ->isNotEmpty()          // passes
   ;

.. _isnotequalto----stringisnotequalto:

isNotEqualTo====stringIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----stringisnotidenticalto:

isNotIdenticalTo====stringIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _length:

length
^^^^^^

``length`` gives you an ``:ref:`integer <integer>``` asserter containing the string length.

.. code-block:: php

   $string = 'atoum'
   
   $this
       ->string($string)
           ->length
               ->isGreaterThanOrEqualTo(5)
   ;

.. _match----stringmatch:

match====stringMatch
^^^^^^^^^^^^^^^^^^^^

``match`` checks that the string matches a regular expression.

.. code-block:: php

   $phone = '0102030405';
   $vdm   = "Aujourd'hui, à 57 ans, mon père s'est fait tatouer une licorne sur l'épaule. VDM";
   
   $this
       ->string($phone)
           ->match('#^0[1-9]\d{8}$#')
   
       ->string($vdm)
           ->match("#^Aujourd'hui.*VDM$#")
   ;

.. _notcontains----stringnotcontains:

notContains====stringNotContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

``notContains`` checks that the string does not contain the given string.

.. code-block:: php

   $string = 'Hello world';
   
   $this
       ->string($string)
           ->notContains('php')   // passes
           ->notContains(';')     // passes
           ->notContains('ll')    // fails
           ->notContains(' ')     // fails
   ;



.. _casttostring:

castToString
~~~~~~~~~~~~

This is the asserter for casting objects to sting.

.. code-block:: php

   class AtoumVersion {
       private $version = '1.0';
   
       public function __toString() {
           return 'atoum v' . $this->version;
       }
   }
   
   $this
       ->castToString(new AtoumVersion())
           ->isEqualTo('atoum v1.0')
   ;

.. _contains----casttostringcontains:

contains====castToStringContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``contains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::contains`` <stringcontains>` documentation
}}}

.. _notcontains----casttostringnotcontains:

notContains====castToStringNotContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``notContains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::notContains`` <stringnotcontains>` documentation
}}}

.. _haslength----casttostringhaslength:

hasLength====castToStringHasLength
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLength`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLength`` <stringhaslength>` documentation
}}}

.. _haslengthgreaterthan----casttostringhaslengthgreaterthan:

hasLengthGreaterThan====castToStringHasLengthGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLengthGreaterThan`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLengthGreaterThan`` <stringhaslengthgreaterthan>` documentation
}}}

.. _haslengthlessthan----casttostringhaslengthlessthan:

hasLengthLessThan====castToStringHasLengthLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLengthLessThan`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLengthLessThan`` <stringhaslengthlessthan>` documentation
}}}

.. _isempty----casttostringisempty:

isEmpty====castToStringIsEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEmpty`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEmpty`` <stringisempty>` documentation
}}}

.. _isequalto----casttostringisequalto:

isEqualTo====castToStringIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isequaltocontentsoffile----casttostringisequaltocontentsoffile:

isEqualToContentsOfFile====castToStringIsEqualToContentsOfFile
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualToContentsOfFile`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEqualToContentsOfFile`` <stringisequaltocontentsoffile>` documentation
}}}

.. _isidenticalto----casttostringisidenticalto:

isIdenticalTo====castToStringIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isnotempty----casttostringisnotempty:

isNotEmpty====castToStringIsNotEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEmpty`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isNotEmpty`` <stringisnotempty>` documentation
}}}

.. _isnotequalto----casttostringisnotequalto:

isNotEqualTo====castToStringIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----casttostringisnotidenticalto:

isNotIdenticalTo====castToStringIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _match----casttostringmatch:

match====castToStringMatch
^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``match`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::match`` <stringmatch>` documentation
}}}



.. _hash:

hash
~~~~

This is the asserter for hashes.

.. _contains----hashcontains:

contains====hashContains
^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``contains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::contains`` <stringcontains>` documentation
}}}

.. _isequalto----hashisequalto:

isEqualTo====hashIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isequaltocontentsoffile----hashisequaltocontentsoffile:

isEqualToContentsOfFile====hashIsEqualToContentsOfFile
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualToContentsOfFile`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEqualToContentsOfFile`` <stringisequaltocontentsoffile>` documentation
}}}

.. _isidenticalto----hashisidenticalto:

isIdenticalTo====hashIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _ismd5:

isMd5
^^^^^

``isMd5`` checks that the string is a valid ``md5``, an hexadecimal string of 32 characters.

.. code-block:: php

   $hash    = hash('md5', 'atoum');
   $notHash = 'atoum';
   
   $this
       ->hash($hash)
           ->isMd5()       // passes
       ->hash($notHash)
           ->isMd5()       // fails
   ;

.. _isnotequalto----hashisnotequalto:

isNotEqualTo====hashIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----hashisnotidenticalto:

isNotIdenticalTo====hashIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _issha1:

isSha1
^^^^^^

``isSha1`` checks that the string is a ``sha1``, an hexadecimal string of 40 characters.

.. code-block:: php

   $hash    = hash('sha1', 'atoum');
   $notHash = 'atoum';
   
   $this
       ->hash($hash)
           ->isSha1()      // passes
       ->hash($notHash)
           ->isSha1()      // fails
   ;

.. _issha256:

isSha256
^^^^^^^^

``isSha256`` checks that the string is a ``sha256``, an hexadecimal string of 64 characters.

.. code-block:: php

   $hash    = hash('sha256', 'atoum');
   $notHash = 'atoum';
   
   $this
       ->hash($hash)
           ->isSha256()    // passes
       ->hash($notHash)
           ->isSha256()    // fails
   ;

.. _issha512:

isSha512
^^^^^^^^

``isSha512`` checks that the string is a ``sha512``, an hexadecimal string of 128 characeters.

.. code-block:: php

   $hash    = hash('sha512', 'atoum');
   $notHash = 'atoum';
   
   $this
       ->hash($hash)
           ->isSha512()    // passes
       ->hash($notHash)
           ->isSha512()    // fails
   ;

.. _notcontains----hashnotcontains:

notContains====hashNotContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``notContains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::notContains`` <stringnotcontains>` documentation
}}}



.. _output:

output
~~~~~~

This is the asserter for output streams, that is supposed to be displayed on the screen.

.. code-block:: php

   $this
       ->output(
           function() {
               echo 'Hello world';
           }
       )
   ;

.. note::
   The syntax use anonymous functions (also named closures) introduced in PHP 5.3. For more information read `the PHP manual <http://php.net/functions.anonymous>`_.

.. _contains----outputcontains:

contains====outputContains
^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``contains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::contains`` <stringcontains>` documentation
}}}

.. _haslength----outputhaslength:

hasLength====outputHasLength
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLength`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLength`` <stringhaslength>` documentation
}}}

.. _haslengthgreaterthan----outputhaslengthgreaterthan:

hasLengthGreaterThan====outputHasLengthGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLengthGreaterThan`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLengthGreaterThan`` <stringhaslengthgreaterthan>` documentation
}}}

.. _haslengthlessthan----outputhaslengthlessthan:

hasLengthLessThan====outputHasLengthLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLengthLessThan`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLengthLessThan`` <stringhaslengthlessthan>` documentation
}}}

.. _isempty----outputisempty:

isEmpty====outputIsEmpty
^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEmpty`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEmpty`` <stringisempty>` documentation
}}}

.. _isequalto----outputisequalto:

isEqualTo====outputIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isequaltocontentsoffile----outputisequaltocontentsoffile:

isEqualToContentsOfFile====outputIsEqualToContentsOfFile
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualToContentsOfFile`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEqualToContentsOfFile`` <stringisequaltocontentsoffile>` documentation
}}}

.. _isidenticalto----outputisidenticalto:

isIdenticalTo====outputIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isnotempty----outputisnotempty:

isNotEmpty====outputIsNotEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEmpty`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isNotEmpty`` <stringisnotempty>` documentation
}}}

.. _isnotequalto----outputisnotequalto:

isNotEqualTo====outputIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----outputisnotidenticalto:

isNotIdenticalTo====outputIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _match----outputmatch:

match====outputMatch
^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``match`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::match`` <stringmatch>` documentation
}}}

.. _notcontains----outputnotcontains:

notContains====outputNotContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``notContains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::notContains`` <stringnotcontains>` documentation
}}}



.. _utf8string:

utf8String
~~~~~~~~~~

This is the asserter for UTF-8 strings.

.. note::
   ``utf8Strings`` uses the ``mb_*`` functions to handle multi-bytes strings. Read the PHP manual for more information about the extension ```mbstring <http://php.net/mbstring>`_``.

.. _contains----utf8stringcontains:

contains====utf8StringContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``contains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::contains`` <stringcontains>` documentation
}}}

.. _haslength----utf8stringhaslength:

hasLength====utf8StringHasLength
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLength`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLength`` <stringhaslength>` documentation
}}}

.. _haslengthgreaterthan----utf8stringhaslengthgreaterthan:

hasLengthGreaterThan====utf8StringHasLengthGreaterThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLengthGreaterThan`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLengthGreaterThan`` <stringhaslengthgreaterthan>` documentation
}}}

.. _haslengthlessthan----utf8stringhaslengthlessthan:

hasLengthLessThan====utf8StringHasLengthLessThan
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``hasLengthLessThan`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::hasLengthLessThan`` <stringhaslengthlessthan>` documentation
}}}

.. _isempty----utf8stringisempty:

isEmpty====utf8StringIsEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEmpty`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEmpty`` <stringisempty>` documentation
}}}

.. _isequalto----utf8stringisequalto:

isEqualTo====utf8StringIsEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isEqualTo`` <variableisequalto>` documentation
}}}

.. _isequaltocontentsoffile----utf8stringisequaltocontentsoffile:

isEqualToContentsOfFile====utf8StringIsEqualToContentsOfFile
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isEqualToContentsOfFile`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isEqualToContentsOfFile`` <stringisequaltocontentsoffile>` documentation
}}}

.. _isidenticalto----utf8stringisidenticalto:

isIdenticalTo====utf8StringIsIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isIdenticalTo`` <variableisidenticalto>` documentation
}}}

.. _isnotempty----utf8stringisnotempty:

isNotEmpty====utf8StringIsNotEmpty
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEmpty`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::isNotEmpty`` <stringisnotempty>` documentation
}}}

.. _isnotequalto----utf8stringisnotequalto:

isNotEqualTo====utf8StringIsNotEqualTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotEqualTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotEqualTo`` <variableisnotequalto>` documentation
}}}

.. _isnotidenticalto----utf8stringisnotidenticalto:

isNotIdenticalTo====utf8StringIsNotIdenticalTo
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``isNotIdenticalTo`` is an inherited method from the ``variable`` asserter.
For more information, you can read the :ref:```variable::isNotIdenticalTo`` <variableisnotidenticalto>` documentation
}}}

.. _match----utf8stringmatch:

match====utf8StringMatch
^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``match`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::match`` <stringmatch>` documentation
}}}

.. note::
   Don't forget to add the ``u`` to your regular expression. For more information read the `PHP manual <http://php.net/reference.pcre.pattern.modifiers>`_.

.. code-block:: php

   $vdm = "Aujourd'hui, à 57 ans, mon père s'est fait tatouer une licorne sur l'épaule. VDM";
   
   $this
       ->utf8String($vdm)
           ->match("#^Aujourd'hui.*VDM$#u")
   ;

.. _notcontains----utf8stringnotcontains:

notContains====utf8StringNotContains
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

{{{inheritance
``notContains`` is an inherited method from the ``string`` asserter.
For more information, you can read the :ref:```string::notContains`` <stringnotcontains>` documentation
}}}



.. _afterdestructionof:

afterDestructionOf
~~~~~~~~~~~~~~~~~~

This is the asserter for object destruction.

The asserter only receives an object, make sure the ``__destruct()`` method is defined and call it.

If ``__destruct()`` exists and calling does not raise any error or exception, the test will pass.

.. code-block:: php

   $this
       ->afterDestructionOf($objectWithDestructor)     // passes
       ->afterDestructionOf($objectWithoutDestructor)  // fails
   ;



.. _error:

error
~~~~~

This is the asserter for errors.

.. code-block:: php

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists() // or notExists
   ;

.. note::
   The syntax use anonymous functions (also named closures) introduced in PHP 5.3. For more information read `the PHP manual <http://php.net/functions.anonymous>`_.

.. note::
   The errors types E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING along with most of the E_STRICT can't be handled by this function.

.. _exists:

exists
^^^^^^

``exists`` checks that an error has been raised when calling the anonymous function.

.. code-block:: php

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists()      // passes
   
       ->when(
           function() {
               // code sans erreur
           }
       )
           ->error()
               ->exists()      // fails
   ;

.. _notexists:

notExists
^^^^^^^^^

``notExists`` checks that no error has been raised when calling the anonymous function.

.. code-block:: php

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->notExists()   // fails
   
       ->when(
           function() {
               // no error there
           }
       )
           ->error()
               ->notExists()   // passes
   ;

.. _withtype:

withType
^^^^^^^^

``withType`` checks the raised error type.

.. code-block:: php

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->withType(E_USER_NOTICE)   // passes
               ->withType(E_USER_WARNING)  // fails
   ;



.. _class:

class
~~~~~

This is the asserter for classes.

.. code-block:: php

   $object = new \StdClass;
   
   $this
       ->class(get_class($object))
   
       ->class('\StdClass')
   ;

.. note::
   ``class`` being a reserved PHP keyword, it wasn't possible to create a ``class`` asserter. It is actually named ``phpClass`` and a ``class`` alias has been added. You may encounter ``->phpClass()`` or ``->class()``.

It is advised to only use ``->class()``.

.. _hasinterface:

hasInterface
^^^^^^^^^^^^

``hasInterface`` checks that the class implements the given interface.

.. code-block:: php

   $this
       ->class('\ArrayIterator')
           ->hasInterface('Countable')     // passes
   
       ->class('\StdClass')
           ->hasInterface('Countable')     // fails
   ;

.. _hasmethod:

hasMethod
^^^^^^^^^

``hasMethod`` checks that the class contains the given method.

.. code-block:: php

   $this
       ->class('\ArrayIterator')
           ->hasMethod('count')    // passes
   
       ->class('\StdClass')
           ->hasMethod('count')    // fails
   ;

.. _hasnoparent:

hasNoParent
^^^^^^^^^^^

``hasNoParent`` checks that the class does not inherit from any class.

.. code-block:: php

   $this
       ->class('\StdClass')
           ->hasNoParent()     // passes
   
       ->class('\FilesystemIterator')
           ->hasNoParent()     // fails
   ;

.. note::
   A class can implements one or more interface while not inheriting from any class. ``hasNoParent`` does not check implementd interfaces, only inherited classes.

.. _hasparent:

hasParent
^^^^^^^^^

``hasParent`` checks that the class inherits from a class.

.. code-block:: php

   $this
       ->class('\StdClass')
           ->hasParent()       // fails
   
       ->class('\FilesystemIterator')
           ->hasParent()       // passes
   ;

.. note::
   A class can implements one or more interface while not inheriting from any class. ``hasParent`` does not check implementd interfaces, only inherited classes.

.. _isabstract:

isAbstract
^^^^^^^^^^

``isAbstract`` checks that the class is abstract.

.. code-block:: php

   $this
       ->class('\StdClass')
           ->isAbstract()       // fails
   ;

.. _issubclassof:

isSubclassOf
^^^^^^^^^^^^

``isSubclassOf`` checks that the class inherits from the given class.

.. code-block:: php

   $this
       ->class('\FilesystemIterator')
           ->isSubclassOf('\DirectoryIterator')    // passes
           ->isSubclassOf('\SplFileInfo')          // passes
           ->isSubclassOf('\StdClass')             // fails
   ;


.. _mock:

mock
~~~~

This is the asserter for mocks.

.. code-block:: php

   $mock = new \mock\MyClass;
   
   $this
       ->mock($mock)
   ;

.. note::
   For more information on how to create mocks see :ref:`Mocks <mocks>`;

.. _call:

call
^^^^

``call`` let you specify which method of the mock to check

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->once()
   ;

=====atLeastOnce

``atLeastOnce`` check that the tested method (see ``:ref:`call <call>```) has been called at least once.

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->atLeastOnce()
   ;

=====exactly

``exactly`` check that the tested method (see ``:ref:`call <call>```) has been called a specific number of times.

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->exactly(2)
   ;

=====never

``never`` check that the tested method (see ``:ref:`call <call>```) has never been called.

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->never()
   ;

.. note::
   ``never`` is equivalent to ``:ref:`exactly <exactly>`(0)``.

=====once/twice/thrice
This asserters check that the tested method (see ``:ref:`call <call>```) has been called exactly:

* once
* twice
* thrice

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->once()
           ->call('mySecondMethod')
               ->twice()
           ->call('myThirdMethod')
               ->thrice()
   ;

.. note::
   ``once``, ``twice`` et ``thrice`` are respectively equivalent to ``:ref:`exactly <exactly>`(1)``, ``:ref:`exactly <exactly>`(2)`` et ``:ref:`exactly <exactly>`(3)``.

=====withAnyArguments

``withAnyArguments`` let you not specify the expected argument when the tested method is called (see ``:ref:`call <call>```).

This is especially useful to reset arguments, like this example:

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->withArguments('first')     ->once()
               ->withArguments('second')    ->once()
               ->withAnyArguments()->exactly(2)
   ;

=====withArguments

``withArguments`` let you specify the expected arguments that tested method should receive when called (see ``:ref:`call <call>```).

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->withArguments('first', 'second')->once()
   ;

.. note::
   ``withArguments`` does not check the arguments type. If you also want to check the type, use ``:ref:`withIdenticalArguments <withidenticalarguments>```.

=====withIdenticalArguments

``withIdenticalArguments`` let you specify the expected arguments that tested method should receive when called (see ``:ref:`call <call>```).

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->call('myMethod')
               ->withIdenticalArguments('first', 'second')->once()
   ;

.. note::
   ``withIdenticalArguments`` checks the arguments type. If you do not want to check the type, use ``:ref:`withArguments <witharguments>```.

.. _wascalled:

wasCalled
^^^^^^^^^

``wasCalled`` checks that at least one method of the mock has been called at least once.

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->wasCalled()
   ;

.. _wasnotcalled:

wasNotCalled
^^^^^^^^^^^^

``wasNotCalled`` checks that no method of the mock has been called.

.. code-block:: php

   $mock = new \mock\MyFirstClass;
   
   $this
       ->object(new MySecondClass($mock))
   
       ->mock($mock)
           ->wasNotCalled()
   ;


.. _stream:

stream
~~~~~~

This is the asserter for streams.

.. note::
   Unfortunately, I do not know how it works, feel free to contribute!

.. _isread:

isRead
^^^^^^

.. note::
   We need help to write this section !

.. _iswrite:

isWrite
^^^^^^^

.. note::
   We need help to write this section !


.. _writing-help:

Writing help
------------

There are several ways to write unit tests with atoum, and one of them is to use keywords like ``if``, ``and`` or ``then``, ``when`` or ``assert``.

.. _if--and--then:

if, and, then
~~~~~~~~~~~~~

Usage of this keywords is really intuitive:

.. code-block:: php

   $this
       ->if($computer = new computer()))
       ->and($computer->setFirstOperand(2))
       ->and($computer->setSecondOperand(2))
       ->then
           ->object($computer->add())
               ->isIdenticalTo($computer)
           ->integer($computer->getResult())
               ->isEqualTo(4)
   ;

It is important to note that theses keywords do change anything technically or functionally. Their only goal is to ease the test comprehension, which next developers will be thankful for :).

Thereby, ``if`` et ``and``  let you define the prior conditions so that the assertions that follow the ``then`` keyword pass.

However, there is no grammar defining the order these keywords are used, and no syntax check is done by atoum.

It is the developer responsibility to use them wisely, though it is possible to write tests like this:

.. code-block:: php

   $this
       ->and($computer = new computer()))
       ->and($computer->setFirstOperand(2))
       ->then
       ->if($computer->setSecondOperand(2))
           ->object($computer->add())
               ->isIdenticalTo($computer)
           ->integer($computer->getResult())
               ->isEqualTo(4)
   ;

For the same reasons, the use of ``then`` is optional.

It is also important to note that it is possible to write the same test without any keyword:

.. code-block:: php

   $computer = new computer();
   $computer->setFirstOperand(2);
   $computer->setSecondOperand(2);
   
   $this
       ->object($computer->add())
           ->isIdenticalTo($computer)
       ->integer($computer->getResult())
           ->isEqualTo(4)
   ;

There is not speed difference, the only important thing is to chose one way of doing it and stick with it.

.. _when:

when
~~~~

In addition to ``if``, ``and`` and ``then``, there are other keywords.

One of them is ``when``. It adds a feature to get around the fact that it is forbidden to write the following code in PHP:

.. code-block:: php

   $this
       ->if($object = new object($valueAtKey0 = uniqid()))
       ->and(unset($object[0]))
       ->then
           ->sizeOf($object)
               ->isZero()
   ;

PHP will raise the following fatal error: ``Parse error: syntax error, unexpected 'unset' (T_UNSET), expecting »)'``

It is impossible to use ``unset()`` as a function argument.

To fix this problem the ``when`` keyword is capable of evaluating the anonymous function that you may pass as an argument. The previous may then be written like this:

.. code-block:: php

   $this
       ->if($object = new object($valueAtKey0 = uniqid()))
       ->when(
           function() use ($object) {
               unset($object[0]);
           }
       )
       ->then
         ->sizeOf($object)
           ->isZero()
   ;

Of course, if ``when`` does not receive any anonymous function, it will behave exactly like ``if``, ``and`` and ``then``.

.. _assert:

assert
~~~~~~

Finally, there is also the ``assert`` keyword.

The following test will be used to illustrate its usage:

.. code-block:: php

   $this
       ->if($foo = new \mock\foo())
       ->and($bar = new bar($foo))
       ->and($bar->doSomething())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->exactly(2)
   ;

This test has a drawback maintenance wise, because if the developer wants to add one or more new calls to bar::doOtherThing() between the two existing calls, he will have to update the value given to exactly().
To fix this issue, you can reset a mock using 2 ways:

* using $mock->getMockController()->resetCalls() ;
* using utilisant $this->resetMock($mock).

.. code-block:: php

   $this
       ->if($foo = new \mock\foo())
       ->and($bar = new bar($foo))
       ->and($bar->doSomething())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   
       // 1st way
       ->if($foo->getMockController()->resetCalls())
       ->and($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   
       // 2nd way
       ->if($this->resetMock($foo))
       ->and($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   ;

These methods reset the controller memory, it is then possible to write the next assertion as if the mock was never called.

The ``assert`` keyword let you avoid having to explicitly call ``resetCalls()`` and it also triggers the memory reset of all the adapters and mock controllers defined when it is used.

Thanks to this feature, it is possible to write the previous test in a more readable simpler way by passing a string describing the next assertions.

.. code-block:: php

   $this
       ->assert('Foo est vide')
           ->if($foo = new \mock\foo())
           ->and($bar = new bar($foo))
           ->and($bar->doSomething())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()
   
       ->assert('Foo a une valeur')
           ->if($bar->setValue(uniqid())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()
   ;

The string will be used by atoum in atoum generated messages if one of the assertions fail.

.. _mocks:

Mocks
-----
