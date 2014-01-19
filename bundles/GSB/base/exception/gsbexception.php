<?php

namespace GSB\Base\Exception;

class GSBException
{
    public static function invalidArgument($message)
    {
        $location = self::location();

        //throw new \InvalidArgumentException($bt[1]['class'].$bt[1]['type'].$bt[1]['function'].'() [Line '.$bt[0]['line'].'] - '.$message);
        throw new \InvalidArgumentException($location['class'].$location['type'].$location['function'].' [Line '.$location['line'].'] - '.$message);
    }

    public static function database($message)
    {
        $location = self::location();

        throw new \InvalidArgumentException($location['class'].$location['type'].$location['function'].' [Line '.$location['line'].'] - '.$message);
    }

    public static function location()
    {
        $bt = debug_backtrace();
        //die('<pre>'.print_r($bt,true));

        $location['class'] = $bt[2]['class'];
        $location['type'] = $bt[2]['type'];
        $location['function'] = $bt[2]['function'].'()';
        $location['line'] = $bt[1]['line'];

        return $location;
    }
}