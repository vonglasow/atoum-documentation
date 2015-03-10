Cookbook
########


.. _cookbook_singleton:

Test of a singleton
*******************

To test a method that always returns the same instance of an object, checks that two calls to the tested method are the same.

.. code-block:: php

   <?php
   $this
       ->object(\Singleton::getInstance())
           ->isInstanceOf('Singleton')
           ->isIdenticalTo(\Singleton::getInstance())
   ;


.. _cookbook_utilisation_behat:

Use in behat
**********************

Les *asserters* d'atoum sont très facilement utilisables hors de vos tests unitaires classiques. Il vous suffit d'importer la classe *mageekguy\atoum\asserter* en n'oubliant pas d'assurer le chargement des classes nécessaires (atoum fournit une classe d'autoload disponible dans *classes/autoloader.php*).
L'exemple suivant illustre cette utilisation des asserters atoum à l'intérieur de vos *steps* Behat.

Installation
============

Installez simplement atoum et Behat dans votre projet via pear, git clone, zip... Voici un exemple avec le gestionnaire de dépendances *Composer* :

.. code-block:: json

   "require-dev": {
           "behat/behat": "2.4@stable",
           "atoum/atoum": "dev-master",
   }

Il est évidemment nécessaire de remettre à jour vos dépendances composer en lançant la commande :

.. code-block:: shell

   $ php composer.phar update --dev


Configuration
=============

Comme mentionné en introduction, il suffit d'importer la classe d'asserter et d'assurer le chargement des classes d'atoum. Pour Behat, la configuration des asserters s'effectue dans votre classe *FeatureContext.php* (située par défaut dans le répertoire */RACINE DE VOTRE PROJET/features/bootstrap/*).

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


Utilisation
===========

Après ces 2 étapes particulièrement triviales, vos *steps* peuvent s'enrichir des asserters atoum :

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

Encore une fois, ceci n'est qu'un exemple spécifique à Behat mais il reste valable pour tous les besoins d'utilisation des asserters d'atoum hors contexte initial.


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


.. _utilisation-avec-frameworks:

Use with framworks
******************************


.. _utilisation-avec-ezpublish:

Use with ezPublish
__________________________


Étape 1 : Installation d'atoum au sein d'eZ Publish
===================================================

Le framework eZ Publish possède déjà un répertoire dédiés aux tests, nommés logiquement tests. C'est donc dans ce répertoire que devra être placée l':ref:`archive PHAR` <archive-phar>` de atoum. Les fichiers de tests unitaires utilisant atoum seront quand à eux placés dans un sous-répertoire *tests/atoum* afin qu'ils ne soient pas en conflit avec l'existant.


Étape 2 : Création de la classe de test de base
===============================================

Une classe de test basée sur atoum doit étendre la classe *\mageekguy\atoum\test*. Cependant, cette dernière ne prend pas en compte les spécificités de *eZ Publish*. Il est donc nécessaire de définir une classe de test de base, dérivée de *\mageekguy\atoum\test*, qui prendra en compte ces spécifités et donc dérivera l'ensemble des classes de tests unitaires. Pour cela, il suffit de définir la classe suivante dans le fichier *tests\atoum\test.php* :

.. code-block:: php

	<?php

	namespace ezp;

	use mageekguy\atoum;

	require_once __DIR__ . '/mageekguy.atoum.phar';

	// Autoloading : eZ
	require 'autoload.php';

	if ( !ini_get( "date.timezone" ) )
	{
		date_default_timezone_set( "UTC" );
	}

	require_once( 'kernel/common/i18n.php' );

	\eZContentLanguage::setCronjobMode();

	/**
	 * @abstract
	 */
	abstract class test extends atoum\test
	{
	}

	?>



Étape 3 : Création d'une classe de test
======================================

Par défaut, atoum demande à ce que les classes de tests unitaires soient dans un espace de noms contenant *test(s)\unit(s)*, afin de pouvoir déduire le nom de la classe testée. À titre d'exemple, l'espace de noms *\nomprojet* sera utilisé dans ce qui suit. Pour plus de simplicité, il est de plus conseillé de calquer l'arborescence des classes de test sur celle des classes testées, afin de pouvoir localiser rapidement la classe de test d'une classe, et inversement.

.. code-block:: php

	<?php

	namespace nomdeprojet\tests\units;

	require_once '../test.php';

	use ezp;

	class cache extends ezp\test
	{
	   public function testClass()
	   {
		  $this->assert->hasMethod('__construct');
	   }
	}


Étapes 4 : Exécution des tests unitaires
========================================

Une fois une classe de test créée, il suffit d'exécuter en ligne de commande l'instruction ci-dessous pour lancer le test, en se plaçant à la racine du projet :

.. code-block:: shell

	# php tests/atoum/mageekguy.atoum.phar -d tests/atoum/units


Merci `Jérémy Poulain <https://github.com/Tharkun>`_ pour ce tutorial.


.. _utilisation-avec-symfony-2:

Use with Symfony 2
__________________________

Si vous souhaitez utiliser atoum au sein de vos projets Symfony, vous pouvez installer le Bundle `AtoumBundle <https://github.com/atoum/AtoumBundle>`_.

Si vous souhaitez installer et configurer atoum manuellement, voici comment faire.


Étape 1: installation d'atoum
=============================

Si vous utilisez Symfony 2.0, `téléchargez l'archive PHAR <archive-phar>`_ et placez-la dans le répertoire vendor qui est à la racine de votre projet.

Si vous utilisez Symfony 2.1+, `ajoutez atoum dans votre fichier composer.json <installation-par-composer>`_.


Étape 2: création de la classe de test
======================================

Imaginons que nous voulions tester cet Entity:

.. code-block:: php

   <?php
   // src/Acme/DemoBundle/Entity/Car.php
   namespace Acme\DemoBundle\Entity;

   use Doctrine\ORM\Mapping as ORM;

   /**
    * Acme\DemoBundle\Entity\Car
    * @ORM\Table(name="car")
    * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\CarRepository")
    */
   class Car
   {
       /**
        * @var integer $id
        * @ORM\Column(name="id", type="integer")
        * @ORM\Id
        * @ORM\GeneratedValue(strategy="AUTO")
        */
       private $id;

       /**
        * @var string $name
        * @ORM\Column(name="name", type="string", length=255)
        */
       private $name;

       /**
        * @var integer $max_speed
        * @ORM\Column(name="max_speed", type="integer")
        */

       private $max_speed;
   }

.. note::
   Pour plus d'informations sur la création d'Entity dans Symfony 2, reportez-vous au `manuel Symfony <http://symfony.com/fr/doc/current/book/doctrine.html#creer-une-classe-entite>`_.


Créez le répertoire Tests/Units dans votre Bundle (par exemple src/Acme/DemoBundle/Tests/Units). C'est dans ce répertoire que seront stoqués tous les tests de ce Bundle.

Créez un fichier Test.php qui servira de base à tous les futurs tests de ce Bundle.

.. code-block:: php

   <?php
   // src/Acme/DemoBundle/Tests/Units/Test.php
   namespace Acme\DemoBundle\Tests\Units;

   // On inclus et active le class loader
   require_once __DIR__ . '/../../../../../vendor/symfony/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

   $loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

   $loader->registerNamespaces(
       array(
           'Symfony'         => __DIR__ . '/../../../../../vendor/symfony/src',
           'Acme\DemoBundle' => __DIR__ . '/../../../../../src'
       )
   );

   $loader->register();

   use mageekguy\atoum;

   // Pour Symfony 2.0 uniquement !
   require_once __DIR__ . '/../../../../../vendor/mageekguy.atoum.phar';

   abstract class Test extends atoum
   {
       public function __construct(
           adapter $adapter = null,
           annotations\extractor $annotationExtractor = null,
           asserter\generator $asserterGenerator = null,
           test\assertion\manager $assertionManager = null,
           \closure $reflectionClassFactory = null
       )
       {
           $this->setTestNamespace('Tests\Units');
           parent::__construct(
               $adapter,
               $annotationExtractor,
               $asserterGenerator,
               $assertionManager,
               $reflectionClassFactory
           );
       }
   }

.. note::
   L'inclusion de l'archive PHAR d'atoum n'est nécessaire que pour Symfony 2.0. Supprimez cette ligne dans le cas où vous utilisez Symfony 2.1+.


.. note::
   Par défaut, atoum utilise le namespace tests/units pour les tests. Or Symfony 2 et son class loader exigent des majuscules au début des noms. Pour cette raison, nous changeons le namespace des tests grâce à la méthode setTestNamespace('Tests\Units').


Étape 3: écriture d'un test
===========================

Dans le répertoire Tests/Units, il vous suffit de recréer l'arborescence des classes que vous souhaitez tester (par exemple src/Acme/DemoBundle/Tests/Units/Entity/Car.php).

Créons notre fichier de test:

.. code-block:: php

   <?php
   // src/Acme/DemoBundle/Tests/Units/Entity/Car.php
   namespace Acme\DemoBundle\Tests\Units\Entity;

   require_once __DIR__ . '/../Test.php';

   use Acme\DemoBundle\Tests\Units\Test;

   class Car extends Test
   {
       public function testGetName()
       {
           $this
               ->if($car = new \Acme\DemoBundle\Entity\Car())
               ->and($car->setName('Batmobile'))
                   ->string($car->getName())
                       ->isEqualTo('Batmobile')
                       ->isNotEqualTo('De Lorean')
           ;
       }
   }


Étape 4: lancement des tests
============================

Si vous utilisez Symfony 2.0:

.. code-block:: shell

   # Lancement des tests d'un fichier
   $ php vendor/mageekguy.atoum.phar -f src/Acme/DemoBundle/Tests/Units/Entity/Car.php

   # Lancement de tous les tests du Bundle
   $ php vendor/mageekguy.atoum.phar -d src/Acme/DemoBundle/Tests/Units

Si vous utilisez Symfony 2.1+:

.. code-block:: shell

   # Lancement des tests d'un fichier
   $ ./bin/atoum -f src/Acme/DemoBundle/Tests/Units/Entity/Car.php

   # Lancement de tous les tests du Bundle
   $ ./bin/atoum -d src/Acme/DemoBundle/Tests/Units

.. note::
   Vous pouvez obtenir plus d'informations sur le `lancement des tests <lancement-des-tests>`_ dans le chapitre qui y est consacré.


Dans tous les cas, voilà ce que vous devriez obtenir:

.. code-block:: shell

   > PHP path: /usr/bin/php
   > PHP version:
   > PHP 5.3.15 with Suhosin-Patch (cli) (built: Aug 24 2012 17:45:44)
   ===================================================================
   > Copyright (c) 1997-2012 The PHP Group
   =======================================
   > Zend Engine v2.3.0, Copyright (c) 1998-2012 Zend Technologies
   ===============================================================
   >     with Xdebug v2.1.3, Copyright (c) 2002-2012, by Derick Rethans
   ====================================================================
   > Acme\DemoBundle\Tests\Units\Entity\Car...
   [S___________________________________________________________][1/1]
   > Test duration: 0.01 second.
   =============================
   > Memory usage: 0.50 Mb.
   ========================
   > Total test duration: 0.01 second.
   > Total test memory usage: 0.50 Mb.
   > Code coverage value: 42.86%
   > Class Acme\DemoBundle\Entity\Car: 42.86%
   ==========================================
   > Acme\DemoBundle\Entity\Car::getId(): 0.00%
   --------------------------------------------
   > Acme\DemoBundle\Entity\Car::setMaxSpeed(): 0.00%
   --------------------------------------------------
   > Acme\DemoBundle\Entity\Car::getMaxSpeed(): 0.00%
   --------------------------------------------------
   > Running duration: 0.24 second.
   Success (1 test, 1/1 method, 0 skipped method, 4 assertions) !


.. _utilisation-avec-symfony-1-4:

Use withn symfony 1.4
____________________________

if you wich to use atoum inside your Symfony 1.4 project, you can install the plugins sfAtoumPlugin. It's available on this address:  `https://github.com/atoum/sfAtoumPlugin <https://github.com/atoum/sfAtoumPlugin>`_.


Installation
============

There are several way to install this plugin in your project:

* installation via composer
* installation via git submodules


Using composer
---------------------

Ad this lines inside the composer.json file:

.. code-block:: json

   "require"     : {
     "atoum/sfAtoumPlugin": "*"
   },

After a ``php composer.phar update`` the plugin should be in the plugin folder and atoum in the ``vendor`` folder.

Then in your ProjectConfiguration file you have to activate the plugin and define the atoum path.

.. code-block:: php

   <?php
   sfConfig::set('sf_atoum_path', dirname(__FILE__) . '/../vendor/atoum/atoum');

   if (sfConfig::get('sf_environment') != 'prod')
   {
     $this->enablePlugins('sfAtoumPlugin');
   }


Using a git submodule
-------------------------------

First, install atoum as a submodule:

.. code-block:: shell

   $ git submodule add git://github.com/atoum/atoum.git lib/vendor/atoum

Then install sfAtoumPlugin as a git submodule:

.. code-block:: shell

   $ git submodule add git://github.com/atoum/sfAtoumPlugin.git plugins/sfAtoumPlugin

Finally, enable the plugin in in your ProjectConfiguration file:

.. code-block:: php

   <?php
   if (sfConfig::get('sf_environment') != 'prod')
   {
     $this->enablePlugins('sfAtoumPlugin');
   }


Write tests
================

Tests must include the bootstrap file from the plugin:

.. code-block:: php

   <?php
   require_once __DIR__ . '/../../../../plugins/sfAtoumPlugin/bootstrap/unit.php';


Launch tests
================

The symfony command atoum:test is available. The tests can then be launched in this way:

.. code-block:: shell

   $ ./symfony atoum:test

All the arguments of atoum are available.

It's therefore, for example, possible to give a configuration file like this:

.. code-block:: php

   <?php
   php symfony atoum:test -c config/atoum/hudson.php



.. _cookbook_optimiser_php:

Optimiser PHP pour exécuter les tests le plus rapidement possible
*****************************************************************

Par défaut, atoum exécute chaque test dans un processus PHP séparé afin d'en garantir l'isolation. De plus, afin d'optimiser les performances et exploiter au maximum, il n'exécute pas chaque test de manière séquentielle mais parallèlement. Enfin, le code de atoum est de plus conçu de façon à s'exécuter le plus rapidement possible.

Grâce à tout cela, atoum est donc capable d'exécuter très rapidement un grand nombre de test. Cependant, en fonction du système d'exploitation, la création de chacun des sous-processus permettant l'isolation des tests peut être une opération longue et donc susceptible d'avoir un impact important sur les performances globale d'atoum. Il peut donc être très pertinent d'optimiser la taille du binaire PHP qui sera utilisé dans chaque processus afin d'exécuter encore plus rapidement les tests.

En effet, plus le binaire devant être utilisé dans un sous-processus est petit, plus la création du sous-processus correspondant s'effectue rapidement. Or, par défaut, le binaire PHP utilisé en ligne de commande embarque dans la plupart des cas un certain nombre de modules qui ne sont pas forcément utile à l'exécution des tests. Pour vous en convaincre, il vous suffit de récupérer la liste des modules intégrés à votre exécutable PHP à l'aide de la commande *php -m*. Vous constaterez alors certainement que la plupart d'entre eux sont totalement inutiles à la bonne exécution de vos tests. Et par ailleurs, qu'il est tout à fait possible de les désactiver lors de la compilation de PHP afin d'obtenir un binaire plus compact. Il y a cependant un prix à payer pour cela, puisqu'il faut alors obligatoirement compiler *PHP* manuellement. Il n'est cependant pas bien élevé, car la procédure pour cela est relativement simple.

Traditionnellement, une fois les sources du langage récupéré via `php.net <http://www.php.net/>`_, la compilation de PHP s'effectue de la manière suivante sous UNIX :

.. code-block:: shell

	# cd path/to/php/source
	# ./configure
	# make
	# make install

Il est à noter que la commande *make install* doit être exécutée en tant que super-administrateur pour fonctionner correctement. Vu que nous voulons une version sur mesure de PHP, il est nécessaire de modifier cette procédure au niveau de la commande *./configure*. C'est en effet cette commande qui permet de définir, entre autre chose, les modules qui seront intégrés à PHP lors de sa compilation, comme le prouve le résultat de la commande *./configure --help*.

Pour obtenir une version de PHP correspondant précisément à vos besoins, il faut donc commencer par demander la désactivation de l'ensemble des modules par défaut, via l'option *--disable-all*. Une fois cela effectué, il faut ajouter l'option *--enable-cli* pour obtenir uniquement à l'issue de la compilation uniquement le binaire PHP utilisable en ligne de commande. Il n'y a plus ensuite qu'à ajouter via les options * --enable-* * adéquate les modules nécessaires à l'exécution de vos tests, ainsi que les éventuelles options * --with-* * nécessaires à la compilation de ces modules. À titre d'exemple, la commande à utiliser pour compiler un binaire PHP en ligne de commande nécessaire et suffisant pour exécuter les tests unitaires de atoum sous Mac OS X est :

.. code-block:: shell

	# ./configure --disable-all --sysconfdir=/private/etc --enable-cli --with-config-file-path=/etc --with-libxml-dir=/usr  --with-pcre-regex --enable-phar --enable-hash --enable-json --enable-libxml --enable-session --enable-tokenizer --enable-posix --enable-dom


Il est à noter que si vous souhaiter installer votre binaire PHP à un endroit précis pour ne pas remplacer celui déjà installé au niveau de votre système d'exploitation, vous pouvez utiliser l'option *--prefix=path/to/destination/directory*, comme indiqué dans l'aide de *./configure*, disponible via l'option *--help*. Vous pourrez ensuite l'utiliser pour exécuter vos tests via l'argument *-p* de atoum.

Une fois la commande *./configure* exécutée avec les options adéquates, il n'y a plus qu'à poursuivre l'installation de PHP de manière traditionnelle :

.. code-block:: shell

	# make
	# make install


Une fois cela effectué, vous n'aurez plus qu'à exécuter vos tests pour constater la différence en terme de vitesse d'exécution. À titre d'information, sous Mac OS X lion sur un MacBook Air 2012, grâce à la procédure décrite ci-dessus, il est possible de passer d'un binaire PHP de 21 Mo à un binaire PHP de 4.7 Mo, ce qui permet de passer le temps d'exécution de l'ensemble des tests unitaires de atoum de 34 secondes à 17 secondes, soit un gain de 50% :

.. code-block:: shell

	# ls sapi/cli/php
	-rwxr-xr-x  1 fch  staff   4,7M 24 jul 21:46 sapi/cli/php
	# php scripts/runner.php --test-it -ncc
	> PHP path: /usr/local/bin/php
	> PHP version:
	=> PHP 5.4.5 (cli) (built: Jul 24 2012 21:39:33)
	=> Copyright (c) 1997-2012 The PHP Group
	=> Zend Engine v2.4.0, Copyright (c) 1998-2012 Zend Technologies
	> Total tests duration: 13.44 seconds.
	> Total tests memory usage: 258.75 Mb.
	> Running duration: 16.94 seconds.
	Success (144 tests, 1048/1048 methods, 16655 assertions, 0 error, 0 exception) !


En cas de problèms ou simplement de doutes, n'hésitez pas à consulter la `documentation officiel <http://php.net/manual/fr/faq.build.php>`_ sur la compilation.

