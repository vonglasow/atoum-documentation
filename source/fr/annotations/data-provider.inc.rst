
.. _data-provider:

Data providers
**************

Atoum vous propose plusieurs types de fournisseurs de données pour aider à tester le plus efficacement possible vos classes.

Un data provider est une méthode spécifique d'une classe de test chargée de générer des arguments pour une méthode de test, arguments qui seront utilisés par ladite méthode pour valider des assertions.

Si méthode de test ``testFoo`` prend des arguments, mais qu'aucune annotation précisant le data provider n'est présente, atoum va automatiquement rechercher une méthode ``testFooDataProvider``.

Vous pouvez également définir manuellement le nom de la méthode du data provider grâce à l'annotation ``@dataProvider`` à ajouter à la méthode de test :

.. code-block:: php

   <?php
   class calculator extends atoum
   {
       /**
        * @dataProvider sumDataProvider
        */
       public function testSum($a, $b)
       {
           $this
               ->if($calculator = new project\calculator())
               ->then
                   ->integer($calculator->sum($a, $b))->isEqualTo($a + $b)
           ;
       }

       ...
   }

Bien évidemment, il faut penser a définir les arguments de la méthode de test qui vont recevoir les données retournées par le data provider. Dans le cas contraire, atoum va retourner des erreurs lors de l'exécution des tests.

Un data provider est une méthode protégée qui retourne un tableau ou un itérateur qui contient de simples valeurs :

.. code-block:: php

   <?php
   class calculator extends atoum
   {
       ...

       // Fourni des données pour testSum().
       protected function sumDataProvider()
       {
           return array(
               array( 1, 1),
               array( 1, 2),
               array(-1, 1),
               array(-1, 2),
           );
       }
   }

Lors de l'exécution des test, atoum va appeler la méthode ``testSum()`` avec les arguments ``(1, 1)``, ``(1, 2)``, ``(-1, 1)`` et ``(-1, 2)``, tels que retournés par la méthode ``sumDataProvider()``.

.. warning::
   L'isolation des tests ne sera pas utilisée dans ce cas d'utilisation, ce qui signifie que les appels successifs à la méthode ``testSum()`` seront exécutés dans le même processus PHP.
