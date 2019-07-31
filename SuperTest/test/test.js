const request = require('supertest');
const console = require('console');

const target = 'http://default.web.mw.localhost:8080/mediawiki/';

describe('GET /index.php/Main_Page', function() {
  it('responds with HTML', function(done) {
	console.log( '/index.php/Main_Page' );
    request( target )
      .get('/index.php/Main_Page')
      .expect('Content-Type', /^text\/html/)
      .expect(200, done);
  });
});

