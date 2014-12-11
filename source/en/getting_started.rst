Getting started
###############

Installation
************

If you're willing to use it, download the latest stable build.

There are several ways to install atoum :

* As a `PHAR`_ archive
* Using `composer`_
* Using the `installer`_
* Cloning the `github`_ repository
* Using a `Symfony2 Bundle`_
* Using a `Zend Framework 2 component`_

PHAR
=====

A PHAR (PHp ARchive) is automatically built along each atoum's source code update.

PHAR is an archive format for PHP applications, available since PHP 5.3.

Installation
------------

You can download the latest stable version of atoum from the official website : `http://downloads.atoum.org/nightly/mageekguy.atoum.phar <http://downloads.atoum.org/nightly/mageekguy.atoum.phar>`_

Updating
--------

Updating atoum's PHAR is a cinch thanks to its command line tools :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update

.. note::
   The atoum's update process needs to alter the PHAR file. 
   By default, PHP comes with this feature disabled, hence the ``-d phar.readonly=0`` argument.

If a new version exists it will be downloaded and installed in the archive itself :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   Update to version 'nightly-2416-201402121146'... Done !
   Enable version 'nightly-2416-201402121146'... Done !
   Atoum was updated to version 'nightly-2416-201402121146' successfully !

If there are no new versions available, atoum stops and nothing happens.

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   There is no new version available !

atoum won't ask any confirmation before proceeding with the update as you can easily go back to a previous version.

Listing available versions from the atoum's archive
---------------------------------------------------

To show the list of versions contained in the archive, use the ``--list-available-versions`` (or the shorter ``-lav``) argument.

.. code-block:: shell

   $ php mageekguy.atoum.phar -lav
     nightly-941-201201011548
     nightly-1568-201210311708
   * nightly-2416-201402121146

Available versions will be shown, the current active one being prefixed with ``*``.

Choosing the current version
---------------------------

To set the active version of atoum, use the ``--enable-version`` (or the shorter ``-ev``) argument followed by the name of the version you want to use by default.

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar -ev DEVELOPMENT

.. note::
   Setting the active version of atoum needs PHP to be able to alter the PHAR file. 
   By default, PHP comes with this feature disabled, hence the ``-d phar.readonly=0`` argument.

Deleting older versions
-----------------------

Over time, the archive may contain several unused atoum's versions.

To delete a sepecific version of atoum, use the --delete-version (or shorter -dv) argument followed by the name of the version you want to delete.

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar -dv nightly-941-201201011548

The version has now been removed.

.. note::
   You cannot remove the currently active version.

.. note::
   
   To delete a version from the archive, PHP needs to alter the PHAR file. vailable versions will be shown, the current active one being prefixed with ``*``.
   By default, PHP comes with this feature disabled, hence the ``-d phar.readonly=0`` argument.

.. _installation-par-composer:

Composer
========

`Composer <http://getcomposer.org/>`_ is a tool for dependency management in PHP.

Start by downloading and installing Composer

.. code-block:: shell

   curl -s https://getcomposer.org/installer | php

Then, create a composer.json file at the root of your project, containing the following text

.. code-block:: json

   {
       "require": {
           "atoum/atoum": "dev-master"
       }
   }

Finally execute :

.. code-block:: shell

   php composer.phar install


Installer
=========

You can install atoum by using its dedicated `script <https://github.com/atoum/atoum-installer>`_:

.. code-block:: shell

   curl https://raw.github.com/atoum/atoum-installer/master/installer | php -- --phar
   php mageekguy.atoum.phar -v
   atoum version nightly-xxxx-yyyymmddhhmm by Frédéric Hardy (phar:///path/to/mageekguy.atoum.phar)

This script lets you install atoum locally (in a project, see the previous example) or system-wide :

.. code-block:: shell

   curl https://raw.github.com/atoum/atoum-installer/master/installer | sudo php -- --phar --global
   which atoum
   /usr/local/bin/atoum

Options are available for you to you to customize your installation of atoum : see the `documentation <https://github.com/atoum/atoum-installer/blob/master/README.md>`_ for details.

Github
======

If you want to use atoum directly from its sources, you can clone or fork its git repository on github : `git://github.com/atoum/atoum.git`_

Plugin symfony 1
================

If you want to use atoum in a Symfony 1 project, you can use the `sfAtoumPlugin plugin <https://github.com/atoum/sfAtoumPlugin>`_

Installation instructions along with usage examples are available in the cookbook :ref:`using-atoum-with-symfony-1-4` and its Github page.

Symfony2 Bundle
================

If you want to use atoum in a Symfony2 project, a bundle is available at `<https://github.com/atoum/AtoumBundle>`_.

Installation and usage instructions are available on the project's page.

Composant Zend Framework 2
==========================

If you want to use atoum in a Zend Framework 2 project, a component is available at `https://github.com/blanchonvincent/zend-framework-test-atoum <https://github.com/blanchonvincent/zend-framework-test-atoum>`_.

Installation and usage instructions are available on the project's home page.

A quick overview of atoum's philosophy
**************************************

Basic example
==============

You have to write a test class per class.

So if you want to test the infamous ``HelloWorld`` class, you have to write the ``test\units\HelloWorld`` test class.

.. note::
   atoum takes namespaces into account. If you want to test the ``Vendor\Project\HelloWorld`` class, you have to write the ``\Vendor\Project\tests\units\HelloWorld`` class.

Following is the code of the ``HelloWorld`` class we're going to test.

.. code-block:: php

   <?php
   # src/Vendor/Project/HelloWorld.php

   namespace Vendor\Project;

   class HelloWorld
   {
       public function getHiAtoum ()
       {
           return 'Hi atoum !';
       }
   }

Now, below is a sample of what the test class code could look like.

.. code-block:: php

<?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // The test class has its own namespace :
   // [tested class namespace] + "tests\units"
   namespace Vendor\Project\tests\units;

   // You must include the tested class
   require_once __DIR__ . '/../../HelloWorld.php';

   use \atoum;

   /*
    * Test class for \HelloWorld

    * Notice that it has the same name as the tested class
    * and that it extends the atoum class 
    */
   class HelloWorld extends atoum
   {
       /*
        * This method tests getHiAtoum()
        */
       public function testGetHiAtoum ()
       {
           // instantiation of new tested class
           $helloToTest = new \Vendor\Project\HelloWorld();

           $this
               // we assert that the getHiAtoum method returns a String
               ->string($helloToTest->getHiAtoum())
                   // ... et we expect the String to be 'Hi atoum !'
                   ->isEqualTo('Hi atoum !')
           ;
       }
   }

Now, let''s launch the tests suite.
You should see something like :

.. code-block:: shell

   $ ./vendor/bin/atoum -f src/Vendor/Project/tests/units/HelloWorld.php
   > PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > Vendor\Project\tests\units\HelloWorld...
   [S___________________________________________________________][1/1]
   => Test duration: 0.00 second.
   => Memory usage: 0.25 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.25 Mb.
   > Running duration: 0.04 second.
   Success (1 test, 1/1 method, 0 void method, 0 skipped method, 2 assertions)!

We''ve just tested that the ``getHiAtoum`` method :

* returns a string;
* ... that  is equal to ``"Hi atoum !"``.

All tests have passed. There you are, your code is rock solid thanks to atoum !

Rule of Thumb
=================
When you want to test a value you have to :

* indicate the type of this value (integer, float, array, string, …)
* indicate what you are expecting the value to be (equal to, null, containing a substring, ...).

