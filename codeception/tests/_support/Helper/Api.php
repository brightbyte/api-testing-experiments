<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{
    public function seeResponseMatches( $regex )
    {
        $response = $this->getModule('REST')->response;
        $this->assertRegExp( $regex, $response );
    }
}
