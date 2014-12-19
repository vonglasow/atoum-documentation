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
