<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\REST;
use Codeception\Util\JsonArray;

class MediaWikiActionApiTester extends \Codeception\Module
{
    /** @return REST */
    private function getREST() {
        return $this->getModule('REST');
    }

    /** @return Uniq*/
    private function getUniq() {
        return $this->getModule('Uniq');
    }

    public function sendAction( $param, $data = [], $token = null ) {
        $param += [
            'format' => 'json',
        ];

        $rest = $this->getREST();

        if ( $token ) {
            $data['token'] = $this->getTokens( $token )[$token];
        }

        if ( $data ) {
            $rest->sendPOST( 'api.php', array_merge( $param, $data ) );
        } else {
            $rest->sendGET( 'api.php', $param );
        }

        $rest->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $rest->seeResponseIsJson();

        if ( $param['format'] === 'json' ) {
            return new JsonArray( $rest->grabResponse() );
        } else {
            return $rest->grabResponse();
        }
    }

    public function sendActionQuery( $param ) {
        $param += [
            'action' => 'query',
        ];

        return $this->sendAction( $param );
    }

    public function getTokens( ...$type ) {
        $json = $this->sendActionQuery(
            [
                'meta' => 'tokens',
                'type' => implode( '|', $type ),
            ]
        );
        return $json->filterByJsonPath( 'query.tokens' );
    }
}
