.. _annotation-php-extension:

PHP Extensions
**************

Some of your tests may require one or more PHP extension(s). Telling atoum that a test requires an extension is easily done through annotations and the tag ``@extensions``. After the tag ``@extensions``, just add one or more extension names, separated by a space.


.. code-block:: php

   <?php

   namespace vendor\project\tests\units;

   class foo extends \atoum
   {
       /**
        * @extensions intl
        */
       public function testBar()
       {
           // ...
       }
   }

The test will only be executed if the extension is present. If not the test will be skipped and this message will be displayed.

.. code-block:: shell

   vendor\project\tests\units\foo::testBar(): PHP extension 'intl' is not loaded


.. note::
   By default the tests will pass when a test is skipped. But you can use the :ref:`--fail-if-skipped-methods<cli-opts-fail-if-skipped-methods>` command line option to make the test fail when an extension is not present.

