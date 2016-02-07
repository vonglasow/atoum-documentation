
.. _initialization_method:

Les méthodes d'initialisation
*****************************

Voici le processus, lorsque atoum exécute les méthodes de test d'une classe avec le moteur par défaut (``concurrent``) :

#. appel de la méthode ``setUp()`` de la classe de test ;
#. lancement d'un sous-processus PHP pour exécuter **chaque méthode** de test ;
#. dans le sous-processus PHP, appel de la méthode ``beforeTestMethod()`` de la classe de test ;
#. dans le sous-processus PHP, appel de la méthode de test ;
#. dans le sous-processus PHP, appel de la méthode ``afterTestMethod()`` de la classe de test ;
#. une fois le sous-processus PHP terminé, appel de la méthode ``tearDown()`` de la classe de test.

.. note::
   Pour plus d'informations sur les moteurs d'exécution des tests d'atoum, vous pouvez lire le paragraphe sur l'annotation `@engine`_.

Les méthodes ``setUp()`` et ``tearDown()`` permettent donc respectivement d'initialiser et de nettoyer l'environnement de test pour l'ensemble des méthodes de test de la classe exécutée.

Les méthodes ``beforeTestMethod()`` et ``afterTestMethod()`` permettent respectivement d'initialiser et de nettoyer l'environnement d'exécution des tests individuellement pour chacune des méthodes de test de la classe, puisqu'elles sont exécutées dans le même sous-processus, au contraire de ``setUp()`` et ``tearDown()``.

C'est d'ailleurs la raison pour laquelle les méthodes ``beforeTestMethod()`` et ``afterTestMethod()`` acceptent comme argument le nom de la méthode de test exécutée, afin de pouvoir ajuster les traitements en conséquence.

.. code-block:: php

   <?php
   namespace vendor\project\tests\units;

   use
       mageekguy\atoum,
       vendor\project
   ;

   require __DIR__ . '/mageekguy.atoum.phar';

   class bankAccount extends atoum
   {
       public function setUp()
       {
           // Exécutée *avant l'ensemble* des méthodes de test.
           // Initialisation globale.
       }

       public function beforeTestMethod($method)
       {
           // Exécutée *avant chaque* méthode de test.

           switch ($method)
           {
               case 'testGetOwner':
                   // Initialisation pour testGetOwner().
               break;

               case 'testGetOperations':
                   // Initialisation pour testGetOperations().
               break;
           }
       }

       public function testGetOwner()
       {
           ...
       }

       public function testGetOperations()
       {
           ...
       }

       public function afterTestMethod($method)
       {
           // Exécutée *après chaque* méthode de test.

           switch ($method)
           {
               case 'testGetOwner':
                   // Nettoyage pour testGetOwner().
               break;

               case 'testGetOperations':
                   // Nettoyage pour testGetOperations().
               break;
           }
       }

       public function tearDown()
       {
           // Exécutée après l'ensemble des méthodes de test.
           // Nettoyage global.
       }
   }

Par défaut, les méthodes ``setUp()``, ``beforeTestMethod()``, ``afterTestMethod()`` et ``tearDown()`` ne font absolument rien.

Il est donc de la responsabilité du programmeur de les surcharger lorsque c'est nécessaire dans les classes de test concerné.
