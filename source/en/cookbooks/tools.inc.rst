

.. _cookbook_utilisation_behat:

Use in behat
**********************

The *asserters* from atoum are very easy to use outside your traditional unit tests. Just import the class *mageekguy\atoum\asserter* without forgetting to load the required classes (atoum provides an autoload class available in *classes/autoloader.php*).
The following example illustrates this usage of asserter from atoumin your Behat *steps*.

Installation
============

Simply install atoum and Behat in your project via pear, git clone, zip... Here is an example with dependency manager *Composer*:

.. code-block:: json

   "require-dev": {
           "behat/behat": "2.4@stable",
           "atoum/atoum": "dev-master",
   }

It is obviously mandatory to update  your composer dependencies with the command:

.. code-block:: shell

   $ php composer.phar update --dev


Configuration
=============

As mentioned in the introduction, just import the asserter classes from atoum and ensure that they are loaded. For Behat, the configuration of asserters are done inside the class *FeatureContext.php* (located by default in your directory */root-of-project/features/bootstrap/*).

.. code-block:: php

   <?php

   use Behat\Behat\Context\ClosuredContextInterface,
       Behat\Behat\Context\TranslatedContextInterface,
       Behat\Behat\Context\BehatContext,
       Behat\Behat\Exception\PendingException,
       Behat\Behat\Context\Step;
   use Behat\Gherkin\Node\PyStringNode,
       Behat\Gherkin\Node\TableNode;

   use mageekguy\atoum\asserter; // <- atoum asserter

   require_once __DIR__ . '/../../vendor/mageekguy/atoum/classes/autoloader.php'; // <- autoload

   class FeatureContext extends BehatContext
   {
       private $assert;

       public function __construct(array $parameters)
       {
           $this->assert = new asserter\generator();
       }
   }


Usage
===========

After these 2 particular trivial steps, your *steps* can be enriched with the atoum asserters:

.. code-block:: php

   <?php

   // ...

   class FeatureContext extends BehatContext
   {//...

       /**
        * @Then /^I should get a good response using my favorite "([^"]*)"$/
        */
       public function goodResponse($contentType)
       {
           $this->assert
               ->integer($response->getStatusCode())
                   ->isIdenticalTo(200)
               ->string($response->getHeader('Content-Type'))
                   ->isIdenticalTo($contentType);
       }
   }

Once again, this is only an example specific to Behat but it remains valid for all needs of using the asserters of atoum outside the initial context.





.. _cookbook_utilisation_ci:

Use with continous integration tools (CI)
*******************************************************

.. _cookbook_utilisation_jenkins:

Use inside Jenkins (or Hudson)
____________________________________

It's very simple to  the results of atoum to `Jenkins <http://jenkins-ci.org/>`_ (or `Hudson <http://hudson-ci.org/>`_) as xUnit results.


Step1: Add a xUnit report to the configuration of atoum
===========================================================

If you don't have a configuration file
----------------------------------------------

If you don't have a configuration file for atoum yet, we recommend that you extract the directory resource of atoum in that one of your choice by using the following command:

* If you are using the Parh archive of atoum:

.. code-block:: shell

   $ php mageekguy.atoum.phar --extractRessourcesTo /tmp/atoum-src
   $ cp /tmp/atoum-src/resources/configurations/runner/xunit.php.dist /my/project/atoum.php

* If you are using the sources of atoum:

.. code-block:: shell

   $ cp /path/to/atoum/resources/configurations/runner/xunit.php.dist /my/project/.atoum.php

* You can also directly copy the files from `the Github repository <https://github.com/atoum/atoum/blob/master/resources/configurations/runner/xunit.php.dist>`_

There is one last step, edit this file to set the path to the xUnit report where atoum will generate it. This file is ready to use, with him, you will keep the default report and gain a xUnit report for each launch of tests.


If you already have a configuration file
---------------------------------------------

If you already have a configuration file, simply add the following lines:

.. code-block:: php

   <?php

   //...

   /*
    * Xunit report
    */
   $xunit = new atoum\reports\asynchronous\xunit();
   $runner->addReport($xunit);

   /*
    * Xunit writer
    */
   $writer = new atoum\writers\file('/path/to/the/report/atoum.xunit.xml');
   $xunit->addWriter($writer);


Step 2: Test the configuration
=================================

To test this configuration, simply run atoum specifying the configuration file you want to use:

.. code-block:: shell

   $ ./bin/atoum -d /path/to/the/unit/tests -c /path/to/the/configuration.php

.. note::
   If you named your configuration file  ``.atoum.php``, it will be load automatically. The ``-c`` parameter is optional in this case.
   To elt atoum load automatically the ``.atoum.php`` file, you will need to run test from the folder where this file resides or one of his childs.

At the end of the tests, you will have the xUnit report inside the folder specified in the configuration.


Step 3: Laucnhing tests via Jenklins (or Hudson)
=====================================================

There are several possibilities depending on how you build your project:

* If you use a script, simply add the previous command.
* If you use a utility tool like `phing <https://www.phing.info/>`_ or `ant <http://ant.apache.org/>`_, simply add a task. In the case of ant, an exec task type:

.. code-block:: xml

   <target name="unitTests">
     <exec executable="/usr/bin/php" failonerror="yes" failifexecutionfails="yes">
       <arg line="/path/to/mageekguy.atoum.phar -p /path/to/php -d /path/to/test/folder -c /path/to/atoumConfig.php" />
     </exec>
   </target>

Notice the addition of ``-p /path/to/php`` that permit to atoum to know the path to the php binary to use to run the unit tests.


Step 4: Publish the report with Jenkins (or Hudson)
=====================================================

Simply enable the publication of report with JUnit or xUnit format of the plugin you are using, specifying the path to the file generated by atoum.



.. _cookbook_utilisation_travis-ci:

Use with Travis-CI
__________________________

it's simple to use atoum with a tool like `Travis-CI <https://travis-ci.org>`_. Indeed, all the steps are described in the `official documentation <http://docs.travis-ci.com/user/languages/php/#Working-with-atoum>`_ :
* Create your .travis.yml in your project;
* Add it the next two lines:

.. code-block:: yml
   before_script: wget http://downloads.atoum.org/nightly/mageekguy.atoum.phar
   script: php mageekguy.atoum.phar


Here is an example file `.travis.yml` where the unit tests in the `tests`folder will be run.
.. code-block:: yml

   language: php
   php:
     - 5.4
     - 5.5
     - 5.6

   before_script: wget http://downloads.atoum.org/nightly/mageekguy.atoum.phar
   script: php mageekguy.atoum.phar -d tests/



.. _cookbook_hook_git:

Git hook
********

Une bonne pratique, lorsqu'on utilise un logiciel de gestion de versions, est de ne jamais ajouter à un dépôt du code non fonctionnel, afin de pouvoir récupérer une version propre et utilisable du code à tout moment et à n'importe quel endroit de l'historique du dépôt.

Cela implique donc, entre autre, que les tests unitaires doivent passer dans leur intégralité avant que les fichiers créés ou modifiés soient ajoutés au dépôt, et en conséquence, le développeur est censé exécuter les tests unitaires avant d'intégrer son code dans le dépôt.

Cependant, dans les faits, il est très facile pour le développeur d'omettre cette étape, et votre dépôt peut donc contenir à plus ou moins brève échéance du code ne respectant  pas les contraintes imposées par les tests unitaires.

Heureusement, les logiciels de gestion de versions en général et Git en particulier dispose d'un mécanisme, connu sous le nom de hook de pré-commit permettant d'exécuter automatiquement des tâches lors de l'ajout de code dans un dépôt.

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

Le code ci-dessous suppose que vos tests unitaires sont dans des fichiers ayant l'extension ``.php`` et dans des répertoires dont le chemin contient ``/Tests/Units/``. Si ce n'est pas votre cas, vous devrez modifier le script suivant votre contexte.

.. note::
   Dans l'exemple ci-dessus, les fichiers de test doivent inclure atoum pour que le hook fonctionne.

Les tests étant executés très rapidement avec atoum, on peut donc lancer l'ensemble des tests unitaires avant chaque commit avec un hook comme celui-ci :

.. code-block:: php

   <?php
   #!/bin/sh
   ./bin/atoum -d tests/


Étape 2 : Ajout des droits d'exécution
======================================

Pour être utilisable par Git, le fichier ``.git/hook/pre-commit`` doit être rendu exécutable à l'aide de la commande suivante, exécutée en ligne de commande à partir du répertoire de votre dépôt :

.. code-block:: shell

   $ chmod u+x `.git/hook/pre-commit`

À partir de cet instant, les tests unitaires contenus dans les répertoires dont le chemin contient ``/Tests/Units/`` seront lancés automatiquement lorsque vous effectuerez la commande ``git commit``, si des fichiers ayant l'extension ``.php`` ont été modifiés.

Et si d'aventure un test ne passe pas, les fichiers ne seront pas ajoutés au dépôt. Il vous faudra alors effectuer les corrections nécessaires, utiliser la commande ``git add`` sur les fichiers modifiés et utiliser à nouveau ``git commit``.


.. _cookbook_change_default-namespace:

Changer l'espace de nom par défaut
**********************************

Au début de l'exécution d'une classe de test, atoum calcule le nom de la classe testée. Pour cela, par défaut, il remplace dans le nom de la classe de test l'expression  régulière ``#(?:^|\\\)tests?\\\units?\\#i`` par le caractère  ``\``.

Ainsi, si la classe de test porte le nom ``vendor\project\tests\units\foo``, il en déduira  que la classe testée porte le nom ``vendor\project\foo``. Cependant, il peut être nécessaire que l'espace de nom des classes de test ne corresponde pas à cette expression régulière, et dans ce cas, atoum s'arrête alors avec le message d'erreur suivant :

.. code-block:: shell

   > exception 'mageekguy\atoum\exceptions\runtime' with message 'Test class 'project\vendor\my\tests\foo' is not in a namespace which match pattern '#(?:^|\\)ests?\\unit?s\#i'' in /path/to/unit/tests/foo.php
   -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Il faut donc modifier l'expression régulière utilisée, et il est possible de le faire de plusieurs manières. La plus simple est de faire appel à l'annotions ``@namespace`` appliquée à la classe de test, de la manière suivante :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   /**
    * @namespace \my\tests
    */
   abstract class aClass extends atoum
   {
      public function testBar()
      {
         /* ... */
      }
   }


Cette méthode est simple et rapide à mettre en œuvre, mais elle présente l'inconvénient de devoir être répétée dans chaque classe de test, ce qui peut compliquer leur maintenance en cas de modification de leur espace de nom. L'alternative consiste à faire appel à la méthode ``atoum\test::setTestNamespace()`` dans
le constructeur de la classe de test, de la manière suivante :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   abstract class aClass extends atoum
   {
      public function __construct(score $score = null, locale $locale = null, adapter $adapter = null)
      {
         $this->setTestNamespace('\\my\\tests');

         parent::__construct($score, $locale, $adapter);
      }

      public function testBar()
      {
         /* ... */
      }
   }


La méthode ``atoum\test::setTestNamespace()`` accepte en effet un unique argument qui doit être l'expression régulière correspondant à l'espace de nom de votre classe de test. Et pour ne pas avoir à répéter l'appel à cette méthode dans chaque classe de test, il suffit de le faire une bonne fois pour toute dans une classe abstraite de la manière suivante :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   abstract class Test extends atoum
   {
      public function __construct(score $score = null, locale $locale = null, adapter $adapter = null)
      {
          $this->setTestNamespace('\\my\\tests');

         parent::__construct($score, $locale, $adapter);
      }
   }


Ainsi, vous n'aurez plus qu'à faire dériver vos classes de tests unitaires de cette classe abstraite :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests\modules;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;
   use vendor\project\my\tests;

   class aModule extends tests\Test
   {
      public function testDoSomething()
      {
         /* ... */
      }
   }


En cas de modification de l'espace de nommage réservé aux tests unitaires, il ne sera donc nécessaire de ne modifier que la classe abstraite.

De plus, il n'est pas obligatoire d'utiliser une expression régulière, que ce soit au niveau de l'annotation ``@namespace`` ou de la méthode  ``atoum\test::setTestNamespace()``, et une simple chaîne de caractères peut également fonctionner.

En effet, atoum fait appel par défaut à une expression régulière afin que son utilisateur puisse utiliser par défaut un large panel d'espaces de nom sans avoir besoin de le configurer à ce niveau. Cela lui permet donc d'accepter par exemple sans configuration particulière les espaces de nomsuivants :

* ``test\unit\``
* ``Test\Unit\``
* ``tests\units\``
* ``Tests\Units\``
* ``TEST\UNIT\``

Cependant, en règle général, l'espace de nom utilisé pour les classes de test est fixe, et il n'est donc pas nécessaire de recourir à une expression régulière si celle par défaut ne convient pas. Dans notre cas, elle pourrait être remplacé par la chaîne de caractères ``my\tests``, par exemple grâce à l'annotation ``@namespace`` :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   /**
    * @namespace \my\tests\
    */
   abstract class aClass extends atoum
   {
      public function testBar()
      {
         /* ... */
      }
   }
