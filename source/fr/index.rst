.. Documentation reST http://rest-sphinx-memo.readthedocs.org/en/latest/ReST.html
   Dans reST, les headers doivent être soulignées par =*-^"~`:.'# et l'ordre n'a pas d'importance.
   Néanmoins, dans la doc atoum, voici l'ordre retenu: #, *, =, -, ", ^, `, :, ., '
   Si vous avez plus de 4 niveaux, penser à découper votre fichier en plusieurs fichiers.

.. _home:

Qu'est-ce qu'atoum?
================

atoum est un framework de test unitaire, tout comme PHPUnit ou SimpleTest, mais il présente quelques avantages par rapport à ces derniers :

* Moderne, utilisant les innovations des dernières versions de PHP ;
* il est simple et facile à maîtriser;
* il est intuitif, sa syntaxe se veut la plus proche du langage naturel anglais;
* malgré les évolutions constantes d'atoum, la rétrocompatibilité est une des priorités de ses développeurs.

Vous pouvez trouver plus d'information sur le `site officiel <http://atoum.org/>`_.

.. toctree::
   :numbered:
   :maxdepth: 2

   start_with_atoum
   installation
   first_test
   lancement_des_tests
   how_to_write_test_cases
   assertions
   mocking_systems
   engine
   mode-loop
   mode-debug
   fine_tuning
   configuration_bootstraping
   annotations
   option_cli
   cookbook
   extensions
   ide
   participer
   licences
