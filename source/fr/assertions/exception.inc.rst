.. _exception-anchor:

exception
*********

C'est l'assertion dédiée aux exceptions.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
   ;

.. note::
   La syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3.
   Pour plus de précision, lisez la documentation PHP sur `les fonctions anonymes <http://php.net/functions.anonymous>`_.

Nous pouvons même facilement récupérer la dernière exception via ``$this->exception``.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )->isIdenticalTo($this->exception)
   ;


.. _has-code:

hasCode
=======

``hasCode`` vérifie le code de l'exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception('Message', 42);
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasCode(42)
   ;

.. _has-default-code:

hasDefaultCode
==============

``hasDefaultCode`` vérifie que le code de l'exception est la valeur par défaut, c'est-à-dire 0.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception;
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasDefaultCode()
   ;

.. note::
   ``hasDefaultCode`` est équivalent à ``hasCode(0)``.


.. _has-message:

hasMessage
==========

``hasMessage`` vérifie le message de l'exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasMessage('Message')     // passe
           ->hasMessage('message')     // échoue
   ;

.. _has-nested-exception:

hasNestedException
==================

``hasNestedException`` vérifie que l'exception contient une référence vers l'exception précédente. Si l'exception est précisée, cela va également vérifier la classe de l'exception.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() use($myObject) {
               // ce code lève une exception: throw new \Exception('Message');
               $myObject->doOneThing('wrongParameter');
           }
       )
           ->hasNestedException()      // échoue

       ->exception(
           function() use($myObject) {
               try {
                   // ce code lève une exception: throw new \FirstException('Message 1', 42);
                   $myObject->doOneThing('wrongParameter');
               }
               // ... l'exception est attrapée...
               catch(\FirstException $e) {
                   // ... puis relancée, encapsulée dans une seconde exception
                   throw new \SecondException('Message 2', 24, $e);
               }
           }
       )
           ->isInstanceOf('\FirstException')           // échoue
           ->isInstanceOf('\SecondException')          // passe

           ->hasNestedException()                      // passe
           ->hasNestedException(new \FirstException)   // passe
           ->hasNestedException(new \SecondException)  // échoue
   ;

.. _exception-is-clone-of:

isCloneOf
=========

.. hint::
   ``isCloneOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isCloneOf <object-is-clone-of>`


.. _exception-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isEqualTo <object-is-equal-to>`


.. _exception-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isIdenticalTo <object-is-identical-to>`


.. _exception-is-instance-of:

isInstanceOf
============

.. hint::
   ``isInstanceOf`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isInstanceOf <object-is-instance-of>`


.. _exception-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isNotEqualTo <object-is-not-equal-to>`


.. _exception-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``object``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`object::isNotIdenticalTo <object-is-not-identical-to>`


.. _message-anchor:

message
=======

``message`` vous permet de récupérer un asserter de type :ref:`string <string-anchor>` contenant le message de l'exception testée.

.. code-block:: php

   <?php
   $this
       ->exception(
           function() {
               throw new \Exception('My custom message to test');
           }
       )
           ->message
               ->contains('message')
   ;
