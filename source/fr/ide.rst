.. _ide_integration:

Intégration d'atoum dans votre IDE
##################################

.. _ide_sublime2:

Sublime Text 2
**************

Un `plug-in pour SublimeText 2 <https://github.com/toin0u/Sublime-atoum>`_ permet l'exécution des tests unitaires par atoum et la visualisation du résultat sans quitter l'éditeur.

Les informations nécessaires à son installation et à sa configuration sont disponibles `sur le blog de son auteur <http://sbin.dk/2012/05/19/atoum-sublime-text-2-plugin/>`_.

.. _ide_vim:

VIM
***

atoum est livré avec un plug-in facilitant son utilisation dans l'éditeur VIM.

Il permet d'exécuter les tests sans quitter VIM et d'obtenir le rapport correspondant dans une fenêtre de l'éditeur.

Il est alors possible de naviguer parmi les éventuelles erreurs, voire de se rendre à la ligne correspondant à une assertion ne passant pas à l'aide d'une simple combinaison de touches.


Installation du plug-in atoum pour VIM
======================================

Vous trouverez le fichier correspondant au plug-in, nommé ``atoum.vmb``, dans le répertoire ``resources/vim``.

Si vous utilisez l'archive PHAR, il faut extraire le fichier à l'aide de la commande suivante :

.. code-block:: shell

   $ php mageekguy.atoum.phar --extractResourcesTo path/to/a/directory

Une fois l'extraction réalisée, le fichier ``atoum.vmb`` correspondant au plug-in pour VIM sera dans le répertoire ``path/to/a/directory/resources/vim``.

Une fois en possession du fichier ``atoum.vmb``, il faut l'éditer à l'aide de VIM :

.. code-block:: shell

   $ vim path/to/atoum.vmb

Il n'y a plus ensuite qu'à demander à VIM l'installation du plug-in à l'aide de la commande :

.. code-block:: vim

   :source %


Utilisation du plug-in atoum pour VIM
=====================================

Pour utiliser le plug-in, atoum doit évidemment être installé et vous devez être en train d'éditer un fichier contenant une classe de tests unitaires basée sur atoum.

Une fois dans cette configuration, la commande suivante lancera l'exécution des tests :

.. code-block:: vim

   :Atoum

Les tests sont alors exécutés, et une fois qu'ils sont terminés, un rapport basé sur le fichier de configuration d’atoum qui se trouve dans le répertoire ``ftplugin/php/atoum.vim`` de votre répertoire ``.vim`` est généré dans une nouvelle fenêtre.

Évidemment, vous êtes libre de lier cette commande à la combinaison de touches de votre choix, en ajoutant par exemple la ligne suivante dans votre fichier ``.vimrc`` :

.. code-block:: vim

   nnoremap *.php <F12> :Atoum<CR>

L'utilisation de la touche ``F12`` de votre clavier en mode normal appellera alors la commande ``:Atoum``.


Gestion des fichiers de configuration d’atoum
=============================================

Vous pouvez indiquer un autre fichier de configuration pour atoum en ajoutant la ligne suivante à votre fichier ``.vimrc`` :

.. code-block:: vim

   call atoum#defineConfiguration('/path/to/project/directory', '/path/to/atoum/configuration/file', '.php')

La fonction ``atoum#defineConfiguration`` permet en effet de définir le fichier de configuration à utiliser en fonction du répertoire où se trouve le fichier de tests unitaires.
Elle accepte pour cela trois arguments :

* un chemin d'accès vers le répertoire contenant les tests unitaires ;
* un chemin d'accès vers le fichier de configuration d’atoum devant être utilisé ;
* l'extension des fichiers de tests unitaires concernés.

Pour plus de détails sur l'utilisation du plug-in, une aide est disponible dans VIM à l'aide de la commande suivante :

.. code-block:: vim

   :help atoum

.. _ide_phpstorm:

PhpStorm
********

atoum possède avec un plug-in officiel pour PHPStorm. Il vous aide, au quotidien, dans votre développement. Les principales fonctionnalités sont :

* Accédez à la classe de test depuis la classe testée (raccourci : alt+shift+K)
* Accédez à la classe testée depuis la de test (shortcut : alt+shift+K)
* Exécuté les tests à l'intérieur PhpStorm (shortcut : alt+shift+M)
* Identification facile des fichiers de test via une icône spécifique

Installation
============

C'est simple à installer, pour cela il suffit de suivre les étapes suivantes :

* Ouvrir PHPStorm
* Aller dans *Fichier -> Paramètres*, cliquer sur *Plugins*
* Cliquer sur parcourir le répertoire
* Chercher *atoum* dans la liste, cliquer sur le bouton installation
* Redémarrer PHPStorm

Si vous avez besoin de plus d'information, il suffit de lire le `repository du plugin <https://github.com/atoum/phpstorm-plugin>`_.

.. _ide_atom:

Atom
****

atoum possède avec un plug-in officiel pour atom. Celui-ci vous aide dans plusieurs tâches :

* Un panneau avec tous les tests
* Exécuter tous les tests, dans un répertoire ou dans le répertoire courant

Installation
============

Il est simple d'installation, il suffit de suivre les étapes `d'installation officiel <http://flight-manual.atom.io/using-atom/sections/atom-packages/>`_ ou les étapes suivantes :

* Ouvrir atom
* Aller dans *Paramètres*, cliquer sur *Installation*
* Chercher *atoum* dans la liste, cliquer sur le bouton installation

Si vous avez besoin de plus d'information, il suffit de lire le `repository du package <https://github.com/atoum/atom-plugin>`_.

.. _ide_auto-open-test:

Ouvrir automatiquement les tests en échec
*****************************************

atoum est capable d'ouvrir automatiquement les fichiers des tests en échec à la fin de l'exécution. Plusieurs éditeurs sont actuellement supportés :

* :ref:`macvim<ide_auto-open_macvim>` (Mac OS X)
* :ref:`gvim<ide_auto-open_gvim>` (Unix)
* :ref:`PhpStorm<ide_auto-open_phpstorm>` (Mac OS X/Unix)
* :ref:`gedit<ide_auto-open_gedit>` (Unix)

Pour utiliser cette fonctionnalité, vous devrez modifier le :ref:`fichier de configuration <fichier-de-configuration>` d’atoum :

.. _ide_auto-open_macvim:

macvim
======

.. code-block:: php

   <?php
   use
       mageekguy\atoum,
       mageekguy\atoum\report\fields\runner\failures\execute\macos
   ;

   $stdOutWriter = new atoum\writers\std\out();
   $cliReport = new atoum\reports\realtime\cli();
   $cliReport->addWriter($stdOutWriter);

   $cliReport->addField(new macos\macvim());

   $runner->addReport($cliReport);

.. _ide_auto-open_gvim:

gvim
====

.. code-block:: php

   <?php
   use
       mageekguy\atoum,
       mageekguy\atoum\report\fields\runner\failures\execute\unix
   ;

   $stdOutWriter = new atoum\writers\std\out();
   $cliReport = new atoum\reports\realtime\cli();
   $cliReport->addWriter($stdOutWriter);

   $cliReport->addField(new unix\gvim());

   $runner->addReport($cliReport);

.. _ide_auto-open_phpstorm:

PhpStorm
========

Si vous travaillez sous Mac OS X, utilisez la configuration suivante :

.. code-block:: php

   <?php
   use
       mageekguy\atoum,
       mageekguy\atoum\report\fields\runner\failures\execute\macos
   ;

   $stdOutWriter = new atoum\writers\std\out();
   $cliReport = new atoum\reports\realtime\cli();
   $cliReport->addWriter($stdOutWriter);

   $cliReport
       // Si PhpStorm est installé dans /Applications
       ->addField(new macos\phpstorm())

       // Si vous avez installé PhpStorm
       // dans un dossier différent de /Applications
       // ->addField(
       //     new macos\phpstorm(
       //         '/path/to/PhpStorm.app/Contents/MacOS/webide'
       //     )
       // )
   ;

   $runner->addReport($cliReport);


Dans un environnement Unix, utilisez la configuration suivante :

.. code-block:: php

   <?php
   use
       mageekguy\atoum,
       mageekguy\atoum\report\fields\runner\failures\execute\unix
   ;

   $stdOutWriter = new atoum\writers\std\out();
   $cliReport = new atoum\reports\realtime\cli();
   $cliReport->addWriter($stdOutWriter);

   $cliReport
       ->addField(
           new unix\phpstorm('/chemin/vers/PhpStorm/bin/phpstorm.sh')
       )
   ;

   $runner->addReport($cliReport);

.. _ide_auto-open_gedit:

gedit
=====

.. code-block:: php

   <?php
   use
       mageekguy\atoum,
       mageekguy\atoum\report\fields\runner\failures\execute\unix
   ;

   $stdOutWriter = new atoum\writers\std\out();
   $cliReport = new atoum\reports\realtime\cli();
   $cliReport->addWriter($stdOutWriter);

   $cliReport->addField(new unix\gedit());

   $runner->addReport($cliReport);
