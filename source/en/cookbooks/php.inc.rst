

.. _cookbook_optimiser_php:

Optimize PHP to run the tests as fast as possible
*****************************************************************

By default, atoum runs each test in a separate PHP process in order to guarantee the insulation. In addition, in order to optimize performance and exploit to the maximum, it does not perform each test in a sequential manner but at the same time. Finally, the code of Atum is more designed to run as fast as possible.

Grâce à tout cela, atoum est donc capable d'exécuter très rapidement un grand nombre de test. Cependant, en fonction du système d'exploitation, la création de chacun des sous-processus permettant l'isolation des tests peut être une opération longue et donc susceptible d'avoir un impact important sur les performances globale d'atoum. Il peut donc être très pertinent d'optimiser la taille du binaire PHP qui sera utilisé dans chaque processus afin d'exécuter encore plus rapidement les tests.

En effet, plus le binaire devant être utilisé dans un sous-processus est petit, plus la création du sous-processus correspondant s'effectue rapidement. Or, par défaut, le binaire PHP utilisé en ligne de commande embarque dans la plupart des cas un certain nombre de modules qui ne sont pas forcément utile à l'exécution des tests. Pour vous en convaincre, il vous suffit de récupérer la liste des modules intégrés à votre exécutable PHP à l'aide de la commande *php -m*. Vous constaterez alors certainement que la plupart d'entre eux sont totalement inutiles à la bonne exécution de vos tests. Et par ailleurs, qu'il est tout à fait possible de les désactiver lors de la compilation de PHP afin d'obtenir un binaire plus compact. Il y a cependant un prix à payer pour cela, puisqu'il faut alors obligatoirement compiler *PHP* manuellement. Il n'est cependant pas bien élevé, car la procédure pour cela est relativement simple.

Traditionnellement, une fois les sources du langage récupéré via `php.net <http://www.php.net/>`_, la compilation de PHP s'effectue de la manière suivante sous UNIX :

.. code-block:: shell

	# cd path/to/php/source
	# ./configure
	# make
	# make install

Note that the command *make install* must be executed as root to function properly. Vu que nous voulons une version sur mesure de PHP, il est nécessaire de modifier cette procédure au niveau de la commande *./configure*. C'est en effet cette commande qui permet de définir, entre autre chose, les modules qui seront intégrés à PHP lors de sa compilation, comme le prouve le résultat de la commande *./configure --help*.

Pour obtenir une version de PHP correspondant précisément à vos besoins, il faut donc commencer par demander la désactivation de l'ensemble des modules par défaut, via l'option *--disable-all*. Une fois cela effectué, il faut ajouter l'option *--enable-cli* pour obtenir uniquement à l'issue de la compilation uniquement le binaire PHP utilisable en ligne de commande. Il n'y a plus ensuite qu'à ajouter via les options * --enable-* * adéquate les modules nécessaires à l'exécution de vos tests, ainsi que les éventuelles options * --with-* * nécessaires à la compilation de ces modules. À titre d'exemple, la commande à utiliser pour compiler un binaire PHP en ligne de commande nécessaire et suffisant pour exécuter les tests unitaires de atoum sous Mac OS X est :

.. code-block:: shell

	# ./configure --disable-all --sysconfdir=/private/etc --enable-cli --with-config-file-path=/etc --with-libxml-dir=/usr  --with-pcre-regex --enable-phar --enable-hash --enable-json --enable-libxml --enable-session --enable-tokenizer --enable-posix --enable-dom


Il est à noter que si vous souhaiter installer votre binaire PHP à un endroit précis pour ne pas remplacer celui déjà installé au niveau de votre système d'exploitation, vous pouvez utiliser l'option *--prefix=path/to/destination/directory*, comme indiqué dans l'aide de *./configure*, disponible via l'option *--help*. Vous pourrez ensuite l'utiliser pour exécuter vos tests via l'argument *-p* de atoum.

Once the command *. / configure * executed with the appropriate options, there just need to continue with the installation of PHP in the traditional way:

.. code-block:: shell

	# make
	# make install


Once this done, you only have to run your tests to see the difference in terms of execution speed. For information purposes, under Mac OS X lion on a MacBook Air 2012, using the procedure described above, it's possible to switch from 21 MB PHP binary to a 4.7 MB PHP binary which allows to pass the execution time of all the atoum unit tests of 34 seconds to 17 seconds, a 50% gain:

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


In case of problems or doubt, just feel free to consult the`official documentation  <http://php.net/manual/en/faq.build.php>`_ on the compilation of PHP.
