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
