Contribute
==========


How to contribute
------------------

.. important::
   We need help to write this section !


.. _convention-de-codage:

Coding convention
--------------------
The source code of atoum follows some conventions. If you wish to contribute to this project, your code must need to follow the same rules:

* The indentation is done with the tab character
* The names of namespaces, classes, members, methods, and constants are in ``lowerCamelCase``
* The code must be tested

The example below makes no sense but it allows to present more in detail the way in which the code is written:

.. code-block:: php

   <?php

   namespace mageekguy\atoum\coding;

   use
       mageekguy\atoum,
       type\hinting
   ;

   class standards
   {
       const standardsConst = 'standardsConst';
       const secondStandardsConst = 'secondStandardsConst';

       public $public;
       protected $protected;
       private $private = array();

       public function publicFunction($parameter, hinting\class $optional = null)
       {
           $this->public = trim((string) $parameter);
           $this->protected = $optional ?: new hinting\class();

           if (($variable = $this->protectedFunction()) === null)
           {
               throw new atoum\exception();
           }

           $flag = 0;
           switch ($variable)
           {
               case self::standardsConst:
                   $flag = 1;
                   break;

               case self::standardsConst:
                   $flag = 2;
                   break;

               default:
                   return null;
           }

           if ($flag < 2)
           {
               return false;
           }
           else
           {
               return true;
           }
       }

       protected function protectedFunction()
       {
           try
           {
               return $this->protected->get();
           }
           catch (atoum\exception $exception)
           {
               throw new atoum\exception\runtime();
           }
       }

       private function privateFunction()
       {
           $array = $this->private;

           return function(array $param) use ($array) {
               return array_merge($param, $array);
           };
       }
   }


Also here is an example of a unit test:

.. code-block:: php

   <?php

   namespace tests\units\mageekguy\atoum\coding;

   use
       mageekguy\atoum,
       mageekguy\atoum\coding\standards as testedClass
   ;

   class standards extends atoum\test
   {
       public function testPublicFunction()
       {
           $this
               ->if($object = new testedClass())
               ->then
                   ->boolean($object->publicFunction(testedClass::standardsConst))->isFalse()
                   ->boolean($object->publicFunction(testedClass::secondStandardsConst))->isTrue()
               ->if($mock = new \mock\type\hinting\class())
               ->and($this->calling($mock)->get = null)
               ->and($object = new testedClass())
               ->then
                   ->exception(function() use ($object) {
                               $object->publicFunction(uniqid());
                           }
                       )
                           ->IsInstanceOf('\\mageekguy\\atoum\\exception')
           ;
       }
   }

