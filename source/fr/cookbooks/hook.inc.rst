
.. _cookbook_hook_git:

Hook git
********

Une bonne pratique, lorsqu'on utilise un logiciel de gestion de versions, est de ne jamais ajouter à un dépôt du code non fonctionnel, afin de pouvoir récupérer une version propre et utilisable du code à tout moment et à n'importe quel endroit de l'historique du dépôt.

Cela implique donc, entre autres, que les tests unitaires doivent passer dans leur intégralité avant que les fichiers créés ou modifiés soient ajoutés au dépôt et, en conséquence, le développeur est censé exécuter les tests unitaires avant d'intégrer son code dans le dépôt.

Cependant, dans les faits, il est très facile pour le développeur d'omettre cette étape, et votre dépôt peut donc contenir à plus ou moins brève échéance du code ne respectant pas les contraintes imposées par les tests unitaires.

Heureusement, les logiciels de gestion de versions en général et Git en particulier disposent d'un mécanisme, connu sous le nom de hook de pré-commit permettant d'exécuter automatiquement des tâches lors de l'ajout de code dans un dépôt.

L'installation d'un hook de pré-commit est très simple et se déroule en deux étapes.


Étape 1 : Création du script à exécuter
=====================================

Lors de l'ajout de code à un dépôt, Git recherche le fichier ``.git/hook/pre-commit`` à la racine du dépôt et l'exécute s'il existe et qu'il dispose des droits nécessaires.

Pour mettre en place le hook, il vous faut donc créer le fichier ``.git/hook/pre-commit`` et y ajouter le code suivant :

.. code-block:: php

   <?php
   #!/usr/bin/env php
   <?php

   $_SERVER['_'] = '/usr/bin/php';

   exec('git diff --cached --name-only --diff-filter=ACMR | grep ".php"', $phpFiles);

   if ($phpFilesNumber = sizeof($phpFiles) > 0)
   {
      echo $phpFilesNumber . ' PHP files staged, launch all unit test...' . PHP_EOL;

      foreach (new \recursiveIteratorIterator(new \recursiveDirectoryIterator(__DIR__ . '/../../')) as $path => $file)
      {
        if (substr($path, -4) === '.php' && strpos($path, '/Tests/Units/') !== false)
        {
          require_once $path;
        }
      }
   }

Le code ci-dessous suppose que vos tests unitaires sont dans des fichiers ayant l'extension ``.php`` et dans des répertoires dont le chemin contient ``/Tests/Units/``. Si ce n'est pas votre cas, vous devrez modifier le script suivant votre contexte.

.. note::
   Dans l'exemple ci-dessus, les fichiers de test doivent inclure atoum pour que le hook fonctionne.

Les tests étant exécutés très rapidement avec atoum, on peut donc lancer l'ensemble des tests unitaires avant chaque commit avec un hook comme celui-ci :

.. code-block:: php

   <?php
   #!/bin/sh
   ./bin/atoum -d tests/


Étape 2 : Ajout des droits d'exécution
============================

Pour être utilisable par Git, le fichier ``.git/hook/pre-commit`` doit être rendu exécutable à l'aide de la commande suivante, exécutée en ligne de commande à partir du répertoire de votre dépôt :

.. code-block:: shell

   $ chmod u+x `.git/hook/pre-commit`

À partir de cet instant, les tests unitaires contenus dans les répertoires dont le chemin contient ``/Tests/Units/`` seront lancés automatiquement lorsque vous effectuerez la commande ``git commit``, si des fichiers ayant l'extension ``.php`` ont été modifiés.

Et si d'aventure un test ne passe pas, les fichiers ne seront pas ajoutés au dépôt. Il vous faudra alors effectuer les corrections nécessaires, utiliser la commande ``git add`` sur les fichiers modifiés et utiliser à nouveau ``git commit``.

