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

Dans les exemples suivants, les commandes pour lancer les tests avec atoum seront écrit avec la
forme suivante:

    [bash]
    ./bin/atoum

C'est exactement la commande que vous pourriez utiliser si vous avez
[installé atoum avec composer](#composer) sous Linux.



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

Une fois que vous avez préciser à atoum [quels fichiers exécuter](#fichiers-a-executer), vous pouvez
filtrer ce qui sera réellement exécuter.

### Par espace de nom

Pour filtrer sur l'espace de nom, c'est à dire n'exécuter que les tests d'un espace de nom donné,
il vous suffit d'utiliser l'option -ns ou --namespaces.

    [bash]
    ./bin/atoum -d tests/units -ns mageekguy\\atoum\\tests\\units\\asserters

**Note**: il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le
shell.

### Une classe ou une méthode

Pour filtrer sur la classe ou une méthode, c'est à dire n'exécuter que les tests d'une classe ou
d'une méthode donnée, il vous suffit d'utiliser l'option -m ou --methods.

    [bash]
    ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::testContains

**Note**: il est important de doubler chaque backslash pour éviter qu'ils soient interprétés par le
shell.

Vous pouvez remplacer le nom de la classe ou de la méthode par "*" pour signifier "tous".

Si vous remplacez le nom de la méthode par "*", cela revient à dire que vous filtrez par classe.

    [bash]
    ./bin/atoum -d tests/units -m mageekguy\\atoum\\tests\\units\\asserters\\string::*

Si vous remplacez le nom de la class par "*", cela revient à dire que vous filtrez par méthode.

    [bash]
    ./bin/atoum -d tests/units -m *::testContains

### Tags

Tout comme de nombreux outils dont [Behat](http://behat.org), atoum vous permet de tagger vos tests
unitaires et de n'exécuter que ceux ayant un ou plusieurs tags spécifiques.

Pour cela, il faut commencer par définir un ou plusieurs tags pour une ou plusieurs classes de tests
unitaires.

Cela se fait très simplement grâce aux annotations et à la balise @tags:

    [php]
    <?php

    namespace vendor\project\tests\units;

    require_once __DIR__ . '/mageekguy.atoum.phar';

    use mageekguy\atoum;

    /**
     * @tags thisIsOneTag thisIsTwoTag thisIsThreeTag
     */
    class foo extends atoum\test
    {
        public function testBar()
        {
            ...
        }
    }

De la même manière, il est également possible de tagger les méthodes de test.

*Note**: les tags définis au niveau d'une méthode prennent le pas sur ceux définis au niveau de la
classe.

    [php]
    <?php

    namespace vendor\project\tests\units;

    require_once __DIR__ . '/mageekguy.atoum.phar';

    use mageekguy\atoum;

    class foo extends atoum\test
    {
        /**
         * @tags thisIsOneMethodTag thisIsTwoMethodTag thisIsThreeMethodTag
         */
        public function testBar()
        {
            ...
        }
    }

Une fois les tags nécessaires définis, il n'y a plus qu'à exécuter les tests avec le ou les tags
adéquates à l'aide de l'option --tags, ou -t dans sa version courte:

    [shell]
    ./bin/atoum -d tests/units -t thisIsOneTag

Attention, cette instruction n'a de sens que s'il y a une ou plusieurs classes de tests unitaires et
qu'au moins l'une d'entres elles porte le tag spécifié. Dans le cas contraire, aucun test ne sera
exécuté.

Il est possible de définir plusieurs tags:

    [shell]
    ./bin/atoum -d tests/units -t thisIsOneTag thisIsThreeTag

Dans ce dernier cas, les classes de tests ayant été taggés soit avec thisIsOneTag, soit avec
thisIsThreeTag, seront les seules à être exécutées.

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