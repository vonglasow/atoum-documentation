.. _exception-anchor:

exception
*********

C'est l'assertion dédiée aux exceptions.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // this code throws an exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
   ;

.. note::
   The syntax uses anonymous functions (also called closures) introduced in PHP 5.3.
   For more details, read the PHP's documentation on `anonymous functions <http://php.net/functions.anonymous>`_.



.. _has-code:

hasCode
=======

``hasCode`` checks the code of the exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // This code throws a exception: throw new \Exception('Message', 42);
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasCode(42)
   ;

.. _has-default-code:

hasDefaultCode
==============

``hasDefaultCode`` checks that the code of the exception is the default value, 0.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // this code throws an exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasDefaultCode()
   ;

.. note::
   ``hasDefaultCode`` is equivalent to ``hasCode(0)``.


.. _has-message:

hasMessage
==========

``hasMessage`` checks the message from the exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // This code throws a exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasMessage('Message')     // passes
           ->hasMessage('message')     // fails
   ;

.. _has-nested-exception:

hasNestedException
==================

``hasNestedException`` checks that the exception contains a reference to another exception. If the type of the exception is given, this will also checks the class of the exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // This code throws a exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasNestedException()      // fails

       ->exception(
           function() use($myObject) {
               try {
                   // This code throws a exception: throw new \FirstException('Message 1', 42);
                   $myObject->doOneThing('wrongParameter');
               }
               // ... the exception is caught...
               catch(\FirstException $e) {
                   // ... and then throws encapsulated inside a second one
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

.. _exception-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` is a method inherited from asserter ``object``.
   For more information, refer to the documentation of  :ref:```object::isCloneOf`` <object-is-clone-of>`


.. _exception-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from ``object`` asserter.
   For more information, refer to the documentation of  :ref:```object::isEqualTo`` <object-is-equal-to>`


.. _exception-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is an inherited method from ``object`` asserter.
   For more information, refere to the documentation :ref:```object::isIdenticalTo`` <object-is-identical-to>`


.. _exception-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` is a method inherited from asserter ``object``.
   For more information, refer to the documentation of :ref:```object::isInstanceOf`` <object-is-instance-of>`


.. _exception-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from ``object`` asserter.
   For more information, refer to the documentation of  :ref:```object::isNotEqualTo`` <object-is-not-equal-to>`


.. _exception-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is an inherited method from ``object`` asserter.
   For more information, refer to the documentation :ref:```object::isNotIdenticalTo`` <object-is-not-identical-to>`


.. _message-anchor:

message
=======

``message`` enables you to get an asserter of type :ref:`string <string-anchor>` containing the message of the tested exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() {
               throw new \Exception('My custom message to test');
           }
       )
           ->message
               ->contains('message')
   ;
