.. _hash-anchor:

hash
****

C'est l'assertion dédiée aux tests sur les hashs (empreintes numériques).

.. _hash-contains:

contains
========

.. hint::
   ``contains`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::contains <string-contains>`


.. _hash-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _hash-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::isEqualToContentsOfFile <string-is-equal-to-contents-of-file>`


.. _hash-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _is-md5:

isMd5
=====

``isMd5`` checks that the string is a ``md5`` format, i.r. a hexadecimal string of 32 length.

.. code-block:: php

   <?php
   $hash    = hash('md5', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isMd5()       // passes
       ->hash($notHash)
           ->isMd5()       // fails
   ;

.. _hash-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _hash-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _is-sha1:

isSha1
======

``isSha1`` checks that the string is a ``sha1`` format, i.e. a hexadecimal string of 40 length.

.. code-block:: php

   <?php
   $hash    = hash('sha1', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isSha1()      // passes
       ->hash($notHash)
           ->isSha1()      // fails
   ;

.. _is-sha256:

isSha256
========

``isSha256`` checks that the string is a ``sha256`` format, i.e. a hexadecimal string of 64 length.

.. code-block:: php

   <?php
   $hash    = hash('sha256', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isSha256()    // passes
       ->hash($notHash)
           ->isSha256()    // fails
   ;

.. _is-sha512:

isSha512
========

``isSha512`` checks that the string is a ``sha512`` format, i.e. a hexadecimal string of 128 length.

.. code-block:: php

   <?php
   $hash    = hash('sha512', 'atoum');
   $notHash = 'atoum';

   $this
       ->hash($hash)
           ->isSha512()    // passes
       ->hash($notHash)
           ->isSha512()    // fails
   ;

.. _hash-not-contains:

notContains
===========

.. hint::
   ``notContains`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::notContains <string-not-contains>`
