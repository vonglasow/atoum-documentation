
.. _installation:

Installation
************

If you want to use it, simply download the latest version.

You can install atom from several ways:

* by downloading the `PHAR archive`_ ;
* with `composer`_;
* by cloning the `Github`_ repository;
* see also the :ref:`integration with your frameworks <utilisation-avec-frameworks>`.


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

The process to update the archive is very simple. Just run the following command:

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update

.. note::
	Update process modify the PHAR archive. But the default PHP configuration doesn't allow it. This is why it is mandatory to use the directive ``-d phar.readonly=0``.


If a newer version is available then it will be downloaded automatically and installed in the archive:

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

You can list archive contained versions by using the argument ``--list-available-versions``, or ``-lav``:

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
           "atoum/atoum": "~2.5"
       }
   }

Finally, run the following command:

.. code-block:: shell

   $ php composer.phar install


.. _installation-par-github:

Github
======

If you want to use atoum directly from its sources, you can clone or « fork » the github repository: git://github.com/atoum/atoum.git
