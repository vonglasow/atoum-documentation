.. _annotation-php:

PHP Version
**************

Some of your tests may require a specific version of PHP to work (for example, the test may only work on PHP 7). Telling atoum that the test requires a version of PHP is done through annotations and the tag ``@php``.

By default, without providing any operator, the tests will only be executed if the PHP version is greater or equal to the version in the tag :

.. code-block:: php

   /**
    * @php 7.0
    */
   public function testMethod()
   {
      //test content
   }

With this example the test will only be executed if the PHP version is greater of equal to PHP 7.0. If not the test will be skipped and this message will be displayed :

.. code-block:: shell

   vendor\project\tests\units\foo::testBar(): PHP version 5.5.9-1ubuntu4.5 is not >= to 7.0


.. note::
By default the tests will pass when a test is skipped. But you can use the :ref:`--fail-if-skipped-methods<cli-opts-fail-if-skipped-methods>` command line option to make the test fail when an extension is not present.


Internally, atoum uses PHP's `version_compare <http://php.net/version_compare>`_ function to do the comparison.

You're not limited to the greater equal operator. You can pass any version_compare operator.

For example :

.. code-block:: php

   /**
    * @php < 5.4
    */
   public function testMethod()
   {
      //test content
   }

Will skip the test if the PHP version is greater equal to 5.4.

.. code-block:: shell

   vendor\project\tests\units\foo::testBar(): PHP version 5.5.9-1ubuntu4.5 is not < to 5.4

You can also pass multiple conditions, with multiple ``@php`` annotations. For example :

.. code-block:: php

   /**
    * @php >= 5.4
    * @php <= 7.0
    */
   public function testMethod()
   {
      //test content
   }


