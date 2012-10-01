# Écrire ses tests

## Assertions

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
            ->isIdenticalTo(1)          // échoue
    ;

    $stdClass1 = new StdClass();
    $stdClass2 = new StdClass();
    $stdClass3 = $stdClass1;

    $this
        ->variable($stdClass1)
            ->isIdenticalTo(stdClass3)  // passe
            ->isIdenticalTo(stdClass2)  // échoue
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
            ->isNotCallable()   // échoue

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
            ->isNotEqualTo('b')     // passe
            ->isNotEqualTo('a')     // échoue
    ;

Tout comme [isEqualTo](#isequalto), isNotEqualTo ne vérifie pas le type des données, uniquement leurs valeurs.

    [php]
    $aString = '1';
    $aInt    = 1;

    $this
        ->variable($aString)
            ->isNotEqualTo($aInt)   // échoue
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
            ->isNotIdenticalTo(stdClass3)   // échoue
    ;

Si vous ne souhaitez pas vérifier le type des données, utilisez [isNotEqualTo](#isnotequalto).


#### isNull

isNull vérifie que la donnée testée est nulle.

    [php]
    $emptyString = '';
    $null        = null;

    $this
        ->variable($emptyString)
            ->isNull()              // échoue (c'est vide mais pas null)

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
            ->isNotNull()           // échoue
    ;



### boolean

C'est l'assertion dédiée aux booléens.
Elle étend [variable](#variable), toutes ses méthodes sont donc disponibles dans cette assertion.

Si vous essayez de tester une variable qui n'est pas un booléen avec cette assertion, cela échouera.

    [php]
    $a = 'true';

    $this
        ->boolean($a)   // échoue car $a n'est pas un booléen
    ;

**Note** : null n'est pas considéré comme un booléen.
Reportez vous au manuel PHP pour voir ce que [is_bool](http://php.net/is_bool) considère ou non comme un booléen.

#### isFalse

isFalse vérifie que la donnée testée est strictement égale à false.

    [php]
    $true  = true;
    $false = false;

    $this
        ->boolean($true)
            ->isTrue()      // échoue

        ->boolean($false)
            ->isTrue()      // passe
    ;

#### isTrue

isTrue vérifie que la donnée testée est strictement égale à true.

    [php]
    $true  = true;
    $false = false;

    $this
        ->boolean($true)
            ->isTrue()      // passe

        ->boolean($false)
            ->isTrue()      // échoue
    ;



### integer

C'est l'assertion dédiée aux entiers.
Elle étend [variable](#variable), toutes ses méthodes sont donc disponibles dans cette assertion.

Si vous essayez de tester une variable qui n'est pas un entier avec cette assertion, cela échouera.

    [php]
    $a = '1';

    $this
        ->integer($a)       // échoue car "1" n'est pas un entier mais une chaine de caractère
    ;

**Note** : null n'est pas considéré comme un entier.
Reportez vous au manuel PHP pour voir ce que [is_int](http://php.net/is_int) considère ou non comme un entier.

#### isGreaterThan

isGreaterThan vérifie que la donnée testée est strictement supérieure à une valeur donnée.

    [php]
    $zero = 0;

    $this
        ->integer($zero)
            ->isGreaterThan(-1)     // passe
            ->isGreaterThan('-1')   // échoue car "-1" n'est pas un entier
            ->isGreaterThan(0)      // échoue
    ;

**Note** : la valeur donnée à isGreaterThan doit être un entier.

#### isGreaterThanOrEqualTo

isGreaterThanOrEqualTo vérifie que la donnée testée est supérieure ou égale à une valeur donnée.

    [php]
    $zero = 0;

    $this
        ->integer($zero)
            ->isGreaterThanOrEqualTo(-1)    // passe
            ->isGreaterThanOrEqualTo(0)     // passe
            ->isGreaterThanOrEqualTo('-1')  // échoue car "-1" n'est pas un entier
    ;

**Note** : la valeur donnée à isGreaterThanOrEqualTo doit être un entier.

#### isLessThan

isLessThan vérifie que la donnée testée est strictement inférieure à une valeur donnée.

    [php]
    $zero = 0;

    $this
        ->integer($zero)
            ->isLessThan(10)    // passe
            ->isLessThan('10')  // échoue car "10" n'est pas un entier
            ->isLessThan(0)     // échoue
    ;

**Note** : la valeur donnée à isLessThan doit être un entier.

#### isLessThanOrEqualTo

isLessThanOrEqualTo vérifie que la donnée testée est inférieure ou égale à une valeur donnée.

    [php]
    $zero = 0;

    $this
        ->integer($zero)
            ->isLessThanOrEqualTo(10)       // passe
            ->isLessThanOrEqualTo(0)        // passe
            ->isLessThanOrEqualTo('10')     // échoue car "10" n'est pas un entier
    ;

**Note** : la valeur donnée à isLessThanOrEqualTo doit être un entier.

#### isZero

isZero vérifie que la donnée testée est égale à 0.

    [php]
    $zero    = 0;
    $notZero = -1;

    $this
        ->integer($zero)
            ->isZero()          // passe

        ->integer($notZero)
            ->isZero()          // échoue
    ;

**Note** : isZero est équivalent à isEqualTo(0).



### float

C'est l'assertion dédiée aux nombres décimaux.
Elle étend [integer](#integer), toutes ses méthodes sont donc disponibles dans cette assertion.
Évidemment, les méthodes héritées d'integer (isEqualTo, isGreaterThan, isLessThan, etc...) utilisées à travers float attende un nombre décimal et non plus un entier.

Si vous essayez de tester une variable qui n'est pas un nombre décimal avec cette assertion, cela échouera.

    [php]
    $a = '1';

    $this
        ->float($a)     // échoue car "1" n'est pas un nombre décimal mais une chaine de caractère
    ;

**Note** : null n'est pas considéré comme un nombre décimal.
Reportez vous au manuel PHP pour voir ce que [is_float](http://php.net/is_float) considère ou non comme un nombre décimal.

#### isNearlyEqualTo

isNearlyEqualTo vérifie que la donnée testée et suffisament égale à une valeur donnée.
En effet, les nombres décimaux ont une valeur interne qui est pas assez précise. Essayez par exemple d'exécuter la commande suivante:

    [bash]
    php -r 'var_dump(1 - 0.97 === 0.03);'
    bool(false)

Le résultat devrait pourtant être true. 

**Note** : pour avoir plus d'informations sur ce phénomène, reportez vous au [manuel PHP](http://php.net/types.float).

Cette méthode cherche donc à corriger le problème

    [php]
    $float = 1 - 0.97;

    $this
        ->float($float)
            ->isNearlyEqualTo(0.03) // passe
            ->isEqualTo(0.03)       // échoue
    ;

**Note** : pour avoir plus d'informations sur l'algorithme utilisé, consultez le [floating point guide](http://www.floating-point-gui.de/errors/comparison/).



### sizeOf

C'est l'assertion dédiée aux tests sur la taille des tableaux et des objets implémentants l'interface Countable.
Elle étend [integer](#integer), toutes ses méthodes sont donc disponibles dans cette assertion.

    [php]
    $array           = array(1, 2, 3);
    $countableObject = new GlobIterator('*');

    $this
        ->sizeOf($array)
            ->isEqualTo(3)  // passe

        ->sizeOf($countableObject)
            ->isGreatherThan(0)
    ;



### object

C'est l'assertion dédiée aux objets.
Elle étend [variable](#variable), toutes ses méthodes sont donc disponibles dans cette assertion.

Si vous essayez de tester une variable qui n'est pas un objet avec cette assertion, cela échouera.

    [php]
    $a = 1;

    $this
        ->object($a)    // échoue car 1 n'est pas un objet mais un entier
    ;

**Note** : null n'est pas considéré comme un objet.
Reportez vous au manuel PHP pour voir ce que [is_object](http://php.net/is_object) considère ou non comme un objet.

#### hasSize

hasSize vérifie la taille d'un objet qui implémente l'interface Countable.

    [php]
    $countableObject = new GlobIterator('*');

    $this
        ->object($countableObject)
            ->hasSize(3)
    ;

#### isCloneOf

isCloneOf vérifie qu'un objet est le clone d'un objet donné, c'est à dire que les objets sont égaux mais ne pointent pas vers la même instance.

    [php]
    $object1 = new StdClass;
    $object2 = new StdClass;
    $object3 = clone($object1);
    $object4 = new StdClass;
    $object4->foo = 'bar';

    $this
        ->object($object1)
            ->isCloneOf($object2)   // passe
            ->isCloneOf($object3)   // passe
            ->isCloneOf($object4)   // échoue
    ;

**Note** : pour avoir plus de précision sur la comparaison d'objet, reportez vous au [manuel PHP](php.net/language.oop5.object-comparison).

#### isEmpty

isEmpty vérifie que la taille d'un objet implémentant l'interface Countable est égale à 0.

    [php]
    $countableObject = new GlobIterator('atoum.php');

    $this
        ->object($countableObject)
            ->isEmpty()
    ;

**Note** : isEmpty est équivalent à hasSize(0).

#### isInstanceOf

isInstanceOf vérifie qu'un objet est:
* une instance de la classe donnée (abstraite ou non),
* une sous-classe de la classe donnée (abstraite ou non),
* une instance d'une classe (abstraite ou non) qui implémente l'interface donnée.

    [php]
    $object = new StdClass();

    $this
        ->object($object)
            ->isInstanceOf('\StdClass')     // passe
            ->isInstanceOf('\Iterator')     // échoue
    ;


    interface FooInterface
    {
        public function foo();
    }

    class FooClass implements FooInterface
    {
        public function foo()
        {
            echo "foo";
        }
    }

    class BarClass extends FooClass
    {
    }

    $foo = new FooClass;
    $bar = new BarClass;

    $this
        ->object($foo)
            ->isInstanceOf('\FooClass')     // passe
            ->isInstanceOf('\FooInterface') // passe
            ->isInstanceOf('\BarClass')     // échoue
            ->isInstanceOf('\StdClass')     // échoue

        ->object($bar)
            ->isInstanceOf('\FooClass')     // passe
            ->isInstanceOf('\FooInterface') // passe
            ->isInstanceOf('\BarClass')     // passe
            ->isInstanceOf('\StdClass')     // échoue
    ;

**Note** : Les noms des classes et des interfaces doit être absolu et commencé par un antislash.


### dateTime

C'est l'assertion dédiée à l'objet [DateTime](http://php.net/datetime).
Elle étend [object](#object), toutes ses méthodes sont donc disponibles dans cette assertion.

Si vous essayez de tester une variable qui n'est pas un objet DateTime (ou une classe qui l'étend) avec cette assertion, cela échouera.

#### hasDate

hasDate vérifie la partie date de l'objet DateTime.

    [php]
    $dt = new DateTime('1981-02-13');

    $this
        ->dateTime($dt)
            ->hasDate('1981', '02', '13')   // passe
            ->hasDate('1981', '2',  '13')   // passe
            ->hasDate(1981,   2,    13)     // passe
    ;

#### hasDateAndTime

hasDateAndTime vérifie la date et l'horaire de l'objet DateTime

    [php]
    $dt = new DateTime('1981-02-13 01:02:03');

    $this
        ->dateTime($dt)
            ->hasDateAndTime('1981', '02', '13', '01', '02', '03')  // passe
            ->hasDateAndTime('1981', '2',  '13', '1',  '2',  '3')   // passe
            ->hasDateAndTime(1981,   2,    13,   1,    2,    3)     // passe
    ;

#### hasDay

hasDay vérifie le jour de l'objet DateTime.

    [php]
    $dt = new DateTime('1981-02-13');

    $this
        ->dateTime($dt)
            ->hasDay(13)        // passe
    ;

#### hasHours

hasHours vérifie les heures de l'objet DateTime.

    [php]
    $dt = new DateTime('01:02:03');

    $this
        ->dateTime($dt)
            ->hasHours('01')    // passe
            ->hasHours('1')     // passe
            ->hasHours(1)       // passe
    ;

#### hasMinutes

hasMinutes vérifie les minutes de l'objet DateTime.

    [php]
    $dt = new DateTime('01:02:03');

    $this
        ->dateTime($dt)
            ->hasMinutes('02')  // passe
            ->hasMinutes('2')   // passe
            ->hasMinutes(2)     // passe
    ;

#### hasMonth

hasMonth vérifie le mois de l'objet DateTime.

    [php]
    $dt = new DateTime('1981-02-13');

    $this
        ->dateTime($dt)
            ->hasMonth(2)       // passe
    ;

#### hasSeconds

hasSeconds vérifie les secondes de l'objet DateTime.

    [php]
    $dt = new DateTime('01:02:03');

    $this
        ->dateTime($dt)
            ->hasSeconds('03')    // passe
            ->hasSeconds('3')     // passe
            ->hasSeconds(3)       // passe
    ;

#### hasTime

hasTime vérifie la partie horaire de l'objet DateTime

    [php]
    $dt = new DateTime('01:02:03');

    $this
        ->dateTime($dt)
            ->hasTime('01', '02', '03')     // passe
            ->hasTime('1',  '2',  '3')      // passe
            ->hasTime(1,    2,    3)        // passe
    ;

#### hasTimezone

hasTimezone vérifie le fuseau horaire de l'objet DateTime.

    [php]
    $dt = new DateTime();

    $this
        ->dateTime($dt)
            ->hasTimezone('Europe/Paris')
    ;

#### hasYear

hasYear vérifie l'année de l'objet DateTime.

    [php]
    $dt = new DateTime('1981-02-13');

    $this
        ->dateTime($dt)
            ->hasYear(1981)     // passe
    ;



### mysqlDateTime



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



### castToString



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



### output
### adapter
### afterDestructionOf



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



### mock

This is the asserter dedicated to test your code using mock objects.



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




### stream





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

