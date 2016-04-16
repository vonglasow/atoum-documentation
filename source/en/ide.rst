.. _ide_integration:

Integration of atoum in your IDE
################################

.. _ide_sublime2:

Sublime Text 2
**************

A `plug-in for SublimeText 2 <https://github.com/toin0u/Sublime-atoum>`_ allows the execution of unit tests by atoum and the visualization of the result without leaving the editor.

The information necessary for it's installation and it's configuration are available `on the blog's author <http://sbin.dk/2012/05/19/atoum-sublime-text-2-plugin/>`_.

.. _ide_vim:

VIM
***

atoum comes with a plug-in facilitates its use in VIM.

It allows to run tests without leaving VIM and obtaining the report in a separate window.

It's possible to navigate among errors, or even to go to the line in the editor with an assertion from failed test with a simple combination of keys.


Installation of the plug-in atoum for VIM
=========================================

You will find the file corresponding to the plug-in, named ``atoum.vmb``, in the directory named ``resources/vim``.

If you are using the PHAR archive, you must extract the file with the following command:

.. code-block:: shell

   $ php mageekguy.atoum.phar --extractResourcesTo path/to/a/directory

Once the extraction is performed, the file ``atoum.vmb`` corresponding to the plug-in for VIM will stand in the directory ``path/to/a/directory/resources/vim``.

Once in possession of the ``atoum.vmb`` file, it's required to edit with VIM:

.. code-block:: shell

   $ vim path/to/atoum.vmb

It's now required to ask VIM the installation of the plug-in by using the command:

.. code-block:: vim

   :source %


Use of the plug-in atoum for VIM
================================

To use the plug-in, atoum must obviously be installed and you must be editing a file containing a class of unit tests based on atoum.

Once in this configuration, the following command will launch the execution of tests:

.. code-block:: vim

   :Atoum

The tests are executed, and once they are finished, a report based on the configuration of atoum file located in the directory ``ftplugin/php/atoum.vim`` in your ``.vim`` directory is generated in a new window.

Of course, you are free to bind this command to the combination of keys of your choice, for example adding the following line in your ``.vimrc`` file:

.. code-block:: vim

   nnoremap *.php <F12> :Atoum<CR>

The use of the key ``F12`` on your keyboard in normal mode will call the command ``:Atoum``.


File's configuration management of atoum
========================================

You can specify another configuration file for atoum by adding the following line to your ``.vimrc`` file:

.. code-block:: vim

   call atoum#defineConfiguration('/path/to/project/directory', '/path/to/atoum/configuration/file', '.php')

Indeed the function ``atoum#defineConfiguration`` allow to defined the configuration file to use, based on the directory where the unit test files are located.
It take three arguments:

* a path to the directory containing the unit tests;
* a path to the configuration's file of atoum to be used;
* the extension's file of relevant unit test.

For more details on the use of plug-in, help is available in VIM with the following command:

.. code-block:: vim

   :help atoum

.. _ide_phpstorm:

PhpStorm
********

atoum comes with an official plug-in for PHPStorm. It really helps you in your day-to-day development. The main functionality are:

* Go to the test class from the tested class (shortcut : alt+shift+K)
* Go to the tested class from the test class (shortcut : alt+shift+K)
* Execute tests inside PhpStorm (shortcut : alt+shift+M)
* Easily identify test files by a custom icon

Installation
============

It's easy to install, simply follow theses steps:

* Open PhpStorm
* Go to *File -> Settings*, then click on *Plugins*
* Click on Browse repositories
* Search for *atoum* in the list, then click on the install button
* Restart PhpStorm

If you need more information check the `repository of the plugins <https://github.com/atoum/phpstorm-plugin>`_.



.. _ide_atom:

Atom
****

atoum comes with an official package for atom. It helps you in several tasks :

* A panel with all tests
* Run all the tests, a directory or the current one

Installation
============

It's easy to install, simply follow the `official documentation <http://flight-manual.atom.io/using-atom/sections/atom-packages/>`_ or theses steps:

* Open atom
* Go to *Settings*, then click on *Install*
* Search for *atoum* in the list, then click on the install button

If you need more information check the `repository of the package <https://github.com/atoum/atom-plugin>`_.



.. _ide_auto-open-test:

Automatically open failed tests
*******************************

atoum is able to automatically open files from failed tests at the end of there execution. Several editors are currently supported:

* :ref:`macvim<ide_auto-open_macvim>` (Mac OS X)
* :ref:`gvim<ide_auto-open_gvim>` (Unix)
* :ref:`PhpStorm<ide_auto-open_phpstorm>` (Mac OS X/Unix)
* :ref:`gedit<ide_auto-open_gedit>` (Unix)

To use this feature, you need to change the :ref:`configuration file <fichier-de-configuration>`:

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

If you are under Mac OS X, use the following configuration:

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
       // If PhpStorm is installed in /Applications
       ->addField(new macos\phpstorm())

       // If you have installed PhpStorm
       // in another directory than /Applications
       // ->addField(
       //     new macos\phpstorm(
       //         '/path/to/PhpStorm.app/Contents/MacOS/webide'
       //     )
       // )
   ;

   $runner->addReport($cliReport);


Under Unix environment, use the following configuration:

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
           new unix\phpstorm('/path/to/PhpStorm/bin/phpstorm.sh')
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
