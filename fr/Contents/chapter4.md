# Cookbook

## Test d'un singleton

Pour tester si une méthode retourne bien systématiquement la même instance d'un objet,
vérifiez que deux appels successifs à la méthode testée sont bien identiques.

    [php]
    $this
        ->object(\Singleton::getInstance())
            ->isInstanceOf('Singleton')
            ->isIdenticalTo(\Singleton::getInstance())
    ;


## Utilisation dans behat

TODO: https://github.com/mageekguy/atoum/wiki/atoum-et-Behat

## Utilisation dans Jenkins (ou Hudson)

TODO: https://github.com/mageekguy/atoum/wiki/atoum-et-Jenkins-(ou-Hudson)

## Hook git

TODO: https://github.com/mageekguy/atoum/wiki/atoum-et-Git

## Changer l'espace de nom par défaut

TODO: https://github.com/mageekguy/atoum/wiki/Modifier-l'espace-de-nom-par-d%C3%A9faut-des-tests-unitaires

## Utilisation avec ezPublish 

TODO: https://github.com/mageekguy/atoum/wiki/Utiliser-atoum-avec-eZ-publish

## Utilisation avec symfony 2

Vous avez la possibilité d'utiliser atoum sur un projet symfony 2 avec 
[JediAtoumBundle](https://github.com/FlorianLB/JediAtoumBundle) mais vous pouvez également configurer atoum vous-même avec [le fichier PHAR](http://downloads.atoum.org/nightly/mageekguy.atoum.phar).

### Etape 1 : Initialisation de votre classe de test

Pour notre test, nous utiliserons une classe qu'on appellera "Car.php" que l'on placera dans l'Entity d'un bundle.

    [php]
    <?php
    // src/Acme/DemoBundle/Entity/Car.php
    namespace Acme\DemoBundle\Entity;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Acme\DemoBundle\Entity\Car
     * @ORM\Table(name="car")
     * @ORM\Entity(repositoryClass="Acme\DemoBundle\Entity\CarRepository")
     */
    class Car
    {
        /**
         * @var integer $id
         * @ORM\Column(name="id", type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @var string $name
         * @ORM\Column(name="name", type="string", length=255)
         */
        private $name;

        /**
         * @var integer $max_speed
         * @ORM\Column(name="max_speed", type="integer")
         */

        private $max_speed;
    }

[Voir ici](http://symfony.com/fr/doc/current/book/doctrine.html#creer-une-classe-entite)) pour plus d'info sur les 
entities de symfony 2. 

Si votre projet est en symfony 2.0.* ,téléchargez 
[le fichier PHAR](http://downloads.atoum.org/nightly/mageekguy.atoum.phar) et placez le dans le répertoire 
vendor qui est à la racine de votre projet.
Sinon, si vous utilisez symfony 2.1.*, ajoutez atoum avec composer comme décrit dans le chapitre 1.

Ajouter à votre dossier src/Acme/DemoBundle le dossier Tests/Units/Entity et créer le fichier Car.php dans ce nouveau
dossier.
Ajoutez un fichier Test.php à placer directement dans le dossier Tests/Units.

    [php]
    <?php
    // src/Acme/DemoBundle/Tests/Units/Test.php
    namespace Acme\DemoBundle\Tests\Units;

    require_once __DIR__ . '/../../../../../vendor/symfony/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

    $loader = new \Symfony\Component\ClassLoader\UniversalClassLoader();

    $loader->registerNamespaces(
        array(
            'Symfony'         => __DIR__ . '/../../../../../vendor/symfony/src',
            'Acme\DemoBundle' => __DIR__ . '/../../../../../src'
        )
    );

    $loader->register();

    use mageekguy\atoum;

    require_once __DIR__ . '/../../../../../vendor/mageekguy.atoum.phar';

    abstract class Test extends atoum\test
    {
        public function __construct(atoum\factory $factory = null)
        {
            $this->setTestNamespace('Tests\Units');
            parent::__construct($factory);
        }
    }

### Etape 3 : Ecriture d'un test

    [php]
    <?php
    // src/Acme/DemoBundle/Tests/Units/Car.php
    namespace Acme\DemoBundle\Tests\Units\Entity;

    require_once __DIR__ . '/../Test.php';

    use Acme\DemoBundle\Tests\Units;

    class Car extends Units\Test
    {

        public function testGetName()
        {
            $car = new \Acme\DemoBundle\Entity\Car();
            $car->setName('batmobile');
            $this->string($car->getName())->isEqualTo('batmobile');
            $this->string($car->getName())->isNotEqualTo('delorean');
        }
    }

Tout est maintenant en place pour lancer votre test.

    [bash]
    php src/Acme/DemoBundle/Tests/Units/Entity/Car.php

    > PHP path: /usr/bin/php
    > PHP version:
    => PHP 5.3.15 with Suhosin-Patch (cli) (built: Aug 24 2012 17:45:44)
    => Copyright (c) 1997-2012 The PHP Group
    => Zend Engine v2.3.0, Copyright (c) 1998-2012 Zend Technologies
    =>     with Xdebug v2.1.3, Copyright (c) 2002-2012, by Derick Rethans
    > Acme\DemoBundle\Tests\Units\Entity\Car...
    [S___________________________________________________________][1/1]
    => Test duration: 0.01 second.
    => Memory usage: 0.50 Mb.
    > Total test duration: 0.01 second.
    > Total test memory usage: 0.50 Mb.
    > Code coverage value: 42.86%
    => Class Acme\DemoBundle\Entity\Car: 42.86%
    ==> Acme\DemoBundle\Entity\Car::getId(): 0.00%
    ==> Acme\DemoBundle\Entity\Car::setMaxSpeed(): 0.00%
    ==> Acme\DemoBundle\Entity\Car::getMaxSpeed(): 0.00%
    > Running duration: 0.24 second.
    Success (1 test, 1/1 method, 0 skipped method, 4 assertions) !    



