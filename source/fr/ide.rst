Intégration d'atoum dans votre IDE
##################################


Sublime Text 2
**************

Un `plug-in pour SublimeText 2 <https://github.com/toin0u/Sublime-atoum>`_ permet l'exécution des tests unitaires par atoum et la visualisation du résultat sans quitter l'éditeur.

Les informations nécessaires à son installation et à sa configuration sont disponibles `sur le blog de son auteur <http://sbin.dk/2012/05/19/atoum-sublime-text-2-plugin/>`_.


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

Une fois en possession du fichier ``atoum.vmb``, il faut l'éditer à l'aide de VIM :

.. code-block:: shell

   $ vim path/to/atoum.vmb

Il n'y a plus ensuite qu'à demander à VIM l'installation du plug-in à l'aide de la commande :

.. code-block:: vim

   :source %


Utilisation du plug-in atoum pour VIM
=====================================

Pour utiliser le plug-in, atoum doit évidemment être installé et vous devez être en train d'éditer un fichier contenant une classe de tests unitaires basée sur atoum.

Une fois dans cette configuration, la commande suivante lancera l'exécution des tests :

.. code-block:: vim

   :Atoum

Les tests sont alors exécutés, et une fois qu'ils sont terminés, un rapport basé sur le fichier de configuration de atoum qui se trouve dans le répertoire ``ftplugin/php/atoum.vim`` de votre répertoire ``.vim`` est généré dans une nouvelle fenêtre.

Évidemment, vous êtes libre de lier cette commande à la combinaison de touches de votre choix, en ajoutant par exemple la ligne suivante dans votre fichier ``.vimrc`` :

.. code-block:: vim

   nnoremap *.php <F12> :Atoum<CR>

L'utilisation de la touche ``F12`` de votre clavier en mode normal appellera alors la commande ``:Atoum``.


Gestion des fichiers de configuration de atoum
==============================================

Vous pouvez indiquer un autre fichier de configuration pour atoum en ajoutant la ligne suivante à votre fichier ``.vimrc`` :

.. code-block:: vim

   call atoum#defineConfiguration('/path/to/project/directory', '/path/to/atoum/configuration/file', '.php')

La fonction ``atoum#defineConfiguration`` permet en effet de définir le fichier de configuration à utiliser en fonction du répertoire ou se trouve le fichier de tests unitaires.
Elle accepte pour cela trois arguments :

* un chemin d'accès vers le répertoire contenant les tests unitaires ;
* un chemin d'accès vers le fichier de configuration de atoum devant être utilisé ;
* l'extension des fichiers de tests unitaires concernés.

Pour plus de détails sur l'utilisation du plug-in, une aide est disponible dans VIM à l'aide de la commande suivante :

.. code-block:: vim

   :help atoum


Ouvrir automatiquement les tests en échec
*****************************************

atoum est capable d'ouvrir automatiquement les fichiers des tests en échec à la fin de l'exécution. Plusieurs éditeurs sont actuellement supportés :

* :ref:`macvim <macvim-anchor>` (Mac OS X)
* :ref:`gvim <gvim-anchor>` (Unix)
* :ref:`PhpStorm <php-storm>` (Mac OS X/Unix)
* :ref:`gedit <gedit-anchor>` (Unix)

Pour utiliser cette fonctionnalité, vous devrez modifier le `fichier de configuration <chapitre3.html#fichier-de-configuration>`_ de atoum :


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


PhpStorm
========

Si vous travaillez sous Mac OS X, utilisez la configuration suivante :

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


Dans un environnement Unix, utilisez la configuration suivante :

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
