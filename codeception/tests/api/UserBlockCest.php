<?php 

class UserBlockCest {

    // tests
    public function testBlockUser(ApiTester $I) {
        $I->wantTo( 'Block a user' );
        $I->becomeUser( 'Mindy' );

        $eve = $I->getNewAgent( 'Eve' );

        $title = $I->getNewTitle( 'BlockUser_' );

        $eve->editPage( $title, 'one', 'first edit' );
        $eve->seeResponseContainsJsonPath( 'edit.result', 'Success' );

        $I->sendAction(
            [ 'action' => 'block',
                'user' => $eve->name,
                'reason' => 'testing',
            ],
            [
                'token' => $I->getUserData()->tokens->csrf
            ]
        );
        $I->seeResponseContainsJsonPath( 'block.result', 'Success' );

        $eve->editPage( $title, 'two', 'second edit' );
        $eve->seeResponseContainsJsonPath( 'error.code', 'permissiondenied' );

        $I->sendAction(
            [ 'action' => 'unblock',
                'user' => $eve->name,
                'reason' => 'testing',
            ],
            [
                'token' => $mindy->tokens->csrf
            ]
        );
        $I->seeResponseContainsJsonPath( 'unblock.result', 'Success' );

        $eve->editPage( $title, 'three', 'third edit' );
        $eve->seeResponseContainsJsonPath( 'edit.result', 'Success' );
    }
}
