
.. _start_with_atoum:

Start with atoum
###################

You first need to :ref:`install it<installation>`, and then try to start your :ref:`first test<first-tests>`. But to understand how to do it, the best is to read the following
section.


.. _atoum-philosophie:

The philosophy of atoum
************************

Simple example
==============

You need to write a test class for each class to test.

Imagine that you want to test the traditional class ``HelloWorld``, then you must create the test class ``test\units\HelloWorld``.

.. note::
   atoum use namespace. For example, to test the ``Vendor\Project\HelloWorld`` class, you must create the class ``Vendor\Project\tests\units\HelloWorld``.


Here is the code of the ``HelloWorld`` class that we will test.

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

Now, here is the code of the test class that we could write.

.. code-block:: php

   <?php
   # src/Vendor/Project/tests/units/HelloWorld.php

   // The test class has is own namespace :
   // The namespace of the tested class + "test\units"
   namespace Vendor\Project\tests\units;

   // You must include the tested class
   require_once __DIR__ . '/../../HelloWorld.php';

   use atoum;

   /*
    * Test class for Vendor\Project\HelloWorld
    *
    * Note that they had the same name that the tested class
    * and that it derives frim the atoum class
    */
   class HelloWorld extends atoum
   {
       /*
        * This method is dedicated to the getHiAtoum() method
        */
       public function testGetHiAtoum ()
       {
           $this
               // creation of a new instance of the tested class
               ->given($this->newTestedInstance)

               // we test that the getHiAtoum method returns 
               // a string...
               ->string($this->testedInstance->getHiAtoum())
                   // ... and that this string is the one we want,
                   // namely 'Hi atoum !'
                   ->isEqualTo('Hi atoum !')
           ;
       }
   }

Now, launch our tests.
You should see something like this:

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

We just test that the method ``getHiAtoum``:
* returns a string;
* that is equals to ``"Hi atoum !"``.

The tests are passed, everything is green. Here, your code is solid as a rock with atoum!


Basic principles
=================

When you want to test a value, you must:

* indicate the type of this value (integer, decimal, array, String, etc.);
* indicate what you are expecting the value to be (equal to, null, containing a substring, ...).
