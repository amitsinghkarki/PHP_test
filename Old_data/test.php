<?php

// function hello($hello = '')
// {
//     if ($hello == true && !empty($hello)) {
//         return 'hello';
//     }

//     return 'bye';

// }

// echo hello(1);
/*
Suppose that you have to implement a class named Dragonball. This class must have an attribute named ballCount (which starts from 0) and a method iFoundaBall. When iFoundaBall is called, ballCount is increased by one. If the value of ballCount is equal to seven, then the message You can ask your wish is printed, and ballCount is reset to 0. How would you implement this class?
 */

class Dragonball
{

    public static $ballCount = 0;

    public static function iFoundaBall()
    {

        self::$ballCount += 1;
        if (self::$ballCount >= 7) {
            echo "<br/>You can ask your wish";
            return;
        }
        echo "</br>you found total " . self::$ballCount . " balls";

        return self::$ballCount;
    }
}
// $a = new Dragonball;
for ($i = 0; $i < 10; $i++) {

    Dragonball::iFoundaBall();
}

// *
// **
// ***

// for ($i = 0; $i < 3; $i++) {
//     for ($j = 0; $j <= $i; $j++) {
//         echo "*";
//     }
//     echo '</br>';
// }
