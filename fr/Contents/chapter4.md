# Cookbook

## Test d'un singleton

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


## Utilisation dans behat

https://github.com/mageekguy/atoum/wiki/atoum-et-Behat

## Utilisation dans Jenkins (ou Hudson)

https://github.com/mageekguy/atoum/wiki/atoum-et-Jenkins-(ou-Hudson)

## Hook git

https://github.com/mageekguy/atoum/wiki/atoum-et-Git

## Changer l'espace de nom par défaut

https://github.com/mageekguy/atoum/wiki/Modifier-l'espace-de-nom-par-d%C3%A9faut-des-tests-unitaires

## utilisation avec ezPublish 

https://github.com/mageekguy/atoum/wiki/Utiliser-atoum-avec-eZ-publish

## utilisation avec sf2

https://github.com/mageekguy/atoum/wiki/Utiliser-atoum-avec-Symfony-2