
.. _cookbook_change_default-namespace:

Changer l'espace de nom par défaut
**********************************

Au début de l'exécution d'une classe de test, atoum calcule le nom de la classe testée. Pour cela, par défaut, il remplace dans le nom de la classe de test l'expression  régulière ``#(?:^|\\\)tests?\\\units?\\#i`` par le caractère  ``\``.

Ainsi, si la classe de test porte le nom ``vendor\project\tests\units\foo``, il en déduira  que la classe testée porte le nom ``vendor\project\foo``. Cependant, il peut être nécessaire que l'espace de nom des classes de test ne corresponde pas à cette expression régulière, et dans ce cas, atoum s'arrête alors avec le message d'erreur suivant :

.. code-block:: shell

   > exception 'mageekguy\atoum\exceptions\runtime' with message 'Test class 'project\vendor\my\tests\foo' is not in a namespace which match pattern '#(?:^|\\)ests?\\unit?s\#i'' in /path/to/unit/tests/foo.php
   -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Il faut donc modifier l'expression régulière utilisée, ceci est possible de plusieurs manières. Le plus simple est de faire appel à l'annotation ``@namespace`` appliquée à la classe de test, de la manière suivante :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   /**
    * @namespace \my\tests
    */
   abstract class aClass extends atoum
   {
      public function testBar()
      {
         /* ... */
      }
   }


Cette méthode est simple et rapide à mettre en œuvre, mais elle présente l'inconvénient de devoir être répétée dans chaque classe de test, ce qui peut compliquer leur maintenance en cas de modification de leur espace de nom. L'alternative consiste à faire appel à la méthode ``atoum\test::setTestNamespace()`` dans
le constructeur de la classe de test, de la manière suivante :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   abstract class aClass extends atoum
   {
      public function __construct(score $score = null, locale $locale = null, adapter $adapter = null)
      {
         $this->setTestNamespace('\\my\\tests');

         parent::__construct($score, $locale, $adapter);
      }

      public function testBar()
      {
         /* ... */
      }
   }


La méthode ``atoum\test::setTestNamespace()`` accepte en effet un unique argument qui doit être l'expression régulière correspondant à l'espace de nom de votre classe de test. Et pour ne pas avoir à répéter l'appel à cette méthode dans chaque classe de test, il suffit de le faire une bonne fois pour toutes dans une classe abstraite de la manière suivante :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   abstract class Test extends atoum
   {
      public function __construct(score $score = null, locale $locale = null, adapter $adapter = null)
      {
          $this->setTestNamespace('\\my\\tests');

         parent::__construct($score, $locale, $adapter);
      }
   }


Ainsi, vous n'aurez plus qu'à faire dériver vos classes de tests unitaires de cette classe abstraite :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests\modules;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;
   use vendor\project\my\tests;

   class aModule extends tests\Test
   {
      public function testDoSomething()
      {
         /* ... */
      }
   }


En cas de modification de l'espace de nommage réservé aux tests unitaires, il ne sera donc nécessaire de ne modifier que la classe abstraite.

De plus, il n'est pas obligatoire d'utiliser une expression régulière, que ce soit au niveau de l'annotation ``@namespace`` ou de la méthode  ``atoum\test::setTestNamespace()``, et une simple chaîne de caractères peut également fonctionner.

En effet, atoum fait appel par défaut à une expression régulière afin que son utilisateur puisse utiliser par défaut un large panel d'espaces de nom sans avoir besoin de le configurer à ce niveau. Cela lui permet donc d'accepter par exemple sans configuration particulière les espaces de nomsuivants :

* ``test\unit\``
* ``Test\Unit\``
* ``tests\units\``
* ``Tests\Units\``
* ``TEST\UNIT\``

Cependant, en règle général, l'espace de nom utilisé pour les classes de test est fixe et il n'est donc pas nécessaire de recourir à une expression régulière si celle par défaut ne convient pas. Dans notre cas, elle pourrait être remplacée par la chaîne de caractères ``my\tests``, par exemple grâce à l'annotation ``@namespace`` :

.. code-block:: php

   <?php

   namespace vendor\project\my\tests;

   require_once __DIR__ . '/mageekguy.atoum.phar';

   use mageekguy\atoum;

   /**
    * @namespace \my\tests\
    */
   abstract class aClass extends atoum
   {
      public function testBar()
      {
         /* ... */
      }
   }



.. _cookbook_singleton:

Test d'un singleton
*******************

Pour tester si une méthode retourne bien systématiquement la même instance d'un objet, vérifiez que deux appels successifs à la méthode testée sont bien identiques.

.. code-block:: php

   <?php
   $this
       ->object(\Singleton::getInstance())
           ->isInstanceOf('Singleton')
           ->isIdenticalTo(\Singleton::getInstance())
   ;
