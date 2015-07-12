

.. _cookbook_optimiser_php:

Optimize PHP to run the tests as fast as possible
*****************************************************************

By default, the :ref:`engine execution <@engine>` of atoum launch each test in a separate PHP process to ensure the insulation. In addition, to maximize performance, it doesn't perform each test sequentially, but in parallel. Furthermore, atoum is designed to run as fast as possible.

Through all of this, atoum is therefore able to execute very quickly large numbers of tests. However, depending on the operating system, the creation of each of the sub-processes that permit insulation of the tests can be a long operation and therefore likely to have a significant impact on the overall performance of atoum. So, it can be very relevant to optimize the size of the binary PHP that will be used in each process to run even faster tests.

Indeed, more the binary to be used in a subprocess is small, more the creation of the corresponding sub-process occurs quickly. However, by default, the binary PHP command line embarks on most cases a number of modules that are not necessarily useful to run the tests. To convince you, simply retrieve the list of modules into your PHP executable with the command *php -m*. Then you will definitely notice that most of them are completely unnecessary to the proper execution of your tests. And moreover, that it's possible to turn them off when PHP is compiled in order to obtain a more compact binary. But there is a price to pay for it, since you then must compile *PHP* manually. it's however not too expensive, because the procedure for this is relatively simple.

Traditionally, once sources of language retrieved via `php.net <http://www.php.net/>`_ compiling PHP is done as follows under UNIX:

.. code-block:: shell

	# cd path/to/php/source
	# ./configure
	# make
	# make install

Note that the command *make install* must be executed as root to function properly. Vu que nous voulons une version sur mesure de PHP, il est nécessaire de modifier cette procédure au niveau de la commande *./configure*. C'est en effet cette commande qui permet de définir, entre autres choses, les modules qui seront intégrés à PHP lors de sa compilation, comme le prouve le résultat de la commande *./configure --help*.

Pour obtenir une version de PHP correspondant précisément à vos besoins, il faut donc commencer par demander la désactivation de l'ensemble des modules par défaut, via l'option *--disable-all*. Une fois cela effectué, il faut ajouter l'option *--enable-cli* pour obtenir uniquement, à l'issue de la compilation, le binaire PHP utilisable en ligne de commande. Il n'y a plus ensuite qu'à ajouter via les options * --enable-* * adéquates les modules nécessaires à l'exécution de vos tests, ainsi que les éventuelles options * --with-* * nécessaires à la compilation de ces modules. À titre d'exemple, la commande à utiliser pour compiler un binaire PHP en ligne de commande nécessaire et suffisant pour exécuter les tests unitaires de atoum sous Mac OS X est :

.. code-block:: shell

	# ./configure --disable-all --sysconfdir=/private/etc --enable-cli --with-config-file-path=/etc --with-libxml-dir=/usr  --with-pcre-regex --enable-phar --enable-hash --enable-json --enable-libxml --enable-session --enable-tokenizer --enable-posix --enable-dom


Noted that if you wish to install your PHP binary to a specific location to avoid replacing the one already installed at the level of your operating system, you can use the option *-prefix = path/to/destination/directory*, as shown in the help of *./configure*, available via the option *-help*. You can then use it to run your tests via the argument *-p* of atoum.

Once the command *./configure* executed with the appropriate options, there just need to continue with the installation of PHP in the traditional way:

.. code-block:: shell

	# make
	# make install


Once this done, you only have to run your tests to see the difference in terms of execution speed. For information purposes, under Mac OS X Lion on a MacBook Air 2012, using the procedure described above, it's possible to switch from 21 MB PHP binary to a 4.7 MB PHP binary which allows to pass the execution time of all the atoum unit tests of 34 seconds to 17 seconds, a 50% gain :

.. code-block:: shell

	# ls sapi/cli/php
	-rwxr-xr-x  1 fch  staff   4,7M 24 jul 21:46 sapi/cli/php
	# php scripts/runner.php --test-it -ncc
	> PHP path: /usr/local/bin/php
	> PHP version:
	=> PHP 5.4.5 (cli) (built: Jul 24 2012 21:39:33)
	=> Copyright (c) 1997-2012 The PHP Group
	=> Zend Engine v2.4.0, Copyright (c) 1998-2012 Zend Technologies
	> Total tests duration: 13.44 seconds.
	> Total tests memory usage: 258.75 Mb.
	> Running duration: 16.94 seconds.
	Success (144 tests, 1048/1048 methods, 16655 assertions, 0 error, 0 exception) !


In case of problems or doubt, just feel free to consult the`official documentation  <http://php.net/manual/en/faq.build.php>`__ on the compilation of PHP.
