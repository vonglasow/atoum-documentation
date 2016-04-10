.. _hash-anchor:

hash
****

C'est l'assertion dédiée aux tests sur les hashs (empreintes numériques).

.. _hash-contains:

contains
========

.. hint::
   ``contains`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`string::contains <string-contains>`


.. _hash-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _hash-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` est une méthode héritée de l'asserter ``string``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`string::isEqualToContentsOfFile <string-is-equal-to-contents-of-file>`


.. _hash-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _is-md5:

isMd5
=====

``isMd5`` vérifie que la chaîne de caractère est du format ``md5``, par exemple une chaîne de caractère d'une longueur de 32.

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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _hash-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _is-sha1:

isSha1
======

``isSha1`` vérifie que la chaîne de caractère est du format ``sha1``, par exemple une chaîne de caractère d'une longueur de 40.

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

``isSha256`` vérifie que la chaîne de caractère est du format ``sha256``, par exemple une chaîne de caractère d'une longueur de 64 caractères.

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

``isSha512`` vérifie que la chaîne de caractère est du format ``sha512``, c'est-à-dire,  une chaîne de caractère d'une longueur de 128 caractères.

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
   Pour plus d'informations, reportez-vous à la documentation de :ref:`string::notContains <string-not-contains>`
