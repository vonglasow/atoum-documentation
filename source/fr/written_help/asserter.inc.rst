
.. _asserter:

assert
******

Enfin, il existe le mot-clef ``assert`` qui a également un fonctionnement un peu particulier.

Pour illustrer son fonctionnement, le test suivant va être utilisé :

.. code-block:: php

   <?php
   $this
       ->given($foo = new \mock\foo())
       ->and($bar = new bar($foo))
       ->if($bar->doSomething())
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

Le test précédent présente un inconvénient en terme de maintenance, car si le développeur a besoin d'intercaler un ou plusieurs nouveaux appels à bar::doOtherThing() entre les deux appels déjà effectués, il sera obligé de mettre à jour en conséquence la valeur de l'argument passé à exactly().
Pour remédier à ce problème, vous pouvez remettre à zéro un mock de 2 manières différentes :

* soit en utilisant $mock->getMockController()->resetCalls() ;
* soit en utilisant $this->resetMock($mock).

.. code-block:: php

   <?php
   $this
       ->given($foo = new \mock\foo())
       ->and($bar = new bar($foo))
       ->if($bar->doSomething())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()

       // 1ère manière
       ->given($foo->getMockController()->resetCalls())
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()

       // 2ème manière
       ->given($this->resetMock($foo))
       ->if($bar->setValue(uniqid())
       ->then
           ->mock($foo)
               ->call('doOtherThing')
                   ->once()
   ;

Ces méthodes effacent la mémoire du contrôleur, il est donc possible d'écrire l'assertion suivante comme si le bouchon n'avait jamais été utilisé.

Le mot-clef ``assert`` permet de se passer de l'appel explicite à ``resetCalls()`` ou ``resetMock`` et de plus il provoque l'effacement de la mémoire de l'ensemble des adaptateurs et des contrôleurs de mock définis au moment de son utilisation.

Grâce à lui, il est donc possible d'écrire le test précédent d'une façon plus simple et plus lisible, d'autant qu'il est possible de passer une chaîne de caractère à assert afin d'expliquer le rôle des assertions suivantes :

.. code-block:: php

   <?php
   $this
       ->assert("Bar n'a pas de valeur")
           ->given($foo = new \mock\foo())
           ->and($bar = new bar($foo))
           ->if($bar->doSomething())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()

       ->assert('Bar a une valeur')
           ->if($bar->setValue(uniqid())
           ->then
               ->mock($foo)
                   ->call('doOtherThing')
                       ->once()
   ;

La chaîne de caractères sera de plus reprise dans les messages générés par atoum si l'une des assertions ne passe pas avec succès.
