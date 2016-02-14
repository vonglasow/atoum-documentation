.. _start_with_atoum:

Start with atoum
###################

.. _installation:

Installation
************

If you want to iuse it, simply download the latest version.

You can install atom from several ways:

* by downloading the `PHAR archive`_ ;
* with `composer`_;
* by cloning the `Github`_ repository;
* see also the :ref:`integration with your frameworks <utilisation-avec-frameworks>`_


.. _archive-phar:

PHAR archive
============

A PHAR (PHp ARchive) is created automatically on each modification of atoum.

PHAR is an archive format for PHP application.


Installation
------------

You can download the latest stable version of atoum directly from the official website: `http://downloads.atoum.org/nightly/mageekguy.atoum.phar <http://downloads.atoum.org/nightly/mageekguy.atoum.phar>`_


Update
-----------

The update of the archive is very simple. Just run the following command:

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update

.. note::
   The update of atoum requires the modification of the PHAR archive. However, by default, the configuration of PHP desn't allow it. This is why it is mandatory to use the directive ``-d phar.readonly=0``.


If a newer version exists then it will be downloaded automatically and installed in the archive:

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   Update to version 'nightly-2416-201402121146'... Done !
   Enable version 'nightly-2416-201402121146'... Done !
   Atoum was updated to version 'nightly-2416-201402121146' successfully !

If there is no newer version, atoum will stop immediately:

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   There is no new version available !

atoum doesn't require any confirmation from the user to be upgraded, because it's very easy to get back to a previous version.

List the versions contained in the archive
--------------------------------------------

To see the contained versions in archive following each updates, you need to use the argument ``--list-available-versions``, or ``-lav``:

.. code-block:: shell

   $ php mageekguy.atoum.phar -lav
     nightly-941-201201011548
     nightly-1568-201210311708
   * nightly-2416-201402121146

The list of versions in the archive is displayed, the currently active version being preceded by ``*``.

Change the current version
---------------------------

To activate another version, just use the argument ``--enable-version``, or ``-ev``, followed by the name of the version to use:

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar -ev DEVELOPMENT

.. note::
   The modification of the current version requires the modification of the PHAR archive. However, by default, the configuration of PHP desn't allow it. This is why it is mandatory to use the directive ``-d phar.readonly=0``.


Deleting older versions
--------------------------------

Over time, the archive may contain multiple versions of atoum who are no longer used.

To remove them, just use the argument ``--delete-version``, or ``-dv`` followed by the name of the version to deleted:

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar -dv nightly-941-201201011548

The version is then removed.

.. warning::
   It's not possible to delete the current version.

.. note::
   Deleting a version requires the modification of the PHAR archive. However, by default, the configuration of PHP desn't allow it. This is why it is mandatory to use the directive ``-d phar.readonly=0``.


.. _installation-par-composer:

Composer
========

`Composer <http://getcomposer.org>`_ is a dependency management tool in PHP.

Start by installing composer:

.. code-block:: shell

   $ curl -s https://getcomposer.org/installer | php

Then create a file ``composer.json`` containing the following JSON (JavaScript Object Notation):

.. code-block:: json

   {
       "require-dev": {
           "atoum/atoum": "~2.1"
       }
   }

Finally, run the following command:

.. code-block:: shell

   $ php composer.phar install


.. _installation-par-github:

Github
======

If you want to use atoum directly from its sources, you can clone or « fork » the github repository: git://github.com/atoum/atoum.git


.. _atoum-philosophie:

The philosophy of atoum
************************

Simple example
==============

You need to write a test class for each class to test.

Imagine that you want to test the traditional class ``HelloWorld``, then you must create the test class ``test\units\HelloWorld``.

.. note::
   atoum use namespace. For example, to test the ``Vendor\Project\HelloWorld`` class, you must create the class ``Vendor\Project\tests\units\HelloWorld``.


Here is the code of the ``HelloWorld`` class that we will test.

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

Now, here is the code of the test class that we could write.

.. code-block:: php

   <?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // The test class has is own namespace :
   // The namespace of the tested class + "test\units"
   namespace Vendor\Project\tests\units;

   // You must include the tested class
   require_once __DIR__ . '/../../HelloWorld.php';

   use atoum;

   /*
    * Test class for Vendor\Project\HelloWorld
    *
    * Note that they had the same name that the tested class
    * and that it derives frim the atoum class
    */
   class HelloWorld extends atoum
   {
       /*
        * This method is dedicated to the getHiAtoum() method
        */
       public function testGetHiAtoum ()
       {
           $this
               // creation of a new instance of the tested class
               ->given($this->newTestedInstance)

               // we test that the getHiAtoum method returns 
               // a string...
               ->string($this->testedInstance->getHiAtoum())
                   // ... and that this string is the one we want,
                   // namely 'Hi atoum !'
                   ->isEqualTo('Hi atoum !')
           ;
       }
   }

Now, launch our tests.
You should see something like this:

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

We just test that the method ``getHiAtoum``:
* returns a string;
* that is equals to ``"Hi atoum !"``.

The tests are passed, everything is green. Here, your code is solid as a rock with atoum!


Basic principles
=================

When you want to test a value, you must:

* indicate the type of this value (integer, decimal, array, String, etc.);
* indicate what you are expecting the value to be (equal to, null, containing a substring, ...).
