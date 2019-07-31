<?php
class ApiCest 
{    
    public function tryApi(ApiTester $I)
    {
        $I->sendGET('api.php');
        $I->seeResponseCodeIs(200);
    }
}