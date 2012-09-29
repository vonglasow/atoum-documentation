# Écrire ses tests

## Assertions

<!--
    variable
        isCallable
        isEqualTo
        isIdenticalTo
        isNotCallable
        isNotEqualTo
        isNotIdenticalTo
        isNotNull
        isNull
        isReferenceTo
    boolean
    integer
    float
    sizeOf
    object
    dateTime
    mysqlDateTime
    exception
    phpArray
    string
    castToString
    hash
    output
    adapter
    afterDestructionOf
    error
    mock
    phpClass
    testedClass
    stream
-->




### variable

C'est l'assertion de base de toutes les variables. Elle contient les tests de base nécessaire à n'importe quel type de variable.

#### isCallable

isCallable vérifie que la donnée testée peut être appelée comme fonction.

    [php]
    $f = function() {
        // code
    };

    $this
        ->variable($f)
            ->isCallable()  // passe

        ->variable('\Vendor\Application\foobar')
            ->isCallable()

        ->variable(array('\Vendor\Application\Foo', 'bar'))
            ->isCallable()

        ->variable('\Vendor\Application\Foo::bar')
            ->isCallable()
    ;


#### isEqualTo

isEqualTo vérifie que les données testées ont la même valeur.

    [php]
    $a = 'a';

    $this
        ->variable($a)
            ->isEqualTo('a')    // passe
    ;

isEqualTo ne vérifie pas le type des données, uniquement leurs valeurs.

    [php]
    $aString = '1';
    $aInt    = 1;

    $this
        ->variable($aString)
            ->isEqualTo($aInt)  // passe
    ;

**Note** : Quand vous testez des données de différents types avec isEqualTo, elles sont comparées avec l'opérateur "==".

Si vous souhaitez tester la valeur et le type, utilisez [isIdenticalTo](#isidenticalto).


#### isIdenticalTo

isIdenticalTo vérifie que les données testées ont la même valeur et sont de même types.
Dans le cas d'objet, isIdenticalTo vérifie que les données pointent la même instance.

    [php]
    $a = '1';

    $this
        ->variable($a)
            ->isIdenticalTo(1)          // ne passe pas
    ;

    $stdClass1 = new StdClass();
    $stdClass2 = new StdClass();
    $stdClass3 = $stdClass1;

    $this
        ->variable($stdClass1)
            ->isIdenticalTo(stdClass2)  // ne passe pas

        ->variable($stdClass1)
            ->isIdenticalTo(stdClass3)  // passe
    ;

Si vous ne souhaitez pas vérifier le type des données, utilisez [isEqualTo](#isequalto).


#### isNotCallable

isNotCallable vérifie que la donnée testée ne peut pas être appelée comme fonction.

    [php]
    $f = function() {
        // code
    };
    $int    = 1;
    $string = 'nonExistingMethod';

    $this
        ->variable($f)
            ->isNotCallable()   // ne passe pas

        ->variable($int)
            ->isNotCallable()   // passe

        ->variable($string)
            ->isNotCallable()   // passe
    ;


#### isNotEqualTo

isEqualTo vérifie que les données testées n'ont pas la même valeur.

    [php]
    $a = 'a';

    $this
        ->variable($a)
            ->isNotEqualTo('a')     // ne passe pas

        ->variable($a)
            ->isNotEqualTo('b')     // passe
    ;

Tout comme [isEqualTo](#isequalto), isNotEqualTo ne vérifie pas le type des données, uniquement leurs valeurs.

    [php]
    $aString = '1';
    $aInt    = 1;

    $this
        ->variable($aString)
            ->isNotEqualTo($aInt)   // ne passe pas
    ;


#### isNotIdenticalTo

isNotIdenticalTo vérifie que les données testées n'ont ni le même type, ni la même valeur.
Dans le cas d'objet, isNotIdenticalTo vérifie que les données ne pointent pas sur la même instance.

    [php]
    $a = '1';

    $this
        ->variable($a)
            ->isNotIdenticalTo(1)           // passe
    ;

    $stdClass1 = new StdClass();
    $stdClass2 = new StdClass();
    $stdClass3 = $stdClass1;

    $this
        ->variable($stdClass1)
            ->isNotIdenticalTo(stdClass2)   // passe

        ->variable($stdClass1)
            ->isNotIdenticalTo(stdClass3)   // ne passe pas
    ;

Si vous ne souhaitez pas vérifier le type des données, utilisez [isNotEqualTo](#isnotequalto).


#### isNull

isNull vérifie que la donnée testée est nulle.

    [php]
    $emptyString = '';
    $null        = null;

    $this
        ->variable($emptyString)
            ->isNull()              // ne passe pas (c'est vide mais pas null)

        ->variable($null)
            ->isNull()              // passe
    ;


#### isNotNull

isNotNull vérifie que la donnée testée n'est pas nulle.

    [php]
    $emptyString = '';
    $null        = null;

    $this
        ->variable($emptyString)
            ->isNotNull()           // passe (c'est vide mais pas null)

        ->variable($null)
            ->isNotNull()           // ne passe pass
    ;


### integer

This is the asserter dedicated to integer testing. It extends the variable asserter : You can use every assertions in the variable asserter while testing integers.

If you try to test a variable that is not an integer with the integer asserter, it will raise a failure.

    [php]
    $a1 = '1';

    $this
            ->integer($a1) //Will fail, a1 is not an integer, event if it represents one

Note

null is not considered as a valid integer. You can check PHP's is_int function to check what is considered an integer.

#### isZero

isZero verify that the tested variable is equal to 0.

    [php]
    $zero = 0;
    $minusOne = -1;

    $this
            ->integer($zero)
               ->isZero(); // Will pass

    $this
            ->integer($minusOne)
               ->isZero(); // Will fail

#### isLessThan

isLessThan verify that the tested integer is strictly less than a given integer.

    [php]
    $zero = 0;

    $this
            ->integer($zero)
               ->isLessThan(10); // Will pass

    $this
            ->integer($zero)
               ->isLessThan('10'); // Will fail, you have to pass an actual integer to isLessThan

    $this
            ->integer($zero)
               ->isLessThan(0); // Will fail, 0 is equal to 0

Note

values given to isLessThan must be actual integers.

#### isGreaterThan

isGreaterThan verify that the tested integer is strictly greater than a given integer.

    [php]
    $zero = 0;

    $this
            ->integer($zero)
               ->isGreaterThan(-1); // Will pass

    $this
            ->integer($zero)
               ->isGreaterThan('-1'); // Will fail, you have to pass an actual integer to isGreaterThan

    $this
            ->integer($zero)
               ->isGreaterThan(0); // Will fail, 0 is equal to 0


Note

values given to isGreaterThan must be actual integers.

#### isLessThanOrEqualTo

isLessThanOrEqualTo verify that the tested integer is less or equal to a given integer.

    [php]
    $zero = 0;

    $this
            ->integer($zero)
               ->isLessThanOrEqualTo(10); // Will pass

    $this
            ->integer($zero)
               ->isLessThanOrEqualTo('10'); // Will fail, you have to pass an actual integer to isLessThanOrEqualTo

    $this
            ->integer($zero)
               ->isLessThanOrEqualTo(0); // Will pass

Note

values given to isLessThanOrEqualTo must be actual integers.

#### isGreaterThanOrEqualTo

isGreaterThanOrEqualTo verify that the tested integer is greater or equal to a given integer.

    [php]
    $zero = 0;

    $this
            ->integer($zero)
               ->isGreaterThanOrEqualTo(-1); // Will pass

    $this
            ->integer($zero)
               ->isGreaterThanOrEqualTo('-1'); // Will fail, you have to pass an actual integer to isGreaterThanOrEqualTo

    $this
            ->integer($zero)
               ->isGreaterThanOrEqualTo(0); // Will pass


Note

values given to isGreaterThanOrEqualTo must be actual integers.

### float

This is the asserter dedicated to floating values testing.

It extends the integer asserter making it possible to test floating point values.

You can use every assertions that are present in the integer asserter.
Note

Of course, while testing float values, assertions that expected integers will expect float values (isGreaterThan, isGreaterOrEqualTo, isLessThan, isLessThanOrEqualTo)

### boolean

This is the asserter dedicated to boolean testing.

It extends the variable asserter.

#### isTrue

isTrue verify that the tested boolean is true (strictly equals to false).

    [php]
    $boolean = false;
    $boolean2 = true;

    $this
            ->boolean($boolean)
               ->isTrue(); // Will fail

    $this
            ->boolean($boolean2)
               ->isTrue(); // Will pass

#### isFalse

isFalse verify that the tested boolean is false (strictly equals to false).

    [php]
    $boolean = false;
    $boolean2 = true;

    $this
           ->boolean($boolean)
              ->isFalse(); // Will pass

    $this
           ->boolean($boolean2)
              ->isFalse(); // Will fail

### string

This is the asserter dedicated to string testing.

It extends the variable asserter : You can use every assertions of the variable asserter while testing a string.

#### isEmpty

isEmpty verify that the string is empty (no characters)

    [php]
    $emptyString = '';
    $nonEmptyString = ' ';

    $this
            ->string($emptyString)
                ->isEmpty();//Will pass
    $this
            ->string($nonEmptyString)
                ->isEmpty();//Will fail

#### isNotEmpty

isNotEmpty verify that the string is not empty (contains some characters)

    [php]
    $emptyString = '';
    $nonEmptyString = ' ';

    $this
            ->string($emptyString)
                ->isNotEmpty();//Will fail
    $this
            ->string($nonEmptyString)
                ->isNotEmpty();//Will pass

#### match

match will try to verify that the string matches a given regular expression.

    [php]
    $polite = 'Hello the world';
    $rude   = 'yeah... the world ';

    $this
            ->string($polite)
                ->match();//will pass

    $this
            ->string($rude)
                ->match();//will fail

#### hasLength

hasLength will verify that the string has a given length.

    [php]
    $string = 'Hello the world';

    $this
            ->string($string)
                ->hasLength(15);//Will pass

    $this
            ->string($string)
                ->hasLength(16);//Will fail

### dateTime

This is the asserter dedicated to DateTime testing.

It extends from the variable asserter : You can use every assertions of the variable asserter while testing a DateTime object.

#### hasTimezone

#### isInYear

#### isInMonth

#### isInDay

#### hasDate

### phpArray / array

This is the asserter dedicated to array testing.

It extends from the variable asserter : You can use every assertions of the variable asserter while testing arrays.

#### hasSize

hasSize will verify that the tested array has a given number of element (non recursive).

    [php]
    $array = array(1, 2, 3, 7);
    $this
            ->array($array)
            ->hasSize(4);//will pass

    $this
            ->array($array)
            ->hasSize(7);//Will fail

#### isEmpty

isEmpty will verify that the array is empty (does not contains any value)

    [php]
    $emptyArray = array();
    $nonEmptyArray = array(null, null);

    $this
            ->array($emptyArray)
            ->isEmpty();//will pass

    $this
            ->array($nonEmptyArray)
            ->isEmpty();//will fail

#### isNotEmpty

isEmpty will verify that the array is not empty (contains at least one value of any kind)

    [php]
    $emptyArray = array();
    $nonEmptyArray = array(null, null);

    $this
            ->array($emptyArray)
            ->isNotEmpty();//will fail

    $this
            ->array($nonEmptyArray)
            ->isNotEmpty();//will pass

#### contains

contains will verify that the tested array directly contains a given value (will not search for the value recursively).
contains will not test the type of the value.

If you want to test both the type and the value, you will use strictlyContains.

    [php]
    $arrayWithNull = array(null);
    $arrayWithEmptyString = array('', 1);
    $arrayWithArrayWithNull = array(array(null));
    $arrayWithString1 = array('1', 2, 3);

    $this
            ->array($arrayWithNull)
                ->contains(null);//will pass
            ->array($arrayWithEmptyString)
                ->contains(null)//will pass (null == '')
            ->array($arrayWithArrayWithNull)
                ->contains(null);//will fail, does not search recursively
            ->array($arrayWithString1)
                ->contains(1);//will pass, does not match the type

#### notContains

notContains will verify that the tested array does not contains a given value (will not search for the value recursively).
notContains will not test the type of the value.

If you want to test both the type and the value, you will use strictlyNotContains.

    [php]
    $arrayWithNull = array(null);
    $arrayWithEmptyString = array('', 1);
    $arrayWithArrayWithNull = array(array(null));
    $arrayWithString1 = array('1', 2, 3);

    $this
            ->array($arrayWithNull)
                ->notContains(null);//will fail
            ->array($arrayWithEmptyString)
                ->notContains(null)//will fail (null == '')
            ->array($arrayWithArrayWithNull)
                ->notContains(null);//will pass, does not search recursively
            ->array($arrayWithString1)
                ->notContains(1);//will fail, 1 == '1'

#### containsValues

containsValues will verify that the tested array does contains some values (given in an array)
containsValues will not test the type of the values to look for.

If you want to test both the types and the values, you will use strictlyContainsValues.

    [php]
    $arrayWithString1And2And3 = array('1', 2, 3);

    $this
            ->array($arrayWithString1And2And3)
                ->containsValues(array(1, 2, 3))//will pass
                ->containsValues(array('1', '2', '3'))//will pass
                ->containsValues(array('1, 2, 3));//will pass

#### notContainsValues

notContainsValues will verify that the tested array does not contains any value of a given array
notContainsValues will not test the type of the values to look for.

If you want to test both the types and the values, you will use strictlyNotContainsValues.

    [php]
    $arrayWithString1And2And3 = array('1', 2, 3);

    $this
            ->array($arrayWithString1And2And3)
                ->notContainsValues(array(1, 4, 5))//will faill as '1' is in the tested array
                ->notContainsValues(array(4, 6, '2'))//will fail as 2 is in the tested array
                ->notContainsValues(array('1', 2, 3))//will fail as all the values are in the tested array
                ->notContainsValues(array(4, 5, 6));//will pass as none of the values are in the tested array

#### strictlyContainsValues

strictlyContainsValues will verify that the tested array contains all the values of a given array
stricltyContainsValues will test the type of the values to look for.

If you do not want to test both the types and the values, you will use containsValues.

    [php]
    $arrayWithString1And2And3 = array('1', 2, 3);

    $this
            ->array($arrayWithString1And2And3)
                ->notContainsValues(array(1, 2, 3))//will faill as '1' is in the tested array, not 1
                ->notContainsValues(array('3', '2', '1'))//will fail as '3' and '2' are not in the tested array, but 2 and 3 are
                ->notContainsValues(array(2, '1', 3));//will pass as all the values are in the tested array

#### strictlyNotContainsValues

strictlyNotContainsValues will verify that the tested array does not contains any value of a given array
strictlyNotContainsValues will test the type of the values to look for.

If you do not want to test both the types and the values, you will use notContainsValues.

    [php]
    $arrayWithString1And2And3 = array('1', 2, 3);

    $this
            ->array($arrayWithString1And2And3)
                ->notContainsValues(array(1, 4, 5))//will pass as none of the values are in the tested array (1 !== '1')
                ->notContainsValues(array(4, 6, '2'))//will pass as none of the values are in the tested array (2 !== '2')
                ->notContainsValues(array('1', 2, 3))//will fail as all of the values are in the tested array
                ->notContainsValues(array(4, 5, 6));//will pass as none of the values are in the tested array

#### strictlyContains

contains will verify that the tested array directly contains a given value (will not search for the value recursively).
contains will test the type of the value.

If you do not want to test both the type and the value, you will use contains.

    [php]
    $arrayWithNull = array(null);
    $arrayWithEmptyString = array('', 1);
    $arrayWithArrayWithNull = array(array(null));
    $arrayWithString1 = array('1', 2, 3);

    $this
            ->array($arrayWithNull)
                ->strictlyContains(null)//will pass
            ->array($arrayWithEmptyString)
                ->strictlyContains(null)//will fail (null !== '')
            ->array($arrayWithArrayWithNull)
                ->strictlyContains(null)//will fail, does not search recursively
            ->array($arrayWithString1)
                ->strictlyContains(1)//will fail, 1 !== '1'
            ->array($arrayWithString1)
                ->strictlyContains('1');//Will pass

#### strictlyNotContains

strictlyNotContains will verify that the tested array does not contains a given value (will not search for the value recursively).
strictlyNotContains will test the type of the value.

If you do not want to test both the type and the value, you will use notContains.

    [php]
    $arrayWithNull = array(null);
    $arrayWithEmptyString = array('', 1);
    $arrayWithArrayWithNull = array(array(null));
    $arrayWithString1 = array('1', 2, 3);

    $this
            ->array($arrayWithNull)
                ->strictlyNotContains(null)//will fail
            ->array($arrayWithEmptyString)
                ->strictlyNotContains(null)//will pass (null !== '')
            ->array($arrayWithArrayWithNull)
                ->strictlyNotContains(null)//will pass, does not search recursively
            ->array($arrayWithString1)
                ->strictlyNotContains(1);//will pass, 1 !== '1'

#### hasKey

hasKey will verify that the given array has a given key

    [php]
    $array  = array(2, 4, 6);
    $array2 = array("2"=>1, "3"=>2, "4"=>3);

    $this
            ->array($array1)
                ->hasKey(1)//will pass
                ->hasKey(2)//will pass
                ->hasKey('1')//will pass, keys are "casted", and $array[1] do exists
                ->hasKey(5);//will fail
    $this
            ->array($array2)
                ->hasKey(2)//will pass
                ->hasKey("3")//will pass
                ->hasKey(0);//will fail

#### notHasKey

notHasKey will verify that the given array does not have a given key

    [php]
    $array  = array(2, 4, 6);
    $array2 = array("2"=>1, "3"=>2, "3"=>3);

    $this
            ->array($array1)
                ->notHasKey(1)//will fail
                ->notHasKey(2)//will fail
                ->notHasKey('1')//will fail, keys are "casted", and $array[1] do exists
                ->notHasKey(5);//will pass
    $this
            ->array($array2)
                ->notHasKey(2)//will fail
                ->notHasKey("3")//will fail
                ->notHasKey(0);//will pass

#### hasKeys

hasKeys will verify that the tested array contains all the given keyx (given as an array)

    [php]
    $array  = array(2, 4, 6);
    $array2 = array("2"=>1, "3"=>2, "4"=>3);

    $this
            ->array($array1)
                ->hasKeys(array(1, 2))//will pass
                ->hasKeys(array('0', 2))//will pass
                ->hasKeys(array("2", 0))//will pass
                ->hasKeys(array(0, 3))//will fail, $array[3] does not exists

    $this
            ->array($array2)
                ->hasKeys(array(2, "3"))//will pass
                ->hasKeys(array("3", 4));//will pass

#### notHasKeys

notHasKeys will verify that the tested array does not contains any of the given keys (given as an array of keys)

    [php]
    $array  = array(2, 4, 6);
    $array2 = array("2"=>1, "3"=>2, "4"=>3);

    $this
            ->array($array1)
                ->notHasKeys(array(1, 2))//will fail, all the keys exists in the tested array
                ->notHasKeys(array('0', 3))//will fail, $array['0'] exists
                ->notHasKeys(array("4", 5))//will pass, none of the keys exists in the tested array
                ->notHasKeys(array(3, 'two'))//will pass, none of the keys exists in the tested array

    $this
            ->array($array2)
                ->notHasKeys(array(2, "3"))//will pass
                ->notHasKeys(array("3", 4));//will pass

### sizeOf

This asserter is dedicated to test the length of an array.

It extends from the integer asserter : You can use every assertions of the integer asserter while testing the size of an array.

### object

This is the asserter dedicated to object testing.

It extends from the variable asserter : You can use every assertions of the variable asserter while testing an object.

#### isInstanceOf

isInstanceOf will tell if the tested object is an instance of a given interface and or a subclass of a given type.

    [php]
    $stdClass = new stdClass();
    $this
            ->object($stdClass)
                ->isInstanceOf('\StdClass')//Will pass
                ->isInstanceOf('\Iterator');//Will fail


    interface SomeInterface
    {
        public function doTest();
    }

    class SomeClass implements SomeInterface
    {
        public function doTest ()
        {
            echo "testing atoum is the best thing ever.";
        }
    }

    class SomeChildClass extends SomeClass
    {

    }

    $someClass = new SomeClass();
    $someClone = clone($someClass);
    $someChildClass = new SomeChildClass();

    $this
            ->object($someClass)
                ->isInstanceOf('\SomeClass')//will pass
                ->isInstanceOf('\SomeInterface')//will pass
                ->isInstanceOf('\SomeChildClass');//will fail

    $this
            ->object($someClone)
                ->isInstanceOf('\SomeClass')//will pass
                ->isInstanceOf('\SomeInterface')//will pass
                ->isInstanceOf('\SomeChildClass');//will fail

    $this
            ->object($someChildClass)
                ->isInstanceOf('\SomeClass')//will pass, inheritance
                ->isInstanceOf('\SomeInterface')//will pass, inheritance of interfaces
                ->isInstanceOf('\SomeChildClass');//will pass

#### hasSize

hasSize will check the size of an object. This assertion have sense mainly if your object implements the Countable
interface.


#### isEmpty

### phpClass / class

This is the asserter dedicated to class definition testing.

#### hasParent

#### hasNoParent

#### isSubclassOf

#### hasInterface

#### isAbstract

#### hasMethod

### testedClass

This is the asserter dedicated to the tested class definition testing.

It extends the phpClass (class) asserter : You can use every assertions of the phpClass asserter while testing the tested class.

### hash

This is the asserter dedicated to the validation of hashing function results.

It extends the string asserters : You can use every asertions of the string asserter while testing a hash.

#### isSha1

isSha1 verify that the given hash *could be* the result of a sha1 hash.

#### isSha256

isSha256 verify that the given hash *could be* the result of a sha256 hash.

#### isSha512

isSha256 verify that the given hash *could be* the result of a sha512 hash.

#### isMd5

md5 verify that the given hash *could be* the result of a md5 hash.

### error

This asserter is dedicated to error testing.

Again, atoum is nicely using closure to test errors (NOTICE, WARNING, …) :

    [php]
    class RaiseError extends atoum\test
    {
        public function testRaiseError ()
        {
            $error = new \RaiseError();

            $this->object($error);
            $this
                     ->when(function()use($error){
                            $error->raise();
                     })
                     ->error('This is an error', E_USER_WARNING)
                        ->exists();
                     //Sachant qu'il est possible de ne spécifier
                     // ni message ni type attendu.
        }
    }

#### exists

#### notExists

#### withType

#### withAnyType

#### withMessage

#### withAnyMessage

#### withPattern

### exception

This is the asserter dedicated to exception testing.

It extends from the object asserter : You can use every assertions of the object asserter while testing exceptions.

atoum takes part of closures to test exceptions.

    [php]
    $this
            ->exception(function () {
                //this code will raise an exception
                throw new Exception('This is an exception');
            })


            

To test exceptions atoum is using closures (introduced in PHP 5,3).

    [php]
    class ExceptionLauncher extends atoum\test
    {
        public function testLaunchException ()
        {
            $exception = new \ExceptionLauncher();
            $this
                     ->exception(function()use($exception){
                                    $exception->launchException();
                                })
                     ->isInstanceOf('LaunchedException')
                     ->hasMessage('Message in the exception');

        }
    }

#### hasDefaultCode

#### hasCode

#### hasMessage

#### hasNestedException

### mock

This is the asserter dedicated to test your code using mock objects.

## Fournisseur de données

## Les mock

Mocks are of course supported by atoum !
Generating a Mock from an interface

atoum can generate a mock directly from an interface.

    [php]
    class UsingWriter extends atoum\test
    {
        public function testWithMockedInterface ()
        {
            $this->mockGenerator->generate('\IWriter');
            $mockIWriter = new \mock\IWriter;

            $usingWriter = new \UsingWriter();
            //La méthode setIWriter attends un objet
            //qui implemente l'interface IWriter
            //  (setIWriter (IWriter $writer))
            $usingWriter->setIWriter($mockIWriter);

            $this
                    ->when(function () use($usingWriter) {
                                    $usingWriter->write('hello');
                    })
                    ->mock($mockIWriter)
                        ->call('write')
                        ->once();
        }
    }

### À partir d'une classe existante

atoum can generate a mock directly from a class definition.

    [php]
    public function testWithMockedObject ()
    {
        $this->mockGenerator->generate('\Writer');
        $mockWriter = new \mock\Writer;

        $usingWriter = new \UsingWriter();
        //La méthode setWriter attends un objet
        //de type Writer (setWriter (Writer $writer))
        $usingWriter->setWriter($mockWriter);

        $this
                ->when(function () use($usingWriter) {
                                $usingWriter->write('hello');
                })
                ->mock($mockWriter)
                    ->call('write')
                    ->once();
    }

There is also a shorter syntax to generate mock from a class definition.

    [php]
    public function testWithMockedObject ()
    {
        $mockWriter = new \mock\Writer;

        //...
    }

atoum is able to automatically find the class definition to mock on demand so you don't have to call the mock generator.

When requesting a mock instance for a class, do not forget to specify the full class path (including namespaces).

    [php]
    namespace Package\Writers
    {
        class SampleWriter implements Writer
        {
            //...
        }

    }

    namespace
    {
        class UsingWriter 
        {
            public function write(\Package\Writers\Writer $writer, $string) 
            {
                $writer->write($string);
            }
        }
    }

In this example, the class we want to mock lives in the Package\Writers namespace, so to request a mock in our test we should do :

    [php]
    namespace Package\test\units;

    class UsingWriter extends atoum\test
    {
        public function testWrite()
        {                     
            $this
                ->if($mockWriter = new \mock\Package\Writers\SampleWriter())
                ->then()
                    ->when(function() use($mockWriter) {
                        $usingWriter = new \UsingWriter();
                        $usingWriter->write($mockWriter, 'Hello World!');  
                    })  
                    ->mock($mockWriter)
                        ->call('write')
                        ->withArguments('Hello World!')
                        ->once()
            ;
        }
    }

### À partir de rien

atoum can also let you create and completely specify a mock object.

    [php]
    $this->mockGenerator->generate('WriterFree');
    $mockWriter = new \mock\WriterFree;
    $mockWriter->getMockController()->write = function($text){};

    $usingWriter = new \UsingWriter();
    $usingWriter->setFreeWriter($mockWriter);

    $this
            ->when(function () use($usingWriter) {
                            $usingWriter->write('hello');
            })
            ->mock($mockWriter)
                ->call('write')
                ->once();

