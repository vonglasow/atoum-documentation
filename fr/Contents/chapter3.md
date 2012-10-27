# Lancement des tests

## Exécutable

atoum dispose d'un exécutable qui vous permet de lancer vos tests en ligne de commande.

### Avec l'archive phar

Si vous utilisez l'archive phar, elle est elle-même l'exécutable.

#### linux

    [bash]
    php path/to/mageekguy.atoum.phar

#### windows

    [bash]
    X:\Path\To\php.exe X:\Path\To\mageekguy.atoum.phar


### Avec les sources

Si vous utilisez les sources, l'exécutable se trouve dans path/to/atoum/bin.

#### linux

    [bash]
    php path/to/bin/atoum

    # OU #

    ./path/to/bin/toum

#### windows

    [bash]
    X:\Path\To\php.exe X:\Path\To\bin\atoum\bin


### Exemples dans le reste de la documentation

Les exemples suivants contenant des commandes pour lancer les tests avec atoum seront écrit avec la forme suivante:

    [bash]
    ./bin/atoum

C'est exactement la commande que vous pourriez utiliser si vous avez [installé atoum avec composer](#composer) sous Linux.



## Fichiers à exécuter

### Par fichiers

Pour lancer les tests d'un fichier, il vous suffit d'utiliser l'option -f ou --files.

    [bash]
    ./bin/atoum -f tests/units/MyTest.php

Vous pouvez évidemment spécifier plusieurs fichiers:

    [bash]
    ./bin/atoum -f tests/units/MyFirstTest.php tests/units/MySecondTest.php

**Note**: vous ne devez mettre qu'une seule fois l'option -f.
Dans le cas contraire, seul le dernier est pris en compte.

    [bash]
    # Ne test que MySecondTest.php
    ./bin/atoum -f MyFirstTest.php -f MySecondTest.php

    # Ne test que MyThirdTest.php et MyFourthTest.php
    ./bin/atoum -f MyFirstTest.php MySecondTest.php -f MyThirdTest.php MyFourthTest.php


### Par répertoires

Pour lancer les tests d'un répertoire, il vous suffit d'utiliser l'option -d ou --directories.

    [bash]
    ./bin/atoum -d tests/units

Vous pouvez évidemment spécifier plusieurs répertoires:

    [bash]
    ./bin/atoum -d tests/units/First tests/units/Second

**Note**: vous ne devez mettre qu'une seule fois l'option -d.
Dans le cas contraire, seul le dernier est pris en compte.

    [bash]
    # Ne test que le répertoire Second
    ./bin/atoum -d First -d Second

    # Ne test que les répertoires Third et Fourth
    ./bin/atoum -d First Second -d Third Fourth


## Filtres

Une fois que vous avez préciser à atoum [quels fichiers exécuter](#fichiers-a-executer), vous pouvez filtrer ce qui sera réellement exécuter.

### Par namespaces

Pour filtrer sur le namespace, il vous suffit d'utiliser l'option -ns ou --namespaces.

    [bash]
    ./bin/atoum -d tests/units -ns mageekguy, please help me !

### Une classe
### Une méthode
### Tags

https://github.com/mageekguy/atoum/wiki/Utiliser-les-tags

## Fichier de configuration
### Couverture du code

https://github.com/mageekguy/atoum/wiki/G%C3%A9n%C3%A9rer-le-rapport-de-couverture-du-code-au-format-HTML

## Fichier de bootstrap

https://github.com/mageekguy/atoum/wiki/Utiliser-un-fichier-de-%22bootstrap%22

## Option de la ligne de commande

https://github.com/mageekguy/atoum/wiki/Le-mode-%22loop%22

## Sortie