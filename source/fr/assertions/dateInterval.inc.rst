.. _date-interval:

dateInterval
************

C'est l'assertion dédiée à l'objet `DateInterval <http://php.net/dateinterval>`_.

Si vous essayez de tester une variable qui n'est pas un objet ``DateInterval`` (ou une classe qui l'étend) avec cette assertion, cela échouera.

.. _date-interval-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isCloneOf <object-is-clone-of>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isIdenticalTo <object-is-identical-to>`


.. _date-interval-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isInstanceOf <object-is-instance-of>`


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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isNotEqualTo <object-is-not-equal-to>`


.. _date-interval-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isNotIdenticalTo <object-is-not-identical-to>`


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
