
.. _cookbook_change_default-namespace:

Change the default namespace
**********************************

At the beginning of the execution of a test class, atoum computes the name of the tested class. To do this, by default, it replaces in the name of the class the following regular expression ``#(?:^|\\\)tests?\\\units?\\#i`` by char ``\``.

Thus, if the test class name is ``vendor\project\tests\units\foo``, it will deduct in that the tested class named  is ``vendor\project\foo``. However, it may be necessary that the namespace of the test classes may not match this regular expression, and in this case, atoum then stops with the following error message:

.. code-block:: shell

   > exception 'mageekguy\atoum\exceptions\runtime' with message 'Test class 'project\vendor\my\tests\foo' is not in a namespace which match pattern '#(?:^|\\)ests?\\unit?s\#i'' in /path/to/unit/tests/foo.php
   -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


Therefore, modify the regular expression used, and it is possible to do so in several ways. The easiest way is to appeal to him annotions ``@namespace`` applied to the test class in the following way:

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


This method is quick and simple to implement, but it has the disadvantage of having to be repeated in each test class, which is not so maintenable if there is some change in their namespace. The alternative is to call the ``atoum\test::setTestNamespace()`` method in the constructor of the test class, in this way:
 

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

Moreover, it's not mandatory to use a regular expression, either at the level of the ``@namespace`` annotation or the method ``atoum\test::setTestNamespace()`` a simple string can also works.

Indeed atoum by default use a regular expression so that the user can use a wide range of namespaces without the need to configure it at this level. This therefore allows it to accept for example, without any special configuration the following namespaces:

* ``test\unit\``
* ``Test\Unit\``
* ``tests\units\``
* ``Tests\Units\``
* ``TEST\UNIT\``

However, in general, the namespace used to test classes is fixed, and it's not necessary to use a regular expression if the default isn't suitable. In our case, it could be replaced with the string ``my\tests``, for example through the ``@namespace`` annotation:

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
