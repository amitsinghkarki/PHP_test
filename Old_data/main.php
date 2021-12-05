<?php

echo "<h1>hello World!</h1>";

class Dragonball
{
    private static $instances = [];

    protected function __construct()
    {}

    /**
     * Singletons should not be cloneable.
     */
    protected function __clone()
    {}

    /**
     * Singletons should not be restorable from strings.
     */
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public function __sleep()
    {
        echo "time to sleep";
    }
    public static $ballCount = 0;

    public static function getInstance(): Dragonball
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        return self::$instances[$cls];
    }
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
    $s1 = Dragonball::getInstance();
    $s1->iFoundaBall();
    echo $s1->__wakeup();
}
