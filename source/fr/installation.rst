
.. _installation:

Installation
************

Si vous souhaitez l'utiliser, il vous suffit de télécharger la dernière version.

Vous pouvez installer atoum de plusieurs manières :

* en téléchargeant l'`archive PHAR`_ ;
* à l'aide de `Composer`_ ;
* en clonant le dépôt `Github`_ ;
* voir aussi :ref:`l'integration d'atoum dans votre frameworks <utilisation-avec-frameworks>`.


.. _archive-phar:

Archive PHAR
============

Une archive PHAR (PHp ARchive) est créée automatiquement à chaque modification d'atoum.

PHAR est un format d'archive applicative pour PHP.


Installation
------------

Vous pouvez télécharger la dernière version stable d'atoum directement depuis le site officiel : `http://downloads.atoum.org/nightly/mageekguy.atoum.phar <http://downloads.atoum.org/nightly/mageekguy.atoum.phar>`_


Mise à jour
----------------------

La mise à jour de l'archive est très simple. Il vous suffit de lancer la commande suivante :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar --update

.. note::
	Le processus de mise à jour modifie l'archive PHAR. Cependant, par défaut la configuration de PHP ne l'autorise pas. Voilà pourquoi il faut utiliser la directive ``-d phar.readonly=0``.


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
--------------------------------------------------------

Vous pouvez lister les versions disponibles dans les archives en utilisant ``--list-available-versions`` ou ``-lav``:

.. code-block:: shell

   $ php mageekguy.atoum.phar -lav
     nightly-941-201201011548
     nightly-1568-201210311708
   * nightly-2416-201402121146

La liste des versions présentes dans l'archive est alors affichée, la version actuellement active étant précédée de ``*``.

Changer la version courante
-----------------------------------

Pour activer une autre version, il suffit d'utiliser l'argument ``--enable-version``, ou ``-ev`` en version abrégée, suivi du nom de la version à utiliser :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar -ev DEVELOPMENT

.. note::
	La modification de la version courante nécessite la modification de l'archive PHAR. Or par défaut, la configuration de php ne l'autorise pas. Voilà pourquoi il faut utiliser la directive ``-d phar.readonly=0``.


Suppression d'anciennes versions
-----------------------------------------

Au cours du temps, l'archive peut contenir plusieurs versions d'atoum qui ne sont plus utilisées.

Pour les supprimer, il suffit d'utiliser l'argument ``--delete-version``, ou ``-dv`` dans sa version abrégée, suivi du nom de la version à supprimer :

.. code-block:: shell

   $ php -d phar.readonly=0 mageekguy.atoum.phar -dv nightly-941-201201011548

La version est alors supprimée.

.. warning::
	Il n'est pas possible de supprimer la version active.

.. note::
	La suppression d'une version nécessite la modification de l'archive PHAR. Or par défaut, la configuration de php ne l'autorise pas. Voilà pourquoi il faut utiliser la directive ``-d phar.readonly=0``.


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
       "require-dev": {
           "atoum/atoum": "~2.5"
       }
   }

Enfin, exécutez la commande suivante :

.. code-block:: shell

   $ php composer.phar install


.. _installation-par-github:

Github
======

Si vous souhaitez utiliser atoum directement depuis ses sources, vous pouvez cloner ou « forker » le dépôt github : `git://github.com/atoum/atoum.git <git://github.com/atoum/atoum.git>`_
