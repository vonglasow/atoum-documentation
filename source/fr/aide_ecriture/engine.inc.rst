

.. _@engine:

Les moteurs d'exécution
***********************

Plusieurs moteurs d'exécutions des tests (au niveau de la classe ou des méthodes) existent. Ceux-ci sont configurables via l'annotation ``@engine``. Par défaut, les différents tests s'exécutent en parallèle, dans des sous-processus PHP, c'est le mode ``concurrent``.

Il existe actuellement trois modes d'exécution :
* *inline* : les tests s'exécutent dans le même processus, cela revient au même comportement que PHPUnit. Même si ce mode est très rapide, il n'y a pas d'isolation des tests.
* *isolate* : les tests s'exécutent de manière séquentielle dans un sous-processus PHP. Ce mode d'exécution est assez lent.
* *concurrent* : le mode par défaut, les tests s'exécutent en parallèle, dans des sous-processus PHP. 

Voici un exemple :

.. code-block:: php

  <?php
  
  /**
   * @engine concurrent
   */
  class Foo extends \atoum
  {
  	public function testBarWithBaz()
  	{
  		sleep(1);
  		$this->newTestedInstance;
  		$baz = new \Baz();
  		$this->object($this->testedInstance->setBaz($baz))
  			->isIdenticalTo($this->testedInstance);
  			
  		$this->string($this->testedInstance->bar())
  			->isIdenticalTo('baz');
  	}
  	
  	public function testBarWithoutBaz()
  	{
  		sleep(1);
  		$this->newTestedInstance;
  		$this->string($this->testedInstance->bar())
  			->isIdenticalTo('foo');
  	}
  }

En mode ``concurent`` :

.. code-block:: shell

=> Test duration: 2.01 seconds.
=> Memory usage: 0.50 Mb.
> Total test duration: 2.01 seconds.
> Total test memory usage: 0.50 Mb.
> Running duration: 1.08 seconds.


En mode ``inline`` :

.. code-block:: shell

=> Test duration: 2.01 seconds.
=> Memory usage: 0.25 Mb.
> Total test duration: 2.01 seconds.
> Total test memory usage: 0.25 Mb.
> Running duration: 2.01 seconds.


En mode ``isolate`` :

.. code-block:: shell

=> Test duration: 2.00 seconds.
=> Memory usage: 0.50 Mb.
> Total test duration: 2.00 seconds.
> Total test memory usage: 0.50 Mb.
> Running duration: 2.10 seconds.

