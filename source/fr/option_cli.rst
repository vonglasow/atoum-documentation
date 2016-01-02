.. _cli-options:

Option de la ligne de commande
##############################

La plupart des options existent sous 2 formes, une courte de 1 à 6 caractères et une longue, plus explicative. Ces 2 formes font strictement la même chose. Vous pouvez utiliser indifféremment l'une ou l'autre forme.

Certaines options acceptent plusieurs valeurs :

.. code-block:: shell

   $ ./bin/atoum -f tests/units/MyFirstTest.php tests/units/MySecondTest.php


.. note::
   Vous ne devez mettre qu'une seule fois chaque option. Dans le cas contraire, seule la dernière est prise en compte.


.. code-block:: shell

   # Ne test que MySecondTest.php
   $ ./bin/atoum -f MyFirstTest.php -f MySecondTest.php

   # Ne test que MyThirdTest.php et MyFourthTest.php
   $ ./bin/atoum -f MyFirstTest.php MySecondTest.php -f MyThirdTest.php MyFourthTest.php


.. _cli-options-bootstrap_file:

-bf <file> / --bootstrap-file <file>
************************************

Cette option vous permet de spécifier le chemin vers le fichier de bootstrap.

.. code-block:: shell

   $ ./bin/atoum -bf /path/to/bootstrap.php
   $ ./bin/atoum --bootstrap-file /path/to/bootstrap.php


.. _cli-options-configuration:

-c <file> / --configuration <file>
**********************************

Cette option vous permet de spécifier le chemin vers le fichier de configuration à utiliser pour lancer les tests.

.. code-block:: shell

   $ ./bin/atoum -c config/atoum.php
   $ ./bin/atoum --configuration tests/units/conf/coverage.php


.. _cli-options-directories:

-d <directories> / --directories <directories>
**********************************************

Cette option vous permet de spécifier le ou les répertoires de tests à lancer.

.. code-block:: shell

   $ ./bin/atoum -d tests/units/db/
   $ ./bin/atoum --directories tests/units/db/ tests/units/entities/


.. _cli-options-debug:

--debug
*******

Cette option vous permet d'activer le mode debug

.. code-block:: shell

   $ ./bin/atoum --debug

.. note::
   Reportez-vous à la section sur le :ref:`le-mode-debug` pour avoir plus d'informations.


.. _cli-options-report-title:

-drt <string> / --default-report-title <string>
***********************************************

Cette option vous permet de spécifier le titre par défaut des rapports générés par atoum.

.. code-block:: shell

   $ ./bin/atoum -drt Title
   $ ./bin/atoum --default-report-title "My Title"

.. note::
   Si le titre comporte des espaces, il faut obligatoirement l'entourer de guillemets.


.. _cli-options-file:

-f <files> / --files <files>
****************************

Cette option vous permet de spécifier le ou les fichiers de tests à lancer.

.. code-block:: shell

   $ ./bin/atoum -f tests/units/db/mysql.php
   $ ./bin/atoum --files tests/units/db/mysql.php tests/units/db/pgsql.php


.. _cli-options-force_terminal:

-ft / --force-terminal
**********************

Cette option vous permet de forcer la sortie vers le terminal.

.. code-block:: shell

   $ ./bin/atoum -ft
   $ ./bin/atoum --force-terminal


.. _cli-options-glob:

-g <pattern> / --glob <pattern>
*******************************

Cette option vous permet de spécifier les fichiers de tests à lancer en fonction d'un schéma.

.. code-block:: shell

   $ ./bin/atoum -g ???
   $ ./bin/atoum --glob ???


.. _cli-options-help:

-h / --help
***********

Cette option vous permet d'afficher la liste des options disponibles.

.. code-block:: shell

   $ ./bin/atoum -h
   $ ./bin/atoum --help


.. _cli-options-loop:

-l / --loop
***********

Cette option vous permet d'activer le mode loop d'atoum.

.. code-block:: shell

   $ ./bin/atoum -l
   $ ./bin/atoum --loop

.. note::
   Reportez-vous à la section sur le :ref:`mode-loop` pour avoir plus d'informations.


.. _cli-options-methods:

-m <class::method> / --methods <class::methods>
***********************************************

Cette option vous permet de filtrer les classes et les méthodes à lancer.

.. code-block:: shell

   # lance uniquement la méthode testMyMethod de la classe vendor\\project\\test\\units\\myClass
   $ ./bin/atoum -m vendor\\project\\test\\units\\myClass::testMyMethod
   $ ./bin/atoum --methods vendor\\project\\test\\units\\myClass::testMyMethod

   # lance toutes les méthodes de test de la classe vendor\\project\\test\\units\\myClass
   $ ./bin/atoum -m vendor\\project\\test\\units\\myClass::*
   $ ./bin/atoum --methods vendor\\project\\test\\units\\myClass::*

   # lance uniquement les méthodes testMyMethod de toutes les classes de test
   $ ./bin/atoum -m *::testMyMethod
   $ ./bin/atoum --methods *::testMyMethod

.. note::
   Reportez-vous à la section sur les filtres par :ref:`filtres-par-classe-ou-methode` pour avoir plus d'informations.


.. _cli-options-max_children_number:

-mcn <integer> / --max-children-number <integer>
************************************************

Cette option vous permet de définir le nombre maximum de processus lancés pour exécuter les tests.

.. code-block:: shell

   $ ./bin/atoum -mcn 5
   $ ./bin/atoum --max-children-number 3


.. _cli-options-ncc:

-ncc / --no-code-coverage
*************************

Cette option vous permet de désactiver la génération du rapport de la couverture de code.

.. code-block:: shell

   $ ./bin/atoum -ncc
   $ ./bin/atoum --no-code-coverage


.. _cli-options-nccfc:

-nccfc <classes> / --no-code-coverage-for-classes <classes>
***********************************************************

Cette option vous permet de désactiver la génération du rapport de la couverture de code pour une ou plusieurs classe.

.. code-block:: shell

   $ ./bin/atoum -nccfc vendor\\project\\db\\mysql
   $ ./bin/atoum --no-code-coverage-for-classes vendor\\project\\db\\mysql vendor\\project\\db\\pgsql

.. note::
   Il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.


.. _cli-options-nccfns:

-nccfns <namespaces> / --no-code-coverage-for-namespaces <namespaces>
*********************************************************************

Cette option vous permet de désactiver la génération du rapport de la couverture de code pour un ou plusieurs espaces de noms.

.. code-block:: shell

   $ ./bin/atoum -nccfns vendor\\outside\\lib
   $ ./bin/atoum --no-code-coverage-for-namespaces vendor\\outside\\lib1 vendor\\outside\\lib2

.. note::
   Il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.


.. _cli-options-nccid:

-nccid <directories> / --no-code-coverage-in-directories <directories>
**********************************************************************

Cette option vous permet de désactiver la génération du rapport de la couverture de code pour un ou plusieurs répertoires.

.. code-block:: shell

   $ ./bin/atoum -nccid /path/to/exclude
   $ ./bin/atoum --no-code-coverage-in-directories /path/to/exclude/1 /path/to/exclude/2


.. _cli-options-ns:

-ns <namespaces> / --namespaces <namespaces>
********************************************

Cette option vous permet de filtrer les classes et les méthodes en fonction des espaces de noms.

.. code-block:: shell

   $ ./bin/atoum -ns mageekguy\\atoum\\tests\\units\\asserters
   $ ./bin/atoum --namespaces mageekguy\\atoum\\tests\\units\\asserters

.. note::
   Reportez-vous à la section sur les filtres :ref:`filtres-par-namespace` pour avoir plus d'informations.


.. _cli-options-php:

-p <file> / --php <file>
************************

Cette option vous permet de spécifier le chemin de l'exécutable php à utiliser pour lancer vos tests.

.. code-block:: shell

   $ ./bin/atoum -p /usr/bin/php5
   $ ./bin/atoum --php /usr/bin/php5

Par défaut, la valeur est recherchée parmi les valeurs suivantes (dans l'ordre):

* constante PHP_BINARY
* variable d'environnement PHP_PEAR_PHP_BIN
* variable d'environnement PHPBIN
* constante PHP_BINDIR + '/php'


.. _cli-options-sf:

-sf <file> / --score-file <file>
********************************

Cette option vous permet de spécifier le chemin vers le fichier des résultats créé par atoum.

.. code-block:: shell

   $ ./bin/atoum -sf /path/to/atoum.score
   $ ./bin/atoum --score-file /path/to/atoum.score


.. _cli-options-tags:

-t <tags> / --tags <tags>
*************************

Cette option vous permet de filtrer les classes et les méthodes à lancer en fonction des tags.

.. code-block:: shell

   $ ./bin/atoum -t OneTag
   $ ./bin/atoum --tags OneTag TwoTag

.. note::
   Reportez-vous à la section sur les filtres par :ref:`filtres-par-tag` pour avoir plus d'informations.


.. _cli-options-test_all:

--test-all
**********

Cette option vous permet de lancer les tests se trouvant dans les répertoires définis dans le fichier de configuration via $script->addTestAllDirectory('path/to/directory').

.. code-block:: shell

   $ ./bin/atoum --test-all


.. _cli-options-test_it:

--test-it
*********

Cette option vous permet de lancer les tests unitaires d'atoum pour vérifier qu'il tourne sans problème sur votre serveur.

.. code-block:: shell

   $ ./bin/atoum --test-it


.. _cli-options-tfe:

-tfe <extensions> / --test-file-extensions <extensions>
*******************************************************

Cette option vous permet de spécifier le ou les extensions des fichiers de tests à lancer.

.. code-block:: shell

   $ ./bin/atoum -tfe phpt
   $ ./bin/atoum --test-file-extensions phpt php5t


.. _cli-options-ulr:

-ulr / --use-light-report
*************************

Cette option vous permet d'alléger la sortie généré par atoum.

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

Cette option vous permet d'afficher la version courante d'atoum.

.. code-block:: shell

   $ ./bin/atoum -v
   $ ./bin/atoum --version

   atoum version DEVELOPMENT by Frédéric Hardy (/path/to/atoum)
