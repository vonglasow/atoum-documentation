# Introduction

## Qu'est-ce que atoum ?

atoum est un framework de test unitaire, tout comme PHPUnit ou SimpleTest, mais :

* il est moderne et utilise les innovations des dernières versions de PHP ;
* il est simple et facile à maitriser ;
* il est intuitif, sa syntaxe se veut la plus proche du language naturel anglais.


## Téléchargement et installation

Pour le moment, atoum n'a pas de version finale. Il est néanmoins d'ores et déjà stable et utilisable.
Si vous souhaitez utiliser atoum, il vous suffit de télécharger la dernière version.
Malgré les évolutions constantes d'atoum, la rétro-compatibilité est une des priorités des développeurs.

Vous pouvez installer atoum de 5 manières :

* [en téléchargeant une archive PHAR](#archive-phar) ;
* [en utilisant composer](#composer) ;
* [en clonant le dépôt github](#github) ;
* [en utilisant un plugin symfony 1](#plugin-symfony-1) ;
* [en utilisant un bundle symfony 2](#bundle-symfony-2).


### Archive PHAR

Une archive PHAR est créée automatiquement à chaque modification d'atoum. PHAR (**PH**P **Ar**chive) est un format d'archive d'application PHP, disponible depuis PHP 5.3.

Vous pouvez télécharger la dernière version stable d'atoum directement depuis le site officiel : [http://downloads.atoum.org/nightly/mageekguy.atoum.phar](http://downloads.atoum.org/nightly/mageekguy.atoum.phar)


### Composer

[Composer](http://getcomposer.org) est un outil de gestion de dépendance en PHP.

Commencer par installer composer

    [shell]
    curl -s https://getcomposer.org/installer | php

Créez, ensuite, un fichier composer.json contenant le JSON suivant : 

    [json]
    {
        "require": {
            "mageekguy/atoum": "dev-master"
        }
    }

Enfin, exécutez la commande suivante :

    [shell]
    php composer.phar install


### Github

Si vous souhaitez utiliser atoum directement depuis ses sources, vous pouvez cloner ou forker le dépôt github :
[git://github.com/mageekguy/atoum.git](git://github.com/mageekguy/atoum.git)


### Plugin symfony 1

Si vous souhaitez utiliser atoum au sein d'un projet symfony 1, un plugin existe et est disponible à l'adresse suivante :
[https://github.com/agallou/sfAtoumPlugin](https://github.com/agallou/sfAtoumPlugin).
Toutes les instructions pour l'installation et l'utilisation d'atoum sont expliquées sur cette page.


### Bundle symfony 2

Si vous souhaitez utiliser atoum au sein d'un projet symfony 2, un bundle existe et est disponible à l'adresse suivante :
[https://github.com/FlorianLB/JediAtoumBundle](https://github.com/FlorianLB/JediAtoumBundle).
Toutes les instructions pour l'installation et l'utilisation d'atoum sont expliquées sur cette page.


## La philosophie d'atoum

### Exemple simple

Vous devez écrire une classe de test pour chaque classe à tester.

Imaginez que nous vouliez tester la traditionnelle classe HelloWorld, alors vous devez créer la classe de test test\units\HelloWorld.

**NOTE** : atoum utilise les espaces de noms. Par exemple, pour tester la classe \Vendor\Application\HelloWorld,
vous devez créer la classe \Vendor\Application\tests\units\HelloWorld.

Voici le code de la classe HelloWorld que nous allons tester.

    [php]
    <?php
    # src/Vendor/Application/HelloWorld.php

    namespace Vendor\Application;

    class HelloWorld
    {
        public function getHiAtoum ()
        {
            return 'Hi atoum !';
        }
    }

Maintenant, voici le code de la classe de test que nous pourrions écrire.

    [php]
    <?php
    # src/Vendor/Application/tests/units/HelloWorld.php

    // La classe de test à son propre namespace :
    // Le namespace de la classe à tester + "tests\units"
    namespace Vendor\Application\tests\units;

    // Vous devez inclure la classe à tester
    require_once __DIR__ . '/../../HelloWorld.php';

    use \mageekguy\atoum;

    /*
     * Classe de test pour \HelloWorld

     * Remarquez qu'elle porte le même nom que la classe à tester
     * et qu'elle étend atoum\test
     */
    class HelloWorld extends atoum\test
    {
        /*
         * Cette méthode est dédiée à la méthode getHiAtoum()
         */
        public function testGetHiAtoum ()
        {
            // création d'une nouvelle instance de la classe à tester
            $helloToTest = new \Vendor\Application\HelloWorld();

            $this
                // nous testons que la méthode getHiAtoum retourne bien
                // une chaîne de caractère...
                ->string($helloToTest->getHiAtoum())
                    // ... et que la chaîne est bien celle attendu,
                    // c'est à dire 'Hi atoum !'
                    ->isEqualTo('Hi atoum !')
            ;
        }
    }

Maintenant, lançons nos tests :

    [bash]
    php vendor/mageekguy.atoum.phar -f src/Vendor/Application/tests/units/HelloWorld.php

Vous devriez voir quelque chose comme ça :

    [bash]
    > PHP path: /usr/bin/php
    > PHP version:
    => PHP 5.4.7 (cli) (built: Sep 13 2012 04:24:47)
    => Copyright (c) 1997-2012 The PHP Group
    => Zend Engine v2.4.0, Copyright (c) 1998-2012 Zend Technologies
    =>     with Xdebug v2.2.1, Copyright (c) 2002-2012, by Derick Rethans
    > Vendor\Application\tests\units\HelloWorld...
    [S___________________________________________________________][1/1]
    => Test duration: 0.02 second.
    => Memory usage: 0.00 Mb.
    > Total test duration: 0.02 second.
    > Total test memory usage: 0.00 Mb.
    > Code coverage value: 100.00%
    > Running duration: 0.34 second.
    Success (1 test, 1/1 method, 2 assertions, 0 error, 0 exception) !


Nous venons de tester que la méthode getHiAtoum :

* retourne bien une chaîne de caractère ;
* et que cette chaîne est bien celle attendu, c'est à dire 'Hi atoum !'.

Les tests sont passés, tout est au vert. Voilà, votre code est solide comme un roc grâce à atoum !


### Principes de base

Avec atoum, quand vous voulez tester quelque chose :

* spécifiez sur quoi vous voulez travailler (une variable, un objet, un tableau, une chaîne de caractère, un nombre entier, etc...) ;
* indiquez dans quel état il doit être (égal à, null, contenant quelque chose, etc...).