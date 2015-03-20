
.. _cookbook_hook_git:

Hook git
********

A good practice, when using a version control system, is to never add a non-functional code in repository, in order to retrieve a version clean and usable code at any time and any place the history of the deposit.

This implies, among other things, that the unit tests must pass in their entirety before the files created or modified are added to the repository, and as a result, the developer is supposed to run the unit tests before joining its code in the repository.

However, in fact, it is very easy for the developer to omit this step and your repository may therefore contain, more or less imminent, code which does not respect the constraints imposed by unit tests.

Fortunately, version control software in general and in particular Git has a mechanism, known as the pre-commit hook name to automatically perform tasks when adding code in a repository.

The installation of a pre-commit hook is very simple and takes place in two stages.


Step 1: Creation of the script to run
=======================================

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

Le code ci-dessous suppose que vos tests unitaires sont dans des fichiers ayant l'extension ``.php`` et dans des répertoires dont le chemin contient ``/Tests/Units/``. If this is not your case, you will need to modify the script depending on your context.

.. note::
   In the example above, the test files must include atoum for the hook works.

The tests are run very quickly with atoum, all unit tests can be run before each commit with a hook like this:

.. code-block:: php

   <?php
   #!/bin/sh
   ./bin/atoum -d tests/


Step 2: Add execution rights
======================================

Pour être utilisable par Git, le fichier ``.git/hook/pre-commit`` doit être rendu exécutable à l'aide de la commande suivante, exécutée en ligne de commande à partir du répertoire de votre dépôt :

.. code-block:: shell

   $ chmod u+x `.git/hook/pre-commit`

À partir de cet instant, les tests unitaires contenus dans les répertoires dont le chemin contient ``/Tests/Units/`` seront lancés automatiquement lorsque vous effectuerez la commande ``git commit``, si des fichiers ayant l'extension ``.php`` ont été modifiés.

Et si d'aventure un test ne passe pas, les fichiers ne seront pas ajoutés au dépôt. Il vous faudra alors effectuer les corrections nécessaires, utiliser la commande ``git add`` sur les fichiers modifiés et utiliser à nouveau ``git commit``.

