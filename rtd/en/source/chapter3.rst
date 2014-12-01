.. _launching-tests:

Launching tests
===============

.. _executable:

Executable
----------

Atoum has an executable that allow you to launch your tests from the command line.

.. _using-the-phar-archive:

Using the phar archive
~~~~~~~~~~~~~~~~~~~~~~

If you are using the phar archive, then the archive is itself the executable.

.. _pharLinuxMac:

linux / mac
^^^^^^^^^^^

.. code-block:: shell

   $ php path/to/mageekguy.atoum.phar

.. _pharWindows:

windows
^^^^^^^

.. code-block:: shell

   C:\> X:\Path\To\php.exe X:\Path\To\mageekguy.atoum.phar


.. _using-the-source:

Using the source
~~~~~~~~~~~~~~~~

If you are using the source, the executable is located in path/to/atoum/bin.

.. _sourceLinuxMac:

linux / mac
^^^^^^^^^^^

.. code-block:: shell

   $ php path/to/bin/atoum
   
   # OU #
   
   $ ./path/to/bin/atoum

.. _sourceWindows:

windows
^^^^^^^

.. code-block:: shell

   C:\> X:\Path\To\php.exe X:\Path\To\bin\atoum\bin


.. _examples-in-the-remainder-of-the-documentation:

Examples in the remainder of the Documentation
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In the following examples, the commands used to launch the tests with Atoum will be written in the form:

.. code-block:: shell

   $ ./bin/atoum

This is the exact command you would use if you have `installed Atoum with composer <chapter1.html#Composer>`_ under Linux


.. _files-to-execute:

Files to execute
----------------

.. _by-file:

By File
~~~~~~~

In order to launch tests on a file, you only need to use the -f or --files option.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyTest.php


.. _by-directory:

By Directory
~~~~~~~~~~~~

In order to launch tests on a directory, you only need to use the -d or --directories option.

.. code-block:: shell

   $ ./bin/atoum -d tests/units


.. _filters:

Filters
-------

Once you have told Atoum :ref:`which files it must execute <files-to-execute>`, you will be able to filter to will really be executed.

.. _by-namespace:

By Namespace
~~~~~~~~~~~~

In order to filter on a namespace, that is to execute the tests solely on a given namespace, you only need need to use the -ns or --namespace option.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

.. note::
   It is important to double each backslash in order to prevent the shell from interpreting them.


.. _class-or-method:

Class or method
~~~~~~~~~~~~~~~

In order to filter on a class or a method, that is to executre only the tests of a particular class or method, you need only to use the -m or --methods options.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

.. note::
   It is important to double each backslash in order to prevent the shell from interpreting them.


You can replace the class or method name by ``*`` to signify ``all``.

If you replace the method name by ``*``, it reslults in filtering by class.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

If you replace the class name by ``**``, it results in filtering by methods.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m *::testContains

.. _tags:

Tags
~~~~

Just as numerous tools such as `Behat <http://behat.org>`_, Atoum allows you to tag your unit tests and to execute only those with (a) specific tag(s)

In order for this to happen, one must begin by defining (a) tag(s) for (a) class(es) of unit tests.

It can easily be done thanks to the annotation or the anchor @tags:

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


It is also possible to tag test methods.

.. note::
   Tags defined at method level overtake those defined at class level.


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

Once the necessary tags have been defined, tests can be executed with or without the required tags by using the option --tags or -t for its shorthand version.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag

Warning, this instruction only makes sense if there is one or more class of unit tests and if at least one of them is tagged with the specified tag. In the opposite case, no test will be performed.

It is possible to define several tags:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

In that last case, the tests classes having been tagged with thisIsOneTag or with thisIsThreeTag will be the only one executed.

.. _configuration-files:

Configuration files
-------------------

.. todo::
   We need help to write this section !


.. _code-coverage:

Code Coverage
~~~~~~~~~~~~~

By default, if PHP can make use of the `Xdebug <http://xdebug.org>`_ extension, Atoum will indicate in command line mode the code coverage percentage for the tests just executed.

If the code coverage percentage is 100%, Atoum merely indicate it, but if it is not the case, it will display the global coverage percentage as well as that of each tested class method.

.. code-block:: shell

   $ php tests/units/classes/template.php
   > atoum version DEVELOPMENT by Frederic Hardy (/Users/fch/Atoum)
   > PHP path: /usr/local/bin/php
   > PHP version:
   .. _php-5-3-8--cli---built--sep-21-2011-23-14-37:
   
   > PHP 5.3.8 (cli) (built: Sep 21 2011 23:14:37)
   ===============================================
   .. _copyright--c--1997-2011-the-php-group:
   
   > Copyright (c) 1997-2011 The PHP Group
   =======================================
   .. _zend-engine-v2-3-0--copyright--c--1998-2011-zend-technologies:
   
   > Zend Engine v2.3.0, Copyright (c) 1998-2011 Zend Technologies
   ===============================================================
   .. _with-xdebug-v2-1-1--copyright--c--2002-2011--by-derick-rethans:
   
   >     with Xdebug v2.1.1, Copyright (c) 2002-2011, by Derick Rethans
   ====================================================================
   > mageekguy\atoum\tests\units\template...
   [SSSSSSSSSSSSSSSSSSSSSSSSSSS_________________________________][27/27]
   .. _test-duration--15-63-seconds:
   
   > Test duration: 15.63 seconds.
   ===============================
   .. _memory-usage--8-25-mb:
   
   > Memory usage: 8.25 Mb.
   ========================
   > Total test duration: 15.63 seconds.
   > Total test memory usage: 8.25 Mb.
   > Code coverage value: 92.52%
   .. _class-mageekguy-atoum-template--91-14:
   
   > Class mageekguy\atoum\template: 91.14%
   ========================================
   .. _mageekguy-atoum-template--setwith----80-00:
   
   > mageekguy\atoum\template::setWith(): 80.00%
   ---------------------------------------------
   .. _mageekguy-atoum-template--resetchildrendata----25-00:
   
   > mageekguy\atoum\template::resetChildrenData(): 25.00%
   -------------------------------------------------------
   .. _mageekguy-atoum-template--addtoparent----0-00:
   
   > mageekguy\atoum\template::addToParent(): 0.00%
   ------------------------------------------------
   .. _mageekguy-atoum-template--unsetattribute----0-00:
   
   > mageekguy\atoum\template::unsetAttribute(): 0.00%
   ---------------------------------------------------
   .. _class-mageekguy-atoum-template-data--96-43:
   
   > Class mageekguy\atoum\template\data: 96.43%
   =============================================
   .. _mageekguy-atoum-template-data----tostring----0-00:
   
   > mageekguy\atoum\template\data::__toString(): 0.00%
   ----------------------------------------------------
   > Running duration: 2.36 seconds.
   Success (1 test, 27 methods, 485 assertions, 0 error, 0 exception) !

It is however possible to obtain a more precise representation of the code coverage percentage by the tests in the form of an HTML report. In order to obtain it, one only needs to base it on the configuration files models included in Atoum. If you are using the PHAR archive, it must be extracted by using the following command:

.. code-block:: php

   php mageekguy.atoum.phar -er /path/to/destination/directory

Once the extraction has been perfomed, you should be able to see a directory named "resources/configuration.runner" in the directory "/path/to/destination/directory".

If you are using Atoum with a `github repository clone <chapter1.html#Github>`_ or with `composer <chapter1.html#Composer>`_, the models can be found in "/path/to/atoum/resources/configurations/runner.

In this directory are, among other interesting things, an Atoum configuration file model named "coverage.php.dist" that you will need to copy at the location of your choosing under, for example, the name "coverage.php".

Once the copy has been performed, modify it with you prefered editor in order to define:
* the directory in wich HTML files shall be generated.

* the URL from which the report will be accessible.


For example:

.. code-block:: php

   $coverageField = new atoum\report\fields\runner\coverage\html(
       'Code coverage de mon projet',
       '/path/to/destination/directory'
   );
   
   $coverageField->setRootUrl('http://url/of/web/site');

.. note::
   It is also possible to modify the report title using the first argument of the "mageekguy\atoum\report\fields\runner\coverage\html" class's constructor.


Once this is all done, the configuration file can be used at tests execution time as follows:

.. code-block:: shell

   $ ./bin/atoum -c path/to/coverage.php -d tests/units
One the tests have been executed, Atoum will generate the code coverage report in HTML format in the directory previously defined. It then will be readable using your favorite browser.

.. note::
   The calculation of the code coverage percentage as well as the corresponding reporting can significally slow down the tests execution. It can therefore be interesting to not systematically make use of the conrresponding configuration file or to temporarily deactivate them using the -ncc option.


.. _notifications:

Notifications
~~~~~~~~~~~~~

atoum is able to warn you when the tests are performed using several notification system: :ref:`Growl <growl>`, :ref:`Notification Center <osxnotificationcenter>`, :ref:`Libnotify <libnotify>`.

.. _growl:

Growl
^^^^^

This feature uses the ``growlnotify`` utility. To check if the command is available, run:

.. code-block:: shell

   $ which growlnotify && echo $?
   /path/to/growlnotify
   0

Then you will have to add the following lines to your configuration file:

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

.. _OSXNotificationCenter:

Mac OS X Notification Center
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This feature uses the ``terminal-notifier`` utility. To check if the command is available, run:

.. code-block:: shell

   $ which terminal-notifier && echo $?
   /path/to/terminal-notifier
   0

.. note::
   Visit `the project's Github page <https://github.com/alloy/terminal-notifier>`_ to get more information on ``terminal-notifier``.


Then you will have to add the following lines to your configuration file:

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

.. _libnotify:

Libnotify
^^^^^^^^^

This feature uses the ``notify-send`` utility. To check if the command is available, run:

.. code-block:: shell

   $ which notify-send && echo $?
   /path/to/notify-send
   0

Then you will have to add the following lines to your configuration file:

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

.. _bootstrap-file:

Bootstrap file
--------------

Atoum can use a ``bootstrap`` file which will be executed before each test method thus allowing the initialization of the tests execution environment.

Using it makes it possible for example to define a class autoloading function, to read a configuration file or to perform any other operation necessary to the proper tests execution.

The ``bootstrap`` file definition can be done in 2 differents manners, either by using the command line or via a configuration file

When using the command line, the -bf or the --bootstrap-file option followed by the relative or absolute path to the bootstrap file intended to be used.

.. code-block:: shell

   $ ./bin/atoum -bf path/to/bootstrap/file

.. note::
   A boostrap file is not a configuration file et therefore does not the have the same capabilities.


In a configuration file, Atoum is configured via the $runner variable, which is itself defined in ``bootstrap`` file.

Moreover, both files are not included at the same time since the configuration file is included by Atoum before the tests execution but after the launching of the tests, when the ##bootstrap file, should it be defined, is the first and foremost file included by Atoum.

Finally the ``bootstrap`` can help avoid systematically loading the /scripts/runner.php file or the Atoum PHAR archive in the test classes.

However, in this case, it won't possible to execute directly a test file via the PHP executable when using the command line.

In order to do this, one must include the scripts/runner.php or the Atoum PHAR archive in the ``bootstrap`` file and systematically execute the tests using the command line via scripts/runner/.php ou the PHAR archive.

The ``bootstrap`` file must at mininum contain this:

.. code-block:: php

   <?php
   
   // if the PHAR archive is used:
   require_once path/to/mageekguy.atoum.phar;
   
   // or if the source is used:
   // require_once path/atoum/scripts/runner.php

.. _command-line-options:

Command line options
--------------------

Most of the options exist come in 2 flavours, the short version (1 to 6 characters) and the more explicit long version. Both flavours do the exact same thing and you can use them indifferently.

Certain options can accept multiple values:

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyFirstTest.php tests/units/MySecondTest.php


.. note::
   You must use each option only once, if you do not only the repeated option will be taken into account and all others will be discarded.


.. code-block:: shell

   # Only tests "MySecondTest.php"
   $ ./bin/atoum -f MyFirstTest.php -f MySecondTest.php
   
   # Only tests "MyThirdTest.php" and "MyFourthTest.php"
   $ ./bin/atoum -f MyFirstTest.php MySecondTest.php -f MyThirdTest.php MyFourthTest.php

.. _bf--file------bootstrap-file--file:

-bf <file> / --bootstrap-file <file>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Specifies to the path to the bootstrap file.

.. code-block:: shell

   $ ./bin/atoum -bf /path/to/bootstrap.php
   $ ./bin/atoum --bootstrap-file /path/to/bootstrap.php

.. _c--file------configuration--file:

-c <file> / --configuration <file>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Specifies which configuration to use to launch the tests.

.. code-block:: shell

   $ ./bin/atoum -c config/atoum.php
   $ ./bin/atoum --configuration tests/units/conf/coverage.php

.. _d--directories------directories--directories:

-d <directories> / --directories <directories>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Specifies one or more directories containing tests to be launched.

.. code-block:: shell

   $ ./bin/atoum -d tests/units/db/
   $ ./bin/atoum --directories tests/units/db/ tests/units/entities/

.. _debug:

--debug
~~~~~~~

Turns debug mode on

.. code-block:: shell

   $ ./bin/atoum --debug

.. note::
   Check out `debug mode <chapter2.html#Debug-mode>`_ section for more information.


.. _drt--string------default-report-title--string:

-drt <string> / --default-report-title <string>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Specifies the title used in reports generated by Atoum.

.. code-block:: shell

   $ ./bin/atoum -drt Title
   $ ./bin/atoum --default-report-title "My Title"

.. note::
   If the title contains spaces, it must be enclosed in double quotes.


.. _f--files------files--files:

-f <files> / --files <files>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Specifies tests files to launch.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/db/mysql.php
   $ ./bin/atoum --files tests/units/db/mysql.php tests/units/db/pgsql.php

.. _ft-----force-terminal:

-ft / --force-terminal
~~~~~~~~~~~~~~~~~~~~~~

Forces output to stdout.

.. code-block:: shell

   $ ./bin/atoum -ft
   $ ./bin/atoum --force-terminal

.. _g--pattern------glob--pattern:

-g <pattern> / --glob <pattern>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Filters tests files to launch by pattern(s).

.. code-block:: shell

   $ ./bin/atoum -g ???
   $ ./bin/atoum --glob ???

.. _h-----help:

-h / --help
~~~~~~~~~~~

Lists the available options.

.. code-block:: shell

   $ ./bin/atoum -h
   $ ./bin/atoum --help

.. _l-----loop:

-l / --loop
~~~~~~~~~~~

Activates Atoum's loop mode.

.. code-block:: shell

   $ ./bin/atoum -l
   $ ./bin/atoum --loop

.. note::
   Check out the `loop mode <chapter2.html#loop-mode>`_ section for more information.


.. _m--class--method------methods--class--methods:

-m <class::method> / --methods <class::methods>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Filters classes and methods to launch.

.. code-block:: shell

   # Launches only the method "testMyMethod" of class "vendor\\project\\test\\units\\myClass"
   $ ./bin/atoum -m vendor\\project\\test\\units\\myClass::testMyMethod
   $ ./bin/atoum --methods vendor\\project\\test\\units\\myClass::testMyMethod
   
   # Launches all the test methods on class "vendor\\project\\test\\units\\myClass"
   $ ./bin/atoum -m vendor\\project\\test\\units\\myClass::*
   $ ./bin/atoum --methods vendor\\project\\test\\units\\myClass::*
   
   # Launches only the method "testMyMethod" of all test classes
   $ ./bin/atoum -m *::testMyMethod
   $ ./bin/atoum --methods *::testMyMethod

.. note::
   Check out the :ref:`filter by class or method <class-or-method>` section for more information.


.. _mcn--integer------max-children-number--integer:

-mcn <integer> / --max-children-number <integer>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Defines the maximum number of simulaneous processes launched to execute tests.

.. code-block:: shell

   $ ./bin/atoum -mcn 5
   $ ./bin/atoum --max-children-number 3

.. _ncc-----no-code-coverage:

-ncc / --no-code-coverage
~~~~~~~~~~~~~~~~~~~~~~~~~

Deactivates the code coverage reporting.

.. code-block:: shell

   $ ./bin/atoum -ncc
   $ ./bin/atoum --no-code-coverage

.. _nccfc--classes------no-code-coverage-for-classes--classes:

-nccfc <classes> / --no-code-coverage-for-classes <classes>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Deactivates code coverage reporting for one or more classes.

.. code-block:: shell

   $ ./bin/atoum -nccfc vendor\\project\\db\\mysql
   $ ./bin/atoum --no-code-coverage-for-classes vendor\\project\\db\\mysql vendor\\project\\db\\pgsql

.. note::
   It is important to double each backslash in order to prevent the shell from interpreting them.


.. _nccfns--namespaces------no-code-coverage-for-namespaces--namespaces:

-nccfns <namespaces> / --no-code-coverage-for-namespaces <namespaces>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Deactivates code coverage reporting for one or more namespaces.

.. code-block:: shell

   $ ./bin/atoum -nccfns vendor\\outside\\lib
   $ ./bin/atoum --no-code-coverage-for-namespaces vendor\\outside\\lib1 vendor\\outside\\lib2

.. note::
   It is important to double each backslash in order to prevent the shell from interpreting them.


.. _nccid--directories------no-code-coverage-in-directories--directories:

-nccid <directories> / --no-code-coverage-in-directories <directories>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Deactivates code coverage reporting for one or more directories.

.. code-block:: shell

   $ ./bin/atoum -nccid /path/to/exclude
   $ ./bin/atoum --no-code-coverage-in-directories /path/to/exclude/1 /path/to/exclude/2

.. _ns--namespaces------namespaces--namespaces:

-ns <namespaces> / --namespaces <namespaces>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Filters the class(es) and method(s) by namespace(s).

.. code-block:: shell

   $ ./bin/atoum -ns mageekguy\\atoum\\tests\\units\\asserters
   $ ./bin/atoum --namespaces mageekguy\\atoum\\tests\\units\\asserters

.. note::
   Check out the :ref:`filter by namespace <by-namespace>` section for more information.


.. _p--file------php--file:

-p <file> / --php <file>
~~~~~~~~~~~~~~~~~~~~~~~~

Specifies the path to the php executable used to launch the test(s).

.. code-block:: shell

   $ ./bin/atoum -p /usr/bin/php5
   $ ./bin/atoum --php /usr/bin/php5

By default the seeked value is looked up among the following values (in that order):
* PHP_BINARY constant.

* PHP_PEAR_PHP_BIN environment variable.
* PHPBON environment variable.
* PHP_BINDIR + '/php' constant.

.. _sf--file------score-file--file:

-sf <file> / --score-file <file>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

specifies a path to the score file generated by Atoum.

.. code-block:: shell

   $ ./bin/atoum -sf /path/to/atoum.score
   $ ./bin/atoum --score-file /path/to/atoum.score

.. _t--tags------tags--tags:

-t <tags> / --tags <tags>
~~~~~~~~~~~~~~~~~~~~~~~~~

Filters class(es) and method(s) to launch by tag.

.. code-block:: shell

   $ ./bin/atoum -t OneTag
   $ ./bin/atoum --tags OneTag TwoTag

.. note::
   Check out the [filter by tag|#Tags]] section for more information.


.. _test-all:

--test-all
~~~~~~~~~~

Launches the tests found in the directories defined in the configuration file via $script->addTestAllDirectory('path/to/directory').

.. code-block:: shell

   $ ./bin/atoum --test-all

.. _test-it:

--test-it
~~~~~~~~~

Launches the Atoum unit tests in order to verify that they can execute properly on your machine.

.. code-block:: shell

   $ ./bin/atoum --test-it

.. _tfe--extensions------test-file-extensions--extensions:

-tfe <extensions> / --test-file-extensions <extensions>
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Specifies the extension(s) of the test files to launch.

.. code-block:: shell

   $ ./bin/atoum -tfe phpt
   $ ./bin/atoum --test-file-extensions phpt php5t

.. _ulr-----use-light-report:

-ulr / --use-light-report
~~~~~~~~~~~~~~~~~~~~~~~~~

Ligthens the report output generated by Atoum.

.. code-block:: shell

   $ ./bin/atoum -ulr
   $ ./bin/atoum --use-light-report
   
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][  59/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 118/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 177/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 236/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 295/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 354/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 413/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 472/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 531/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 590/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 649/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 708/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 767/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 826/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 885/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][ 944/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][1003/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][1062/1141]
   [SSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS>][1121/1141]
   [SSSSSSSSSSSSSSSSSSSS________________________________________][1141/1141]
   Success (154 tests, 1141/1141 methods, 0 void method, 0 skipped method, 16875 assertions) !

.. _v-----version:

-v / --version
~~~~~~~~~~~~~~

This option displays the current version of Atoum.

.. code-block:: shell

   $ ./bin/atoum -v
   $ ./bin/atoum --version
   
   atoum version DEVELOPMENT by Frédéric Hardy (/path/to/atoum)
