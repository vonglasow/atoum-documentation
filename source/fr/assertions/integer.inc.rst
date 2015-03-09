.. _integer-anchor:

integer
*******

C'est l'assertion dédiée aux entiers.

Si vous essayez de tester une variable qui n'est pas un entier avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un entier. Reportez-vous au manuel de PHP pour savoir ce que `is_int <http://php.net/is_int>`_ considère ou non comme un entier.


.. _integer-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isEqualTo <variable-is-equal-to>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isIdenticalTo <variable-is-identical-to>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _integer-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


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
