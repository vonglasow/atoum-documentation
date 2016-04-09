
Il est possible d'écrire des tests unitaires avec atoum de plusieurs manières, et l'une d'elles est d'utiliser des mots-clefs tels que ``given``, ``if``, ``and`` ou bien encore ``then``, ``when`` ou ``assert`` qui permettent de mieux organiser et de rendre plus lisibles les tests.

.. _given-if-and-then:

``given``, ``if``, ``and`` et ``then``
***************************************

L'utilisation de ces mots-clefs est très intuitive :

.. code-block:: php

   <?php
   $this
       ->given($computer = new computer())
       ->if($computer->prepare())
       ->and(
           $computer->setFirstOperand(2),
           $computer->setSecondOperand(2)
       )
       ->then
           ->object($computer->add())
               ->isIdenticalTo($computer)
           ->integer($computer->getResult())
               ->isEqualTo(4)
   ;

Il est important de noter que ces mots-clés n'ont pas un autre but que de donner aux tests une forme plus lisible. Elles n'ont aucun effet technique sur les tests. Le seul but est d'aider le lecteur, les humains ou plus précisément le développeur, à comprendre ce qui se passe dans le test.

Ainsi, ``given``, ``if`` et ``and`` permettent de définir les conditions préalables pour que les assertions qui suivent le mot-clef ``then`` passent avec succès.

Cependant, il n'y a pas de grammaire régissant l'ordre d'utilisation de ces mots-clefs et aucune vérification syntaxique n'est effectuée par atoum.

Ainsi, le développeurs utiliseras ces mots-clés a bon escient  pour rendre les tests aussi lisibles que possible. Mal utilisé, vous finiriez avec des tests écrit de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->and($computer = new computer())
       ->if($computer->setFirstOperand(2))
       ->then
       ->given($computer->setSecondOperand(2))
           ->object($computer->add())
               ->isIdenticalTo($computer)
           ->integer($computer->getResult())
               ->isEqualTo(4)
   ;

Pour les mêmes raisons, l'utilisation de ``then`` est facultative.

Il est également important de noter qu'il est tout à fait possible d'écrire le même test en n'utilisant aucun mot-clef :

.. code-block:: php

   <?php
   $computer = new computer();
   $computer->setFirstOperand(2);
   $computer->setSecondOperand(2);

   $this
       ->object($computer->add())
           ->isIdenticalTo($computer)
       ->integer($computer->getResult())
           ->isEqualTo(4)
   ;

Le test ne sera pas plus lent ou plus rapide à exécuter, et il n'y a aucun avantage à utiliser une notation plutôt qu'une autre, l'important est d'en choisir une et de s'y tenir. De cette façon, cela permet de facilité la maintenance des tests (le problème est exactement le même que les conventions de codage).

.. _when:

when
****

En plus de ``given``, ``if``, ``and`` et ``then``, il existe également d'autres mots-clefs.

L'un d'entre eux est ``when``. Il dispose d'une fonctionnalité spécifique introduite pour contourner le fait qu'il est illégal d'écrire en PHP le code suivant :

.. code-block:: php

   <?php
   $this
       ->if($array = array(uniqid()))
       ->and(unset($array[0]))
       ->then
           ->sizeOf($array)
               ->isZero()
   ;

Le langage génère en effet dans ce cas l'erreur fatale : ``Parse error: syntax error, unexpected 'unset' (T_UNSET), expecting ')'``

Il est en effet impossible d'utiliser ``unset()`` comme argument d'une fonction.

Pour résoudre ce problème, le mot-clef ``when`` est capable d'interpréter l'éventuelle fonction anonyme qui lui est passée en argument, ce qui permet d'écrire le test précédent de la manière suivante :

.. code-block:: php

   <?php
   $this
       ->if($array = array(uniqid()))
       ->when(
           function() use ($array) {
               unset($array[0]);
           }
       )
       ->then
         ->sizeOf($array)
           ->isZero()
   ;

Bien évidemment, si ``when`` ne reçoit pas de fonction anonyme en argument, il se comporte exactement comme ``given``, ``if``, ``and`` et ``then``, à savoir qu'il ne fait absolument rien fonctionnellement parlant.
