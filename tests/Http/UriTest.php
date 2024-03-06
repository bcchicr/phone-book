<?php

namespace Bcchicr\StudentList\Http;

use PHPUnit\Framework\TestCase;

class UriTest extends TestCase
{
    public function testUri()
    {
        $uriString = 'foo://example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals($uriString, (string)$uri);

        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals($uriString, (string)$uri);
    }
    public function testScheme()
    {
        $uriString = 'foo://example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('foo', $uri->getScheme());

        $uriString = 'FoO://example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('foo', $uri->getScheme());

        $uriString = '://example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getScheme());
    }
    public function testAuthority()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('user:pass@example.com:8042', $uri->getAuthority());

        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('user:pass@example.com:8042', $uri->getAuthority());

        $uriString = 'foo://user:pass@example.com/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('user:pass@example.com', $uri->getAuthority());

        $uriString = 'http://user:pass@example.com:80/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('user:pass@example.com', $uri->getAuthority());

        $uriString = 'https://example.com:443/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('example.com', $uri->getAuthority());

        $uriString = 'https://:pass@example.com:443/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals(':pass@example.com', $uri->getAuthority());

        $uriString = 'https:/';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getAuthority());
    }
    public function testUserInfo()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('user:pass', $uri->getUserInfo());

        $uriString = 'https://example.com:443/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getUserInfo());

        $uriString = 'https://:pass@example.com:443/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals(':pass', $uri->getUserInfo());

        $uriString = 'https://user@example.com:443/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('user', $uri->getUserInfo());
    }
    public function testHost()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('example.com', $uri->getHost());

        $uriString = 'foo:/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getHost());

        $uriString = 'foo://user:pass@ExAmPlE.cOm:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('example.com', $uri->getHost());
    }
    public function testPort()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals(8042, $uri->getPort());

        $uriString = 'foo://user:pass@example.com/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals(null, $uri->getPort());

        $uriString = 'http://user:pass@example.com:80/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals(null, $uri->getPort());
    }
    public function testPath()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('/over/there', $uri->getPath());

        $uriString = 'foo://user:pass@example.com:8042?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getPath());

        $uriString = 'foo://user:pass@example.com:8042/?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('/', $uri->getPath());

        $uriString = 'https://ru.wikipedia.org/wiki/Золотое_сечение';
        $uri = new Uri($uriString);
        $this->assertEquals(
            '/wiki/%D0%97%D0%BE%D0%BB%D0%BE%D1%82%D0%BE%D0%B5_%D1%81%D0%B5%D1%87%D0%B5%D0%BD%D0%B8%D0%B5',
            $uri->getPath()
        );
        $uriString = 'https://ru.wikipedia.org/wiki/%D0%97олотое_сечение';
        $uri = new Uri($uriString);
        $this->assertEquals(
            '/wiki/%D0%97%D0%BE%D0%BB%D0%BE%D1%82%D0%BE%D0%B5_%D1%81%D0%B5%D1%87%D0%B5%D0%BD%D0%B8%D0%B5',
            $uri->getPath()
        );
    }
    public function testQuery()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('name=ferret', $uri->getQuery());

        $uriString = 'foo://user:pass@example.com:8042#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getQuery());

        $uriString = 'https://ru.wikipedia.org/wiki?Золотое=сечение';
        $uri = new Uri($uriString);
        $this->assertEquals(
            '%D0%97%D0%BE%D0%BB%D0%BE%D1%82%D0%BE%D0%B5=%D1%81%D0%B5%D1%87%D0%B5%D0%BD%D0%B8%D0%B5',
            $uri->getQuery()
        );
    }
    public function testFragment()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $this->assertEquals('nose', $uri->getFragment());

        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret';
        $uri = new Uri($uriString);
        $this->assertEquals('', $uri->getFragment());

        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#Золотое';
        $uri = new Uri($uriString);
        $this->assertEquals('%D0%97%D0%BE%D0%BB%D0%BE%D1%82%D0%BE%D0%B5', $uri->getFragment());
    }
    public function testMutability()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $newUri = $uri
            ->withScheme('http')
            ->withUserInfo('')
            ->withHost('localhost')
            ->withPort(80)
            ->withPath('/test')
            ->withQuery('test=test')
            ->withFragment('test');
        $this->assertEquals('http://localhost/test?test=test#test', (string) $newUri);
    }
    public function testMutabilityNoChange()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);

        $uriScheme = $uri->withScheme('foo');
        $this->assertSame($uriScheme, $uri);

        $uriUserInfo = $uri->withUserInfo('user:pass');
        $this->assertSame($uriUserInfo, $uri);

        $uriHost = $uri->withHost('example.com');
        $this->assertSame($uriHost, $uri);

        $uriPort = $uri->withPort(8042);
        $this->assertSame($uriPort, $uri);

        $uriPath = $uri->withPath('/over/there');
        $this->assertSame($uriPath, $uri);

        $uriQuery = $uri->withQuery('name=ferret');
        $this->assertSame($uriQuery, $uri);

        $uriFragment = $uri->withFragment('nose');
        $this->assertSame($uriFragment, $uri);
    }
    public function testMutabilityUnset()
    {
        $uriString = 'foo://user:pass@example.com:8042/over/there?name=ferret#nose';
        $uri = new Uri($uriString);
        $newUri = $uri
            ->withScheme('')
            ->withUserInfo('')
            ->withHost('')
            ->withPort(null)
            ->withPath('')
            ->withQuery('')
            ->withFragment('');
        $this->assertEquals('', (string) $newUri);
    }
}
