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