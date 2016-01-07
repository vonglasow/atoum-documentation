.. _error-anchor:

error
*****

It's assertion dedicated to errors.

.. code-block:: php

   <?php
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
   The syntax uses anonymous functions (also called closures) introduced in PHP 5.3.
   For more details, read the PHP's documentation on `anonymous functions <http://php.net/functions.anonymous>`_.


.. warning::
   The error types E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING as well as the E_STRICT can't be managed with this function.


.. _exists-anchor:

exists
======

``exists`` checks that an error was raised during the execution of the previous code.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists()      // pass

       ->when(
           function() {
               // code without error
           }
       )
           ->error()
               ->exists()      // failed
   ;

.. _not-exists:

notExists
=========

``notExists`` checks that an error was raised during the execution of the previous code.

.. code-block:: php

   <?php
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
               // code without error
           }
       )
           ->error()
               ->notExists()   // pass
   ;

.. _with-type:

withType
========

``withType`` checks the type of the raised error.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withType(E_USER_NOTICE)   // pass
           ->exists()

       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withType(E_USER_WARNING)  // failed
           ->exists()
   ;


.. _with-any-type:

withAnyType
===========

``withAnyType`` does not check the type of the raised error. That's the default behaviour. So ``->error()->withAnyType()->exists()`` is the equivalent of ``->error()->exists()``. This method is here if you want to add semantic to your test.


.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withAnyType() // pass
           ->exists()
       ->when(
           function() {
           }
       )
       ->error()
           ->withAnyType()
           ->exists() // fails
   ;


.. _with-message:

withMessage
===========

``withMessage`` checks the message content of the raised error.


.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withMessage('message')
           ->exists() // passes
   ;

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withMessage('MESSAGE')
           ->exists() // fails
   ;


.. _with-any-message:

withAnyMessage
==============

``withAnyMessage`` does not check the error message. That's the default behaviour. So ``->error()->withAnyMessage()->exists()`` is the equivalent of ``->error()->exists()``. This method is here if you want to add semantic to your test.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error();
           }
       )
       ->error()
           ->withAnyMessage()
           ->exists() // passes
   ;

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withAnyMessage()
           ->exists() // passes
   ;

   $this
       ->when(
           function() {
           }
       )
       ->error()
           ->withAnyMessage()
           ->exists() // fails
   ;
