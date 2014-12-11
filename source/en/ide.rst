Using atoum with your favorite IDE
##################################

Sublime Text 2
**************

A `SublimeText 2 plugin <https://github.com/toin0u/Sublime-atoum>`_ enables you to launch tests and see their results from within the editor.

Installation instructions are available at `its author's blog <http://sbin.dk/2012/05/19/atoum-sublime-text-2-plugin/>`_.

VIM
***

atoum is bundled with a VIM plugin.

It enables you to launch tests suites without leaving the editor and shows you the tests report in the editor's screen.

You can then navigate through errors and go straight to the line where assertions have failed using a key stroke.

Installing the VIM plugin
=========================

You'll find the plugin file ``atoum.vmb`` in the ``resources/vim`` folder.

If you're using the PHAR archive, you'll need to extract the file using the following instruction : 

.. code-block:: shell

   $ php mageekguy.atoum.phar --extractResourcesTo path/to/a/directory

Once the extraction is done, the plugin file ``atoum.vmb`` will be located in the ``path/to/a/directory/resources/vim`` folder.

Edit the file in VIM :

.. code-block:: shell

   $ vim path/to/atoum.vmb

And ask VIM to install the plugin with the command below :

.. code-block:: vim

   :source %

Using the atoum VIM plugin
==========================

For the plugin to work, atoum obviously has to be installed. You also are expected to be editing a file containing a test class based on atoum.

If this is actually the case, you can launch the test suite :

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
