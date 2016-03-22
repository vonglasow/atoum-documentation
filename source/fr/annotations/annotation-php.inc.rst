.. _annotation-php:

PHP Version
***********

Certain de vos test peuvent requérir une version spécifique de PHP pour fonctionner (par exemple, pour certains test ne fonctionnant que avec PHP 7). Dire à atoum qu'un test require une version spécifique de PHP est fait à travers l'annotation ``@php``.

Par défaut, sans fournir d'opérateur, le test ne sera exécuté que si la version de PHP est supérieur ou égale à la version du tag in the tag :

.. code-block:: php

   /**
    * @php 7.0
    */
   public function testMethod()
   {
      // contenu du test
   }

Dans cette exemple, le test ne sera exécuté que si la version de PHP est supérieur ou égale à PHP 7.0. Dans le cas contraire, le test sera passé et le message suivant sera affiché :

.. code-block:: shell

   vendor\project\tests\units\foo::testBar(): PHP version 5.5.9-1ubuntu4.5 is not >= to 7.0


.. note::
   Par défaut, le test passe lorsqu'il est passé. Mais vous pouvez utiliser :ref:`--fail-if-skipped-methods<cli-opts-fail-if-skipped-methods>` l'option de la ligne de commande afin de faire échoué les tests passés.

En interne, atoum utilise le `comparateur de version de PHP <http://php.net/version_compare>`_ pour effectuer la comparaison.

Vous n'êtes pas limité à l'opérateur égale ou supérieur. Vous pouvez passé tout les opérateurs de version_compare.

Par exemple :

.. code-block:: php

   /**
    * @php < 5.4
    */
   public function testMethod()
   {
      // contenu du test
   }

Va passé le test si la version de PHP est supérieur ou égal à PHP 5.4

.. code-block:: shell

   vendor\project\tests\units\foo::testBar(): PHP version 5.5.9-1ubuntu4.5 is not < to 5.4

Vous pouvez aussi utilisé de multiple condition, avec l'annotation ``@php``. Par exemple :

.. code-block:: php

   /**
    * @php >= 5.4
    * @php <= 7.0
    */
   public function testMethod()
   {
      // contenu du test
   }
