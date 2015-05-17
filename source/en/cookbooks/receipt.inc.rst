
.. _cookbook_change_default-namespace:

Change the default namespace
**********************************

Au début de l'exécution d'une classe de test, atoum calcule le nom de la classe testée. Pour cela, par défaut, il remplace dans le nom de la classe de test l'expression  régulière ``#(?:^|\\\)tests?\\\units?\\#i`` par le caractère  ``\``.

Ainsi, si la classe de test porte le nom ``vendor\project\tests\units\foo``, il en déduira  que la classe testée porte le nom ``vendor\project\foo``. Cependant, il peut être nécessaire que l'espace de nom des classes de test ne corresponde pas à cette expression régulière, et dans ce cas, atoum s'arrête alors avec le message d'erreur suivant :

.. code-block:: shell

   > exception 'mageekguy\atoum\exceptions\runtime' with message 'Test class 'project\vendor\my\tests\foo' is not in a namespace which match pattern '#(?:^|\\)ests?\\unit?s\#i'' in /path/to/unit/tests/foo.php
   -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Therefore, modify the regular expression used, and it is possible to do so in several ways. La plus simple est de faire appel à l'annotions ``@namespace`` appliquée à la classe de test, de la manière suivante :

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


The ``atoum\test:setTestNamespace()`` method indeed accepts a single argument which must be the regular expression matches the namespace of your test class. And to not have to repeat the call to this method in each test class, just do it once and for all in an abstract class in the following manner:

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


Thus, you will only have to do derive your unit test classes from this abstract class:

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


If changes to unit tests namespace, it is therefore necessary to change only the abstract class.

De plus, il n'est pas obligatoire d'utiliser une expression régulière, que ce soit au niveau de l'annotation ``@namespace`` ou de la méthode  ``atoum\test::setTestNamespace()``, et une simple chaîne de caractères peut également fonctionner.

En effet, atoum fait appel par défaut à une expression régulière afin que son utilisateur puisse utiliser par défaut un large panel d'espaces de nom sans avoir besoin de le configurer à ce niveau. Cela lui permet donc d'accepter par exemple sans configuration particulière les espaces de nomsuivants :

* ``test\unit\``
* ``Test\Unit\``
* ``tests\units\``
* ``Tests\Units\``
* ``TEST\UNIT\``

Cependant, en règle général, l'espace de nom utilisé pour les classes de test est fixe, et il n'est donc pas nécessaire de recourir à une expression régulière si celle par défaut ne convient pas. Dans notre cas, elle pourrait être remplacé par la chaîne de caractères ``my\tests``, par exemple grâce à l'annotation ``@namespace`` :

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

Test of a singleton
*******************

To test a method that always returns the same instance of an object, checks that two calls to the tested method are the same.

.. code-block:: php

   <?php
   $this
       ->object(\Singleton::getInstance())
           ->isInstanceOf('Singleton')
           ->isIdenticalTo(\Singleton::getInstance())
   ;
