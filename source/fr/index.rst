.. Documentation reST http://rest-sphinx-memo.readthedocs.org/en/latest/ReST.html
   Dans reST, les headers doivent être soulignées par =*-^"~`:.'# et l'ordre n'a pas d'importance.
   Néanmoins, dans la doc atoum, voici l'ordre retenu: #, *, =, -, ", ^, `, :, ., '
   Si vous avez plus de 4 niveaux, penser à découper votre fichier en plusieurs fichiers.

Qu'est-ce qu'atoum ?
====================

atoum est un framework de test unitaire, tout comme PHPUnit ou SimpleTest, mais il présente quelques avantages par rapport à ces derniers :

* il est moderne et utilise les innovations des dernières versions de PHP (>= 5.3) ;
* il est simple et facile à maitriser ;
* il est intuitif, sa syntaxe se veut la plus proche du langage naturel anglais ;
* malgré les évolutions constantes d'atoum, la rétrocompatibilité est une des priorités de ses développeurs.

.. toctree::
   :maxdepth: 2

   demarrage
   ide
   lancement_des_tests
   option_cli
   aide_ecriture
   assertions
   cookbook
   participer
   citations
