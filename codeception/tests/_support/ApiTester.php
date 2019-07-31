<?php

use Codeception\Util\Fixtures;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class ApiTester extends \Codeception\Actor
{
    use _generated\ApiTesterActions;

    private $currentUser = null;

    public function becomeUser( $name, $data = [] ) {
        if ( $this->currentUser ) {
            $this->saveSessionSnapshot( "API-USER-{$this->currentUser}" );
        }

        $data = Fixtures::get( "API-USER-$name" );

        $this->loadSessionSnapshot( "API-USER-$name" );

        // FIXME: ensure snapshot is saved automatically after every test
        return $data;
    }
}
