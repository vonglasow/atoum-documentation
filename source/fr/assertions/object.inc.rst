.. _object-anchor:

object
******

C'est l'assertion dédiée aux objets.

Si vous essayez de tester une variable qui n'est pas un objet avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un objet. Reportez-vous au manuel de PHP pour savoir ce que `is_object <http://php.net/is_object>`_ considère ou non comme un objet.


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isCallable <variable-is-callable>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _object-is-identical-to:

isIdenticalTo
=============

``isIdenticalTo`` vérifie que deux objets sont identiques.
Deux objets sont considérés identiques lorsqu'ils font référence à la même instance de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isIdenticalTo <variable-is-identical-to>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotCallable <variable-is-not-callable>`


.. _object-is-not-equal-to:

isNotEqualTo
============

``isEqualTo`` vérifie qu'un objet n'est pas égal à un autre.
Deux objets sont considérés égaux lorsqu'ils ont les mêmes attributs et valeurs, et qu'ils sont des instances de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _object-is-not-identical-to:

isNotIdenticalTo
================

``isIdenticalTo`` vérifie que deux objets ne sont pas identiques.
Deux objets sont considérés identiques lorsqu'ils font référence à la même instance de la même classe.

.. note::
   Pour plus de précision, lisez la documentation PHP sur `la comparaison d'objet <http://php.net/language.oop5.object-comparison>`_.


.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`
