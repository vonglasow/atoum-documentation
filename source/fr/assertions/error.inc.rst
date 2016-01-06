.. _error-anchor:

error
*****

C'est l'assertion dédiée aux erreurs.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists() // ou notExists
   ;

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3.
   Pour plus de précision, lisez la documentation PHP sur `les fonctions anonymes <http://php.net/functions.anonymous>`_.


.. warning::
   Les types d'erreur E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING ainsi que la plupart des E_STRICT ne peuvent pas être gérés avec cette fonction.


.. _exists-anchor:

exists
======

``exists`` vérifie qu'une erreur a été levée lors de l'exécution du code précédent.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists()      // passe

       ->when(
           function() {
               // code sans erreur
           }
       )
           ->error()
               ->exists()      // échoue
   ;

.. _not-exists:

notExists
=========

``notExists`` vérifie qu'aucune erreur n'a été levée lors de l'exécution du code précédent.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->notExists()   // échoue

       ->when(
           function() {
               // code sans erreur
           }
       )
           ->error()
               ->notExists()   // passe
   ;

.. _with-type:

withType
========

``withType`` vérifie le type de l'erreur levée.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withType(E_USER_NOTICE)   // passe
           ->exists()

       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withType(E_USER_WARNING)  // échoue
           ->exists()
   ;


.. _with-any-type:

withAnyType
===========

``withAnyType`` ne vérifie pas le type de l'erreur. C'est le comportement par défaut de l'asserter. Donc ``->error()->withAnyType()->exists()`` est l'équivalent de ``->error()->exists()``. Cette méthode existe pour ajouter de la sémantique dans vos tests.


.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withAnyType()   // passe
           ->exists()
       ->when(
           function() {
           }
       )
       ->error()
           ->withAnyType()
           ->exists() // échoue
   ;


.. _with-message:

withMessage
===========

``withMessage`` vérifie le contenu du message de l'erreur levée.


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
           ->exists() // passe
   ;

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withMessage('MESSAGE')
           ->exists() // échoue
   ;


.. _with-any-message:

withAnyMessage
==============

``withAnyMessage`` ne vérifie pas le message de l'erreur. C'est le comportement par défaut de l'asserter. Donc ``->error()->withAnyMessage()->exists()`` est l'équivalent de ``->error()->exists()``. Cette méthode existe pour ajouter de la sémantique dans vos tests.

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
           ->exists() // passe
   ;

   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
       ->error()
           ->withAnyMessage()
           ->exists() // passe
   ;

   $this
       ->when(
           function() {
           }
       )
       ->error()
           ->withAnyMessage()
           ->exists() // échoue
   ;
