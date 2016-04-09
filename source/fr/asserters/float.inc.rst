.. _float-anchor:

float
*****

C'est l'assertion dédiée aux nombres décimaux.

Si vous essayez de tester une variable qui n'est pas un nombre décimal avec cette assertion, cela échouera.

.. note::
   ``null`` n'est pas un nombre décimal. Reportez-vous au manuel de PHP pour savoir ce que `is_float <http://php.net/is_float>`_ considère ou non comme un nombre décimal.


.. _float-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _float-is-greater-than:

isGreaterThan
=============

.. hint::
   ``isGreaterThan`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`integer::isGreaterThan <integer-is-greater-than>`


.. _float-is-greater-than-or-equal-to:

isGreaterThanOrEqualTo
======================

.. hint::
   ``isGreaterThanOrEqualTo`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`integer::isGreaterThanOrEqualTo <integer-is-greater-than-or-equal-to>`


.. _float-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _float-is-less-than:

isLessThan
==========

.. hint::
   ``isLessThan`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`integer::isLessThan <integer-is-less-than>`


.. _float-is-less-than-or-equal-to:

isLessThanOrEqualTo
===================

.. hint::
   ``isLessThanOrEqualTo`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`integer::isLessThanOrEqualoo <integer-is-less-than-or-equal-to>`


.. _is-nearly-equal-to:

isNearlyEqualTo
===============

``isNearlyEqualTo`` vérifie que le nombre décimal est approximativement égal à la valeur qu'elle reçoit en argument.

En effet, en informatique, les nombres décimaux sont gérées d'une façon qui ne permet pas d'effectuer des comparaisons précises sans recourir à des outils spécialisés. Essayez par exemple d'exécuter la commande suivante :

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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _float-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _float-is-zero:

isZero
======

.. hint::
   ``isZero`` est une méthode héritée de l'asserter ``integer``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`integer::isZero <integer-is-zero>`
