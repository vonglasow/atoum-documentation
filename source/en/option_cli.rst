.. _cli-options:

Command line options
##############################

Most options exist in 2 forms, a short from 1 to 6 characters and a long more explicit. These two forms do strictly the same thing. You can use indifferently the both form.

Some options accept multiple values:

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyFirstTest.php tests/units/MySecondTest.php


.. note::
   You must use once only each option. Otherwise, only the last one is used.


.. code-block:: shell

   # Only test MySecondTest.php
   $ ./bin/atoum -f MyFirstTest.php -f MySecondTest.php

   # Only test MyThirdTest.php and MyFourthTest.php
   $ ./bin/atoum -f MyFirstTest.php MySecondTest.php -f MyThirdTest.php MyFourthTest.php


.. _cli-options-bootstrap_file:

-bf <file> / --bootstrap-file <file>
************************************

This option allows you to specify the path to the bootstrap file.

.. code-block:: shell

   $ ./bin/atoum -bf /path/to/bootstrap.php
   $ ./bin/atoum --bootstrap-file /path/to/bootstrap.php


.. _cli-options-configuration:

-c <file> / --configuration <file>
**********************************

This option allows you to specify the path to the configuration file used for running the tests.

.. code-block:: shell

   $ ./bin/atoum -c config/atoum.php
   $ ./bin/atoum --configuration tests/units/conf/coverage.php


.. _cli-options-directories:

-d <directories> / --directories <directories>
**********************************************

This option allows you to specify the tests directory(ies) to run.

.. code-block:: shell

   $ ./bin/atoum -d tests/units/db/
   $ ./bin/atoum --directories tests/units/db/ tests/units/entities/


.. _cli-options-debug:

--debug
*******

This option allows you to enable debug mode

.. code-block:: shell

   $ ./bin/atoum --debug

.. note::
   Refer to the section on the :ref:`le-mode-debug` for more information.


.. _cli-options-report-title:

-drt <string> / --default-report-title <string>
***********************************************

This option allow you to specify atoum reports default title.

.. code-block:: shell

   $ ./bin/atoum -drt Title
   $ ./bin/atoum --default-report-title "My Title"

.. note::
   If the title contains spaces, you must surround it with quotes.


.. _cli-options-file:

-f <files> / --files <files>
****************************

This option allows you to specify the test files to run.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/db/mysql.php
   $ ./bin/atoum --files tests/units/db/mysql.php tests/units/db/pgsql.php


.. _cli-options-force_terminal:

-ft / --force-terminal
**********************

This option allows you to force the output to the terminal.

.. code-block:: shell

   $ ./bin/atoum -ft
   $ ./bin/atoum --force-terminal


.. _cli-options-glob:

-g <pattern> / --glob <pattern>
*******************************

This option allows you to specify the test files to launch based on a pattern.

.. code-block:: shell

   $ ./bin/atoum -g ???
   $ ./bin/atoum --glob ???


.. _cli-options-help:

-h / --help
***********

This option allows you to display a list of available options.

.. code-block:: shell

   $ ./bin/atoum -h
   $ ./bin/atoum --help


.. _cli-options-loop:

-l / --loop
***********

This option allows you to activate the loop mode of atoum.

.. code-block:: shell

   $ ./bin/atoum -l
   $ ./bin/atoum --loop

.. note::
   Refer to the section on the :ref:`mode-loop` for more information.


.. _cli-options-methods:

-m <class::method> / --methods <class::methods>
***********************************************

This option allows you to filter the classes and methods to launch.

.. code-block:: shell

   # launch only the method testMyMethod of the class vendor\\project\\test\\units\\myClass
   $ ./bin/atoum -m vendor\\project\\test\\units\\myClass::testMyMethod
   $ ./bin/atoum --methods vendor\\project\\test\\units\\myClass::testMyMethod

   # launche all the test methods in class vendor\\project\\test\\units\\myClass
   $ ./bin/atoum -m vendor\\project\\test\\units\\myClass::*
   $ ./bin/atoum --methods vendor\\project\\test\\units\\myClass::*

   # launche only methods named testMyMethod fromm all test classes
   $ ./bin/atoum -m *::testMyMethod
   $ ./bin/atoum --methods *::testMyMethod

.. note::
   Refer to the section on filters by :ref:`filtres-par-classe-ou-methode` for more information.


.. _cli-options-max_children_number:

-mcn <integer> / --max-children-number <integer>
************************************************

This option allows you to set the maximum number of processes launched to run the tests.

.. code-block:: shell

   $ ./bin/atoum -mcn 5
   $ ./bin/atoum --max-children-number 3


.. _cli-options-ncc:

-ncc / --no-code-coverage
*************************

This option allows you to disable the generation of the code coverage report.

.. code-block:: shell

   $ ./bin/atoum -ncc
   $ ./bin/atoum --no-code-coverage


.. _cli-options-nccfc:

-nccfc <classes> / --no-code-coverage-for-classes <classes>
***********************************************************

This option allows you to disable the generation of the code coverage report for one or more class.

.. code-block:: shell

   $ ./bin/atoum -nccfc vendor\\project\\db\\mysql
   $ ./bin/atoum --no-code-coverage-for-classes vendor\\project\\db\\mysql vendor\\project\\db\\pgsql

.. note::
   It's important to double each backslash to avoid they interpretation by the shell.


.. _cli-options-nccfns:

-nccfns <namespaces> / --no-code-coverage-for-namespaces <namespaces>
*********************************************************************

This option allows you to disable the generation of the code coverage report for one or more namespaces.

.. code-block:: shell

   $ ./bin/atoum -nccfns vendor\\outside\\lib
   $ ./bin/atoum --no-code-coverage-for-namespaces vendor\\outside\\lib1 vendor\\outside\\lib2

.. note::
   It's important to double each backslash to avoid they interpretation by the shell.


.. _cli-options-nccid:

-nccid <directories> / --no-code-coverage-in-directories <directories>
**********************************************************************

This option allows you to disable the generation of the code coverage report for one or more directories.

.. code-block:: shell

   $ ./bin/atoum -nccid /path/to/exclude
   $ ./bin/atoum --no-code-coverage-in-directories /path/to/exclude/1 /path/to/exclude/2


.. _cli-options-ns:

-ns <namespaces> / --namespaces <namespaces>
********************************************

This option allows you to filter the classes and methods tested, based on namespaces.

.. code-block:: shell

   $ ./bin/atoum -ns mageekguy\\atoum\\tests\\units\\asserters
   $ ./bin/atoum --namespaces mageekguy\\atoum\\tests\\units\\asserters

.. note::
   Refer to the section on filters  :ref:`filtres-par-namespace` for more information.


.. _cli-options-php:

-p <file> / --php <file>
************************

This option allows you to specify the path to the php executable used to run your tests.

.. code-block:: shell

   $ ./bin/atoum -p /usr/bin/php5
   $ ./bin/atoum --php /usr/bin/php5

By default, the value is search amongst the following values (in order):

* PHP_BINARY constant
* PHP_PEAR_PHP_BIN environment variable
* PHPBIN environment variable
* constant PHP_BINDIR + '/php'


.. _cli-options-sf:

-sf <file> / --score-file <file>
********************************

This option allows you to specify the path to the output file created by atoum.

.. code-block:: shell

   $ ./bin/atoum -sf /path/to/atoum.score
   $ ./bin/atoum --score-file /path/to/atoum.score


.. _cli-options-tags:

-t <tags> / --tags <tags>
*************************

This option allows you to filter the classes and methods to launch based on tags.

.. code-block:: shell

   $ ./bin/atoum -t OneTag
   $ ./bin/atoum --tags OneTag TwoTag

.. note::
   Refer to the section on filters by :ref:`filtres-par-tag` for more information.


.. _cli-options-test_all:

--test-all
**********

This option allows you to run the tests in directories defined in the configuration file through ``$script->addTestAllDirectory('path/to/directory')``.

.. code-block:: shell

   $ ./bin/atoum --test-all


.. _cli-options-test_it:

--test-it
*********

This option allows you to launch atoum own unit tests to check that it runs smoothly on your server.

.. code-block:: shell

   $ ./bin/atoum --test-it


.. _cli-options-tfe:

-tfe <extensions> / --test-file-extensions <extensions>
*******************************************************

This option allows you to specify the extensions of test files to run.

.. code-block:: shell

   $ ./bin/atoum -tfe phpt
   $ ./bin/atoum --test-file-extensions phpt php5t


.. _cli-options-ulr:

-ulr / --use-light-report
*************************

This option allows you to reduce the output generated by atoum.

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



.. _cli-options-fivm:

-fivm, --fail-if-void-methods
*****************************


This option makes the test suite fail if there is at least one void test method.

.. code-block:: shell

   $ ./bin/atoum -fivm
   $ ./bin/atoum --fail-if-void-methods


.. _cli-opts-fail-if-skipped-methods:

-fism, --fail-if-skipped-methods
********************************

This option makes the test suite fail if there is at least one skipped test method

.. code-block:: shell

   $ ./bin/atoum -fism
   $ ./bin/atoum --fail-if-skipped-methods


.. _cli-options-vesion:

-v / --version
**************

This option allows you to display the current version of atoum.

.. code-block:: shell

   $ ./bin/atoum -v
   $ ./bin/atoum --version

   atoum version DEVELOPMENT by Frédéric Hardy (/path/to/atoum)
