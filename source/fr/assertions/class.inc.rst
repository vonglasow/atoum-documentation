.. _class-anchor:

class
*****

C'est l'assertion dédiée aux classes.

.. code-block:: php

   <?php
   $object = new \StdClass;

   $this
       ->class(get_class($object))

       ->class('\StdClass')
   ;

.. note::
   Le mot-clef ``class`` étant réservé en PHP, il n'a pas été possible de créer une assertion ``class``. Elle s'appelle donc ``phpClass`` et un alias ``class`` a été créé. Vous pourrez donc rencontrer des ``->phpClass()`` ou des ``->class()``.


Il est conseillé d'utiliser exclusivement ``->class()``.

.. _has-constant:

hasConstant
===========

``hasConstant`` vérifie que la classe possède bien la constante testée.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasConstant('FOO')       // échoue

       ->class('\FilesystemIterator')
           ->hasConstant('CURRENT_AS_PATHNAME')       // passe
   ;

.. _has-interface:

hasInterface
============

``hasInterface`` vérifie que la classe implémente une interface donnée.

.. code-block:: php

   <?php
   $this
       ->class('\ArrayIterator')
           ->hasInterface('Countable')     // passe

       ->class('\StdClass')
           ->hasInterface('Countable')     // échoue
   ;

.. _has-method:

hasMethod
=========

``hasMethod`` vérifie que la classe contient une méthode donnée.

.. code-block:: php

   <?php
   $this
       ->class('\ArrayIterator')
           ->hasMethod('count')    // passe

       ->class('\StdClass')
           ->hasMethod('count')    // échoue
   ;

.. _has-no-parent:

hasNoParent
===========

``hasNoParent`` vérifie que la classe n'hérite d'aucune classe.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasNoParent()     // passe

       ->class('\FilesystemIterator')
           ->hasNoParent()     // échoue
   ;

.. warning::
   | Une classe peut implémenter une ou plusieurs interfaces et n'hériter d'aucune classe.
   | ``hasNoParent`` ne vérifie pas les interfaces, uniquement les classes héritées.

.. _has-parent:

hasParent
=========

``hasParent`` vérifie que la classe hérite bien d'une classe.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->hasParent()       // échoue

       ->class('\FilesystemIterator')
           ->hasParent()       // passe
   ;

.. warning::
   | Une classe peut implémenter une ou plusieurs interfaces et n'hériter d'aucune classe.
   | ``hasParent`` ne vérifie pas les interfaces, uniquement les classes héritées.


.. _is-abstract:

isAbstract
==========

``isAbstract`` vérifie que la classe est abstraite.

.. code-block:: php

   <?php
   $this
       ->class('\StdClass')
           ->isAbstract()       // échoue
   ;


.. _class-is-final:

isFinal
=======
``isFinal`` vérifie que la classe est finale.

Dans le cas suivant, nous testons une classe non final (``StdClass``) :

.. code-block:: php

	<?php
	$this
		->class('\StdClass')
			->isFinal()		// échoue
	;


Dans le cas suivant, la classe testée est une classe final

.. code-block:: php

	<?php
	$this
		->testedClass
			->isFinal()		// passe
	;

	$this
		->testedClass
			->isFinal		// passe aussi
	;


.. _is-subclass-of:

isSubclassOf
============

``isSubclassOf`` vérifie que la classe hérite de la classe donnée.

.. code-block:: php

   <?php
   $this
       ->class('\FilesystemIterator')
           ->isSubclassOf('\DirectoryIterator')    // passe
           ->isSubclassOf('\SplFileInfo')          // passe
           ->isSubclassOf('\StdClass')             // échoue
   ;
