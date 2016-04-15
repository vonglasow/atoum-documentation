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

Dans les exemples suivants, les commandes pour lancer les tests avec atoum seront écrites avec la forme suivante :

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


Vous trouverez d'autres arguments dans la section approprié lié à la :ref`ligne de commande <cli-options>`.

Filtres
*******

Une fois que vous avez préciser à atoum les :ref:`fichiers à exécuter <fichiers-a-executer>`, vous pouvez filtrer ce qui sera réellement exécuter.

.. _filtres-par-namespace:

Par espace de noms
==================

Pour filtrer sur les espace de nom, par example exécuter le test seulement sur un espace de nom, il suffit d'utiliser l'option ``-ns`` or ``--namespaces``.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

.. note::
   Il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.


.. _filtres-par-classe-ou-methode:

Une classe ou une méthode
=========================

Pour filtrer sur une classe ou une méthode, c'est-à-dire exécuter seulement des tests d'une classe ou une méthode, il suffit d'utiliser l'option ``-m`` ou ``--methods``.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

.. note::
   Il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.


Vous pouvez remplacer le nom de la classe ou de la méthode par ``*`` pour signifier ``tous``.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

En utilisant "*" au lieu d'un nom de classe signifie que vous pouvez filtrer par nom de la méthode.

.. code-block:: shell

   $ ./bin/atoum -d tests/units -m *::testContains


.. _filtres-par-tag:

Tags
====

Tout comme de nombreux outils, dont `Behat <http://behat.org>`_, atoum vous permet de taguer vos tests unitaires et de n'exécuter que ceux ayant un ou plusieurs tags spécifiques.

Pour cela, il faut commencer par définir un ou plusieurs tags pour une ou plusieurs classes de tests unitaires.

Cela se fait très simplement grâce aux annotations et à la balise @tags :

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

De la même manière, il est également possible de taguer les méthodes de test.

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

Une fois les tags nécessaires définis, il n'y a plus qu'à exécuter les tests avec le ou les tags adéquates à l'aide de l'option --tags, ou -t dans sa version courte :

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag

Attention, cette instruction n'a de sens que s'il y a une ou plusieurs classes de tests unitaires et qu'au moins l'une d'entre elles porte le tag spécifié. Dans le cas contraire, aucun test ne sera exécuté.

Il est possible de définir plusieurs tags :

.. code-block:: shell

   $ ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

Dans ce dernier cas, les classes de tests ayant été tagués soit avec thisIsOneTag, soit avec thisIsThreeTag, seront les seules à être exécutées.
