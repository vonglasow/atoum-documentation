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
               ->withType(E_USER_WARNING)  // échoue
   ;
