/*
const request = require('supertest');
const assert = require('assert');
const console = require('console');

const http = require('http');

var dummyServer = http.createServer( function () {} ).listen( 9999 );

var target = 'http://default.web.mw.localhost:8080/mediawiki/';

// httpProxy.createProxyServer( { target: target } );

describe('GET /index.php/Main_Page', function() {
  it('responds with HTML', function(done) {
	console.log( `${target}/index.php/Main_Page` );
    request( dummyServer )
      .get('http://default.web.mw.localhost:8080')
      .expect('Content-Type', /^text\/html/)
      .expect(200, done);
  });
});

dummyServer.close();
*/
const request = require('supertest');
const http = require('http');
const httpProxy = require('http-proxy');

var dummyServer = http.createServer();

request( proxyServer )
   .get('https://de.wikipedia.org/wiki/Hauptseite')
   .then(res => {
      console.log('Status ' + res.status);
      console.log('Body ' + res.body);
   });

dummyServer.close();
