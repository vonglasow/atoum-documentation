
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

When adding code to a repository, Git looks for the file ``.git/hook/pre-commit`` in the root of the repository and executes it if it exists and that it has the necessary rights.

To set up the hook, you must therefore create the ``.git/hook/pre-commit`` file and add the following code:

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

The code below assumes that your unit tests are in files with the extension ``.php`` and directories path contains ``/ Tests/Units``. If this is not your case, you will need to modify the script depending on your context.

.. note::
   In the example above, the test files must include atoum for the hook works.

The tests are run very quickly with atoum, all unit tests can be run before each commit with a hook like this:

.. code-block:: php

   <?php
   #!/bin/sh
   ./bin/atoum -d tests/


Step 2: Add execution rights
======================================

To be usable by Git, the file ``.git/hook/pre-commit`` must be made executable by using the following command, executed in command line from the directory of your deposit:

.. code-block:: shell

   $ chmod u+x `.git/hook/pre-commit`

From this moment on, unit tests contained in the directories with the path contains ``/ Tests/Units`` will be launched automatically when you perform the command ``git commit``, if files with the extension ``.php`` have been changed.

And if unfortunately a test does not pass, the files will not be added to the repository. You must then make the necessary adjustments, use the command ``git add`` on modified files and use again ``git commit``.

