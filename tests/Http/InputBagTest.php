<?php

namespace Bcchicr\StudentList\Http;

use Bcchicr\StudentList\Http\Exception\BadRequestException;
use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class InputBagTest extends TestCase
{
    public function testBasic()
    {
        $bag = new InputBag();

        $boolValue = false;
        $intValue = 1;
        $floatValue = 2.0;
        $stringValue = '3';
        $nullValue = null;
        $arrayValue = [
            $boolValue,
            $intValue,
            $floatValue,
            $stringValue,
            $nullValue
        ];

        $bag['bool'] = $boolValue;
        $bag['int'] = $intValue;
        $bag['float'] = $floatValue;
        $bag['string'] = $stringValue;
        $bag['null'] = $nullValue;
        $bag['array'] = $arrayValue;

        $this->assertEquals($boolValue, $bag['bool']);
        $this->assertEquals($intValue, $bag['int']);
        $this->assertEquals($floatValue, $bag['float']);
        $this->assertEquals($stringValue, $bag['string']);
        $this->assertEquals($nullValue, $bag['null']);
        $this->assertEquals($arrayValue, $bag['array']);
    }
    public function testSetWithoutKey()
    {
        $this->expectException(InvalidArgumentException::class);
        $bag = new InputBag();
        $bag[] = 'test';
    }
    public function testSetObject()
    {
        $this->expectException(InvalidArgumentException::class);
        $bag = new InputBag();
        $bag['incorrect'] = new DateTime();
    }
    public function testGetObject()
    {
        $this->expectException(BadRequestException::class);
        $bag = new InputBag(['incorrect' => new DateTime()]);
        $incorrect = $bag['incorrect'];
    }
}
