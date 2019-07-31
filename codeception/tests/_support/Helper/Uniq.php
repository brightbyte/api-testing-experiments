<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\REST;
use Codeception\Util\JsonArray;

class Uniq extends \Codeception\Module
{
    private static $counter = 0;

    public function uniq( $prefix = '', $suffix = '' ) {
        self::$counter ++;
        return $prefix . $this->format( self::$counter ) . $suffix;
    }

    private function format( $counter ) {
        // TODO: convert to alphabetic string with padding
        // TODO: add randomness
        return "$counter";
    }

}
