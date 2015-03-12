.. _array-anchor:

array
*****

C'est l'assertion dédiée aux tableaux.

.. note::
   ``array`` étant un mot réservé en PHP, il n'a pas été possible de créer une assertion ``array``. Elle s'appelle donc ``phpArray`` et un alias ``array`` a été créé. Vous pourrez donc rencontrer des ``->phpArray()`` ou des ``->array()``.


Il est conseillé d'utiliser exclusivement ``->array()`` afin de simplifier la lecture des tests.


.. _sucre-syntaxique:

Sucre syntaxique
=================

Il est à noter, qu'afin de simplifier l'écriture des tests sur les tableaux, du sucre syntaxique est disponible. Celui-ci permet d'effectuer diverses assertions directement sur les clefs du tableau testé.

.. code-block:: php

	$a = [
		'foo' => 42,
		'bar' => '1337' 
	];

	$this
		->array($a)
			->integer['foo']->isEqualTo(42)
			->string['bar']->isEqualTo('1337')
	;

.. note::
   Cette forme d'écriture n'est diponible qu'a partir de PHP 5.4 et supérieur.


.. _array-contains:

contains
========

``contains`` vérifie qu'un tableau contient une certaine donnée.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->contains('1')     // passe
           ->contains(1)       // passe, ne vérifie pas...
           ->contains('2')     // ... le type de la donnée
           ->contains(10)      // échoue
   ;

.. note::
   ``contains`` ne fait pas de recherche récursive.


.. warning::
   | ``contains`` ne teste pas le type de la donnée.
   | Si vous souhaitez vérifier également son type, utilisez :ref:`strictlyContains <strictly-contains>`.


.. _contains-values:

containsValues
==============

``containsValues`` vérifie qu'un tableau contient toutes les données fournies dans un tableau.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->containsValues(array(1, 2, 3))        // passe
           ->containsValues(array('5', '8', '13')) // passe
           ->containsValues(array(0, 1, 2))        // échoue
   ;

.. note::
   ``containsValues`` ne fait pas de recherche récursive.


.. warning::
   | ``containsValues`` ne teste pas le type des données.
   | Si vous souhaitez vérifier également leurs types, utilisez :ref:`strictlyContainsValues <strictly-contains-values>`.


.. _has-key:

hasKey
======

``hasKey`` vérifie qu'un tableau contient une certaine clef.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'        => 'atoum',
       'owner'       => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->hasKey(0)         // passe
           ->hasKey(1)         // passe
           ->hasKey('1')       // passe
           ->hasKey(10)        // échoue

       ->array($atoum)
           ->hasKey('name')    // passe
           ->hasKey('price')   // échoue
   ;

.. note::
   ``hasKey`` ne fait pas de recherche récursive.


.. warning::
   ``hasKey`` ne teste pas le type des clefs.


.. _has-keys:

hasKeys
=======

``hasKeys`` vérifie qu'un tableau contient toutes les clefs fournies dans un tableau.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'        => 'atoum',
       'owner'       => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->hasKeys(array(0, 2, 4))           // passe
           ->hasKeys(array('0', 2))            // passe
           ->hasKeys(array('4', 0, 3))         // passe
           ->hasKeys(array(0, 3, 10))          // échoue

       ->array($atoum)
           ->hasKeys(array('name', 'owner'))   // passe
           ->hasKeys(array('name', 'price'))   // échoue
   ;

.. note::
   ``hasKeys`` ne fait pas de recherche récursive.


.. warning::
   ``hasKeys`` ne teste pas le type des clefs.


.. _array-has-size:

hasSize
=======

``hasSize`` vérifie la taille d'un tableau.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->hasSize(7)        // passe
           ->hasSize(10)       // échoue
   ;

.. note::
   ``hasSize`` n'est pas récursif.


.. _array-is-empty:

isEmpty
=======

``isEmpty`` vérifie qu'un tableau est vide.

.. code-block:: php

   <?php
   $emptyArray    = array();
   $nonEmptyArray = array(null, null);

   $this
       ->array($emptyArray)
           ->isEmpty()         // passe

       ->array($nonEmptyArray)
           ->isEmpty()         // échoue
   ;

.. _array-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _array-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _array-is-not-empty:

isNotEmpty
==========

``isNotEmpty`` vérifie qu'un tableau n'est pas vide.

.. code-block:: php

   <?php
   $emptyArray    = array();
   $nonEmptyArray = array(null, null);

   $this
       ->array($emptyArray)
           ->isNotEmpty()      // échoue

       ->array($nonEmptyArray)
           ->isNotEmpty()      // passe
   ;

.. _array-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _array-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _keys-anchor:

keys
====

``keys`` vous permet de récupérer un asserter de type :ref:`array <array-anchor>` contenant les clefs du tableau testé.

.. code-block:: php

   <?php
   $atoum = array(
       'name'  => 'atoum',
       'owner' => 'mageekguy',
   );

   $this
       ->array($atoum)
           ->keys
               ->isEqualTo(
                   array(
                       'name',
                       'owner',
                   )
               )
   ;

.. _array-not-contains:

notContains
===========

``notContains`` vérifie qu'un tableau ne contient pas une donnée.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->notContains(null)         // passe
           ->notContains(1)            // échoue
           ->notContains(10)           // passe
   ;

.. note::
   ``notContains`` ne fait pas de recherche récursive.


.. warning::
   | ``notContains`` ne teste pas le type de la donnée.
   | Si vous souhaitez vérifier également son type, utilisez :ref:`strictlyNotContains <strictly-not-contains>`.


.. _not-contains-values:

notContainsValues
=================

``notContainsValues`` vérifie qu'un tableau ne contient aucune des données fournies dans un tableau.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->notContainsValues(array(1, 4, 10))    // échoue
           ->notContainsValues(array(4, 10, 34))   // passe
           ->notContainsValues(array(1, '2', 3))   // échoue
   ;

.. note::
   ``notContainsValues`` ne fait pas de recherche récursive.


.. warning::
   | ``notContainsValues`` ne teste pas le type des données.
   | Si vous souhaitez vérifier également leurs types, utilisez :ref:`strictlyNotContainsValues <strictly-not-contains-values>`.


.. _not-has-key:

notHasKey
=========

``notHasKey`` vérifie qu'un tableau ne contient pas une certaine clef.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'  => 'atoum',
       'owner' => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->notHasKey(0)          // échoue
           ->notHasKey(1)          // échoue
           ->notHasKey('1')        // échoue
           ->notHasKey(10)         // passe

       ->array($atoum)
           ->notHasKey('name')     // échoue
           ->notHasKey('price')    // passe
   ;

.. note::
   ``notHasKey`` ne fait pas de recherche récursive.


.. warning::
   ``notHasKey`` ne teste pas le type des clefs.


.. _not-has-keys:

notHasKeys
==========

``notHasKeys`` vérifie qu'un tableau ne contient aucune des clefs fournies dans un tableau.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
   $atoum     = array(
       'name'        => 'atoum',
       'owner'       => 'mageekguy',
   );

   $this
       ->array($fibonacci)
           ->notHasKeys(array(0, 2, 4))            // échoue
           ->notHasKeys(array('0', 2))             // échoue
           ->notHasKeys(array('4', 0, 3))          // échoue
           ->notHasKeys(array(10, 11, 12))         // passe

       ->array($atoum)
           ->notHasKeys(array('name', 'owner'))    // échoue
           ->notHasKeys(array('foo', 'price'))     // passe
   ;

.. note::
   ``notHasKeys`` ne fait pas de recherche récursive.


.. warning::
   ``notHasKeys`` ne teste pas le type des clefs.


.. _size-anchor:

size
====

``size`` vous permet de récupérer un asserter de type :ref:`integer <integer-anchor>` contenant la taille du tableau testé.

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->size
               ->isGreaterThan(5)
   ;

.. _strictly-contains:

strictlyContains
================

``strictlyContains`` vérifie qu'un tableau contient une certaine donnée (même valeur et même type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->strictlyContains('1')     // passe
           ->strictlyContains(1)       // échoue
           ->strictlyContains('2')     // échoue
           ->strictlyContains(2)       // passe
           ->strictlyContains(10)      // échoue
   ;

.. note::
   ``strictlyContains`` ne fait pas de recherche récursive.


.. warning::
   | ``strictlyContains`` teste le type de la donnée.
   | Si vous ne souhaitez pas vérifier son type, utilisez :ref:`contains <array-contains>`.


.. _strictly-contains-values:

strictlyContainsValues
======================

``strictlyContainsValues`` vérifie qu'un tableau contient toutes les données fournies dans un tableau (même valeur et même type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->strictlyContainsValues(array('1', 2, '3'))    // passe
           ->strictlyContainsValues(array(1, 2, 3))        // échoue
           ->strictlyContainsValues(array(5, '8', 13))     // passe
           ->strictlyContainsValues(array('5', '8', '13')) // échoue
           ->strictlyContainsValues(array(0, '1', 2))      // échoue
   ;

.. note::
   ``strictlyContainsValues`` ne fait pas de recherche récursive.


.. warning::
   | ``strictlyContainsValues`` teste le type des données.
   | Si vous ne souhaitez pas vérifier leurs types, utilisez :ref:`containsValues <contains-values>`.


.. _strictly-not-contains:

strictlyNotContains
===================

``strictlyNotContains`` vérifie qu'un tableau ne contient pas une donnée (même valeur et même type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($fibonacci)
           ->strictlyNotContains(null)         // passe
           ->strictlyNotContains('1')          // échoue
           ->strictlyNotContains(1)            // passe
           ->strictlyNotContains(10)           // passe
   ;

.. note::
   ``strictlyNotContains`` ne fait pas de recherche récursive.


.. warning::
   | ``strictlyNotContains`` teste le type de la donnée.
   | Si vous ne souhaitez pas vérifier son type, utilisez :ref:`notContains <array-not-contains>`.


.. _strictly-not-contains-values:

strictlyNotContainsValues
=========================

``strictlyNotContainsValues`` vérifie qu'un tableau ne contient aucune des données fournies dans un tableau (même valeur et même type).

.. code-block:: php

   <?php
   $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

   $this
       ->array($array)
           ->strictlyNotContainsValues(array('1', 4, 10))  // échoue
           ->strictlyNotContainsValues(array(1, 4, 10))    // passe
           ->strictlyNotContainsValues(array(4, 10, 34))   // passe
           ->strictlyNotContainsValues(array('1', 2, '3')) // échoue
           ->strictlyNotContainsValues(array(1, '2', 3))   // passe
   ;

.. note::
   ``strictlyNotContainsValues`` ne fait pas de recherche récursive.


.. warning::
   | ``strictlyNotContainsValues`` teste le type des données.
   | Si vous ne souhaitez pas vérifier leurs types, utilisez :ref:`notContainsValues <not-contains-values>`.
