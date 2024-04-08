<?php

namespace Bcchicr\Framework\Http;

use PHPUnit\Framework\TestCase;
use Bcchicr\Framework\Http\Foundation\Stream;

class StreamTest extends TestCase
{
    public function testBasic()
    {
        $stream = Stream::create('test');

        $this->assertEquals(4, $stream->getSize());
        $this->assertEquals(0, $stream->tell());
        $this->assertFalse($stream->eof());
        $this->assertTrue($stream->isSeekable());
        $this->assertTrue($stream->isReadable());
        $this->assertTrue($stream->isWritable());
        $this->assertEquals('test', $stream->read(5));
        $this->assertTrue($stream->eof());
        $stream->rewind();
        $this->assertEquals(0, $stream->tell());
        $stream->seek(0, SEEK_END);
        $this->assertEquals(3, $stream->write('php'));
        $stream->rewind();
        $this->assertEquals('testphp', $stream->getContents());
        $this->assertEquals(7, $stream->tell());
        $this->assertEquals(7, $stream->getSize());
    }
}
