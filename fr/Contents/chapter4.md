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

TODO: https://github.com/atoum/atoum/wiki/atoum-et-Behat

## Utilisation dans Jenkins (ou Hudson)

TODO: https://github.com/atoum/atoum/wiki/atoum-et-Jenkins-(ou-Hudson)

## Hook git

TODO: https://github.com/atoum/atoum/wiki/atoum-et-Git

## Changer l'espace de nom par défaut

TODO: https://github.com/atoum/atoum/wiki/Modifier-l'espace-de-nom-par-d%C3%A9faut-des-tests-unitaires

## Utilisation avec ezPublish 

TODO: https://github.com/atoum/atoum/wiki/Utiliser-atoum-avec-eZ-publish

## Utilisation avec Symfony 2

Si vous souhaitez utiliser atoum au sein de vos projets Symfony, vous pouvez installer le Bundle
[JediAtoumBundle](#bundle-symfony-2).

Si vous souhaitez installer et configurer atoum manuellement, voici comment faire.

### Étape 1: installation d'atoum

Si vous utilisez Symfony 2.0, [téléchargez l'archive PHAR](#archive-phar) et placez-la dans le
répertoire vendor qui est à la racine de votre projet.

Si vous utilisez Symfony 2.1, [ajoutez atoum dans votre fichier composer.json](#composer).

### Étape 2: création de la classe de test

Imaginons que nous voulions tester cet Entity:

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

**Note**: pour plus d'informations sur la création d'Entity dans Symfony 2,
reportez-vous au
[manuel Symfony](http://symfony.com/fr/doc/current/book/doctrine.html#creer-une-classe-entite). 

Créez le répertoire Tests/Units dans votre Bundle (par exemple src/Acme/DemoBundle/Tests/Units).
C'est dans ce répertoire que seront stoqués tous les tests de ce Bundle.

Créez un fichier Test.php qui servira de base à tous les futurs tests de ce Bundle.

    [php]
    <?php
    // src/Acme/DemoBundle/Tests/Units/Test.php
    namespace Acme\DemoBundle\Tests\Units;

    // On inclus et active le class loader
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

    // Pour Symfony 2.0 uniquement !
    require_once __DIR__ . '/../../../../../vendor/mageekguy.atoum.phar';

    abstract class Test extends atoum\test
    {
        public function __construct(
            adapter $adapter = null,
            annotations\extractor $annotationExtractor = null,
            asserter\generator $asserterGenerator = null,
            test\assertion\manager $assertionManager = null,
            \closure $reflectionClassFactory = null
        )
        {
            $this->setTestNamespace('Tests\Units');
            parent::__construct(
                $adapter,
                $annotationExtractor,
                $asserterGenerator,
                $assertionManager,
                $reflectionClassFactory
            );
        }
    }

**Note**: l'inclusion de l'archive PHAR d'atoum n'est nécessaire que pour Symfony 2.0.
Supprimez cette ligne dans le cas où vous utilisez Symfony 2.1

**Note**: par défaut, atoum utilise le namespace tests/units pour les tests.
Or Symfony 2 et son class loader exigent des majuscules au début des noms.
Pour cette raison, nous changeons le namespace des tests grâce à la méthode
setTestNamespace('Tests\Units').

### Étape 3: écriture d'un test

Dans le répertoire Tests/Units, il vous suffit de recréer l'arborescence des classes que vous
souhaitez tester (par exemple src/Acme/DemoBundle/Tests/Units/Entity/Car.php).

Créons notre fichier de test:

    [php]
    <?php
    // src/Acme/DemoBundle/Tests/Units/Entity/Car.php
    namespace Acme\DemoBundle\Tests\Units\Entity;

    require_once __DIR__ . '/../Test.php';

    use Acme\DemoBundle\Tests\Units\Test;

    class Car extends Test
    {
        public function testGetName()
        {
            $this
                ->if($car = new \Acme\DemoBundle\Entity\Car())
                ->and($car->setName('Batmobile'))
                    ->string($car->getName())
                        ->isEqualTo('Batmobile')
                        ->isNotEqualTo('De Lorean')
            ;
        }
    }

### Étape 4: lancement des tests

Si vous utilisez Symfony 2.0:

    [bash]
    # Lancement des tests d'un fichier
    php vendor/mageekguy.atoum.phar -f src/Acme/DemoBundle/Tests/Units/Entity/Car.php

    # Lancement de tous les tests du Bundle
    php vendor/mageekguy.atoum.phar -d src/Acme/DemoBundle/Tests/Units

Si vous utilisez Symfony 2.1:

    [bash]
    # Lancement des tests d'un fichier
    ./bin/atoum -f src/Acme/DemoBundle/Tests/Units/Entity/Car.php

    # Lancement de tous les tests du Bundle
    ./bin/atoum -d src/Acme/DemoBundle/Tests/Units

**Note**: vous pouvez obtenir plus d'informations sur le [lancement des tests](#lancement-des-tests)
au chapitre 3.


Dans tous les cas, voilà ce que vous devriez obtenir:

    [bash]
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