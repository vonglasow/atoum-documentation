.. _after-destruction-of:

afterDestructionOf
******************

C'est l'assertion dédiée à la destruction des objets.

Cette assertion ne fait que prendre un objet, vérifier que la méthode ``__destruct()`` est bien définie puis l'appelle.

Si ``__destruct()`` existe bien et si son appel se passe sans erreur ni exception, alors le test passe.

.. code-block:: php

   <?php
   $this
       ->afterDestructionOf($objectWithDestructor)     // passe
       ->afterDestructionOf($objectWithoutDestructor)  // échoue
   ;
