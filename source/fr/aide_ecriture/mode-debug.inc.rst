
.. _le-mode-debug:

Le mode débug
***************

Parfois, un test ne passe pas et il est difficile d'en découvrir la raison.

Dans ce cas, l'une des techniques possibles pour remédier au problème est de tracer le comportement du code concerné, soit directement au cœur de la classe testée à l'aide d'un débogueur ou de fonctions du type de ``var_dump()`` ou ``print_r()``, soit au niveau du test unitaire.

Et il se trouve qu’atoum dispose d'un certain nombre d'outils pour faciliter la tâche du développeur dans ce dernier contexte.

Ces outils ne sont cependant actifs que lorsqu’atoum est exécuté à l'aide de l'argument ``--debug``, afin que l'exécution des tests unitaires ne soit pas perturbée par les instructions relatives au débogage hors de ce contexte.
Lorsque l'argument ``--debug`` est utilisé, trois méthodes peuvent être activées :

* ``dump()`` qui permet de connaître le contenu d'une variable ;
* ``stop()`` qui permet d'arrêter l'exécution d'un test ;
* ``executeOnFailure()`` qui permet de définir une fonction anonyme qui ne sera exécutée qu'en cas d'échec d'une assertion.

Ces trois méthodes s'intègrent parfaitement dans l'interface fluide qui caractérise atoum.

.. _dump:

dump
====
La méthode ``dump()`` peut s'utiliser de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->dump($foo->getBar())
   ;

Lors de l'exécution du test, le retour de la méthode ``foo::getBar()`` sera affiché sur la sortie standard.

Il est également possible de passer plusieurs arguments à ``dump()``, de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->dump($foo->getBar(), $bar)
   ;

.. important::
   La méthode ``dump`` n'est activée que si vous lancez les tests avec l'argument ``--debug``. Dans le cas contraire, cette méthode sera totalement ignorée.

.. _stop:

stop
====

L'utilisation de la méthode ``stop()`` est également très simple :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->stop() // le test s'arrêtera ici si --debug est utilisé
           ->object($foo->getBar())
               ->isIdenticalTo($bar)
   ;

Si ``--debug`` est utilisé, les 2 dernières lignes ne seront pas exécutées.

.. important::
   La méthode ``stop`` n'est activée que si vous lancez les tests avec l'argument ``--debug``. Dans le cas contraire, cette méthode sera totalement ignorée.


.. _executeOnFailure:

executeOnFailure
================

La méthode ``executeOnFailure()`` est très puissante et tout aussi simple à utiliser.

Elle prend en effet en argument une fonction anonyme qui sera exécutée si et seulement si l'une des assertions composant le test n'est pas vérifiée. Elle s'utilise de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($foo = new foo())
       ->executeOnFailure(
           function() use ($foo) {
               var_dump($foo);
           }
       )
       ->then
           ->object($foo->setBar($bar = new bar()))
               ->isIdenticalTo($foo)
           ->object($foo->getBar())
               ->isIdenticalTo($bar)
   ;

Dans l'exemple précédent, contrairement à ``dump()`` qui provoque systématiquement l'affichage sur la sortie standard le contenu des variables qui lui sont passées en argument, la fonction anonyme passée en argument ne provoquera l'affichage du contenu de la variable ``foo`` que si l'une des assertions suivantes est en échec.

Bien évidemment, il est possible de faire appel plusieurs fois à ``executeOnFailure()`` dans une même méthode de test pour définir plusieurs fonctions anonymes différentes devant être exécutées en cas d'échec du test.

.. important::
   La méthode ``executeOnFailure`` n'est activée que si vous lancez les tests avec l'argument ``--debug``. Dans le cas contraire, cette méthode sera totalement ignorée.

