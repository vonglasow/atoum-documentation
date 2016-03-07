
.. _utilisation-avec-frameworks:

Use with frameworks
*******************

.. _utilisation-avec-ezpublish:

Use with ezPublish
==================


Step 1: Installation of atoum in eZ Publish
-------------------------------------------

The eZ Publish framework have already a directory dedicated to tests, logically named tests. It's in this directory that should be placed  the :ref:`PHAR archive <archive-phar>` of atoum. The unit test files using atoum will be placed in a subdirectory *tests/atoum* so they don't conflict with the existing.


Step 2: Creating the class of the base tests
--------------------------------------------

A class based on atoum must extend the class ``\mageekguy\atoum\test``. However, this one doesn't take into account of *eZ Publish* specificities. It's therefore mandatory to
define a base test class, derived from ``\mageekguy\atoum\test``, which will take into account these specificities and will derive all of the classes of unit tests. To do this, just defined the following class in the file ``tests\atoum\test.php``:

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



Step 3: Creating a test class
-----------------------------

By default, atoum asks that unit tests classes are in a namespace containing *test(s)\unit(s)*, in order to deduce the name of the tested class. For example, the namespace *\nameofprojet* will be used in the following. For simplicity, it's further advisable to model the test tree on the tested classes tree, in order to quickly locate the class of a tested class, and vice versa.

.. code-block:: php

	<?php

	namespace nameofproject\tests\units;

	require_once '../test.php';

	use ezp;

	class cache extends ezp\test
	{
	   public function testClass()
	   {
		  $this->assert->hasMethod('__construct');
	   }
	}


Step 4: Running the unit tests
------------------------------

Once a test class created, simply execute this command-line to start the test from the root of the project:

.. code-block:: shell

	# php tests/atoum/mageekguy.atoum.phar -d tests/atoum/units


Thanks to `Jérémy Poulain <https://github.com/Tharkun>`_ for this tutorial.


.. _utilisation-avec-symfony-2:

Use with Symfony 2
==================

If you want to use atoum within your Symfony projects, you can install the Bundle `AtoumBundle <https://github.com/atoum/AtoumBundle>`_.

If you want to install and configure atoum manually, here's how to do it.


Step 1: installation of atoum
-----------------------------

If you use Symfony 2.0, :ref:`download the PHAR <archive-phar>` and place it in the vendor directory which is at the root of your project.

If you use Symfony 2.1+, :ref:`add atoum in your composer.json <installation-par-composer>`.


Step 2: create the test class
-----------------------------

Imagine that we wanted to test this Entity:

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
   For more information about creating Entity in Symfony 2, refer to <http://symfony.com/fr/doc/current/book/doctrine.html#creer-une-classe-entite>`_.


Create the directory Tests/Units in your Bundle (for example src/Acme/DemoBundle/Tests/Units). It's in this directory that will be stored all tests of this Bundle.

Create a Test.php file that will serve as a base for all new tests in this Bundle.

.. code-block:: php

   <?php
   // src/Acme/DemoBundle/Tests/Units/Test.php
   namespace Acme\DemoBundle\Tests\Units;

   // It includes the class loader and active it
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

   // For Symfony 2.0 only !
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
   The inclusion of atoum's PHAR archive is only necessary for Symfony 2.0. Remove this line if you use Symfony 2.1+.


.. note::
   By default, atoum uses namespace tests/units for testing. However Symfony 2 and its class loader require capitalization at the beginning of the names. For this reason, we change tests namespace through the method: setTestNamespace('Tests\Units').


Step 3: write a test
--------------------

In the Tests/Units directory, simply recreate the tree of the classes that you want to test (for example src/Acme/DemoBundle/Tests/Units/Entity/Car.php).

Create our test file:

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


Step 4: launch tests
--------------------

If you use Symfony 2.0:

.. code-block:: shell

   # Launch tests of one file
   $ php vendor/mageekguy.atoum.phar -f src/Acme/DemoBundle/Tests/Units/Entity/Car.php

   # Launch all tests of the Bundle
   $ php vendor/mageekguy.atoum.phar -d src/Acme/DemoBundle/Tests/Units

If you use Symfony 2.1+:

.. code-block:: shell

   # Launch tests of one file
   $ ./bin/atoum -f src/Acme/DemoBundle/Tests/Units/Entity/Car.php

   # Launch all tests of the Bundle
   $ ./bin/atoum -d src/Acme/DemoBundle/Tests/Units

.. note::
   You can get more information on the :ref:`test launch <lancement-des-tests>` in the chapter which is dedicated to.


In any case, this is what you should get:

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

Use with symfony 1.4
====================

If you want to use atoum inside your Symfony 1.4 project, you can install the plugins sfAtoumPlugin. It's available on this address: `https://github.com/atoum/sfAtoumPlugin <https://github.com/atoum/sfAtoumPlugin>`_.


Installation
------------

There are several ways to install this plugin in your project:

* installation via composer
* installation via git submodules


Using composer
""""""""""""""

Add this lines inside the composer.json file:

.. code-block:: json

   "require"     : {
     "atoum/sfAtoumPlugin": "*"
   },

After a ``php composer.phar update`` the plugin should be in the plugin folder and atoum in the ``vendor`` folder.

Then, in your ProjectConfiguration file, you have to activate the plugin and define the atoum path.

.. code-block:: php

   <?php
   sfConfig::set('sf_atoum_path', dirname(__FILE__) . '/../vendor/atoum/atoum');

   if (sfConfig::get('sf_environment') != 'prod')
   {
     $this->enablePlugins('sfAtoumPlugin');
   }


Using a git submodule
"""""""""""""""""""""

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
-----------

Tests must include the bootstrap file from the plugin:

.. code-block:: php

   <?php
   require_once __DIR__ . '/../../../../plugins/sfAtoumPlugin/bootstrap/unit.php';


Launch tests
------------

The symfony command ``atoum:test`` is available. The tests can then be launched in this way:

.. code-block:: shell

   $ ./symfony atoum:test

All the arguments of atoum are available.

It's therefore, for example, possible to give a configuration file like this :

.. code-block:: php

   <?php
   php symfony atoum:test -c config/atoum/hudson.php


.. _framework-symfony-1-plugin:

Symfony 1 plugin
================

To use atoum within a symfony project 1, a plug-in exists and is available at the following address: `https://github.com/atoum/sfAtoumPlugin <https://github.com/atoum/sfAtoumPlugin>`_.

The instructions for installation and use are the cookbook  :ref:`utilisation-avec-symfony-1-4` as well as on the github page.


.. _framework-symfony-2-bundle:

Symfony 2 bundle
================

To use atoum inside a Symfony 2 project, the bundle `AtoumBundle <https://github.com/atoum/AtoumBundle>`_  is available.

The instructions for installation and use are the cookbook :ref:`utilisation-avec-symfony-2` as well as on the github page.

.. _framework-zend-framework-2:

Zend Framework 2 component
==========================

If you want to use atoum within a Zend Framework 2 project, a component exists and is available at the `following address <https://github.com/blanchonvincent/zend-framework-test-atoum>`_.

The instructions for installation and usage are available on this page.
