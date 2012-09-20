# Qu'est-ce qu'atoum ?

atoum est un framework de test unitaire, tout comme PHPUnit ou SimpleTest, mais :

* il est moderne et utilise les innovations des dernières versions de PHP ;
* il est simple et facile à maitriser ;
* il est intuitif, son API se veut la plus proche du language naturel (en anglais).


## Téléchargement et installation

Pour le moment, atoum n'est pas versionné. Si vous souhaitez utiliser atoum, il vous suffit de télécharger la dernière version stable.
Malgré les évolutions constantes d'atoum, la rétro-compatibilité est assurée autant que possible.

Vous pouvez installer atoum de 3 manières :

* en téléchargeant une archive PHAR ;
* en utilisant composer ;
* en clonant le dépôt github.


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
        "require"; {
            "mageekguy/atoum": "dev-master"
        }
    }

Enfin, exécutez la commande suivante :

    [shell]
    php composer.phar install


### Github

Si vous souhaitez utiliser atoum directement depuis ses sources, vous pouvez cloner ou forker son dépôt github : git://github.com/mageekguy/atoum.git


## La philosophie d'atoum

### Exemple simple

Vous devez écrire une classe de test pour chaque classe à tester.
Si nous prenons, par exemple, la traditionnelle classe HelloWorld, vous devez créer la classe de test test\units\HelloWorld.

**NOTE** : atoum utilise les espaces de noms. Par exemple, pour tester la classe \Vendor\Application\HelloWorld, vous devez créer la classe \Vendor\Application\tests\units\HelloWorld.

Voici le code de la classe HelloWorld que nous allons tester.

    [php]
    <?php
    # src/Vendor/Application/HelloWorld.php

    namespace Vendor\Application;

    /**
    * La classe à tester
    */
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

    // La classe de test à son propre namespace
    namespace Vendor\Application\tests\units;

    // Vous devez inclure la classe à tester
    require_once __DIR__ . '/../../HelloWorld.php';

    use \mageekguy\atoum;

    /*
     * Classe de test pour \HelloWorld
     * Remarquez qu'elle porte le même nom que la classe à tester !
     * Elle étend atoum\test
     */
    class HelloWorld extends atoum\test
    {
        /*
         * Cette méthode est dédiée à la méthode getHiAtoum()
         */
        public function testGetHiAtoum ()
        {
            $this
                // création d'une nouvelle instance de la classe à tester
                ->given($helloToTest = new \Vendor\Application\HelloWorld())

                // nous testons que la méthode getHiAtoum retourne bien une chaîne de caractère...
                ->string($helloToTest->getHiAtoum())
                    // et que la chaîne est bien celle attendu, c'est à dire 'Hi atoum !'
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

Et voilà, votre code est solide comme un rock grâce à atoum !


### Règles générales

Avec atoum, quand vous voulez tester quelque chose :

* spécifiez sur quoi vous voulez travailler (une variable, un objet, un tableau, une chaîne de caractère, un nombre entier, etc...) ;
* indiquez dans quel état il doit être (égal à, null, contenan quelque chose, etc...).

Dans l'exemple précédent, nous avons tester que la méthode getHiAtoum :

* retourne bien une chaîne de caractère ;
* et que cette chaîne est bien celle attendu, c'est à dire 'Hi atoum !'.


### Plus d'asserters

Avec atoum vous pouvez tester plusieurs types de données avec des "asserters".
Pour voir la liste complète, allez voir le [chapitre 2](#asserters).

Voyons ensemble les principaux asserters avec ce nouvel exemple.

D'abord, la classe à tester :

    [php]
    <?php
    # src/Vendor/Application/BasicTypes.php

    namespace Vendor\Application;

    class BasicTypes
    {
        public function getInteger()      { return 1;                }
        public function getTrue()         { return true;             }
        public function getFalse()        { return false;            }
        public function getString()       { return 'atoum';          }
        public function getObject()       { return new BasicTypes(); }
        public function getFloat()        { return 1.1;              }
        public function getNull()         { return null;             }
        public function getEmptyArray()   { return array();          }
        public function getArraySizeOf3() { return range(0, 2);      }
    }

Maintenant, la classe de test

    [php]
    <?php
    # src/Vendor/Application/tests/units/BasicTypes.php

    // La classe de test à son propre namespace
    namespace Vendor\Application\tests\units;

    // Vous devez inclure la classe à tester
    require_once __DIR__ . '/../../BasicTypes.php';

    use \mageekguy\atoum;

    class BasicTypes extends atoum\test
    {
        public function testBoolean()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type booléen
                ->boolean($bt->getFalse())
                    // c'est bien la valeur false
                    ->isFalse()
                // vérification du type boolean
                ->boolean($bt->getTrue())
                    // c'est bien la valeur true
                    ->isTrue()
            ;
        }

        public function testInteger()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type entier
                ->integer($bt->getInteger())
                    // c'est bien un entier positif
                    ->isGreaterThan(0)
                    // c'est bien égal à 1
                    ->isEqualTo(1)
            ;
        }

        public function testString()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type chaîne de caractère
                ->string($bt->getString())
                    // c'est bien une chaîne non vide
                    ->isNotEmpty()
                    // c'est bien égal à 'atoum'
                    ->isEqualTo('atoum')
            ;
        }

        public function testObject()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type objet
                ->object($bt->getObject())
                    // c'est bien une instance de \Vendor\Application\BasicTypes
                    ->isInstanceOf('\Vendor\Application\BasicTypes')
                    // c'est bien une nouvelle instance
                    ->isNotIdenticalTo($bt)
            ;
        }

        public function testFloat()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type float
                ->float($bt->getFloat())
                    // c'est bien égal à 1.1
                    ->isEqualTo(1.1)
            ;
        }

        public function testArray()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type array
                ->array($bt->getEmptyArray())
                    // il est bien vide
                    ->isEmpty()

                // vérification du type array
                ->array($bt->getArraySizeOf3())
                    // il est bien non vide
                    ->isNotEmpty()
                    // il contient bien 3 valeurs
                    ->hasSize(3)
            ;
        }

        public function testNull()
        {
            $this
                // création de l'instance à tester
                ->given($bt = new \Vendor\Application\BasicTypes())

                // vérification du type variable
                ->variable($bt->getNull())
                    // c'est bien une variable null
                    ->isNull()
            ;
        }
    }

Vous connaissez, maintenant, les principaux asserters proposés par atoum.


### Testing a Singleton

To test if your method always returns the same instance of the same object, you can ask atoum to check that the instances are identicals.

    [php]
    <?php //...
    class Singleton extends atoum\test
    {
        public function testGetInstance()
        {
            $this->assert
                    ->object(\Singleton::getInstance())
                        ->isInstanceOf('Singleton')
                        ->isIdenticalTo(\Singleton::getInstance());
        }
    }

### Testing exceptions

To test exceptions atoum is using closures (introduced in PHP 5,3).

    [php]
    class ExceptionLauncher extends atoum\test
    {
        public function testLaunchException ()
        {
            $exception = new \ExceptionLauncher();
            $this->assert
                     ->exception(function()use($exception){
                                    $exception->launchException();
                                })
                     ->isInstanceOf('LaunchedException')
                     ->hasMessage('Message in the exception');

        }
    }

### Testing errors

Again, atoum is nicely using closure to test errors (NOTICE, WARNING, …) :

    [php]
    class RaiseError extends atoum\test
    {
        public function testRaiseError ()
        {
            $error = new \RaiseError();

            $this->assert->object($error);
            $this->assert
                     ->when(function()use($error){
                            $error->raise();
                     })
                     ->error('This is an error', E_USER_WARNING)
                        ->exists();
                     //Sachant qu'il est possible de ne spécifier
                     // ni message ni type attendu.
        }
    }

### Testing using Mocks

Mocks are of course supported by atoum !
Generating a Mock from an interface

atoum can generate a mock directly from an interface.

    [php]
    class UsingWriter extends atoum\test
    {
        public function testWithMockedInterface ()
        {
            $this->mockGenerator->generate('\IWriter');
            $mockIWriter = new \mock\IWriter;

            $usingWriter = new \UsingWriter();
            //La méthode setIWriter attends un objet
            //qui implemente l'interface IWriter
            //  (setIWriter (IWriter $writer))
            $usingWriter->setIWriter($mockIWriter);

            $this->assert
                    ->when(function () use($usingWriter) {
                                    $usingWriter->write('hello');
                    })
                    ->mock($mockIWriter)
                        ->call('write')
                        ->once();
        }
    }

### Generating a Mock from a class

atoum can generate a mock directly from a class definition.

    [php]
    public function testWithMockedObject ()
    {
        $this->mockGenerator->generate('\Writer');
        $mockWriter = new \mock\Writer;

        $usingWriter = new \UsingWriter();
        //La méthode setWriter attends un objet
        //de type Writer (setWriter (Writer $writer))
        $usingWriter->setWriter($mockWriter);

        $this->assert
                ->when(function () use($usingWriter) {
                                $usingWriter->write('hello');
                })
                ->mock($mockWriter)
                    ->call('write')
                    ->once();
    }

There is also a shorter syntax to generate mock from a class definition.

    [php]
    public function testWithMockedObject ()
    {
        $mockWriter = new \mock\Writer;

        //...
    }

atoum is able to automatically find the class definition to mock on demand so you don't have to call the mock generator.

When requesting a mock instance for a class, do not forget to specify the full class path (including namespaces).

    [php]
    namespace Package\Writers
    {
        class SampleWriter implements Writer
        {
            //...
        }

    }

    namespace
    {
        class UsingWriter 
        {
            public function write(\Package\Writers\Writer $writer, $string) 
            {
                $writer->write($string);
            }
        }
    }

In this example, the class we want to mock lives in the Package\Writers namespace, so to request a mock in our test we should do :

    [php]
    namespace Package\test\units;

    class UsingWriter extends atoum\test
    {
        public function testWrite()
        {                     
            $this
                ->if($mockWriter = new \mock\Package\Writers\SampleWriter())
                ->then()
                    ->when(function() use($mockWriter) {
                        $usingWriter = new \UsingWriter();
                        $usingWriter->write($mockWriter, 'Hello World!');  
                    })  
                    ->mock($mockWriter)
                        ->call('write')
                        ->withArguments('Hello World!')
                        ->once()
            ;
        }
    }

### Generating a Mock from scratch

atoum can also let you create and completely specify a mock object.

    [php]
    $this->mockGenerator->generate('WriterFree');
    $mockWriter = new \mock\WriterFree;
    $mockWriter->getMockController()->write = function($text){};

    $usingWriter = new \UsingWriter();
    $usingWriter->setFreeWriter($mockWriter);

    $this->assert
            ->when(function () use($usingWriter) {
                            $usingWriter->write('hello');
            })
            ->mock($mockWriter)
                ->call('write')
                ->once();
