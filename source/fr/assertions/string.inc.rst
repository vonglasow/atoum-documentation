.. _string-anchor:

string
******

C'est l'assertion dédiée aux chaînes de caractères.

.. _string-contains:

contains
========

``contains`` vérifie qu'une chaîne de caractère contient une autre chaîne de caractère donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->contains('ll')    // passe
           ->contains(' ')     // passe
           ->contains('php')   // échoue
   ;

.. _string-has-length:

hasLength
=========

``hasLength`` vérifie la taille d'une chaîne de caractères.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLength(11)     // passe
           ->hasLength(20)     // échoue
   ;

.. _string-has-length-greater-than:

hasLengthGreaterThan
====================

``hasLengthGreaterThan`` vérifie que la taille d'une chaîne de caractères est plus grande qu'une valeur donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLengthGreaterThan(10)     // passe
           ->hasLengthGreaterThan(20)     // échoue
   ;

.. _string-has-length-less-than:

hasLengthLessThan
=================

``hasLengthLessThan`` vérifie que la taille d'une chaîne de caractères est plus petite qu'une valeur donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->hasLengthLessThan(20)     // passe
           ->hasLengthLessThan(10)     // échoue
   ;

.. _string-is-empty:

isEmpty
=======

``isEmpty`` vérifie qu'une chaîne de caractères est vide.

.. code-block:: php

   <?php
   $emptyString    = '';
   $nonEmptyString = 'atoum';

   $this
       ->string($emptyString)
           ->isEmpty()             // passe

       ->string($nonEmptyString)
           ->isEmpty()             // échoue
   ;

.. _string-is-equal-to:

isEqualTo
=========

.. hint::
   ``isEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isEqualTo <variable-is-equal-to>`


.. _string-is-equal-to-contents-of-file:

isEqualToContentsOfFile
=======================

``isEqualToContentsOfFile`` vérifie qu'une chaîne de caractère est égale au contenu d'un fichier donné par son chemin.

.. code-block:: php

   <?php
   $this
       ->string($string)
           ->isEqualToContentsOfFile('/path/to/file')
   ;

.. note::
   si le fichier n'existe pas, le test échoue.


.. _string-is-identical-to:

isIdenticalTo
=============

.. hint::
   ``isIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isIdenticalTo <variable-is-identical-to>`


.. _string-is-not-empty:

isNotEmpty
==========

``isNotEmpty`` vérifie qu'une chaîne de caractères n'est pas vide.

.. code-block:: php

   <?php
   $emptyString    = '';
   $nonEmptyString = 'atoum';

   $this
       ->string($emptyString)
           ->isNotEmpty()          // échoue

       ->string($nonEmptyString)
           ->isNotEmpty()          // passe
   ;

.. _string-is-not-equal-to:

isNotEqualTo
============

.. hint::
   ``isNotEqualTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotEqualTo <variable-is-not-equal-to>`


.. _string-is-not-identical-to:

isNotIdenticalTo
================

.. hint::
   ``isNotIdenticalTo`` est une méthode héritée de l'asserter ``variable``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`variable::isNotIdenticalTo <variable-is-not-identical-to>`


.. _length-anchor:

length
======

``length`` vous permet de récupérer un asserter de type :ref:`integer <integer-anchor>` contenant la taille de la chaîne de caractères testée.

.. code-block:: php

   <?php
   $string = 'atoum'

   $this
       ->string($string)
           ->length
               ->isGreaterThanOrEqualTo(5)
   ;


.. _string-match:

match
=====

.. hint::
   ``match`` est un alias de la méthode ``matches``.
   Pour plus d'informations, reportez-vous à la documentation de :ref:`string::matches <string-matches>`


.. _string-matches:

matches
=======

``matches`` vérifie qu'une expression régulière correspond à la chaîne de caractères.

.. code-block:: php

   <?php
   $phone = '0102030405';
   $vdm   = "Aujourd'hui, à 57 ans, mon père s'est fait tatouer une licorne sur l'épaule. VDM";

   $this
       ->string($phone)
           ->matches('#^0[1-9]\d{8}$#')

       ->string($vdm)
           ->matches("#^Aujourd'hui.*VDM$#")
   ;

.. _string-not-contains:

notContains
===========

``notContains`` vérifie qu'une chaîne de caractère ne contient pas une autre chaîne de caractère donnée.

.. code-block:: php

   <?php
   $string = 'Hello world';

   $this
       ->string($string)
           ->notContains('php')   // passe
           ->notContains(';')     // passe
           ->notContains('ll')    // échoue
           ->notContains(' ')     // échoue
   ;
