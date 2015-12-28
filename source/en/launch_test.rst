.. _lancement-des-tests:

Running tests
###################

Executable
**********

atoum has an executable that allows you to run your tests with command line.

With phar archive
===================

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
================

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
==========================================

In the following examples, the commands to launch tests with atoum will be written with this syntax:

.. code-block:: shell

   $ ./bin/atoum

This is exactly the command that you might use if you had  :ref:`installation-par-composer` under Linux.


.. _fichiers-a-executer:

Files to run
*******************


By files
============

To run a specific file test, simply use the -f option or --files.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyTest.php


By folders
===============

To run a test in a folder, simply use the -d option or --directories.

.. code-block:: shell

   $ ./bin/atoum -d tests/units


Filters
*******

Once you have told to atoum :ref:`which files it must execute <fichiers-a-executer>`, you will be able to filter what will really be executed.

.. _filtres-par-namespace:

By namespace
==================

To filter on the namespace, i.e. execute only test on given namespace, you have to use the option -ns or --namespaces.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

.. note::
   It's important to double each backslash to prevent them from being interpreted by the shell.


.. _filtres-par-classe-ou-methode:

A class or a method
=========================

To filter on the class or a method, i.e. only run tests of a class or a method, just use the option -m or --methods.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

.. note::
   It's important to double each backslash to prevent them from being interpreted by the shell.


You can replace the name of the class or the method by ``*`` to mean ``all``.

If you change the name of the method by ``*``, that is to say that you filter by class.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

If you change the name of the class by "*", that is to say that you filter by method.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m *::testContains


.. _filtres-par-tag:

Tags
====

Like many tools including `Behat <http://behat.org>`_, atoum allows you to tag your unit tests and run only this with one or more specific tags.

For this, we must start by defining one or more tags to one or several classes of unit tests.

This is easily done through annotations and the tag @tags:

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

Once the necessary tags defined, just have to run the tests with the appropriate tags by using the option --tags, or -t in its short version:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag

Be careful, this statement only makes sense if there is one or more classes of unit testing and at least one of them has the specified tag. Otherwise, no test will be executed.

It's possible to define several tags:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

In the latter case, the tests that have been tagged with thisIsOneTag, either thisIsThreeTag, classes will be the only to be executed.


Extensions
==========

Some of your tests may require one or more PHP extension(s). Telling atoum that a test requires an extension is easily done through annotations and the tag @extensions.

After the tag @extensions, just add one or more extension names, separated by a space.


.. code-block:: php

   <?php

   namespace vendor\project\tests\units;

   class foo extends \atoum
   {
       /**
        * @extensions intl
        */
       public function testBar()
       {
           // ...
       }
   }

The test will only be executed if the extension is present. If not the test will be skipped and this message will be displayed.

.. code-block:: shell

   vendor\project\tests\units\foo::testBar(): PHP extension 'intl' is not loaded


.. note::
   By default the tests will pass when a test is skipped. But you can use the --fail-if-skipped-methods command line option to make the test fail when an extension is not present.




.. _fichier-de-configuration:

Configuration file
************************

If you name your configuration file ``. atoum.php``, atoum will load it automatically if this file is located in the current directory. The ``-c`` parameter is optional in this case.


Code coverage
==================

By default, if PHP has the extension `Xdebug <http://xdebug.org>`_, atoum indicates in command line, the rate of tests code coverage.

If the coverage rate is 100%, atoum merely indicated. But otherwise, it displays the overall coverage and that of each method of the class tested in the form of a percentage.

.. code-block:: shell

   $ php tests/units/classes/template.php
   > atoum version DEVELOPMENT by Frederic Hardy (/Users/fch/Atoum)
   > PHP path: /usr/local/bin/php
   > PHP version:
   => PHP 5.3.8 (cli) (built: Sep 21 2011 23:14:37)
   => Copyright (c) 1997-2011 The PHP Group
   => Zend Engine v2.3.0, Copyright (c) 1998-2011 Zend Technologies
   =>     with Xdebug v2.1.1, Copyright (c) 2002-2011, by Derick Rethans
   > mageekguy\atoum\tests\units\template...
   [SSSSSSSSSSSSSSSSSSSSSSSSSSS_________________________________][27/27]
   => Test duration: 15.63 seconds.
   => Memory usage: 8.25 Mb.
   > Total test duration: 15.63 seconds.
   > Total test memory usage: 8.25 Mb.
   > Code coverage value: 92.52%
   => Class mageekguy\atoum\template: 91.14%
   ==> mageekguy\atoum\template::setWith(): 80.00%
   ==> mageekguy\atoum\template::resetChildrenData(): 25.00%
   ==> mageekguy\atoum\template::addToParent(): 0.00%
   ==> mageekguy\atoum\template::unsetAttribute(): 0.00%
   => Class mageekguy\atoum\template\data: 96.43%
   ==> mageekguy\atoum\template\data::__toString(): 0.00%
   > Running duration: 2.36 seconds.
   Success (1 test, 27 methods, 485 assertions, 0 error, 0 exception) !

However, it is possible to get a more accurate representation of the rate of code coverage by tests, in HTML report.

To get it, simply rely on models of configuration files included in atoum.

If you use the PHAR archive, it must retrieve them by using the following command:

.. code-block:: php

   php mageekguy.atoum.phar -er /path/to/destination/directory

Once the extraction is done, you should have in the directory/path/to/destination/directory a directory called resources/configurations/runner.

If you are using atoum with a github repository clone :ref:`installation-par-github` or with composer :ref:`installation-par-composer`, the models can be found in ``/path/to/atoum/resources/configurations/runner``

In this directory, there is, among other interesting things, a template of configuration file for atoum named ``coverage.php.dist`` that you need to copy to the location of your choice. Rename the ``coverage.php``.

After copying the file, just have to change it with the editor of your choice to define the directory where the HTML files will be generated and the URL from which the report should be accessible.

For exemple:

.. code-block:: php

   $coverageField = new atoum\report\fields\runner\coverage\html(
       'Code coverage of my project',
       '/path/to/destination/directory'
   );

   $coverageField->setRootUrl('http://url/of/web/site');

.. note::
   It is also possible to change the title of the report using the first argument to the constructor of the class ``mageekguy\atoum\report\fields\runner\coverage\html``.


Once this is done, you just have to use the configuration file when running the tests, as follows:

.. code-block:: shell

   $ ./bin/atoum -c path/to/coverage.php -d tests/units

Once the tests run, atoum generate the code coverage report in HTML format in the directory that you set earlier, and it will be readable using the browser of your choice.

.. note::
   The calculation of code coverage by tests as well as the generation of the corresponding report may slow significantly the performance of the tests. Then it can be interesting, not to systematically use the corresponding configuration file, or disable them temporarily using the -ncc argument.


.. _notifications-anchor:

Notifications
=============

atoum is able to warn you when the tests are run using several notification system: `Growl`_, `Mac OS X Notification Center`_, `Libnotify`_.


Growl
-----

This feature requires the presence of the executable ``growlnotify``. To check if it is available, use the following command:

.. code-block:: shell

   $ which growlnotify

You will have the path to the executable or the message ``growlnotify not found`` if it is not installed.

Then just add the following code to your configuration file:

.. code-block:: php

   <?php
   $images = '/path/to/atoum/resources/images/logo';

   $notifier = new \mageekguy\atoum\report\fields\runner\result\notifier\image\growl();
   $notifier
       ->setSuccessImage($images . DIRECTORY_SEPARATOR . 'success.png')
       ->setFailureImage($images . DIRECTORY_SEPARATOR . 'failure.png')
   ;

   $report = $script->AddDefaultReport();
   $report->addField($notifier, array(atoum\runner::runStop));


Mac OS X Notification Center
----------------------------

This feature uses the ``terminal-notifier`` utility. To check if it is available, use the following command:

.. code-block:: shell

   $ which terminal-notifier

You will have the path to the executable or the message ``terminal-notifier not found`` if it is not installed.

.. note::
   Visit `the project's Github page <https://github.com/alloy/terminal-notifier>`_ to get more information on ``terminal-notifier``.


Then just add the following code to your configuration file:

.. code-block:: php

   <?php
   $notifier = new \mageekguy\atoum\report\fields\runner\result\notifier\terminal();

   $report = $script->AddDefaultReport();
   $report->addField($notifier, array(atoum\runner::runStop));

On OS X, you can define a command to be executed when the user clicks on the notification.

.. code-block:: php

   <?php
   $coverage = new atoum\report\fields\runner\coverage\html(
       'Code coverage',
       $path = sys_get_temp_dir() . '/coverage_' . time()
   );
   $coverage->setRootUrl('file://' . $path);

   $notifier = new \mageekguy\atoum\report\fields\runner\result\notifier\terminal();
   $notifier->setCallbackCommand('open 'file://' . $path . '/index.html);

   $report = $script->AddDefaultReport();
   $report
       ->addField($coverage, array(atoum\runner::runStop))
       ->addField($notifier, array(atoum\runner::runStop))
   ;

The example above shows how to automatically open the code coverage report when the user clicks on the notification.


Libnotify
---------

This feature requires the presence of the executable ``notify-send``. To check if it is available, use the following command:

.. code-block:: shell

   $ which notify-send

You will have the path to the executable or the message ``notify-send not found`` if it is not installed.

Then just add the following code to your configuration file:

.. code-block:: php

   <?php
   $images = '/path/to/atoum/resources/images/logo';

   $notifier = new \mageekguy\atoum\report\fields\runner\result\notifier\image\libnotify();
   $notifier
       ->setSuccessImage($images . DIRECTORY_SEPARATOR . 'success.png')
       ->setFailureImage($images . DIRECTORY_SEPARATOR . 'failure.png')
   ;

   $report = $script->AddDefaultReport();
   $report->addField($notifier, array(atoum\runner::runStop));


Bootstrap file
********************

atoum allows the definition of a ``bootstrap`` file, which will be run before each test method and which therefore allows to initialize the test execution environment.

This makes it possible to define, for example, an autoloading classes, read a configuration file or perform any other operation necessary for the proper performance of the tests.

The definition of this ``bootstrap`` file can be done in two different ways, either in command line, or via a configuration file.

In command line, you should use the argument -bf or the argument --bootstrap-file followed by the absolute or relative path to the concerned file:

.. code-block:: shell

   $ ./bin/atoum -bf path/to/bootstrap/file

.. note::
   A bootstrap file is not a configuration file and therefore does not have the same opportunities.


In a configuration file, atoum is configurable via the $runner variable, which is not defined in a ``bootstrap`` file.

Moreover, they are not included at the same time, since the configurations file is included by atoum before the tests run but after tests launch., while the ``bootstrap``, if it's define, is the first file included by atoum itself. Finally, the ``bootstrap`` file can allow to not have to systematically include the scripts/runner.php file or atoum PHAR archive in test classes.

However, in this case, it will not be possible to directly execute a test file directly from the PHP executable in command line.

To do this, simply include in the ``bootstrap`` the file scripts/runner.php or PHAR archive of atoum and systematically execute tests by command line via scripts/runner.php or 'PHAR archive.

Therefore, the "bootstrap" file must at least contain this:

.. code-block:: php

   <?php

   // if the PHAR archive is used:
   require_once path/to/mageekguy.atoum.phar;

   // or if sources is used:
   // require_once path/atoum/scripts/runner.php
