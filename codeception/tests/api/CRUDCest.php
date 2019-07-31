<?php 

class CRUDCest {
    public function _before(ApiTester $I) {
    }

    // tests
    public function testCreateEditDelete(ApiTester $I) {
        $I->wantTo( 'Create, edit, and delete' );

        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST( 'api.php',
                [ 'action' => 'edit',
                    'title' => 'Test',
                    'creatonly' => 'true',
                    'format' => 'json',
                    'summary' => 'some test',
                    'text' => 'test text',
                    'token' => '+\\',
                ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseContainsJson( [
            'edit' => [
                'result' => 'Success'
            ]
        ]);

        $I->sendGET( 'api.php',
            [ 'action' => 'parse',
                'page' => 'Test',
                'format' => 'json',
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatches( '/test text/');

        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST( 'api.php',
            [ 'action' => 'edit',
                'title' => 'Test',
                'format' => 'json',
                'summary' => 'some edit',
                'text' => 'edited test text',
                'token' => '+\\',
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseContainsJson( [
            'edit' => [
                'result' => 'Success'
            ]
        ]);

        $I->sendGET( 'api.php',
            [ 'action' => 'parse',
                'page' => 'Test',
                'format' => 'json',
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
        $I->seeResponseMatches( '/edited test text/');

        $I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');
        $I->sendPOST( 'api.php',
            [ 'action' => 'delete',
                'title' => 'Test',
                'format' => 'json',
                'token' => '+\\',
            ]
        );
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseContainsJson( [
            'delete' => [
                'title' => 'Test'
            ]
        ]);

        $I->sendGET( 'api.php',
            [ 'action' => 'parse',
                'page' => 'Test',
                'format' => 'json',
            ]
        );
        $I->seeResponseContainsJson( [
            'error' => [
                'code' => 'missingtitle'
            ]
        ]);
    }
}
