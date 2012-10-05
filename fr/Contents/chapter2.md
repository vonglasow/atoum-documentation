# Écrire ses tests

## Assertions

### variable

C'est l'assertion de base de toutes les variables. Elle contient les tests nécessaires à n'importe quel type de variable.

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
            ->isFalse()     // échoue

        ->boolean($false)
            ->isFalse()     // passe
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
Évidemment, les méthodes héritées d'integer (isEqualTo, isGreaterThan, isLessThan, etc...) utilisées à travers float attendent un nombre décimal et non plus un entier.

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
En effet, les nombres décimaux ont une valeur interne qui n'est pas assez précise. Essayez par exemple d'exécuter la commande suivante:

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

C'est l'assertion dédiée aux objets décrivant une date MySQL et basé sur l'objet [DateTime](http://php.net/datetime).
Les dates doivent utiliser le format MySQL (et de nombreux SGBD), c'est à dire 'Y-m-d H:i:s'
(Reportez vous à la documentation de la fonction [date()](http://php.net/date) du manuel PHP pour connaitre la signification de ce format).

Elle étend [dateTime](#dateTime), toutes ses méthodes sont donc disponibles dans cette assertion.

Si vous essayez de tester une variable qui n'est pas un objet DateTime (ou une classe qui l'étend) avec cette assertion, cela échouera.



### exception

C'est l'assertion dédiée aux exceptions.

Elle étend [objet](#object), toutes ses méthodes sont donc disponibles dans cette assertion.

    [php]
    $this
        ->exception(
            function () {
                // ce code lève une exception
                throw new \Exception;
            }
        )
    ;

**Note** : la syntaxe utilise les fonctions anonymes (aussi appelées fermetures ou closures) introduites en PHP 5.3.
Reportez vous au [manuel PHP](http://php.net/functions.anonymous) pour avoir plus d'informations sur le sujet.

    [php]
    $this
        ->exception(
            function () {
                throw new MyCataclysmicException('This a terrible error !');
            }
        )
            ->isInstanceOf('MyCataclysmicException')
            ->hasMessage('This a terrible error !')
    ;

#### hasCode

hasCode vérifie le code de l'exception.

    [php]
    $this
        ->exception(
            function () {
                throw new \Exception('Message', 42);
            }
        )
            ->hasCode(42)
    ;

#### hasDefaultCode

hasDefaultCode vérifie que le code de l'exception est bien 0.

    [php]
    $this
        ->exception(
            function () {
                throw new \Exception;
            }
        )
            ->hasDefaultCode()
    ;

#### hasMessage

hasMessage vérifie le message de l'exception.

    [php]
    $this
        ->exception(
            function () {
                throw new \Exception('Message');
            }
        )
            ->hasMessage('Message')     // passe
            ->hasMessage('message')     // échoue
    ;

#### hasNestedException

hasNestedException vérifie que l'exception contient une référence vers l'exception précédente.
Si l'exception est précisée, cela va également vérifier que c'est la bonne exception.

    [php]
    $this
        ->exception(
            function () {
                throw new \Exception('Message');
            }
        )
            ->hasNestedException()      // échoue

        ->exception(
            function () {
                try {
                    // Cette exception est levée...
                    throw new \FirstException('Message 1', 42);
                }
                // ... puis attrapée...
                catch(\FirstException $e) {
                    // ... et enfin relancée, encapsulée dans une seconde exception
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



### array

C'est l'assertion dédié aux tableaux.

Elle étend [variable](#variable), toutes ses méthodes sont donc disponibles dans cette assertion.

**Note** : le mot-clef "array" étant réservé en PHP, il n'a pas été possible de créer une classe "array".
La classe de l'assertion s'appelle donc "phpArray" et un alias "array" a été créé.
Vous pourrez donc rencontrer des ->phpArray() ou des ->array().
Il est conseillé d'utiliser exclusivement ->array().

#### contains

contains vérifie qu'un tableau contient une certaine donnée.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($fibonacci)
            ->contains('1')     // passe
            ->contains(1)       // passe, ne vérifie pas le type de la donnée
            ->contains('2')     // passe, ne vérifie pas le type de la donnée
            ->contains(10)      // échoue
    ;

**Note**: contains ne fait pas de recherche récursive.

**Note**: contains ne teste pas le type de la donnée. Si vous souhaitez vérifier également son type, utilisez [strictlyContains](#strictlycontains).

#### containsValues

containsValues vérifie qu'un tableau contient toutes les données fournies dans un tableau.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($array)
            ->containsValues(array(1, 2, 3))        // passe
            ->containsValues(array('5', '8', '13')) // passe
            ->containsValues(array(0, 1, 2))        // échoue
    ;

**Note**: containsValues ne fait pas de recherche récursive.

**Note**: containsValues ne teste pas le type des données. Si vous souhaitez vérifier également leurs types, utilisez [strictlyContainsValues](#strictlycontainsvalues).

#### hasKey

hasKey vérifie qu'un tableau contient une certaine clef.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
    $atoum     = array(
        'name'        => 'atoum',
        'owner'       => 'mageekguy',
        'description' => 'The modern, simple and intuitive PHP 5.3+ unit testing framework.',
    );

    $this
        ->array($fibonacci)
            ->hasKey(0)         // passe
            ->hasKey(1)         // passe
            ->hasKey('1')       // passe
            ->hasKey(10)        // échoue

        ->array($atoum)
            ->hasKey('name')    // passe
            ->hasKey('price')   // échoue
    ;

**Note**: hasKey ne fait pas de recherche récursive.

**Note**: hasKey ne teste pas le type des clef.

#### hasKeys

hasKeys vérifie qu'un tableau contient toutes les clefs fournies dans un tableau.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
    $atoum     = array(
        'name'        => 'atoum',
        'owner'       => 'mageekguy',
        'description' => 'The modern, simple and intuitive PHP 5.3+ unit testing framework.',
    );

    $this
        ->array($fibonacci)
            ->hasKeys(array(0, 2, 4))           // passe
            ->hasKeys(array('0', 2))            // passe
            ->hasKeys(array('4', 0, 3))         // passe
            ->hasKeys(array(0, 3, 10))          // échoue

        ->array($atoum)
            ->hasKeys(array('name', 'owner'))   // passe
            ->hasKeys(array('name', 'price'))   // échoue
    ;

**Note**: hasKeys ne fait pas de recherche récursive.

**Note**: hasKeys ne teste pas le type des clef.

#### hasSize

hasSize vérifie la taille d'un tableau.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($fibonacci)
            ->hasSize(7)        // passe
            ->hasSize(10)       // échoue
    ;

**Note**: hasSize n'est pas récursif.

#### isEmpty

isEmpty vérifie qu'un tableau est vide.

    [php]
    $emptyArray    = array();
    $nonEmptyArray = array(null, null);

    $this
        ->array($emptyArray)
            ->isEmpty()         // passe

        ->array($nonEmptyArray)
            ->isEmpty()         // échoue
    ;

#### isNotEmpty

isEmpty vérifie qu'un tableau n'est pas vide.

    [php]
    $emptyArray    = array();
    $nonEmptyArray = array(null, null);

    $this
        ->array($emptyArray)
            ->isNotEmpty()      // échoue

        ->array($nonEmptyArray)
            ->isNotEmpty()      // passe
    ;

#### notContains

notContains vérifie qu'un tableau ne contient pas une donnée.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($fibonacci)
            ->notContains(null)         // passe
            ->notContains(1)            // échoue
            ->notContains(10)           // passe
    ;

**Note**: notContains ne fait pas de recherche récursive.

**Note**: notContains ne teste pas le type de la donnée. Si vous souhaitez vérifier également son type, utilisez [strictlyNotContains](#strictlynotcontains).

#### notContainsValues

notContainsValues vérifie qu'un tableau ne contient aucune des données fournies dans un tableau.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($array)
            ->notContainsValues(array(1, 4, 10))    // échoue
            ->notContainsValues(array(4, 10, 34))   // passe
            ->notContainsValues(array(1, '2', 3))   // échoue
    ;

**Note**: notContainsValues ne fait pas de recherche récursive.

**Note**: notContainsValues ne teste pas le type des données. Si vous souhaitez vérifier également leurs types, utilisez [strictlyNotContainsValues](#strictlynotcontainsvalues).

#### notHasKey

notHasKey vérifie qu'un tableau ne contient pas une certaine clef.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
    $atoum     = array(
        'name'        => 'atoum',
        'owner'       => 'mageekguy',
        'description' => 'The modern, simple and intuitive PHP 5.3+ unit testing framework.',
    );

    $this
        ->array($fibonacci)
            ->notHasKey(0)          // échoue
            ->notHasKey(1)          // échoue
            ->notHasKey('1')        // échoue
            ->notHasKey(10)         // passe

        ->array($atoum)
            ->notHasKey('name')     // échoue
            ->notHasKey('price')    // passe
    ;

**Note**: notHasKey ne fait pas de recherche récursive.

**Note**: notHasKey ne teste pas le type des clef.

#### notHasKeys

notHasKeys vérifie qu'un tableau ne contient aucune des clefs fournies dans un tableau.

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');
    $atoum     = array(
        'name'        => 'atoum',
        'owner'       => 'mageekguy',
        'description' => 'The modern, simple and intuitive PHP 5.3+ unit testing framework.',
    );

    $this
        ->array($fibonacci)
            ->notHasKeys(array(0, 2, 4))            // échoue
            ->notHasKeys(array('0', 2))             // échoue
            ->notHasKeys(array('4', 0, 3))          // échoue
            ->notHasKeys(array(0, 3, 10))           // passe

        ->array($atoum)
            ->notHasKeys(array('name', 'owner'))    // échoue
            ->notHasKeys(array('name', 'price'))    // passe
    ;

**Note**: notHasKeys ne fait pas de recherche récursive.

**Note**: notHasKeys ne teste pas le type des clef.

#### strictlyContains

strictlyContains vérifie qu'un tableau contient une certaine donnée (même valeur et même type).

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($fibonacci)
            ->strictlyContains('1')     // passe
            ->strictlyContains(1)       // échoue
            ->strictlyContains('2')     // échoue
            ->strictlyContains(2)       // passe
            ->strictlyContains(10)      // échoue
    ;

**Note**: strictlyContains ne fait pas de recherche récursive.

**Note**: strictlyContains teste le type de la donnée. Si vous ne souhaitez pas vérifier son type, utilisez [contains](#contains).

#### strictlyContainsValues

strictlyContainsValues vérifie qu'un tableau contient toutes les données fournies dans un tableau (même valeur et même type).

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($array)
            ->strictlyContainsValues(array('1', 2, '3'))    // passe
            ->strictlyContainsValues(array(1, 2, 3))        // échoue
            ->strictlyContainsValues(array(5, '8', 13))     // passe
            ->strictlyContainsValues(array('5', '8', '13')) // échoue
            ->strictlyContainsValues(array(0, '1', 2))      // échoue
    ;

**Note**: strictlyContainsValues ne fait pas de recherche récursive.

**Note**: strictlyContainsValues teste le type des données. Si vous ne souhaitez pas vérifier leurs types, utilisez [containsValues](#containsvalues).

#### strictlyNotContains

strictlyNotContains vérifie qu'un tableau ne contient pas une donnée (même valeur et même type).

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($fibonacci)
            ->strictlyNotContains(null)         // passe
            ->strictlyNotContains('1')          // échoue
            ->strictlyNotContains(1)            // passe
            ->strictlyNotContains(10)           // passe
    ;

**Note**: strictlyNotContains ne fait pas de recherche récursive.

**Note**: strictlyNotContains teste le type de la donnée. Si vous ne souhaitez pas vérifier son type, utilisez [notContains](#notcontains).

#### strictlyNotContainsValues

strictlyNotContainsValues vérifie qu'un tableau ne contient aucune des données fournies dans un tableau (même valeur et même type).

    [php]
    $fibonacci = array('1', 2, '3', 5, '8', 13, '21');

    $this
        ->array($array)
            ->strictlyNotContainsValues(array('1', 4, 10))  // échoue
            ->strictlyNotContainsValues(array(1, 4, 10))    // passe
            ->strictlyNotContainsValues(array(4, 10, 34))   // passe
            ->strictlyNotContainsValues(array('1', 2, '3')) // échoue
            ->strictlyNotContainsValues(array(1, '2', 3))   // passe
    ;

**Note**: strictlyNotContainsValues ne fait pas de recherche récursive.

**Note**: strictlyNotContainsValues teste le type des données. Si vous ne souhaitez pas vérifier leurs types, utilisez [notContainsValues](#notcontainsvalues).



### string

C'est l'assertion dédié aux chaines de caractères.

Elle étend [variable](#variable), toutes ses méthodes sont donc disponibles dans cette assertion.

#### contains

contains vérifie qu'une chaine de caractère contient une autre chaine de caractère donnée.

    [php]
    $string = 'Hello world';

    $this
        ->string($string)
            ->contains('ll')    // passe
            ->contains(' ')     // passe
            ->contains('php')   // échoue
    ;

#### hasLength

hasLength vérifie la taille d'une chaine de caractères.

    [php]
    $string = 'Hello world';

    $this
        ->string($string)
            ->hasLength(11)     // passe
            ->hasLength(20)     // échoue
    ;

#### isEmpty

isEmpty vérifie qu'une chaine de caractères est vide.

    [php]
    $emptyString    = '';
    $nonEmptyString = 'atoum';

    $this
        ->string($emptyString)
            ->isEmpty()             // passe
    
        ->string($nonEmptyString)
            ->isEmpty()             // échoue
    ;

#### isEqualToContentsOfFile

isEqualToContentsOfFile vérifie qu'une chaine de caractère est égale au contenu d'un fichier donné par son chemin.

    [php]
    $this
        ->string($string)
            ->isEqualToContentsOfFile('/path/to/file')
    ;

**Note** : Si le fichier n'existe pas, le test échoue.

#### isNotEmpty

isNotEmpty vérifie qu'une chaine de caractères n'est pas vide.

    [php]
    $emptyString    = '';
    $nonEmptyString = 'atoum';

    $this
        ->string($emptyString)
            ->isNotEmpty()          // échoue
    
        ->string($nonEmptyString)
            ->isNotEmpty()          // passe
    ;

#### match

match will try to verify that the string matches a given regular expression.

    [php]
    $phone = '0102030405';
    $vdm   = 'Aujourd'hui, à 57 ans, mon père s'est fait tatouer une licorne sur l'épaule. VDM';

    $this
        ->string($phone)
            ->match('#0\d{7}#')

        ->string($vdm)
            ->match("#^Aujourd'hui.*VDM$#")
    ;



### castToString

C'est l'assertion dédié aux tests sur le transtypage d'objets en chaine de caractères.

Elle étend [string](#string), toutes ses méthodes sont donc disponibles dans cette assertion.

    [php]
    class AtoumVersion {
        private $version = '1.0';

        public function __toString() {
            return 'atoum v' . $this->version;
        }
    }

    $this
        ->castToString(new AtoumVersion())
            ->isEqualTo('atoum v1.0')
    ;



### hash

C'est l'assertion dédié aux tests sur les hashs (empreintes numériques).

Elle étend [string](#string), toutes ses méthodes sont donc disponibles dans cette assertion.

#### isMd5

isMd5 vérifie que la chaine de caractère est au format md5, c'est à dire une chaine hexadécimale de 32 caractères.

    [php]
    $hash    = hash('md5', 'atoum');
    $notHash = 'atoum';

    $this
        ->hash($hash)
            ->isMd5()       // passe
        ->hash($notHash)
            ->isMd5()       // échoue
    ;

#### isSha1

isSha1 vérifie que la chaine de caractère est au format sha1, c'est à dire une chaine hexadécimale de 40 caractères.

    [php]
    $hash    = hash('sha1', 'atoum');
    $notHash = 'atoum';

    $this
        ->hash($hash)
            ->isSha1()      // passe
        ->hash($notHash)
            ->isSha1()      // échoue
    ;

#### isSha256

isSha256 vérifie que la chaine de caractère est au format sha256, c'est à dire une chaine hexadécimale de 64 caractères.

    [php]
    $hash    = hash('sha256', 'atoum');
    $notHash = 'atoum';

    $this
        ->hash($hash)
            ->isSha256()    // passe
        ->hash($notHash)
            ->isSha256()    // échoue
    ;

#### isSha512

isSha512 vérifie que la chaine de caractère est au format sha512, c'est à dire une chaine hexadécimale de 128 caractères.

    [php]
    $hash    = hash('sha512', 'atoum');
    $notHash = 'atoum';

    $this
        ->hash($hash)
            ->isSha512()    // passe
        ->hash($notHash)
            ->isSha512()    // échoue
    ;



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
            //La méthode setIWriter attend un objet
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
        //La méthode setWriter attend un objet
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

