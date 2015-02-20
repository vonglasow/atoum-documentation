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

C'est exactement la commande que vous pourriez utiliser si vous avez :ref:`installation-par-composer` sous Linux.


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

Une fois que vous avez préciser à atoum les `fichiers à exécuter`_, vous pouvez filtrer ce qui sera réellement exécuter.

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

Tout comme de nombreux outils dont `Behat <http://behat.org>`_, atoum vous permet de tagger vos tests unitaires et de n'exécuter que ceux ayant un ou plusieurs tags spécifiques.

Pour cela, il faut commencer par définir un ou plusieurs tags pour une ou plusieurs classes de tests unitaires.

Cela se fait très simplement grâce aux annotations et à la balise @tags:

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

Une fois les tags nécessaires définis, il n'y a plus qu'à exécuter les tests avec le ou les tags adéquates à l'aide de l'option --tags, ou -t dans sa version courte:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag

Be careful, this statement only makes sense if there is one or more classes of unit testing and at least one of them has the specified tag. Otherwise, no test will be executed.

It's possible to define several tags:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

In the latter case, the tests that have been tagged with thisIsOneTag, either thisIsThreeTag, classes will be the only to be executed.


.. _fichier-de-configuration:

Configuration file
************************

If you name your configuration file ``. atoum.php``, atoum will load it automatically if this file is located in the current directory. The ``-c`` parameter is optional in this case.


Code coverage
==================

Par défaut, si PHP dispose de l'extension `Xdebug <http://xdebug.org>`_, atoum indique en ligne de commande le taux de couverture du code par les tests venant d'être exécutés.

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

Dans le cas où vous utilisez atoum en ayant cloné le dépôt :ref:`installation-par-github` ou l'ayant installé via :ref:`installation-par-composer`, les modèles se trouvent dans ``/path/to/atoum/resources/configurations/runner``

Dans ce répertoire, il y a, entre autre chose intéressante, un modèle de fichier de configuration pour atoum nommé ``coverage.php.dist`` qu'il vous faudra copier à l'emplacement de votre choix. Renommez le ``coverage.php``.

Une fois le fichier copié, il n'y a plus qu'à le modifier à l'aide de l'éditeur de votre choix afin de définir le répertoire dans lequel les fichiers HTML devront être générés ainsi que l'URL à partir de laquelle le rapport devra être accessible.

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

Une fois les tests exécutés, atoum génèrera alors le rapport de couverture du code au format HTML dans le répertoire que vous aurez défini précédemment, et il sera lisible à l'aide du navigateur de votre choix.

.. note::
   Le calcul du taux de couverture du code par les tests ainsi que la génération du rapport correspondant peuvent ralentir de manière notable l'exécution des tests. Il peut être alors intéressant de ne pas utiliser systématiquement le fichier de configuration correspondant, ou bien de les désactiver temporairement à l'aide de l'argument -ncc.


.. _notifications-anchor:

Notifications
=============

atoum est capable de vous prévenir lorsque les tests sont exécutés en utilisant plusieurs système de notification : `Growl`_, `Mac OS X Notification Center`_, `Libnotify`_.


Growl
-----

Cette fonctionnalité nécessite la présence de l'exécutable ``growlnotify``. To check if it is available, use the following command:

.. code-block:: shell

   $ which growlnotify

Vous aurez alors le chemin de l'exécutable ou alors le message ``growlnotify not found`` s'il n'est pas installé.

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

Cette fonctionnalité nécessite la présence de l'exécutable ``terminal-notifier``. To check if it is available, use the following command:

.. code-block:: shell

   $ which terminal-notifier

Vous aurez alors le chemin de l'exécutable ou alors le message ``terminal-notifier not found`` s'il n'est pas installé.

.. note::
   Rendez-vous sur `la page Github du projet <https://github.com/alloy/terminal-notifier>`_ pour obtenir plus d'information sur l'installation de ``terminal-notifier``.


Then just add the following code to your configuration file:

.. code-block:: php

   <?php
   $notifier = new \mageekguy\atoum\report\fields\runner\result\notifier\terminal();

   $report = $script->AddDefaultReport();
   $report->addField($notifier, array(atoum\runner::runStop));

Sous OS X, vous avez la possibilité de définir une commande qui sera exécutée lorsque l'utilisateur cliquera sur la notification.

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

L'exemple ci-dessus montre comment ouvrir le rapport de couverture du code lorsque l'utilisateur clique sur la notification.


Libnotify
---------

Cette fonctionnalité nécessite la présence de l'exécutable ``notify-send``. To check if it is available, use the following command:

.. code-block:: shell

   $ which notify-send

Vous aurez alors le chemin de l'exécutable ou alors le message ``notify-send not found`` s'il n'est pas installé.

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

atoum autorise la définition d'un fichier de ``bootstrap`` qui sera exécuté avant chaque méthode de test et qui permet donc d'initialiser l'environnement d'exécution des tests.

Il devient ainsi possible de définir, par exemple, une fonction d'auto-chargement de classes, de lire un fichier de configuration ou de réaliser toute autre opération nécessaire à la bonne exécution des tests.

La définition de ce fichier de ``bootstrap`` peut se faire de deux façons différentes, soit en ligne de commande, soit via un fichier de configuration.

En ligne de commande, il faut utiliser au choix l'argument -bf ou l'argument --bootstrap-file suivi du chemin relatif ou absolu vers le fichier concerné:

.. code-block:: shell

   $ ./bin/atoum -bf path/to/bootstrap/file

.. note::
   Un fichier de bootstrap n'est pas un fichier de configuration et n'a donc pas les mêmes possibilités.


Dans un fichier de configuration, atoum est configurable via la variable $runner, qui n'est pas définie dans un fichier de ``bootstrap``.

De plus, ils ne sont pas inclus au même moment, puisque le fichier de configuration est inclus par atoum avant le début de l'exécution des tests mais après le lancement des tests, alors que le fichier de ``bootstrap``, s'il est défini, est le tout premier fichier inclus par atoum proprement dit. Enfin, le fichier de ``bootstrap`` peut permettre de ne pas avoir à inclure systématiquement le fichier scripts/runner.php ou l'archive PHAR de atoum dans les classes de test.

Cependant, dans ce cas, il ne sera plus possible d'exécuter directement un fichier de test directement via l'exécutable PHP en ligne de commande.

Pour cela, il suffit d'inclure dans le fichier de ``bootstrap`` le fichier scripts/runner.php ou l'archive PHAR de atoum et d'exécuter systématiquement les tests en ligne de commande via scripts/runner.php ou l'archive PHAR.

Le fichier de ``bootstrap`` doit donc au minimum contenir ceci:

.. code-block:: php

   <?php

   // if the PHAR archive is used:
   require_once path/to/mageekguy.atoum.phar;

   // or if sources is used:
   // require_once path/atoum/scripts/runner.php
