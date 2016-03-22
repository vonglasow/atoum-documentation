.. _fichier-de-configuration:

Fichier de configuration
************************

Si vous nommez votre fichier de configuration ``.atoum.php``, atoum le chargera automatiquement si ce fichier se trouve dans le répertoire courant. Le paramètre ``-c`` est donc optionnel dans ce cas.


Couverture du code
==================

Par défaut, si PHP dispose de l'extension `Xdebug <http://xdebug.org>`_, atoum indique en ligne de commande le taux de couverture du code par les tests venant d'être exécutés.

Si le taux de couverture est de 100%, atoum se contente de l'indiquer. Mais dans le cas contraire, il affiche le taux de couverture globale ainsi que celui de chaque méthode de la classe testée sous la forme d'un pourcentage.

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

Si vous utlisez l'archive PHAR, il faut les extraire en utilisant la commande suivante :

.. code-block:: php

   php mageekguy.atoum.phar -er /path/to/destination/directory

Une fois l'extraction effectuée, vous devriez avoir dans le répertoire /path/to/destination/directory un répertoire nommé resources/configurations/runner.

Dans le cas où vous utilisez atoum en ayant cloné le dépôt :ref:`installation-par-github` ou l'ayant installé via :ref:`installation-par-composer`, les modèles se trouvent dans ``/path/to/atoum/resources/configurations/runner``

Dans ce répertoire, il y a, entre autre chose intéressante, un modèle de fichier de configuration pour atoum nommé ``coverage.php.dist`` qu'il vous faudra copier à l'emplacement de votre choix. Renommez le ``coverage.php``.

Une fois le fichier copié, il n'y a plus qu'à le modifier à l'aide de l'éditeur de votre choix afin de définir le répertoire dans lequel les fichiers HTML devront être générés ainsi que l'URL à partir de laquelle le rapport devra être accessible.

Par exemple :

.. code-block:: php

   $coverageField = new atoum\report\fields\runner\coverage\html(
       'Code coverage de mon projet',
       '/path/to/destination/directory'
   );

   $coverageField->setRootUrl('http://url/of/web/site');

.. note::
   Il est également possible de modifier le titre du rapport à l'aide du premier argument du constructeur de la classe ``mageekguy\atoum\report\fields\runner\coverage\html``.


Une fois tout cela effectué, il n'y a plus qu'à utiliser le fichier de configuration lors de l'exécution des tests, de la manière suivante :

.. code-block:: shell

   $ ./bin/atoum -c path/to/coverage.php -d tests/units

Une fois les tests exécutés, atoum génèrera alors le rapport de couverture du code au format HTML dans le répertoire que vous aurez défini précédemment, et il sera lisible à l'aide du navigateur de votre choix.

.. note::
   Le calcul du taux de couverture du code par les tests ainsi que la génération du rapport correspondant peuvent ralentir de manière notable l'exécution des tests. Il peut être alors intéressant de ne pas utiliser systématiquement le fichier de configuration correspondant, ou bien de les désactiver temporairement à l'aide de l'argument -ncc.


.. _notifications-anchor:

Notifications
=============

atoum est capable de vous prévenir lorsque les tests sont exécutés en utilisant plusieurs systèmes de notification : `Growl`_, `Mac OS X Notification Center`_, `Libnotify`_.


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

