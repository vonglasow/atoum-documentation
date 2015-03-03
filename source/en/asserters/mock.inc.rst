.. _mock-asserter:

mock
****

This is the asserter for mocks.

.. code-block:: php

   <?php
   $mock = new \mock\MyClass;

   $this
       ->mock($mock)
   ;

.. note::
   Refer to the documentation on :ref:`mock <les-bouchons-mock>` for more information on how to create and manage mocks.


.. _call-anchor:

call
====

``call`` let you specify which method of the mock to check, his call must be followed by a call to one of the following verification method like `atLeastOnce`_, `once/twice/thrice`_, `exactly`_, etc...

.. code-block:: php

   <?php

   $this
       ->given($mock = new \mock\MyFirstClass)
       ->and($object = new MySecondClass($mock))

       ->if($object->methodThatCallMyMethod())  // This will call myMethod from $mock
       ->then

       ->mock($mock)
           ->call('myMethod')
               ->once()
   ;

.. _at-least-once:

atLeastOnce
```````````

``atLeastOnce`` check that the tested method (see :ref:`call <call-anchor>`) from the mock has been called at least once.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->atLeastOnce()
   ;

.. _exactly-anchor:

exactly
```````

``exactly`` check that the tested method (see :ref:`call <call-anchor>`) has been called a specific number of times.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->exactly(2)
   ;

.. _never-anchor:

never
`````

``never`` check that the tested method (see :ref:`call <call-anchor>`) has never been called.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->never()
   ;

.. note::
   ``never`` is equivalent to ``:ref:`exactly <exactly-anchor>`(0)``.


.. _once-twice-thrice:

once/twice/thrice
`````````````````
This asserters check that the tested method (see :ref:`call <call-anchor>`) from the tested mock has been called exactly:

* once
* twice
* thrice

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->once()
           ->call('mySecondMethod')
               ->twice()
           ->call('myThirdMethod')
               ->thrice()
   ;

.. note::
   ``once``, ``twice`` and ``thrice`` are respectively equivalent to ``:ref:`exactly <exactly-anchor>`(1)``, ``:ref:`exactly <exactly-anchor>`(2)`` and ``:ref:`exactly <exactly-anchor>`(3)``.


.. _with-any-arguments:

withAnyArguments
````````````````

``withAnyArguments`` permet de ne pas spécifier les arguments attendus lors de l'appel à la méthode testée (voir :ref:`call <call-anchor>`) du mock testé.

Cette méthode est surtout utile pour remettre à zéro les arguments, comme dans l'exemple suivant :

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->withArguments('first')     ->once()
               ->withArguments('second')    ->once()
               ->withAnyArguments()->exactly(2)
   ;

.. _with-arguments:

withArguments
`````````````

``withArguments`` permet de spécifier les paramètres attendus lors de l'appel à la méthode testée (voir :ref:`call <call-anchor>`) du mock testé.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->withArguments('first', 'second')->once()
   ;

.. warning::
   | ``withArguments`` ne teste pas le type des arguments.
   | Si vous souhaitez vérifier également leurs types, utilisez :ref:`withIdenticalArguments <with-identical-arguments>`.


.. _with-identical-arguments:

withIdenticalArguments
``````````````````````

``withIdenticalArguments`` permet de spécifier les paramètres attendus lors de l'appel à la méthode testée (voir :ref:`call <call-anchor>`) du mock testé.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->call('myMethod')
               ->withIdenticalArguments('first', 'second')->once()
   ;

.. warning::
   | ``withIdenticalArguments`` teste le type des arguments.
   | Si vous ne souhaitez pas vérifier leurs types, utilisez :ref:`withArguments <with-arguments>`.


.. _was-called:

wasCalled
=========

``wasCalled`` vérifie qu'au moins une méthode du mock a été appelée au moins une fois.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->wasCalled()
   ;

.. _was-not-called:

wasNotCalled
============

``wasNotCalled`` vérifie qu'aucune méthode du mock n'a été appelée.

.. code-block:: php

   <?php
   $mock = new \mock\MyFirstClass;

   $this
       ->object(new MySecondClass($mock))

       ->mock($mock)
           ->wasNotCalled()
   ;
