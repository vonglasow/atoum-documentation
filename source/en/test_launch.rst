.. _lancement-des-tests:

Lancement des tests
###################

Exécutable
**********

atoum dispose d'un exécutable qui vous permet de lancer vos tests en ligne de commande.

Avec l'archive phar
===================

Si vous utilisez l'archive phar, elle est elle-même l'exécutable.

linux / mac
-----------

.. code-block:: shell

   $ php path/to/mageekguy.atoum.phar

windows
-------

.. code-block:: shell

   C:\> X:\Path\To\php.exe X:\Path\To\mageekguy.atoum.phar


Avec les sources
================

Si vous utilisez les sources, l'exécutable se trouve dans path/to/atoum/bin.

linux / mac
-----------

.. code-block:: shell

   $ php path/to/bin/atoum

   # OU #

   $ ./path/to/bin/atoum

windows
-------

.. code-block:: shell

   C:\> X:\Path\To\php.exe X:\Path\To\bin\atoum\bin


Exemples dans le reste de la documentation
==========================================

Dans les exemples suivants, les commandes pour lancer les tests avec atoum seront écrit avec la forme suivante:

.. code-block:: shell

   $ ./bin/atoum

C'est exactement la commande que vous pourriez utiliser si vous avez :ref:`installation-par-composer` sous Linux.


.. _fichiers-a-executer:

Fichiers à exécuter
*******************


Par fichiers
============

Pour lancer les tests d'un fichier, il vous suffit d'utiliser l'option -f ou --files.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyTest.php


Par répertoires
===============

Pour lancer les tests d'un répertoire, il vous suffit d'utiliser l'option -d ou --directories.

.. code-block:: shell

   $ ./bin/atoum -d tests/units


Filtres
*******

Une fois que vous avez préciser à atoum les `fichiers à exécuter`_, vous pouvez filtrer ce qui sera réellement exécuter.

.. _filtres-par-namespace:

Par espace de noms
==================

Pour filtrer sur l'espace de noms, c'est à dire n'exécuter que les tests d'un espace de noms donné, il vous suffit d'utiliser l'option -ns ou --namespaces.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

.. note::
   Il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.


.. _filtres-par-classe-ou-methode:

Une classe ou une méthode
=========================

Pour filtrer sur la classe ou une méthode, c'est à dire n'exécuter que les tests d'une classe ou d'une méthode donnée, il vous suffit d'utiliser l'option -m ou --methods.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

.. note::
   Il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.


Vous pouvez remplacer le nom de la classe ou de la méthode par ``*`` pour signifier ``tous``.

Si vous remplacez le nom de la méthode par ``*``, cela revient à dire que vous filtrez par classe.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

Si vous remplacez le nom de la class par ``*``, cela revient à dire que vous filtrez par méthode.

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

De la même manière, il est également possible de tagger les méthodes de test.

.. note::
   Les tags définis au niveau d'une méthode prennent le pas sur ceux définis au niveau de la classe.


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

Attention, cette instruction n'a de sens que s'il y a une ou plusieurs classes de tests unitaires et qu'au moins l'une d'entres elles porte le tag spécifié. Dans le cas contraire, aucun test ne sera exécuté.

Il est possible de définir plusieurs tags:

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

Dans ce dernier cas, les classes de tests ayant été taggés soit avec thisIsOneTag, soit avec thisIsThreeTag, seront les seules à être exécutées.


.. _fichier-de-configuration:

Fichier de configuration
************************

Si vous nommez votre fichier de configuration ``.atoum.php``, atoum le chargera automatiquement si ce fichier se trouve dans le répertoire courant. Le paramètre ``-c`` est donc optionnel dans ce cas.


Couverture du code
==================

Par défaut, si PHP dispose de l'extension `Xdebug <http://xdebug.org>`_, atoum indique en ligne de commande le taux de couverture du code par les tests venant d'être exécutés.

Si le taux de couverture est de 100%, atoum se contente de l'indiquer. Mais dans le cas contraire, il affiche le taux de couverture globale ainsi que celui de chaque méthode de la classe testée sous la forme la forme d'un pourcentage.

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

Il est cependant possible d'obtenir une représentation plus précise du taux de couverture du code par les tests, sous la forme d'un rapport au format HTML.

Pour l'obtenir, il suffit de se baser sur les modèles de fichiers de configuration inclus dans atoum.

Si vous utlisez l'archive PHAR, il faut les extraire en utilisant la commande suivante:

.. code-block:: php

   php mageekguy.atoum.phar -er /path/to/destination/directory

Une fois l'extraction effectuée, vous devriez avoir dans le répertoire /path/to/destination/directory un répertoire nommé resources/configurations/runner.

Dans le cas où vous utilisez atoum en ayant cloné le dépôt :ref:`installation-par-github` ou l'ayant installé via :ref:`installation-par-composer`, les modèles se trouvent dans ``/path/to/atoum/resources/configurations/runner``

Dans ce répertoire, il y a, entre autre chose intéressante, un modèle de fichier de configuration pour atoum nommé ``coverage.php.dist`` qu'il vous faudra copier à l'emplacement de votre choix. Renommez le ``coverage.php``.

Une fois le fichier copié, il n'y a plus qu'à le modifier à l'aide de l'éditeur de votre choix afin de définir le répertoire dans lequel les fichiers HTML devront être générés ainsi que l'URL à partir de laquelle le rapport devra être accessible.

Par exemple:

.. code-block:: php

   $coverageField = new atoum\report\fields\runner\coverage\html(
       'Code coverage de mon projet',
       '/path/to/destination/directory'
   );

   $coverageField->setRootUrl('http://url/of/web/site');

.. note::
   Il est également possible de modifier le titre du rapport à l'aide du premier argument du constructeur de la classe ``mageekguy\atoum\report\fields\runner\coverage\html``.


Une fois tout cela effectué, il n'y a plus qu'à utiliser le fichier de configuration lors de l'exécution des tests, de la manière suivante:

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

Cette fonctionnalité nécessite la présence de l'exécutable ``growlnotify``. Pour vérifier s'il est disponible, utilisez la commande suivante :

.. code-block:: shell

   $ which growlnotify

Vous aurez alors le chemin de l'exécutable ou alors le message ``growlnotify not found`` s'il n'est pas installé.

Il suffit ensuite d'ajouter le code suivant à votre fichier de configuration :

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

Cette fonctionnalité nécessite la présence de l'exécutable ``terminal-notifier``. Pour vérifier s'il est disponible, utilisez la commande suivante :

.. code-block:: shell

   $ which terminal-notifier

Vous aurez alors le chemin de l'exécutable ou alors le message ``terminal-notifier not found`` s'il n'est pas installé.

.. note::
   Rendez-vous sur `la page Github du projet <https://github.com/alloy/terminal-notifier>`_ pour obtenir plus d'information sur l'installation de ``terminal-notifier``.


Il suffit ensuite d'ajouter le code suivant à votre fichier de configuration :

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

Cette fonctionnalité nécessite la présence de l'exécutable ``notify-send``. Pour vérifier s'il est disponible, utilisez la commande suivante :

.. code-block:: shell

   $ which notify-send

Vous aurez alors le chemin de l'exécutable ou alors le message ``notify-send not found`` s'il n'est pas installé.

Il suffit ensuite d'ajouter le code suivant à votre fichier de configuration :

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


Fichier de bootstrap
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

   // si l'archive PHAR est utilisée :
   require_once path/to/mageekguy.atoum.phar;

   // ou si les sources sont utilisés :
   // require_once path/atoum/scripts/runner.php
