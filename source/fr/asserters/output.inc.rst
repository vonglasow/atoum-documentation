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
   For more details, read the PHP's documentation on `anonymous functions <http://php.net/functions.anonymous>`_.


.. _output-contains:

contains
========

.. hint::
   ``contains`` is a method inherited from the ``string`` asserter.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`string::contains <string-contains>`


.. _output-has-length:

hasLength
=========

.. hint::
   ``hasLength`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::hasLength <string-has-length>`


.. _output-has-length-greater-than:

hasLengthGreaterThan
====================

.. hint::
   ``hasLengthGreaterThan`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::hasLengthGreaterThan <string-has-length-greater-than>`


.. _output-has-length-less-than:

hasLengthLessThan
=================

.. hint::
   ``hasLengthLessThan`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::hasLengthLessThan <string-has-length-less-than>`


.. _output-is-empty:

isEmpty
=======

.. hint::
   ``isEmpty`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::isEmpty <string-is-empty>`


.. _output-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _output-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

.. hint::
   ``isEqualToContentsOfFile`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::isEqualToContentsOfFile <string-is-equal-to-contents-of-file>`


.. _output-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _output-is-not-empty:

isNotEmpty
==========

.. hint::
   ``isNotEmpty`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::isNotEmpty <string-is-not-empty>`


.. _output-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _output-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` is a method inherited from the ``variable`` asserter.
   For more information, refer to the documentation of :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _output-matches:

matches
=======

.. hint::
   ``matches`` is a method inherited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::match <string-matches>`


.. _output-not-contains:

notContains
===========

.. hint::
   ``notContains`` is a method herited from the ``string`` asserter.
   For more information, refer to the documentation of :ref:`string::notContains <string-not-contains>`
