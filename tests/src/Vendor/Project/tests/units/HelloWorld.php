<?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // La classe de test a son propre namespace :
   // Le namespace de la classe à tester + "tests\units"
   namespace Vendor\Project\tests\units;

   // Vous devez inclure la classe à tester
   require_once __DIR__ . '/../../HelloWorld.php';

   use atoum;

   /*
    * Classe de test pour Vendor\Project\HelloWorld
    *
    * Remarquez qu’elle porte le même nom que la classe à tester
    * et qu’elle dérive de la classe atoum
    */
   class HelloWorld extends atoum
   {
       /*
        * Cette méthode est dédiée à la méthode getHiAtoum()
        */
       public function testGetHiAtoum ()
       {
           $this
               // création d’une nouvelle instance de la classe à tester
               ->given($this->newTestedInstance())

               // nous testons que la méthode getHiAtoum retourne bien
               // une chaîne de caractère...
               ->string($this->testedInstance->getHiAtoum())
                   // ... et que la chaîne est bien celle attendue,
                   // c’est-à-dire 'Hi atoum !'
                   ->isEqualTo('Hi atoum !')
           ;
       }
   }
