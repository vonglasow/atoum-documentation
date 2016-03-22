
.. _bootstrap_file:

Fichier de bootstrap
********************

atoum autorise la définition d'un fichier de ``bootstrap`` qui sera exécuté avant chaque méthode de test et qui permet donc d'initialiser l'environnement d'exécution des tests.

Il devient ainsi possible de définir, par exemple, une fonction d'auto-chargement de classes, de lire un fichier de configuration ou de réaliser toute autre opération nécessaire à la bonne exécution des tests.

La définition de ce fichier de ``bootstrap`` peut se faire de deux façons différentes, soit en ligne de commande, soit via un fichier de configuration. Si vous nommez votre fichier de bootstrap ``.bootstrap.atoum.php``, atoum le chargera automatiquement si ce fichier se trouve dans le répertoire courant d'où vous lancer atoum.

En ligne de commande, il faut utiliser au choix l'argument ``-bf`` ou l'argument ``--bootstrap-file`` suivi du chemin relatif ou absolu vers le fichier concerné :

.. code-block:: shell

   $ ./bin/atoum -bf path/to/bootstrap/file

.. note::
   Un fichier de bootstrap n'est pas un fichier de configuration et n'a donc pas les mêmes possibilités.

.. _framework-zend-framework-2:

Dans un fichier de configuration, atoum est configurable via la variable ``$runner``, qui n'est pas définie dans un fichier de ``bootstrap``.

De plus, ils ne sont pas inclus au même moment, puisque le fichier de configuration est inclus par atoum avant le début de l'exécution des tests mais après le lancement des tests, alors que le fichier de ``bootstrap``, s'il est défini, est le tout premier fichier inclus par atoum proprement dit. Enfin, le fichier de ``bootstrap`` peut permettre de ne pas avoir à inclure systématiquement le fichier ``scripts/runner.php`` ou l'archive PHAR de atoum dans les classes de test.

Cependant, dans ce cas, il ne sera plus possible d'exécuter directement un fichier de test directement via l'exécutable PHP en ligne de commande.

Pour cela, il suffit d'inclure dans le fichier de ``bootstrap`` le fichier ``scripts/runner.php`` ou l'archive PHAR d’atoum et d'exécuter systématiquement les tests en ligne de commande via ``scripts/runner.php`` ou l'archive PHAR.

Le fichier de ``bootstrap`` doit donc au minimum contenir ceci :

.. code-block:: php

   <?php

   // si l'archive PHAR est utilisée :
   require_once path/to/mageekguy.atoum.phar;

   // ou si les sources sont utilisées :
   // require_once path/atoum/scripts/runner.php
