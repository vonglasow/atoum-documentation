Démarrer avec atoum
###################

Installation
************

Si vous souhaitez l'utiliser, il vous suffit de télécharger la dernière version.

Vous pouvez installer atoum de plusieurs manières :

* en téléchargeant l'`archive PHAR`_ ;
* à l'aide de `Composer`_ ;
* en utilisant un `Script d'installation`_ ;
* en clonant le dépôt `Github`_ ;
* en utilisant un `plugin symfony 1`_ ;
* en utilisant un `bundle Symfony 2`_ ;
* en utilisant un `composant Zend Framework 2`_.


.. _archive-phar:

Archive PHAR
============

Une archive PHAR (PHp ARchive) est créée automatiquement à chaque modification d'atoum.

PHAR est un format d'archive d'application PHP, disponible depuis PHP 5.3.


Installation
------------

Vous pouvez télécharger la dernière version stable d'atoum directement depuis le site officiel : `http://downloads.atoum.org/nightly/mageekguy.atoum.phar <http://downloads.atoum.org/nightly/mageekguy.atoum.phar>`_


Mise à jour
-----------

La mise à jour de l'archive est très simple. Il vous suffit de lancer la commande suivante :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update

.. note::
   La mise à jour d'atoum nécessite la modification de l'archive PHAR. Or par défaut, la configuration de PHP ne l'autorise pas. Voilà pourquoi il faut utiliser la directive ``-d phar.readonly=0``.


Si une version plus récente existe, elle sera alors téléchargée automatiquement et installée au sein de l'archive :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   Update to version 'nightly-2416-201402121146'... Done !
   Enable version 'nightly-2416-201402121146'... Done !
   Atoum was updated to version 'nightly-2416-201402121146' successfully !

S'il n'existe pas de version plus récente, atoum s'arrêtera immédiatement :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   There is no new version available !

atoum ne demande aucune confirmation de la part de l'utilisateur pour réaliser la mise à jour, car il est très facile de revenir à une version précédente.

Lister les versions contenues dans l'archive
--------------------------------------------

Pour afficher les versions contenues dans l'archive au fur et à mesure des mises à jour, il faut faire appel à l'argument ``--list-available-versions``, ou ``-lav`` en version abrégée :

.. code-block:: shell

   $ php mageekguy.atoum.phar -lav
     nightly-941-201201011548
     nightly-1568-201210311708
   * nightly-2416-201402121146

La liste des versions présentes dans l'archive est alors affichée, la version actuellement active étant précédée de ``*``.

Changer la version courante
---------------------------

Pour activer une autre version, il suffit d'utiliser l'argument ``--enable-version``, ou ``-ev`` en version abrégée, suivi du nom de la version à utiliser :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar -ev DEVELOPMENT

.. note::
   La modification de la version courante nécessite la modification de l'archive PHAR. Or par défaut, la configuration de php ne l'autorise pas. Voilà pourquoi il faut utiliser la directive ``-d phar.readonly=0``.


Suppression d'anciennes versions
--------------------------------

Au cours du temps, l'archive peut contenir plusieurs versions d'atoum qui ne sont plus utilisées.

Pour les supprimer, il suffit d'utiliser l'argument ``--delete-version``, ou ``-dv`` dans sa version abrégée, suivi du nom de la version à supprimer :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar -dv nightly-941-201201011548

La version est alors supprimée.

.. warning::
   Il n'est pas possible de supprimer la version active.

.. note::
   La suppression d'une version nécessite la modification de l'archive PHAR. Or par défaut, la configuration de PHP ne l'autorise pas. Voilà pourquoi il faut utiliser la directive ``-d phar.readonly=0``.


.. _installation-par-composer:

Composer
========

`Composer <http://getcomposer.org>`_ est un outil de gestion de dépendance en PHP.

Commencez par installer composer :

.. code-block:: shell

   $ curl -s https://getcomposer.org/installer | php

Créez ensuite un fichier ``composer.json`` contenant le JSON (JavaScript Object Notation) suivant :

.. code-block:: json

   {
       "require" : {
           "atoum/atoum" : "dev-master"
       }
   }

Enfin, exécutez la commande suivante :

.. code-block:: shell

   $ php composer.phar install


.. _installation-par-github:

Github
======

Si vous souhaitez utiliser atoum directement depuis ses sources, vous pouvez cloner ou « forker » le dépôt github : `git://github.com/atoum/atoum.git <git://github.com/atoum/atoum.git>`_


Plugin symfony 1
================

Pour utiliser atoum au sein d'un projet symfony 1, un plug-in existe et est disponible à l'adresse suivante : `https://github.com/atoum/sfAtoumPlugin <https://github.com/atoum/sfAtoumPlugin>`_.

Toutes les instructions pour son installation et son utilisation se trouvent dans le cookbook :ref:`utilisation-avec-symfony-1-4` ainsi que sur la page github.


Bundle Symfony 2
================

Pour utiliser atoum au sein d'un projet Symfony 2, le bundle `AtoumBundle <https://github.com/atoum/AtoumBundle>`_ est disponible.

Toutes les instructions pour son installation et son utilisation se trouvent dans le cookbook :ref:`utilisation-avec-symfony-2` ainsi que sur la page github.


Composant Zend Framework 2
==========================

Si vous souhaitez utiliser atoum au sein d'un projet Zend Framework 2, un composant existe et est disponible à l'adresse suivante : `https://github.com/blanchonvincent/zend-framework-test-atoum <https://github.com/blanchonvincent/zend-framework-test-atoum>`_.

Toutes les instructions pour son installation et son utilisation sont disponibles sur cette page.


La philosophie d'atoum
************************

Exemple simple
==============

Vous devez écrire une classe de test pour chaque classe à tester.

Imaginez que vous vouliez tester la traditionnelle classe ``HelloWorld``, alors vous devez créer la classe de test ``test\units\HelloWorld``.

.. note::
   atoum utilise les espaces de noms. Par exemple, pour tester la classe ``Vendor\Project\HelloWorld``, vous devez créer la classe ``Vendor\Project\tests\units\HelloWorld``.


Voici le code de la classe ``HelloWorld`` que nous allons tester.

.. code-block:: php

   <?php
   # src/Vendor/Project/HelloWorld.php

   namespace Vendor\Project;

   class HelloWorld
   {
       public function getHiAtoum ()
       {
           return 'Hi atoum !';
       }
   }

Maintenant, voici le code de la classe de test que nous pourrions écrire.

.. code-block:: php

   <?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // La classe de test a son propre namespace :
   // Le namespace de la classe à tester + "tests\units"
   namespace Vendor\Project\tests\units;

   // Vous devez inclure la classe à tester
   require_once __DIR__ . '/../../HelloWorld.php';

   use atoum;

   /*
    * Classe de test pour Vendor\Project\HelloWorld
    *
    * Remarquez qu'elle porte le même nom que la classe à tester
    * et qu'elle dérive de la classe atoum
    */
   class HelloWorld extends atoum
   {
       /*
        * Cette méthode est dédiée à la méthode getHiAtoum()
        */
       public function testGetHiAtoum ()
       {
           $this
               // création d'une nouvelle instance de la classe à tester
               ->given($this->newTestedInstance)

               // nous testons que la méthode getHiAtoum retourne bien
               // une chaîne de caractère...
               ->string($this->testedInstance->getHiAtoum())
                   // ... et que la chaîne est bien celle attendue,
                   // c'est-à-dire 'Hi atoum !'
                   ->isEqualTo('Hi atoum !')
           ;
       }
   }

Maintenant, lançons nos tests.
Vous devriez voir quelque chose comme ça :

.. code-block:: shell

   $ ./vendor/bin/atoum -f src/Vendor/Project/tests/units/HelloWorld.php
   > PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > Vendor\Project\tests\units\HelloWorld...
   [S___________________________________________________________][1/1]
   => Test duration: 0.00 second.
   => Memory usage: 0.25 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.25 Mb.
   > Running duration: 0.04 second.
   Success (1 test, 1/1 method, 0 void method, 0 skipped method, 2 assertions)!


Nous venons de tester que la méthode ``getHiAtoum`` :

* retourne bien une chaîne de caractère ;
* que cette dernière est bien égale à ``"Hi atoum !"``.

Les tests sont passés, tout est au vert. Voilà, votre code est solide comme un roc grâce à atoum !


Principes de base
=================

Lorsque vous voulez tester une valeur, vous devez :

* indiquer le type de cette valeur (entier, décimal, tableau, chaîne de caractères, etc.) ;
* indiquer les contraintes devant s'appliquer à cette valeur (égal à, nulle, contenant quelque chose, etc.).
