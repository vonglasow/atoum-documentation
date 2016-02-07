
.. _data-provider:

Fournisseurs de données (data provider)
***************************************

Pour vous aider à tester efficacement vos classes, atoum met à votre disposition des fournisseurs de données (data provider en anglais).

Un fournisseur de données est une méthode d'une classe de test chargée de générer des arguments pour une méthode de test, arguments qui seront utilisés par ladite méthode pour valider des assertions.

Si une méthode de test ``testFoo`` prend des arguments et qu'aucune annotation relative à un fournisseur de données n'est définie, atoum cherchera automatiquement la méthode protected ``testFooDataProvider``.

Vous pouvez néanmoins définir manuellement le nom de la méthode du fournisseur de données grâce à l'annotation ``@dataProvider`` appliquée à la méthode de test concernée, de la manière suivante :

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

Évidemment, il ne faut pas oublier de définir, au niveau de la méthode de test, les arguments correspondant à ceux qui seront retournés par le fournisseur de données. Si ce n'est pas le cas, atoum générera une erreur lors de l'exécution des tests.

La méthode du fournisseur de données est une simple méthode protected qui retourne un tableau ou un itérateur contenant des données :

.. code-block:: php

   <?php
   class calculator extends atoum
   {
       ...

       // Fournisseur de données de testSum().
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

Lors de l'exécution des tests, atoum appellera la méthode de test ``testSum()`` successivement avec les arguments ``(1, 1)``, ``(1, 2)``, ``(-1, 1)`` et ``(-1, 2)`` renvoyés par la méthode ``sumDataProvider()``.

.. warning::
   L'isolation des tests ne sera pas utilisée dans ce contexte, ce qui veut dire que chacun des appels successifs à la méthode ``testSum()`` sera réalisé dans le même processus PHP.
