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

## utilisation avec ezPublish 

TODO: https://github.com/mageekguy/atoum/wiki/Utiliser-atoum-avec-eZ-publish

## utilisation avec sf2

TODO: https://github.com/mageekguy/atoum/wiki/Utiliser-atoum-avec-Symfony-2