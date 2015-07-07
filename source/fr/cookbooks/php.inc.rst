

.. _cookbook_optimiser_php:

Optimiser PHP pour exécuter les tests le plus rapidement possible
*****************************************************************

Par défaut, le :ref:`moteur d'exécution <@engine>` d'atoum lance chaque test dans un processus PHP séparé afin d'en garantir l'isolation. De plus, afin d'optimiser les performances, il n'exécute pas chaque test de manière séquentielle, mais en parallèle. Par ailleurs, atoum est conçu de façon à s'exécuter le plus rapidement possible.

Grâce à tout cela, atoum est donc capable d'exécuter très rapidement un grand nombre de tests. Cependant, en fonction du système d'exploitation, la création de chacun des sous-processus permettant l'isolation des tests peut être une opération longue et donc susceptible d'avoir un impact important sur les performances globales d'atoum. Il peut donc être très pertinent d'optimiser la taille du binaire PHP qui sera utilisé dans chaque processus afin d'exécuter encore plus rapidement les tests.

En effet, plus le binaire devant être utilisé dans un sous-processus est petit, plus la création du sous-processus correspondant s'effectue rapidement. Or, par défaut, le binaire PHP utilisé en ligne de commande embarque dans la plupart des cas un certain nombre de modules qui ne sont pas forcément utile à l'exécution des tests. Pour vous en convaincre, il vous suffit de récupérer la liste des modules intégrés à votre exécutable PHP à l'aide de la commande *php -m*. Vous constaterez alors certainement que la plupart d'entre eux sont totalement inutiles à la bonne exécution de vos tests. Et par ailleurs, qu'il est tout à fait possible de les désactiver lors de la compilation de PHP afin d'obtenir un binaire plus compact. Il y a cependant un prix à payer pour cela, puisqu'il faut alors obligatoirement compiler *PHP* manuellement. Il n'est cependant pas bien élevé, car la procédure pour cela est relativement simple.

Traditionnellement, une fois les sources du langage récupéré via `php.net <http://www.php.net/>`_, la compilation de PHP s'effectue de la manière suivante sous UNIX :

.. code-block:: shell

	# cd path/to/php/source
	# ./configure
	# make
	# make install

Il est à noter que la commande *make install* doit être exécutée en tant que super-administrateur pour fonctionner correctement. Vu que nous voulons une version sur mesure de PHP, il est nécessaire de modifier cette procédure au niveau de la commande *./configure*. C'est en effet cette commande qui permet de définir, entre autres choses, les modules qui seront intégrés à PHP lors de sa compilation, comme le prouve le résultat de la commande *./configure --help*.

Pour obtenir une version de PHP correspondant précisément à vos besoins, il faut donc commencer par demander la désactivation de l'ensemble des modules par défaut, via l'option *--disable-all*. Une fois cela effectué, il faut ajouter l'option *--enable-cli* pour obtenir uniquement à l'issue de la compilation uniquement le binaire PHP utilisable en ligne de commande. Il n'y a plus ensuite qu'à ajouter via les options * --enable-* * adéquates les modules nécessaires à l'exécution de vos tests, ainsi que les éventuelles options * --with-* * nécessaires à la compilation de ces modules. À titre d'exemple, la commande à utiliser pour compiler un binaire PHP en ligne de commande nécessaire et suffisant pour exécuter les tests unitaires de atoum sous Mac OS X est :

.. code-block:: shell

	# ./configure --disable-all --sysconfdir=/private/etc --enable-cli --with-config-file-path=/etc --with-libxml-dir=/usr  --with-pcre-regex --enable-phar --enable-hash --enable-json --enable-libxml --enable-session --enable-tokenizer --enable-posix --enable-dom


Il est à noter que si vous souhaiter installer votre binaire PHP à un endroit précis pour ne pas remplacer celui déjà installé au niveau de votre système d'exploitation, vous pouvez utiliser l'option *--prefix=path/to/destination/directory*, comme indiqué dans l'aide de *./configure*, disponible via l'option *--help*. Vous pourrez ensuite l'utiliser pour exécuter vos tests via l'argument *-p* de atoum.

Une fois la commande *./configure* exécutée avec les options adéquates, il n'y a plus qu'à poursuivre l'installation de PHP de manière traditionnelle :

.. code-block:: shell

	# make
	# make install


Une fois cela effectué, vous n'aurez plus qu'à exécuter vos tests pour constater la différence en terme de vitesse d'exécution. À titre d'information, sous Mac OS X lion sur un MacBook Air 2012, grâce à la procédure décrite ci-dessus, il est possible de passer d'un binaire PHP de 21 Mo à un binaire PHP de 4.7 Mo, ce qui permet de passer le temps d'exécution de l'ensemble des tests unitaires d’atoum de 34 secondes à 17 secondes, soit un gain de 50% :

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


En cas de problèmes ou simplement de doutes, n'hésitez pas à consulter la `documentation officielle <http://php.net/manual/fr/faq.build.php>`_ sur la compilation.
