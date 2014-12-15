Assertions
##########

.. _variable-anchor:

variable
********

C'est l'assertion de base de toutes les variables. Elle contient les tests nécessaires à n'importe quel type de variable.

.. _variable-is-callable:

isCallable
==========

``isCallable`` vérifie que la variable peut être appelée comme fonction.

.. code-block:: php

   <?php
   $f = function() {
       // code
   };

   $this
       ->variable($f)
           ->isCallable()  // passe

       ->variable('\Vendor\Project\foobar')
           ->isCallable()

       ->variable(array('\Vendor\Project\Foo', 'bar'))
           ->isCallable()

       ->variable('\Vendor\Project\Foo::bar')
           ->isCallable()
   ;

.. _variable-is-equal-to:

isEqualTo
=========

``isEqualTo`` vérifie que la variable est égale à une certaine donnée.

.. code-block:: php

   <?php
   $a = 'a';

   $this
       ->variable($a)
           ->isEqualTo('a')    // passe
   ;


.. warning::
   | ``isEqualTo`` ne teste pas le type de la variable.
   | Si vous souhaitez vérifier également son type, utilisez :ref:`isIdenticalTo <variable-is-identical-to>`.


.. _variable-is-identical-to:

isIdenticalTo
=============

``isIdenticalTo`` vérifie que la variable a la même valeur et le même type qu'une certaine donnée. Dans le cas d'objets, ``isIdenticalTo`` vérifie que les données pointent sur la même instance.

.. code-block:: php

   <?php
   $a = '1';

   $this
       ->variable($a)
           ->isIdenticalTo(1)          // échoue
   ;

   $stdClass1 = new \StdClass();
   $stdClass2 = new \StdClass();
   $stdClass3 = $stdClass1;

   $this
       ->variable($stdClass1)
           ->isIdenticalTo(stdClass3)  // passe
           ->isIdenticalTo(stdClass2)  // échoue
   ;

.. warning::
   | ``isIdenticalTo`` teste le type de la variable.
   | Si vous ne souhaitez pas vérifier son type, utilisez :ref:`isEqualTo <variable-is-equal-to>`.


.. _variable-is-not-callable:

isNotCallable
=============

``isNotCallable`` vérifie que la variable ne peut pas être appelée comme fonction.

.. code-block:: php

   <?php
   $f = function() {
       // code
   };
   $int    = 1;
   $string = 'nonExistingMethod';

   $this
       ->variable($f)
           ->isNotCallable()   // échoue

       ->variable($int)
           ->isNotCallable()   // passe

       ->variable($string)
           ->isNotCallable()   // passe

       ->variable(new StdClass)
           ->isNotCallable()   // passe
   ;

.. _variable-is-not-equal-to:

isNotEqualTo
============

``isNotEqualTo`` vérifie que la variable n'a pas la même valeur qu'une certaine donnée.

.. code-block:: php

   <?php
   $a       = 'a';
   $aString = '1';

   $this
       ->variable($a)
           ->isNotEqualTo('b')     // passe
           ->isNotEqualTo('a')     // échoue

       ->variable($aString)
           ->isNotEqualTo($1)      // échoue
   ;

.. warning::
   | ``isNotEqualTo`` ne teste pas le type de la variable.
   | Si vous souhaitez vérifier également son type, utilisez :ref:`isNotIdenticalTo <variable-is-not-identical-to>`.


.. _variable-is-not-identical-to:

isNotIdenticalTo
================

``isNotIdenticalTo`` vérifie que la variable n'a ni le même type ni la même valeur qu'une certaine donnée.

Dans le cas d'objets, ``isNotIdenticalTo`` vérifie que les données ne pointent pas sur la même instance.

.. code-block:: php

   <?php
   $a = '1';

   $this
       ->variable($a)
           ->isNotIdenticalTo(1)           // passe
   ;

   $stdClass1 = new \StdClass();
   $stdClass2 = new \StdClass();
   $stdClass3 = $stdClass1;

   $this
       ->variable($stdClass1)
           ->isNotIdenticalTo(stdClass2)   // passe
           ->isNotIdenticalTo(stdClass3)   // échoue
   ;

.. warning::
   | ``isNotIdenticalTo`` teste le type de la variable.
   | Si vous ne souhaitez pas vérifier son type, utilisez :ref:`isNotEqualTo <variable-is-not-equal-to>`.


.. _is-null:

isNull
======

``isNull`` vérifie que la variable est nulle.

.. code-block:: php

   <?php
   $emptyString = '';
   $null        = null;

   $this
       ->variable($emptyString)
           ->isNull()              // échoue
                                   // (c'est vide mais pas null)

       ->variable($null)
           ->isNull()              // passe
   ;

.. _is-not-null:

isNotNull
=========

``isNotNull`` vérifie que la variable n'est pas nulle.

.. code-block:: php

   <?php
   $emptyString = '';
   $null        = null;

   $this
       ->variable($emptyString)
           ->isNotNull()           // passe (c'est vide mais pas null)

       ->variable($null)
           ->isNotNull()           // échoue
   ;



.. _boolean-anchor:

boolean
*******

C'est l'assertion dédiée aux booléens.

Si vous essayez de tester une variable qui n'est pas un booléen avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un booléen. Reportez-vous au manuel de PHP pour savoir ce que ```is_bool <http://php.net/is_bool>`_`` considère ou non comme un booléen.


.. _boolean-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _is-false:

isFalse
=======

``isFalse`` vérifie que le booléen est strictement égal à ``false``.

.. code-block:: php

   <?php
   $true  = true;
   $false = false;

   $this
       ->boolean($true)
           ->isFalse()     // échoue

       ->boolean($false)
           ->isFalse()     // passe
   ;

.. _boolean-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _boolean-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _boolean-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _is-true:

isTrue
======

``isTrue`` vérifie que le booléen est strictement égal à ``true``.

.. code-block:: php

   <?php
   $true  = true;
   $false = false;

   $this
       ->boolean($true)
           ->isTrue()      // passe

       ->boolean($false)
           ->isTrue()      // échoue
   ;



.. _integer-anchor:

integer
*******

C'est l'assertion dédiée aux entiers.

Si vous essayez de tester une variable qui n'est pas un entier avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un entier. Reportez-vous au manuel de PHP pour savoir ce que ```is_int <http://php.net/is_int>`_`` considère ou non comme un entier.


.. _integer-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _integer-is-greater-than:

isGreaterThan
=============

``isGreaterThan`` vérifie que l'entier est strictement supérieur à une certaine donnée.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isGreaterThan(-1)     // passe
           ->isGreaterThan('-1')   // échoue car "-1"
                                   // n'est pas un entier
           ->isGreaterThan(0)      // échoue
   ;

.. _integer-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

``isGreaterThanOrEqualTo`` vérifie que l'entier est supérieur ou égal à une certaine donnée.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isGreaterThanOrEqualTo(-1)    // passe
           ->isGreaterThanOrEqualTo(0)     // passe
           ->isGreaterThanOrEqualTo('-1')  // échoue car "-1"
                                           // n'est pas un entier
   ;

.. _integer-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _integer-is-less-than:

isLessThan
==========

``isLessThan`` vérifie que l'entier est strictement inférieur à une certaine donnée.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isLessThan(10)    // passe
           ->isLessThan('10')  // échoue car "10" n'est pas un entier
           ->isLessThan(0)     // échoue
   ;

.. _integer-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

``isLessThanOrEqualTo`` vérifie que l'entier est inférieur ou égal à une certaine donnée.

.. code-block:: php

   <?php
   $zero = 0;

   $this
       ->integer($zero)
           ->isLessThanOrEqualTo(10)       // passe
           ->isLessThanOrEqualTo(0)        // passe
           ->isLessThanOrEqualTo('10')     // échoue car "10"
                                           // n'est pas un entier
   ;

.. _integer-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _integer-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _integer-is-zero:

isZero
======

``isZero`` vérifie que l'entier est égal à 0.

.. code-block:: php

   <?php
   $zero    = 0;
   $notZero = -1;

   $this
       ->integer($zero)
           ->isZero()          // passe

       ->integer($notZero)
           ->isZero()          // échoue
   ;

.. note::
   ``isZero`` est équivalent à ``isEqualTo(0)``.




.. _float-anchor:

float
*****

C'est l'assertion dédiée aux nombres décimaux.

Si vous essayez de tester une variable qui n'est pas un nombre décimal avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un nombre décimal. Reportez-vous au manuel de PHP pour savoir ce que ```is_float <http://php.net/is_float>`_`` considère ou non comme un nombre décimal.


.. _float-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _float-is-greater-than:

isGreaterThan
=============

.. hint::
   ``isGreaterThan`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isGreaterThan`` <integer-is-greater-than>`


.. _float-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

.. hint::
   ``isGreaterThanOrEqualTo`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isGreaterThanOrEqualTo`` <integer-is-greater-than-or-equal-to>`


.. _float-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _float-is-less-than:

isLessThan
==========

.. hint::
   ``isLessThan`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isLessThan`` <integer-is-less-than>`


.. _float-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

.. hint::
   ``isLessThanOrEqualTo`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isLessThanOrEqualoo`` <integer-is-less-than-or-equal-to>`


.. _is-nearly-equal-to:

isNearlyEqualTo
===============

``isNearlyEqualTo`` vérifie que le nombre décimal est approximativement égal à la valeur qu'elle reçoit en argument.

En effet, en informatique, les nombres décimaux sont gérées d'une façon qui ne permet pas d'effectuer des comparaisons précises sans recourir à des outils spécialisés. Essayez par exemple d'exécuter la commande suivante:

.. code-block:: shell

   $ php -r 'var_dump(1 - 0.97 === 0.03);'
   bool(false)

Le résultat devrait pourtant être ``true``.

.. note::
   Pour avoir plus d'informations sur ce phénomène, lisez la documentation PHP sur `le type float et sa précision <http://php.net/types.float>`_.


Cette méthode cherche donc à minorer ce problème.

.. code-block:: php

   <?php
   $float = 1 - 0.97;

   $this
       ->float($float)
           ->isNearlyEqualTo(0.03) // passe
           ->isEqualTo(0.03)       // échoue
   ;

.. note::
   Pour avoir plus d'informations sur l'algorithme utilisé, consultez le `floating point guide <http://www.floating-point-gui.de/errors/comparison/>`_.


.. _float-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _float-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _float-is-zero:

isZero
======

.. hint::
   ``isZero`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isZero`` <integer-is-zero>`




.. _size-of:

sizeOf
******

C'est l'assertion dédiée aux tests sur la taille des tableaux et des objets implémentant l'interface ``Countable``.

.. code-block:: php

   <?php
   $array           = array(1, 2, 3);
   $countableObject = new GlobIterator('*');

   $this
       ->sizeOf($array)
           ->isEqualTo(3)

       ->sizeOf($countableObject)
           ->isGreaterThan(0)
   ;

.. _size-of-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _size-of-is-greater-than:

isGreaterThan
=============

.. hint::
   ``isGreaterThan`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isGreaterThan`` <integer-is-greater-than>`


.. _size-of-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

.. hint::
   ``isGreaterThanOrEqualTo`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isGreaterThanOrEqualTo`` <integer-is-greater-than-or-equal-to>`


.. _size-of-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _size-of-is-less-than:

isLessThan
==========

.. hint::
   ``isLessThan`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isLessThan`` <integer-is-less-than>`


.. _size-of-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

.. hint::
   ``isLessThanOrEqualTo`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isLessThanOrEqualoo`` <integer-is-less-than-or-equal-to>`


.. _size-of-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _size-of-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _size-of-is-zero:

isZero
======

.. hint::
   ``isZero`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```integer::isZero`` <integer-is-zero>`




.. _object-anchor:

object
******

C'est l'assertion dédiée aux objets.

Si vous essayez de tester une variable qui n'est pas un objet avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un objet. Reportez-vous au manuel de PHP pour savoir ce que ```is_object <http://php.net/is_object>`_`` considère ou non comme un objet.


.. _object-has-size:

hasSize
=======

``hasSize`` vérifie la taille d'un objet qui implémente l'interface ``Countable``.

.. code-block:: php

   <?php
   $countableObject = new GlobIterator('*');

   $this
       ->object($countableObject)
           ->hasSize(3)
   ;

.. _object-is-callable:

isCallable
==========

.. code-block:: php

   <?php
   class foo
   {
       public function __invoke()
       {
           // code
       }
   }

   $this
       ->object(new foo)
           ->isCallable()  // passe

       ->object(new StdClass)
           ->isCallable()  // échoue
   ;

.. note::
   Pour être identifiés comme ``callable``, vos objets devront être instanciés à partir de classes qui implémentent la méthode magique ```__invoke``  < http://www.php.net/manual/fr/language.oop5.magic.php#object.invoke>`_.


.. hint::
   ``isCallable`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isCallable`` <variable-is-callable>`


.. _object-is-clone-of:

isCloneOf
=========

``isCloneOf`` vérifie qu'un objet est le clone d'un objet donné, c'est-à-dire que les objets sont égaux, mais ne pointent pas vers la même instance.

.. code-block:: php

   <?php
   $object1 = new \StdClass;
   $object2 = new \StdClass;
   $object3 = clone($object1);
   $object4 = new \StdClass;
   $object4->foo = 'bar';

   $this
       ->object($object1)
           ->isCloneOf($object2)   // passe
           ->isCloneOf($object3)   // passe
           ->isCloneOf($object4)   // échoue
   ;

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. _object-is-empty:

isEmpty
=======

``isEmpty`` vérifie que la taille d'un objet implémentant l'interface ``Countable`` est égale à 0.

.. code-block:: php

   <?php
   $countableObject = new GlobIterator('atoum.php');

   $this
       ->object($countableObject)
           ->isEmpty()
   ;

.. note::
   ``isEmpty`` est équivalent à ``hasSize(0)``.


.. _object-is-equal-to:

isEqualTo
=========

``isEqualTo`` vérifie qu'un objet est égal à un autre.
Deux objets sont considérés égaux lorsqu'ils ont les mêmes attributs et valeurs, et qu'ils sont des instances de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _object-is-identical-to:

isIdenticalTo
=============

``isIdenticalTo`` vérifie que deux objets sont identiques.
Deux objets sont considérés identiques lorsqu'ils font référence à la même instance de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _object-is-instance-of:

isInstanceOf
============
``isInstanceOf`` vérifie qu'un objet est :

* une instance de la classe donnée,
* une sous-classe de la classe donnée (abstraite ou non),
* une instance d'une classe qui implémente l'interface donnée.

.. code-block:: php

   <?php
   $object = new \StdClass();

   $this
       ->object($object)
           ->isInstanceOf('\StdClass')     // passe
           ->isInstanceOf('\Iterator')     // échoue
   ;


   interface FooInterface
   {
       public function foo();
   }

   class FooClass implements FooInterface
   {
       public function foo()
       {
           echo "foo";
       }
   }

   class BarClass extends FooClass
   {
   }

   $foo = new FooClass;
   $bar = new BarClass;

   $this
       ->object($foo)
           ->isInstanceOf('\FooClass')     // passe
           ->isInstanceOf('\FooInterface') // passe
           ->isInstanceOf('\BarClass')     // échoue
           ->isInstanceOf('\StdClass')     // échoue

       ->object($bar)
           ->isInstanceOf('\FooClass')     // passe
           ->isInstanceOf('\FooInterface') // passe
           ->isInstanceOf('\BarClass')     // passe
           ->isInstanceOf('\StdClass')     // échoue
   ;

.. note::
   Les noms des classes et des interfaces doivent être absolus, car les éventuelles importations d'espace de nommage ne sont pas prises en compte.

.. hint::
   Notez qu'avec PHP ``>= 5.5`` vous pouvez utiliser le mot-clé ``class`` pour obtenir les noms de classe absolus, par exemple ``$this->object($foo)->isInstanceOf(FooClass::class)``.


.. _object-is-not-callable:

isNotCallable
=============

.. code-block:: php

   <?php
   class foo
   {
       public function __invoke()
       {
           // code
       }
   }

   $this
       ->variable(new foo)
           ->isNotCallable()   // échoue

       ->variable(new StdClass)
           ->isNotCallable()   // passe
   ;

.. hint::
   ``isNotCallable`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotCallable`` <variable-is-not-callable>`


.. _object-is-not-equal-to:

isNotEqualTo
============

``isEqualTo`` vérifie qu'un objet n'est pas égal à un autre.
Deux objets sont considérés égaux lorsqu'ils ont les mêmes attributs et valeurs, et qu'ils sont des instances de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _object-is-not-identical-to:

isNotIdenticalTo
================

``isIdenticalTo`` vérifie que deux objets ne sont pas identiques.
Deux objets sont considérés identiques lorsqu'ils font référence à la même instance de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _date-interval:

dateInterval
************

C'est l'assertion dédiée à l'objet ```DateInterval <http://php.net/dateinterval>`_``.

Si vous essayez de tester une variable qui n'est pas un objet ``DateInterval`` (ou une classe qui l'étend) avec cette assertion, cela échouera.

.. _date-interval-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isCloneOf`` <object-is-clone-of>`


.. _date-interval-is-equal-to:

isEqualTo
=========

``isEqualTo`` vérifie que la durée de l'objet ``DateInterval`` est égale à la durée d'un autre objet ``DateInterval``.

.. code-block:: php

   <?php
   $di = new DateInterval('P1D');

   $this
       ->dateInterval($di)
           ->isEqualTo(                // passe
               new DateInterval('P1D')
           )
           ->isEqualTo(                // échoue
               new DateInterval('P2D')
           )
   ;

.. _date-interval-is-greater-than:

isGreaterThan
=============

``isGreaterThan`` vérifie que la durée de l'objet ``DateInterval`` est supérieure à la durée d'un autre objet ``DateInterval``.

.. code-block:: php

   <?php
   $di = new DateInterval('P2D');

   $this
       ->dateInterval($di)
           ->isGreaterThan(            // passe
               new DateInterval('P1D')
           )
           ->isGreaterThan(            // échoue
               new DateInterval('P2D')
           )
   ;

.. _date-interval-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

``isGreaterThanOrEqualTo`` vérifie que la durée de l'objet ``DateInterval`` est supérieure ou égale à la durée d'un autre objet ``DateInterval``.

.. code-block:: php

   <?php
   $di = new DateInterval('P2D');

   $this
       ->dateInterval($di)
           ->isGreaterThanOrEqualTo(   // passe
               new DateInterval('P1D')
           )
           ->isGreaterThanOrEqualTo(   // passe
               new DateInterval('P2D')
           )
           ->isGreaterThanOrEqualTo(   // échoue
               new DateInterval('P3D')
           )
   ;

.. _date-interval-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isIdenticalTo`` <object-is-identical-to>`


.. _date-interval-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isInstanceOf`` <object-is-instance-of>`


.. _date-interval-is-less-than:

isLessThan
==========

``isLessThan`` vérifie que la durée de l'objet ``DateInterval`` est inférieure à la durée d'un autre objet ``DateInterval``.

.. code-block:: php

   <?php
   $di = new DateInterval('P1D');

   $this
       ->dateInterval($di)
           ->isLessThan(               // passe
               new DateInterval('P2D')
           )
           ->isLessThan(               // échoue
               new DateInterval('P1D')
           )
   ;

.. _date-interval-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

``isLessThanOrEqualTo`` vérifie que la durée de l'objet ``DateInterval`` est inférieure ou égale à la durée d'un autre objet ``DateInterval``.

.. code-block:: php

   <?php
   $di = new DateInterval('P2D');

   $this
       ->dateInterval($di)
           ->isLessThanOrEqualTo(      // passe
               new DateInterval('P3D')
           )
           ->isLessThanOrEqualTo(      // passe
               new DateInterval('P2D')
           )
           ->isLessThanOrEqualTo(      // échoue
               new DateInterval('P1D')
           )
   ;

.. _date-interval-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotEqualTo`` <object-is-not-equal-to>`


.. _date-interval-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotIdenticalTo`` <object-is-not-identical-to>`


.. _date-interval-is-zero:

isZero
======

``isZero`` vérifie que la durée de l'objet ``DateInterval`` est égale à 0.

.. code-block:: php

   <?php
   $di1 = new DateInterval('P0D');
   $di2 = new DateInterval('P1D');

   $this
       ->dateInterval($di1)
           ->isZero()      // passe
       ->dateInterval($di2)
           ->isZero()      // échoue
   ;


.. _date-time:

dateTime
********

C'est l'assertion dédiée à l'objet ```DateTime <http://php.net/datetime>`_``.

Si vous essayez de tester une variable qui n'est pas un objet ``DateTime`` (ou une classe qui l'étend) avec cette assertion, cela échouera.

.. _date-time-has-date:

hasDate
=======

``hasDate`` vérifie la partie date de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasDate('1981', '02', '13')   // passe
           ->hasDate('1981', '2',  '13')   // passe
           ->hasDate(1981,   2,    13)     // passe
   ;

.. _date-time-has-date-and-time:

hasDateAndTime
==============

``hasDateAndTime`` vérifie la date et l'horaire de l'objet ``DateTime``

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13 01:02:03');

   $this
       ->dateTime($dt)
           // passe
           ->hasDateAndTime('1981', '02', '13', '01', '02', '03')
           // passe
           ->hasDateAndTime('1981', '2',  '13', '1',  '2',  '3')
           // passe
           ->hasDateAndTime(1981,   2,    13,   1,    2,    3)
   ;

.. _date-time-has-day:

hasDay
======

``hasDay`` vérifie le jour de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasDay(13)        // passe
   ;

.. _date-time-has-hours:

hasHours
========

``hasHours`` vérifie les heures de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasHours('01')    // passe
           ->hasHours('1')     // passe
           ->hasHours(1)       // passe
   ;

.. _date-time-has-minutes:

hasMinutes
==========

``hasMinutes`` vérifie les minutes de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasMinutes('02')  // passe
           ->hasMinutes('2')   // passe
           ->hasMinutes(2)     // passe
   ;

.. _date-time-has-month:

hasMonth
========

``hasMonth`` vérifie le mois de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasMonth(2)       // passe
   ;

.. _date-time-has-seconds:

hasSeconds
==========

``hasSeconds`` vérifie les secondes de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasSeconds('03')    // passe
           ->hasSeconds('3')     // passe
           ->hasSeconds(3)       // passe
   ;

.. _date-time-has-time:

hasTime
=======

``hasTime`` vérifie la partie horaire de l'objet ``DateTime``

.. code-block:: php

   <?php
   $dt = new DateTime('01:02:03');

   $this
       ->dateTime($dt)
           ->hasTime('01', '02', '03')     // passe
           ->hasTime('1',  '2',  '3')      // passe
           ->hasTime(1,    2,    3)        // passe
   ;

.. _date-time-has-timezone:

hasTimezone
===========

``hasTimezone`` vérifie le fuseau horaire de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime();

   $this
       ->dateTime($dt)
           ->hasTimezone('Europe/Paris')
   ;

.. _date-time-has-year:

hasYear
=======

``hasYear`` vérifie l'année de l'objet ``DateTime``.

.. code-block:: php

   <?php
   $dt = new DateTime('1981-02-13');

   $this
       ->dateTime($dt)
           ->hasYear(1981)     // passe
   ;

.. _date-time-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isCloneOf`` <object-is-clone-of>`


.. _date-time-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isEqualTo`` <object-is-equal-to>`


.. _dat-time-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isIdenticalTo`` <object-is-identical-to>`


.. _date-time-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isInstanceOf`` <object-is-instance-of>`


.. _date-time-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotEqualTo`` <object-is-not-equal-to>`


.. _date-time-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotIdenticalTo`` <object-is-not-identical-to>`




.. _mysql-date-time:

mysqlDateTime
*************

C'est l'assertion dédiée aux objets décrivant une date MySQL et basée sur l'objet ```DateTime <http://php.net/datetime>`_``.

Les dates doivent utiliser un format compatible avec MySQL et de nombreux autre SGBD (Système de gestion de base de données)), à savoir "Y-m-d H:i:s"

.. note::
   Reportez-vous à la documentation de la fonction ```date() <http://php.net/date>`_`` du manuel de PHP pour plus d'information.

Si vous essayez de tester une variable qui n'est pas un objet ``DateTime`` (ou une classe qui l'étend) avec cette assertion, cela échouera.

.. _mysql-date-time-has-date:

hasDate
=======

.. hint::
   ``hasDate`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasDate`` <date-time-has-date>`


.. _mysql-date-time-has-date-and-time:

hasDateAndTime
==============

.. hint::
   ``hasDateAndTime`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasDateAndTime`` <date-time-has-date-and-time>`


.. _mysql-date-time-has-day:

hasDay
======

.. hint::
   ``hasDay`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasDay`` <date-time-has-day>`


.. _mysql-date-time-has-hours:

hasHours
========

.. hint::
   ``hasHours`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasHours`` <date-time-has-hours>`


.. _mysql-date-time-has-minutes:

hasMinutes
==========

.. hint::
   ``hasMinutes`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasMinutes`` <date-time-has-minutes>`


.. _mysql-date-time-has-month:

hasMonth
========

.. hint::
   ``hasMonth`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasMonth`` <date-time-has-month>`


.. _mysql-date-time-has-seconds:

hasSeconds
==========

.. hint::
   ``hasSeconds`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasSeconds`` <date-time-has-seconds>`


.. _mysql-date-time-has-time:

hasTime
=======

.. hint::
   ``hasTime`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasTime`` <date-time-has-time>`


.. _mysql-date-time-has-timezone:

hasTimezone
===========

.. hint::
   ``hasTimezone`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasTimezone`` <date-time-has-timezone>`


.. _mysql-date-time-has-year:

hasYear
=======

.. hint::
   ``hasYear`` est une méthode héritée de l'asserter ``dateTime``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```dateTime::hasYear`` <date-time-has-timezone>`


.. _mysql-date-time-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isCloneOf`` <object-is-clone-of>`


.. _mysql-date-time-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isEqualTo`` <object-is-equal-to>`


.. _mysql-date-time-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isIdenticalTo`` <object-is-identical-to>`


.. _mysql-date-time-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isInstanceOf`` <object-is-instance-of>`


.. _mysql-date-time-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotEqualTo`` <object-is-not-equal-to>`


.. _mysql-date-time-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotIdenticalTo`` <object-is-not-identical-to>`




.. _exception-anchor:

exception
*********

C'est l'assertion dédiée aux exceptions.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
   ;

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3.
   Pour plus de précision, lisez la documentation PHP sur `les fonctions anonymes <http://php.net/functions.anonymous>`_.



.. _has-code:

hasCode
=======

``hasCode`` vérifie le code de l'exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception('Message', 42);
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasCode(42)
   ;

.. _has-default-code:

hasDefaultCode
==============

``hasDefaultCode`` vérifie que le code de l'exception est la valeur par défaut, c'est-à-dire 0.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasDefaultCode()
   ;

.. note::
   ``hasDefaultCode`` est équivalent à ``hasCode(0)``.


.. _has-message:

hasMessage
==========

``hasMessage`` vérifie le message de l'exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasMessage('Message')     // passe
           ->hasMessage('message')     // échoue
   ;

.. _has-nested-exception:

hasNestedException
==================

``hasNestedException`` vérifie que l'exception contient une référence vers l'exception précédente. Si l'exception est précisée, cela va également vérifier la classe de l'exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasNestedException()      // échoue

       ->exception(
           function() use($myObject) {
               try {
                   // ce code lève une exception: throw new \FirstException('Message 1', 42);
                   $myObject->doOneThing('wrongParameter');
               }
               // ... l'exception est attrapée...
               catch(\FirstException $e) {
                   // ... puis relancée, encapsulée dans une seconde exception
                   throw new \SecondException('Message 2', 24, $e);
               }
           }
       )
           ->isInstanceOf('\FirstException')           // échoue
           ->isInstanceOf('\SecondException')          // passe

           ->hasNestedException()                      // passe
           ->hasNestedException(new \FirstException)   // passe
           ->hasNestedException(new \SecondException)  // échoue
   ;

.. _exception-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isCloneOf`` <object-is-clone-of>`


.. _exception-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isEqualTo`` <object-is-equal-to>`


.. _exception-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isIdenticalTo`` <object-is-identical-to>`


.. _exception-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isInstanceOf`` <object-is-instance-of>`


.. _exception-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotEqualTo`` <object-is-not-equal-to>`


.. _exception-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```object::isNotIdenticalTo`` <object-is-not-identical-to>`


.. _message-anchor:

message
=======

``message`` vous permet de récupérer un asserter de type :ref:`string <string-anchor>` contenant le message de l'exception testée.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() {
               throw new \Exception('My custom message to test');
           }
       )
           ->message
               ->contains('message')
   ;



.. _array-anchor:

array
*****

C'est l'assertion dédiée aux tableaux.

.. note::
   ``array`` étant un mot réservé en PHP, il n'a pas été possible de créer une assertion ``array``. Elle s'appelle donc ``phpArray`` et un alias ``array`` a été créé. Vous pourrez donc rencontrer des ``->phpArray()`` ou des ``->array()``.


Il est conseillé d'utiliser exclusivement ``->array()`` afin de simplifier la lecture des tests.

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
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _array-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _array-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


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




.. _string-anchor:

string
******

C'est l'assertion dédiée aux chaînes de caractères.

.. _string-contains:

contains
========

``contains`` vérifie qu'une chaîne de caractère contient une autre chaîne de caractère donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->contains('ll')    // passe
           ->contains(' ')     // passe
           ->contains('php')   // échoue
   ;

.. _string-has-length:

hasLength
=========

``hasLength`` vérifie la taille d'une chaîne de caractères.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLength(11)     // passe
           ->hasLength(20)     // échoue
   ;

.. _string-has-length-greater-than:

hasLengthGreaterThan
====================

``hasLengthGreaterThan`` vérifie que la taille d'une chaîne de caractères est plus grande qu'une valeur donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLengthGreaterThan(10)     // passe
           ->hasLengthGreaterThan(20)     // échoue
   ;

.. _string-has-length-less-than:

hasLengthLessThan
=================

``hasLengthLessThan`` vérifie que la taille d'une chaîne de caractères est plus petite qu'une valeur donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLengthLessThan(20)     // passe
           ->hasLengthLessThan(10)     // échoue
   ;

.. _string-is-empty:

isEmpty
=======

``isEmpty`` vérifie qu'une chaîne de caractères est vide.

.. code-block:: php

   <?php
   $emptyString    = '';
   $nonEmptyString = 'atoum';

   $this
       ->string($emptyString)
           ->isEmpty()             // passe

       ->string($nonEmptyString)
           ->isEmpty()             // échoue
   ;

.. _string-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _string-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

``isEqualToContentsOfFile`` vérifie qu'une chaîne de caractère est égale au contenu d'un fichier donné par son chemin.

.. code-block:: php

   <?php
   $this
       ->string($string)
           ->isEqualToContentsOfFile('/path/to/file')
   ;

.. note::
   si le fichier n'existe pas, le test échoue.


.. _string-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _string-is-not-empty:

isNotEmpty
==========

``isNotEmpty`` vérifie qu'une chaîne de caractères n'est pas vide.

.. code-block:: php

   <?php
   $emptyString    = '';
   $nonEmptyString = 'atoum';

   $this
       ->string($emptyString)
           ->isNotEmpty()          // échoue

       ->string($nonEmptyString)
           ->isNotEmpty()          // passe
   ;

.. _string-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _string-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _length-anchor:

length
======

``length`` vous permet de récupérer un asserter de type :ref:`integer <integer-anchor>` contenant la taille de la chaîne de caractères testée.

.. code-block:: php

   <?php
   $string = 'atoum'

   $this
       ->string($string)
           ->length
               ->isGreaterThanOrEqualTo(5)
   ;

.. _string-match:

match
=====

``match`` vérifie qu'une expression régulière correspond à la chaîne de caractères.

.. code-block:: php

   <?php
   $phone = '0102030405';
   $vdm   = "Aujourd'hui, à 57 ans, mon père s'est fait tatouer une licorne sur l'épaule. VDM";

   $this
       ->string($phone)
           ->match('#^0[1-9]\d{8}$#')

       ->string($vdm)
           ->match("#^Aujourd'hui.*VDM$#")
   ;

.. _string-not-contains:

notContains
===========

``notContains`` vérifie qu'une chaîne de caractère ne contient pas une autre chaîne de caractère donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->notContains('php')   // passe
           ->notContains(';')     // passe
           ->notContains('ll')    // échoue
           ->notContains(' ')     // échoue
   ;



.. _cast-to-string:

castToString
************

C'est l'assertion dédiée aux tests sur le transtypage d'objets en chaîne de caractères.

.. code-block:: php

   <?php
   class AtoumVersion {
       private $version = '1.0';

       public function __toString() {
           return 'atoum v' . $this->version;
       }
   }

   $this
       ->castToString(new AtoumVersion())
           ->isEqualTo('atoum v1.0')
   ;

.. _cast-to-string-contains:

contains
========

.. hint::
   ``contains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::contains`` <string-contains>`


.. _cast-to-string-not-contains:

notContains
===========

.. hint::
   ``notContains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::notContains`` <string-not-contains>`


.. _cast-to-string-has-length:

hasLength
=========

.. hint::
   ``hasLength`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLength`` <string-has-length>`


.. _cast-to-string-has-length-greater-than:

hasLengthGreaterThan
====================

.. hint::
   ``hasLengthGreaterThan`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLengthGreaterThan`` <string-has-length-greater-than>`


.. _cast-to-string-has-length-less-than:

hasLengthLessThan
=================

.. hint::
   ``hasLengthLessThan`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLengthLessThan`` <string-has-length-less-than>`


.. _cast-to-string-is-empty:

isEmpty
=======

.. hint::
   ``isEmpty`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEmpty`` <string-is-empty>`


.. _cast-to-string-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _cast-to-string-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEqualToContentsOfFile`` <string-is-equal-to-contents-of-file>`


.. _cast-to-string-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _cast-to-string-is-not-empty:

isNotEmpty
==========

.. hint::
   ``isNotEmpty`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isNotEmpty`` <string-is-not-empty>`


.. _cast-to-string-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _cast-to-string-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _cast-to-string-match:

match
=====

.. hint::
   ``match`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::match`` <string-match>`




.. _hash-anchor:

hash
****

C'est l'assertion dédiée aux tests sur les hashs (empreintes numériques).

.. _hash-contains:

contains
========

.. hint::
   ``contains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::contains`` <string-contains>`


.. _hash-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _hash-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEqualToContentsOfFile`` <string-is-equal-to-contents-of-file>`


.. _hash-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _is-md5:

isMd5
=====

``isMd5`` vérifie que la chaîne de caractère est au format ``md5``, c'est-à-dire une chaîne hexadécimale de 32 caractères.

.. code-block:: php

   <?php
   $hash    = hash('md5', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isMd5()       // passe
       ->hash($notHash)
           ->isMd5()       // échoue
   ;

.. _hash-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _hash-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _is-sha1:

isSha1
======

``isSha1`` vérifie que la chaîne de caractère est au format ``sha1``, c'est-à-dire une chaîne hexadécimale de 40 caractères.

.. code-block:: php

   <?php
   $hash    = hash('sha1', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isSha1()      // passe
       ->hash($notHash)
           ->isSha1()      // échoue
   ;

.. _is-sha256:

isSha256
========

``isSha256`` vérifie que la chaîne de caractère est au format ``sha256``, c'est-à-dire une chaîne hexadécimale de 64 caractères.

.. code-block:: php

   <?php
   $hash    = hash('sha256', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isSha256()    // passe
       ->hash($notHash)
           ->isSha256()    // échoue
   ;

.. _is-sha512:

isSha512
========

``isSha512`` vérifie que la chaîne de caractère est au format ``sha512``, c'est-à-dire une chaîne hexadécimale de 128 caractères.

.. code-block:: php

   <?php
   $hash    = hash('sha512', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isSha512()    // passe
       ->hash($notHash)
           ->isSha512()    // échoue
   ;

.. _hash-not-contains:

notContains
===========

.. hint::
   ``notContains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::notContains`` <string-not-contains>`




.. _output-anchor:

output
******

C'est l'assertion dédiée aux tests sur les sorties, c'est-à-dire tout ce qui est censé être affiché à l'écran.

.. code-block:: php

   <?php
   $this
       ->output(
           function() {
               echo 'Hello world';
           }
       )
   ;

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3.
   Pour plus de précision, lisez la documentation PHP sur `les fonctions anonymes <http://php.net/functions.anonymous>`_.


.. _output-contains:

contains
========

.. hint::
   ``contains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::contains`` <string-contains>`


.. _output-has-length:

hasLength
=========

.. hint::
   ``hasLength`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLength`` <string-has-length>`


.. _output-has-length-greater-than:

hasLengthGreaterThan
====================

.. hint::
   ``hasLengthGreaterThan`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLengthGreaterThan`` <string-has-length-greater-than>`


.. _output-has-length-less-than:

hasLengthLessThan
=================

.. hint::
   ``hasLengthLessThan`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLengthLessThan`` <string-has-length-less-than>`


.. _output-is-empty:

isEmpty
=======

.. hint::
   ``isEmpty`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEmpty`` <string-is-empty>`


.. _output-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _output-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEqualToContentsOfFile`` <string-is-equal-to-contents-of-file>`


.. _output-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _output-is-not-empty:

isNotEmpty
==========

.. hint::
   ``isNotEmpty`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isNotEmpty`` <string-is-not-empty>`


.. _output-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _output-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _output-match:

match
=====

.. hint::
   ``match`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::match`` <string-match>`


.. _output-not-contains:

notContains
===========

.. hint::
   ``notContains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::notContains`` <string-not-contains>`




.. _utf8-string:

utf8String
**********

C'est l'assertion dédiée aux chaînes de caractères UTF-8.

.. note::
   ``utf8Strings`` utilise les fonctions ``mb_*`` pour gérer les chaînes multi-octets. Reportez-vous au manuel de PHP pour avoir plus d'information sur l'extension ```mbstring <http://php.net/mbstring>`_``.


.. _utf8-string-contains:

contains
========

.. hint::
   ``contains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::contains`` <string-contains>`


.. _utf8-string-has-length:

hasLength
=========

.. hint::
   ``hasLength`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLength`` <string-has-length>`


.. _utf8-string-has-length-greater-than:

hasLengthGreaterThan
====================

.. hint::
   ``hasLengthGreaterThan`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLengthGreaterThan`` <string-has-length-greater-than>`


.. _utf8-string-has-length-less-than:

hasLengthLessThan
=================

.. hint::
   ``hasLengthLessThan`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::hasLengthLessThan`` <string-has-length-less-than>`


.. _utf8-string-is-empty:

isEmpty
=======

.. hint::
   ``isEmpty`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEmpty`` <string-is-empty>`


.. _utf8-string-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isEqualTo`` <variable-is-equal-to>`


.. _utf8-string-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isEqualToContentsOfFile`` <string-is-equal-to-contents-of-file>`


.. _utf8-string-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isIdenticalTo`` <variable-is-identical-to>`


.. _utf8-string-is-not-empty:

isNotEmpty
==========

.. hint::
   ``isNotEmpty`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::isNotEmpty`` <string-is-not-empty>`


.. _utf8-string-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotEqualTo`` <variable-is-not-equal-to>`


.. _utf8-string-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```variable::isNotIdenticalTo`` <variable-is-not-identical-to>`


.. _utf8-string-match:

match
=====

.. hint::
   ``match`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::match`` <string-match>`


.. note::
   Pensez à bien ajouter ``u`` comme option de recherche dans votre expression régulière.
   Pour plus de précision, lisez la documentation PHP sur `les options de recherche des expressions régulières <http://php.net/reference.pcre.pattern.modifiers>`_.


.. code-block:: php

   <?php
   $vdm = "Aujourd'hui, à 57 ans, mon père s'est fait tatouer une licorne sur l'épaule. VDM";

   $this
       ->utf8String($vdm)
           ->match("#^Aujourd'hui.*VDM$#u")
   ;

.. _utf8-string-not-contains:

notContains
===========

.. hint::
   ``notContains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:```string::notContains`` <string-not-contains>`




.. _after-destruction-of:

afterDestructionOf
******************

C'est l'assertion dédiée à la destruction des objets.

Cette assertion ne fait que prendre un objet, vérifier que la méthode ``__destruct()`` est bien définie puis l'appelle.

Si ``__destruct()`` existe bien et si son appel se passe sans erreur ni exception, alors le test passe.

.. code-block:: php

   <?php
   $this
       ->afterDestructionOf($objectWithDestructor)     // passe
       ->afterDestructionOf($objectWithoutDestructor)  // échoue
   ;



.. _error-anchor:

error
*****

C'est l'assertion dédiée aux erreurs.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists() // ou notExists
   ;

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3.
   Pour plus de précision, lisez la documentation PHP sur `les fonctions anonymes <http://php.net/functions.anonymous>`_.


.. warning::
   Les types d'erreur E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING ainsi que la plupart des E_STRICT ne peuvent pas être gérés avec cette fonction.


.. _exists-anchor:

exists
======

``exists`` vérifie qu'une erreur a été levée lors de l'exécution du code précédent.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->exists()      // passe

       ->when(
           function() {
               // code sans erreur
           }
       )
           ->error()
               ->exists()      // échoue
   ;

.. _not-exists:

notExists
=========

``notExists`` vérifie qu'aucune erreur n'a été levée lors de l'exécution du code précédent.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->notExists()   // échoue

       ->when(
           function() {
               // code sans erreur
           }
       )
           ->error()
               ->notExists()   // passe
   ;

.. _with-type:

withType
========

``withType`` vérifie le type de l'erreur levée.

.. code-block:: php

   <?php
   $this
       ->when(
           function() {
               trigger_error('message');
           }
       )
           ->error()
               ->withType(E_USER_NOTICE)   // passe
               ->withType(E_USER_WARNING)  // échoue
   ;



.. _class-anchor:

class
*****

C'est l'assertion dédiée aux classes.

.. code-block:: php

   <?php
   $object = new \StdClass;

   $this
       ->class(get_class($object))

       ->class('\StdClass')
   ;

.. note::
   Le mot-clef ``class`` étant réservé en PHP, il n'a pas été possible de créer une assertion ``class``. Elle s'appelle donc ``phpClass`` et un alias ``class`` a été créé. Vous pourrez donc rencontrer des ``->phpClass()`` ou des ``->class()``.


Il est conseillé d'utiliser exclusivement ``->class()``.

.. _has-interface:

hasInterface
============

``hasInterface`` vérifie que la classe implémente une interface donnée.

.. code-block:: php

   <?php
   $this
       ->class('\ArrayIterator')
           ->hasInterface('Countable')     // passe

       ->class('\StdClass')
           ->hasInterface('Countable')     // échoue
   ;

.. _has-method:

hasMethod
=========

``hasMethod`` vérifie que la classe contient une méthode donnée.

.. code-block:: php

   <?php
   $this
       ->class('\ArrayIterator')
           ->hasMethod('count')    // passe

       ->class('\StdClass')
           ->hasMethod('count')    // échoue
   ;

.. _has-no-parent:

hasNoParent
===========

``hasNoParent`` vérifie que la classe n'hérite d'aucune classe.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasNoParent()     // passe

       ->class('\FilesystemIterator')
           ->hasNoParent()     // échoue
   ;

.. warning::
   | Une classe peut implémenter une ou plusieurs interfaces et n'hériter d'aucune classe.
   | ``hasNoParent`` ne vérifie pas les interfaces, uniquement les classes héritées.


.. _has-parent:

hasParent
=========

``hasParent`` vérifie que la classe hérite bien d'une classe.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasParent()       // échoue

       ->class('\FilesystemIterator')
           ->hasParent()       // passe
   ;

.. warning::
   | Une classe peut implémenter une ou plusieurs interfaces et n'hériter d'aucune classe.
   | ``hasParent`` ne vérifie pas les interfaces, uniquement les classes héritées.


.. _is-abstract:

isAbstract
==========

``isAbstract`` vérifie que la classe est abstraite.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->isAbstract()       // échoue
   ;

.. _is-subclass-of:

isSubclassOf
============

``isSubclassOf`` vérifie que la classe hérite de la classe donnée.

.. code-block:: php

   <?php
   $this
       ->class('\FilesystemIterator')
           ->isSubclassOf('\DirectoryIterator')    // passe
           ->isSubclassOf('\SplFileInfo')          // passe
           ->isSubclassOf('\StdClass')             // échoue
   ;


.. _mock-asserter:

mock
****

C'est l'assertion dédiée aux bouchons.

.. code-block:: php

   <?php
   $mock = new \mock\MyClass;

   $this
       ->mock($mock)
   ;

.. note::
   Reportez-vous à la documentation sur :ref:`les bouchons (mock) <les-bouchons-mock>` pour obtenir plus d'informations sur la façon de créer et gérer les bouchons.


.. _call-anchor:

call
====

``call`` permet de spécifier une méthode du mock à tester, son appel doit être suivi d'un appel à une méthode de vérification d'appel comme `atLeastOnce`_, `once/twice/thrice`_, `exactly`_, etc...

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->once()
   ;

.. _at-least-once:

atLeastOnce
```````````

``atLeastOnce`` vérifie que la méthode testée (voir :ref:`call <call-anchor>`) du mock testé a été appelée au moins une fois.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->atLeastOnce()
   ;

.. _exactly-anchor:

exactly
```````

``exactly`` vérifie que la méthode testée (voir :ref:`call <call-anchor>`) du mock testé exactement un certain nombre de fois.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->exactly(2)
   ;

.. _never-anchor:

never
`````

``never`` vérifie que la méthode testée (voir :ref:`call <call-anchor>`) du mock testé n'a jamais été appelée.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->never()
   ;

.. note::
   ``never`` est équivalent à ``:ref:`exactly <exactly-anchor>`(0)``.


.. _once-twice-thrice:

once/twice/thrice
`````````````````
Ces assertions vérifient que la méthode testée (voir :ref:`call <call-anchor>`) du mock testé a été appelée exactement :

* une fois (once)
* deux fois (twice)
* trois fois (thrice)

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->once()
           ->call('mySecondMethod')
               ->twice()
           ->call('myThirdMethod')
               ->thrice()
   ;

.. note::
   ``once``, ``twice`` et ``thrice`` sont respectivement équivalents à un appel à ``:ref:`exactly <exactly-anchor>`(1)``, ``:ref:`exactly <exactly-anchor>`(2)`` et ``:ref:`exactly <exactly-anchor>`(3)``.


.. _with-any-arguments:

withAnyArguments
````````````````

``withAnyArguments`` permet de ne pas spécifier les arguments attendus lors de l'appel à la méthode testée (voir :ref:`call <call-anchor>`) du mock testé.

Cette méthode est surtout utile pour remettre à zéro les arguments, comme dans l'exemple suivant :

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->withArguments('first')     ->once()
               ->withArguments('second')    ->once()
               ->withAnyArguments()->exactly(2)
   ;

.. _with-arguments:

withArguments
`````````````

``withArguments`` permet de spécifier les paramètres attendus lors de l'appel à la méthode testée (voir :ref:`call <call-anchor>`) du mock testé.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->withArguments('first', 'second')->once()
   ;

.. warning::
   | ``withArguments`` ne teste pas le type des arguments.
   | Si vous souhaitez vérifier également leurs types, utilisez :ref:`withIdenticalArguments <with-identical-arguments>`.


.. _with-identical-arguments:

withIdenticalArguments
``````````````````````

``withIdenticalArguments`` permet de spécifier les paramètres attendus lors de l'appel à la méthode testée (voir :ref:`call <call-anchor>`) du mock testé.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->withIdenticalArguments('first', 'second')->once()
   ;

.. warning::
   | ``withIdenticalArguments`` teste le type des arguments.
   | Si vous ne souhaitez pas vérifier leurs types, utilisez :ref:`withArguments <with-arguments>`.


.. _was-called:

wasCalled
=========

``wasCalled`` vérifie qu'au moins une méthode du mock a été appelée au moins une fois.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->wasCalled()
   ;

.. _was-not-called:

wasNotCalled
============

``wasNotCalled`` vérifie qu'aucune méthode du mock n'a été appelée.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->wasNotCalled()
   ;


.. _stream-anchor:

stream
******

C'est l'assertion dédiée aux stream.

.. important::
   Malheureusement, je n'ai aucune espèce d'idée de son fonctionnement, alors n'hésitez pas à compléter cette partie !


.. _is-read:

isRead
======

.. important::
   We need help to write this section !


.. _is-write:

isWrite
=======

.. important::
   We need help to write this section !
