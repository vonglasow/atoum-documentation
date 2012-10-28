# Lancement des tests

## Exécutable

atoum dispose d'un exécutable qui vous permet de lancer vos tests en ligne de commande.

### Avec l'archive phar

Si vous utilisez l'archive phar, elle est elle-même l'exécutable.

#### linux / mac

    [bash]
    php path/to/mageekguy.atoum.phar

#### windows

    [bash]
    X:\Path\To\php.exe X:\Path\To\mageekguy.atoum.phar


### Avec les sources

Si vous utilisez les sources, l'exécutable se trouve dans path/to/atoum/bin.

#### linux / mac

    [bash]
    php path/to/bin/atoum

    # OU #

    ./path/to/bin/atoum

#### windows

    [bash]
    X:\Path\To\php.exe X:\Path\To\bin\atoum\bin


### Exemples dans le reste de la documentation

Dans les exemples suivants, les commandes pour lancer les tests avec atoum seront écrit avec la forme suivante:

    [bash]
    ./bin/atoum

C'est exactement la commande que vous pourriez utiliser si vous avez [installé atoum avec composer](#composer) sous Linux.



## Fichiers à exécuter

### Par fichiers

Pour lancer les tests d'un fichier, il vous suffit d'utiliser l'option -f ou --files.

    [bash]
    ./bin/atoum -f tests/units/MyTest.php


### Par répertoires

Pour lancer les tests d'un répertoire, il vous suffit d'utiliser l'option -d ou --directories.

    [bash]
    ./bin/atoum -d tests/units


## Filtres

Une fois que vous avez préciser à atoum [quels fichiers exécuter](#fichiers-a-executer), vous pouvez filtrer ce qui sera réellement exécuter.

### Par espace de nom

Pour filtrer sur l'espace de nom, c'est à dire n'exécuter que les tests d'un espace de nom donné,
il vous suffit d'utiliser l'option -ns ou --namespaces.

    [bash]
    ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

**Note**: il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.

### Une classe ou une méthode

Pour filtrer sur la classe ou une méthode, c'est à dire n'exécuter que les tests d'une classe ou d'une méthode donnée,
il vous suffit d'utiliser l'option -m ou --methods.

    [bash]
    ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

**Note**: il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le shell.

Vous pouvez remplacer le nom de la classe ou de la méthode par "*" pour signifier "tous".

Si vous remplacez le nom de la méthode par "*", cela revient à dire que vous filtrez par classe.

    [bash]
    ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

Si vous remplacez le nom de la class par "*", cela revient à dire que vous filtrez par méthode.

    [bash]
    ./bin/atoum -d tests/units -m *::testContains

### Tags

TODO https://github.com/mageekguy/atoum/wiki/Utiliser-les-tags

## Fichier de configuration

TODO

### Couverture du code

TODO https://github.com/mageekguy/atoum/wiki/G%C3%A9n%C3%A9rer-le-rapport-de-couverture-du-code-au-format-HTML

## Fichier de bootstrap

TODO https://github.com/mageekguy/atoum/wiki/Utiliser-un-fichier-de-%22bootstrap%22

## Option de la ligne de commande

TODO https://github.com/mageekguy/atoum/wiki/Le-mode-%22loop%22



Vous pouvez évidemment spécifier plusieurs valeurs par option:

    [bash]
    ./bin/atoum -f tests/units/MyFirstTest.php tests/units/MySecondTest.php


**Note**: vous ne devez mettre qu'une seule fois chaque option.
Dans le cas contraire, seul le dernier est pris en compte.

    [bash]
    # Ne test que MySecondTest.php
    ./bin/atoum -f MyFirstTest.php -f MySecondTest.php

    # Ne test que MyThirdTest.php et MyFourthTest.php
    ./bin/atoum -f MyFirstTest.php MySecondTest.php -f MyThirdTest.php MyFourthTest.php

## Sortie

TODO