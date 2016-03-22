
.. _first-tests:

Premiers tests
##################

Vous avez besoin d'écrire une classe de test pour chaque classe testé.

Imaginez que vous vouliez tester la traditionnelle classe ``HelloWorld``, alors vous devez créer la classe de test ``test\units\HelloWorld``.

.. note::
	atoum utilise les espaces de noms. Par exemple, pour tester la classe ``Vendor\Project\HelloWorld``, vous devez créer la classe ``Vendor\Project\tests\units\HelloWorld``.

Voici le code de la classe ``HelloWorld`` que nous allons tester.

.. code-block:: php

   <?php
   # src/Vendor/Project/HelloWorld.php

   namespace Vendor\Project;

   class HelloWorld
   {
       public function getHiAtoum ()
       {
           return 'Hi atoum !';
       }
   }


Maintenant, voici le code de la classe de test que nous pourrions écrire.

.. code-block:: php

   <?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // La classe de test a son propre namespace :
   // Le namespace de la classe à tester + "tests\units"
   namespace Vendor\Project\tests\units;

   // You must include the tested class (if you have no autoloader)
   require_once __DIR__ . '/../../HelloWorld.php';

   use atoum;

   /*
    * Classe de test pour Vendor\Project\HelloWorld
    *
    * Remarquez qu'elle porte le même nom que la classe à tester
    * et qu'elle dérive de la classe atoum
    */
   class HelloWorld extends atoum
   {
       /*
        * Cette méthode est dédiée à la méthode getHiAtoum()
        */
       public function testGetHiAtoum ()
       {
           $this
               // création d'une nouvelle instance de la classe à tester
               ->given($this->newTestedInstance)

               ->then

	               // nous testons que la méthode getHiAtoum retourne bien
	               // une chaîne de caractère...
	               ->string($this->testedInstance->getHiAtoum())
	                   // ... et que la chaîne est bien celle attendue,
	                   // c'est-à-dire 'Hi atoum !'
	                   ->isEqualTo('Hi atoum !')
           ;
       }
   }

Maintenant, lançons nos tests.
Vous devriez voir quelque chose comme ça :

.. code-block:: shell

   $ ./vendor/bin/atoum -f src/Vendor/Project/tests/units/HelloWorld.php
   > PHP path: /usr/bin/php
   > PHP version:
   => PHP 5.6.3 (cli) (built: Nov 13 2014 18:31:57)
   => Copyright (c) 1997-2014 The PHP Group
   => Zend Engine v2.6.0, Copyright (c) 1998-2014 Zend Technologies
   > Vendor\Project\tests\units\HelloWorld...
   [S___________________________________________________________][1/1]
   => Test duration: 0.00 second.
   => Memory usage: 0.25 Mb.
   > Total test duration: 0.00 second.
   > Total test memory usage: 0.25 Mb.
   > Running duration: 0.04 second.
   Success (1 test, 1/1 method, 0 void method, 0 skipped method, 2 assertions)!


Nous venons de tester que la méthode ``getHiAtoum`` :

* retourne une :ref:`chaîne de caractère <string-anchor>`;
* that :ref:`is equals to<string-is-equal-to>` ``"Hi atoum !"``.

Les tests sont passés, tout est au vert. Voilà, votre code est solide comme un roc grâce à atoum !


Dissecting the test
*******************
It's important you understand each thung we use in this test. So here is some information about it.

We use the namespace ``Vendor\Project\tests\units`` where ``Vendor\Project`` is the namespace of the class and ``tests\units`` the part of the namespace use by atoum to understand that we are on test namespace. This special namespace is configurable and it's explain in the :ref:`appropriate section<cookbook_change_default-namespace>`.
Inside the test method, we use a special syntax :ref:`given and then<given-if-and-then>` that do nothing excepting making the test more readable.
Finally we use another simple tricks with :ref:`newTestedInstance and testedInstance<newTestedInstance>` to get a new instance of the tested class.

