.. _lancement-des-tests:

Running tests
###################

Executable
**********

atoum has an executable that allows you to run your tests with command line.

With phar archive
=================

If you used the phar archive, it's executable itself.

linux / mac
-----------

.. code-block:: shell

   $ php path/to/mageekguy.atoum.phar

windows
-------

.. code-block:: shell

   C:\> X:\Path\To\php.exe X:\Path\To\mageekguy.atoum.phar


With sources
============

If you use sources, the executable could be found in path/to/atoum/bin.

linux / mac
-----------

.. code-block:: shell

   $ php path/to/bin/atoum

   # OR #

   $ ./path/to/bin/atoum

windows
-------

.. code-block:: shell

   C:\> X:\Path\To\php.exe X:\Path\To\bin\atoum\bin


Example in the rest of the documentation
========================================

In the following examples, the commands to launch tests with atoum will be written with this syntax:

.. code-block:: shell

   $ ./bin/atoum

This is exactly the command that you might use if you had  :ref:`installation-par-composer` under Linux.


.. _fichiers-a-executer:

Files to run
************


By files
========

To run a specific file test, simply use the -f option or --files.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyTest.php


By folders
==========

To run a test in a folder, simply use the -d option or --directories.

.. code-block:: shell

   $ ./bin/atoum -d tests/units


You can find more useful arguments to give to the :ref`command line<cli-options>` in the appropriate sections.

Filters
*******

Once you have told to atoum :ref:`which files it must execute <fichiers-a-executer>`, you will be able to filter what will really be executed.

.. _filtres-par-namespace:

By namespace
============

To filter on the namespace, i.e. execute only test on given namespace, you have to use the option ``-ns`` or ``--namespaces``.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

.. note::
   It's important to double each backslash to prevent them from being interpreted by the shell.


.. _filtres-par-classe-ou-methode:

A class or a method
===================

To filter on a class or a method, i.e. only run tests of a class or a method, just use the option ``-m`` or ``--methods``.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

.. note::
   It's important to double each backslash to prevent them from being interpreted by the shell.


You can replace the name of the class or the method by ``*`` to mean ``all``.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

Using "*" instead of class name mean you can filter by method name.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m *::testContains


.. _filtres-par-tag:

Tags
====

Like many tools including `Behat <http://behat.org>`_, atoum allows you to tag your unit tests and run only this with one or more specific tags.

For this, we must start by defining one or more tags to one or several classes of unit tests.

This is easily done through annotations and the @tags tag:

.. code-block:: php

   <?php

   namespace vendor\project\tests\units;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   /**
    * @tags thisIsOneTag thisIsTwoTag thisIsThreeTag
    */
   class foo extends atoum\test
   {
       public function testBar()
       {
           ...
       }
   }

In the same way, it is also possible to tag test methods.

.. note::
   The tags defined in a method level take precedence over those defined at the class level.


.. code-block:: php

   <?php

   namespace vendor\project\tests\units;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   class foo extends atoum\test
   {
       /**
        * @tags thisIsOneMethodTag thisIsTwoMethodTag thisIsThreeMethodTag
        */
       public function testBar()
       {
           ...
       }
   }

Once the necessary tags defined, just have to run the tests with the appropriate tags by using the option ``--tags``, or ``-t`` in its short version:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag

Be careful, this statement only makes sense if there is one or more classes of unit testing and at least one of them has the specified tag. Otherwise, no test will be executed.

It's possible to define several tags:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

In the latter case, the tests that have been tagged with thisIsOneTag, either thisIsThreeTag, classes will be the only to be executed.
