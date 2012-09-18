# Qu'est-ce qu'atoum ? #

atoum est un framework de test unitaire, tout comme PHPUnit ou SimpleTest, mais :
* il est moderne et utilise les innovations des dernières versions de PHP ;
* il est simple et facile à maitriser ;
* il est intuitif, son API se veut la plus proche du language naturel (en anglais).

## Téléchargement et installation ##

Pour le moment, atoum n'est pas versionné. Si vous souhaitez utiliser atoum, il vous suffit de télécharger la dernière version stable.
Malgré les évolutions constantes d'atoum, la rétro-compatibilité est assurée autant que possible.

Vous pouvez installer atoum de 3 manières :
* en téléchargeant une archive PHAR ;
* en utilisant composer ;
* en clonant le dépôt github.

### Archive PHAR

Une archive PHAR est créée automatiquement à chaque modification d'atoum. PHAR (**PH**P **Ar**chive) est un format d'archive d'application PHP, disponible depuis PHP 5.3.

Vous pouvez télécharger la dernière version stable d'atoum directement depuis le site officiel : http://downloads.atoum.org/nightly/mageekguy.atoum.phar

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


## La philosophie d'atoum ##

### Exemple basic ###

Vous devez écrire une classe de test pour chaque classe à tester.
Si nous prenons, par exemple, la fameuse classe HelloWorld, vous devez créer la classe de test test\units\HelloWorld.

NOTE : atoum utilise les espaces de noms. Par exemple, pour tester la classe \Vendor\Application\HelloWorld, vous devez créer la classe \Vendor\Application\tests\units\HelloWorld.

Voici le code de la classe HelloWorld que nous allons tester. Cette classe est dans le fichier src/Vendor/Application/HelloWorld.php

    [php]
    <?php
    namespace Vendor\Application;

    /**
     * The class to be tested
     */
    class HelloWorld
    {
        public function getHiAtoum ()
        {
            return "Hi atoum !";
        }
    }

Maintenant, voici le code de la classe de test que nous pourrions écrire. Cette classe se trouverait dans src/Vendor/Application/tests/units/HelloWorld.php

    [php]
    <?php
    //Your test classes are in a dedicated namespace
    namespace Vendor\Application\tests\units;

    //You have to include your tested class
    require_once __DIR__ . '/../../HelloTheWorld.php';

    //You now include atoum, using it’s phar archive
    require_once __DIR__ . '/atoum/mageekguy.atoum.phar';

    use \mageekguy\atoum;

    /**
     * Test class for \HelloTheWorld
     * Test classes extends from atoum\test
     */
    class HelloTheWorld extends atoum\test
    {
        public function testGetHiBob ()
        {
            //new instance of the tested class
            $helloToTest = new \HelloTheWorld();

            $this->assert
                        //we expect the getHiBob method to return a string
                        ->string($helloToTest->getHiBob())
                        //and the string should be Hi Bob !
                        ->isEqualTo('Hi Bob !');
        }
    }

Now, let's launch the tests

    [bash]
    php -f ./test/HelloTheWorld.php

You will see something like this

    [bash]
    > atoum version nightly-941-201201011548 by Frédéric Hardy (phar:///home/documentation/projects/tests/atoum/mageekguy.atoum.phar/1)
    > PHP path: /usr/bin/php5
    > PHP version:
    => PHP 5.3.6-13ubuntu3.3 with Suhosin-Patch (cli) (built: Dec 13 2011 18:37:10)
    => Copyright (c) 1997-2011 The PHP Group
    => Zend Engine v2.3.0, Copyright (c) 1998-2011 Zend Technologies
    =>     with Xdebug v2.1.2, Copyright (c) 2002-2011, by Derick Rethans
    > tests\units\HelloTheWorld...
    [S___________________________________________________________][1/1]
    => Test duration: 0.01 second.
    => Memory usage: 0.00 Mb.
    > Total test duration: 0.01 second.
    > Total test memory usage: 0.00 Mb.
    > Code coverage value: 100.00%
    > Running duration: 0.16 second.
    Success (1 test, 1/1 method, 2 assertions, 0 error, 0 exception) !

You're done, your code is rock solid !

### Rule of Thumb ###

The basics when you’re testing things using atoum are the following :
*    Tell atoum what you want to work on (a variable, an object, a string, an integer, …)
*    Tell atoum the state the element is expected to be in (is equal to, is null, exists, …).

In the above example we tested that the method getHiBob
*    did return a string (step 1),
*    and that this string was equal to « Hi Bob ! » (step 2).

### More asserters ###

There are of course a lot more asserters in atoum. To see the complete list, see chapter 2.

Let's see with a quick class some more asserters in atoum !

First, the class to be tested, located in PROJECT_PATH/classes/BasicTypes.php.

    [php]
    <?php
    class BasicTypes
    {
        public function getOne (){return 1;}
        public function getTrue(){return true;}
        public function getFalse(){return false;}
        public function getHello(){return 'hello';}
        public function create(){return new BasicTypes();}
        public function getFloat(){return 1.1;}
        public function getNull(){return null;}
        public function getEmptyArray(){return array();}
        public function getArraySizeOf3(){return range(0,2,1);}
    }

Now the test class, located in PROJECT_PATH/tests/BasicTypes.php

    [php]
    <?php //...
    class BasicTypes extends atoum\test
    {
        public function testBoolean ()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->boolean($bt->getFalse())
                        ->isFalse()//getFalse retourne bien false
                    ->boolean($bt->getTrue())
                        ->isTrue();//getTrue retourne bien true
        }

        public function testInteger ()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->integer($bt->getOne())
                    ->isEqualTo(1)
                    ->isGreaterThan(0);
        }

        public function testString()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->string($bt->getHello())
                    ->isNotEmpty()
                    ->isEqualTo('hello');
        }

        public function testObject ()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->object($bt->create())
                    ->isInstanceOf('BasicTypes')
                    ->isNotIdenticalTo($bt);//Une nouvelle instance
        }

        public function testFloat()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->float($bt->getFloat())
                    ->isEqualTo(1.1);
        }

        public function testArray()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->array($bt->getArraySizeOf3())
                        ->hasSize(3)
                        ->isNotEmpty()
                    ->array($bt->getEmptyArray())
                        ->isEmpty();
        }

        public function testNull ()
        {
            $bt = new \BasicTypes();
            $this->assert
                    ->variable($bt->getNull())
                    ->isNull();
        }
    }

Here you are, you saw a complet and basic example of tests using atoum.

### Testing a Singleton ###

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

### Testing exceptions ###

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

### Testing errors ###

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

### Testing using Mocks ###

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

### Generating a Mock from a class ###

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

### Generating a Mock from scratch ###

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
