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
