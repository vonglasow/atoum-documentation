.. _introduction-anchor:

Introduction
============

.. _what-is-atoum:

What is atoum ?
---------------


atoum is a unit test framework, like PHPUnit or SimpleTest. Though, we believe it has an edge on its counterparts thanks to :

* Its more modern approach and its use of PHP's latest features.
* Its simplicity and fast learning curve.
* Its fluent interface, making the tests as readable as the english natural langage


.. _download---install:

Download & Install
------------------

As of today, atoum doesn't have any version number. However, it is both usable and stable. If you're willing to use it, 
download the latest stable build. Even though atoum continuously benefits from new features, backward compatibility is one 
of the main priority of the developers. 

There are several ways to install atoum :

* :ref:`As a PHAR archive <p-h-a-r>`
* :ref:`Using composer <composer-anchor>`
* :ref:`Using an install script <installer-anchor>`
* :ref:`Cloning the github repository <github-anchor>`
* :ref:`Using a Symfony2 Bundle <symfony2-bundle>`.
* :ref:`Using a Zend Framework 2 component <zend-framework-2-component>`


.. _p-h-a-r:

PHAR
~~~~

A PHAR (PHp ARchive) is automatically built along each atoum's source code update.

PHAR is an archive format for PHP applications, available since PHP 5.3. 

.. _installation-anchor:

Installation
^^^^^^^^^^^^

You can download the latest stable version of atoum from the official website : `http://downloads.atoum.org/nightly/mageekguy.atoum.phar <http://downloads.atoum.org/nightly/mageekguy.atoum.phar>`_

.. _updating-anchor:

Updating
^^^^^^^^

Updating atoum's PHAR is a cinch thanks to its command line tools :

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar --update

.. note::
   The atoum's update process needs to alter the PHAR file. 
   By default, PHP comes with this feature disabled, hence the ``-d phar.readonly=0`` argument.

If a new version exists it will be downloaded and installed in the archive itself :

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   Update to version 'nightly-1568-201210311708'... Done !
   Enable version 'nightly-1568-201210311708'... Done !
   Atoum has been updated from version 'old-version' to 'nightly-1568-201210311708' successfully !

If there are no new versions available, atoum stops and nothing happens.

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar --update
   Checking if a new version is available... Done !
   There is no new version available !

atoum won't ask any confirmation before proceeding with the update as you can easily go back to a previous version.

.. _listing-available-versions-present-in-atoum-s-archive:

Listing available versions from the atoum's archive
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To show the list of versions contained in the archive, use the ``--list-available-versions`` (or the shorter ``-lav``) argument.

.. code-block:: shell

   php mageekguy.atoum.phar -lavnightly-941-201201011548
   
   * nightly-1568-201210311708

Available versions will be shown, the current active one being prefixed with ``*``.

.. _updating-the-current-version:

Choosing the current version
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set the active version of atoum, use the ``--enable-version`` (or the shorter ``-ev``) argument followed by the name of the version you want to use by default.

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar -ev DEVELOPMENT

.. note::
   Setting the active version of atoum needs PHP to be able to alter the PHAR file. 
   By default, PHP comes with this feature disabled, hence the ``-d phar.readonly=0`` argument.
   
.. _removing-older-versions:

Deleting older versions
^^^^^^^^^^^^^^^^^^^^^^^

Over time, the archive may contain several unused atoum's versions.

To delete a sepecific version of atoum, use the --delete-version (or shorter -dv) argument followed by the name of the version you want to delete.

.. code-block:: shell

   php -d phar.readonly=0 mageekguy.atoum.phar -dv nightly-941-201201011548

The version has now been removed.

.. note::
   You cannot remove the currently active version.

.. note::
   
   To delete a version from the archive, PHP needs to alter the PHAR file. 
   By default, PHP comes with this feature disabled, hence the ``-d phar.readonly=0`` argument.

.. _composer-anchor:

Composer
~~~~~~~~

`Composer <http://getcomposer.org/>`_ is a tool for dependency management in PHP.

Start by downloading and installing Composer

.. code-block:: shell

   curl -s https://getcomposer.org/installer | php

Then, create a composer.json file at the root of your project, containing the following text

.. code-block:: json

   {
       "require": {
           "atoum/atoum": "dev-master"
       }
   }

Finally execute :

.. code-block:: shell

   php composer.phar install

.. _installer-anchor:

Installer
~~~~~~~~~

You will also be able to install atoum using its dedicated `script <https://github.com/atoum/atoum-installer>`_:

.. code-block:: shell

   curl https://raw.github.com/atoum/atoum-installer/master/installer | php -- --phar
   php mageekguy.atoum.phar -v
   atoum version nightly-xxxx-yyyymmddhhmm by Frédéric Hardy (phar:///path/to/mageekguy.atoum.phar)

This script lets you install atoum locally (in a project, see the previous example) or system-wide :

.. code-block:: shell

   curl https://raw.github.com/atoum/atoum-installer/master/installer | sudo php -- --phar --global
   which atoum
   /usr/local/bin/atoum

Options are available for you to you to customize your installation of atoum : see the `documentation <https://github.com/atoum/atoum-installer/blob/master/README.md>`_ for details.

.. _github-anchor:

Github
~~~~~~

If you want to use atoum directly from its sources, you can clone or fork its git repository on github : git://github.com/atoum/atoum.git

.. _symfony-1-plugin:

Symfony 1 plugin
~~~~~~~~~~~~~~~~

If you want to use atoum in a Symfony 1 project, you can use the `sfAtoumPlugin plugin <https://github.com/atoum/sfAtoumPlugin>`_

Installation instructions along with usage examples are available in the cookbook and its website.

.. _symfony2-bundle:

Symfony2 bundle
~~~~~~~~~~~~~~~

If you want to use atoum in a Symfony2 project, a bundle is available at `<https://github.com/atoum/AtoumBundle>`_.

Installation and usage instructions are available on the project's page.

.. _zend-framework-2-component:

Zend Framework 2 component
~~~~~~~~~~~~~~~~~~~~~~~~~~

If you want to use atoum in a Zend Framework 2 project, a component is available at `https://github.com/blanchonvincent/zend-framework-test-atoum <https://github.com/blanchonvincent/zend-framework-test-atoum>`_.

Installation and usage instructions are available on the project's home page.

.. _a-quick-overview-of-atoum-s-philosophy:

A quick overview of atoum's philosophy
--------------------------------------

.. _very-basic-example:

Basic example
~~~~~~~~~~~~~~~~~~

You have to write a test class per class.

So if you want to test the infamous HelloWorld class, you have to write the test\units\HelloWorld test class.

NOTE : atoum takes namespaces into account. If you want to test the Vendor\Project\HelloWorld class, you have to write the \Vendor\Project\tests\units\HelloWorld class.

Following is the code of your HelloWorld class we're going to test.

.. code-block:: php

   <?php
   # src/Vendor/Project/HelloWorld.php
   
   namespace Vendor\Project;
   
   class HelloWorld
   {
       public function getHiAtoum ()
       {
           return "Hi atoum !";
       }
   }

Now, here is a sample of what the test class code could look like :

.. code-block:: php

   <?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // The test class has its own namespace :
   // [tested class namespace] + "tests\units"
   namespace Vendor\Project\tests\units;

   // You must include the tested class
   require_once __DIR__ . '/../../HelloWorld.php';

   use \atoum;

   /*
    * Test class for \HelloWorld

    * Notice that it has the same name as the tested class
    * and that it extends the atoum class 
    */
   class HelloWorld extends atoum
   {
       /*
        * This method tests getHiAtoum()
        */
       public function testGetHiAtoum ()
       {
           // instantiation of new tested class
           $helloToTest = new \Vendor\Project\HelloWorld();

           $this
               // we assert that the getHiAtoum method returns a String
               ->string($helloToTest->getHiAtoum())
                   // ... et we expect the String to be 'Hi atoum !'
                   ->isEqualTo('Hi atoum !')
           ;
       }
   }

Now, let's launch the tests suite.
You whould see something like :

.. code-block:: shell

   php -f ./test/HelloTheWorld.php

You will see something like this

.. code-block:: shell

   .. code-block:: shell

   $ php vendor/mageekguy.atoum.phar -f src/Vendor/Project/tests/units/HelloWorld.php
   > PHP path: /usr/bin/php
   > PHP version:
   > PHP 5.4.7 (cli) (built : Sep 13 2012 04:24:47)
   > Copyright (c) 1997-2012 The PHP Group
   > Zend Engine v2.4.0, Copyright (c) 1998-2012 Zend Technologies
   >     with Xdebug v2.2.1, Copyright (c) 2002-2012, by Derick Rethans
   > Vendor\Project\tests\units\HelloWorld...
   [S___________________________________________________________][1/1]
   > Test duration : 0.02 second.
   > Memory usage : 0.00 Mb.
   > Total test duration: 0.02 second.
   > Total test memory usage: 0.00 Mb.
   > Code coverage value: 100.00%
   > Running duration: 0.34 second.
   Success (1 test, 1/1 method, 2 assertions, 0 error, 0 exception) !

We've just tested that the getHiAtoum method :

* returns a string;
* ... that  is equal to 'Hi atoum !'.

All tests have passed. There you are, your code is rock solid thanks to atoum !

.. _rule-of-thumb:

Rule of Thumb
~~~~~~~~~~~~~
When you want to test a value you have to : 

* indicate the type of this value (integer, float, array, string, …)
* indicate what you are expecting the value to be (equal to, null, containing a substring, ...).

.. _using-atoum-with-your-favorite-i-d-e:

Using atoum with your favorite IDE
----------------------------------

.. _sublime-text-2:

Sublime Text 2
~~~~~~~~~~~~~~

A `SublimeText 2 plugin <https://github.com/toin0u/Sublime-atoum>`_ enables you to launch tests and see their results from within the editor.

Installation instructions are available at `its author's blog <http://sbin.dk/2012/05/19/atoum-sublime-text-2-plugin/>`_.

.. _v-i-m:

VIM
~~~

atoum is bundled with a VIM plugin.

It enables you to launch tests suites without leaving the editor and shows you the tests report in the editor's screen.

You can then navigate through errors and go straight to the line where assertions have failed using a key stroke.

.. _installing-the-v-i-m-plugin:

Installing the VIM plugin
~~~~~~~~~~~~~~~~~~~~~~~~~

If you're not using the PHAR archive, you'll find the plugin in resources/vim/atoum.vba.

If you're using the PHAR archive, you can ask atoum to extract the file with the command line

.. code-block:: shell

   php mageekguy.atoum.phar --extractResourcesTo path/to/a/directory

Once you have the atoum.vba file, use VIM to edit its content

.. code-block:: shell

   vim path/to/atoum.vba

And ask VIM to install the plugin with

.. code-block:: vim

   :source %

.. _using-atoum-and-v-i-m:

Using atoum and VIM
~~~~~~~~~~~~~~~~~~~

Of course, to work properly, the plugin needs to be correctly installed, and you're supposed to be editing a test case based on atoum.

The following command line asks for tests execution:

.. code-block:: vim

   :Atoum

Tests are launched and a report, based on your atoum configuration in ftplugin/php/atoum.vim of your .vim directory, is generated in a new screen.

Feel free to link this command with a shortcut of your own. i.e. adding the following line to your .vimrc file :

.. code-block:: vim

   nnoremap *.php :Atoum

The F12 function key will now trigger the :Atoum command.

.. _managing-atoum-s-configuration-file:

Managing atoum's configuration file
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can specify another configuration file by adding the following line to your .vimrc file:

.. code-block:: vim

   call atoum#defineConfiguration('/path/to/project/directory', '/path/to/atoum/configuration/file', '.php')

The atoum#defineConfiguration function enables you to define the configuration file to use based on your unit test directory.
it takes 3 arguments :

* The path to the unit tests directory
* The path to the atoum's configuration file to be considered
* The extension of the unit test files that will be concerned

If you want to know more about the plugin, you can use the embedded help in VIM thanks to the following command :

.. code-block:: vim

   :help atoum

Automatically open failing tests
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
atoum is able to automatically open failing tests after suite has run. Here are the supported editors:

* :ref:`macvim <macvim-anchor>` (Mac OS X)
* :ref:`gvim <gvim-anchor>` (Unix)
* :ref:`PhpStorm <php-storm>` (Mac OS X/Unix)
* :ref:`gedit <gedit-anchor>` (Unix)

To use this feature you will have to edit your `configuration file <chapter3.html#configuration-files>`_:

macvim
^^^^^^

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
^^^^

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
^^^^^^^^

If you are on Mac OS X, use the following configuration:

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
       // If PhpStorm is installed in in /Applications
       ->addField(new macos\phpstorm())

       // If PhpStorm is installed anywhere else
       // ->addField(
       //     new macos\phpstorm(
       //         '/path/to/PhpStorm.app/Contents/MacOS/webide'
       //     )
       // )
   ;

   $runner->addReport($cliReport);


On Unix, use the following configuration:

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
^^^^^

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
