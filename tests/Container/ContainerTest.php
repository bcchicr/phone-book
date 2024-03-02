<?php

namespace Bcchicr\StudentList\Container;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

class ContainerTest extends TestCase
{
    private Container $container;

    public function setUp(): void
    {
        $this->container = new Container();
    }
    public function testRegisterAndHas(): void
    {
        $this->container->register('test1', fn () => 'test');
        $isRegistered =  $this->container->has('test1');

        $this->assertTrue($isRegistered);
    }
    // public function testRegisterAndGet(): void
    // {
    //     $container = new Container();
    //     $string = 'test';
    //     $int = 1;
    //     $float = 2.5;
    //     $bool = false;
    //     $null = null;
    //     $array = [true, 2, 3.0, '4', null];
    //     $callback = function () {
    //         return "this is callback";
    //     };
    //     $className = Container::class;

    //     $test1 = is_callable($string);
    //     $test2 = is_callable($array);
    //     $test3 = is_callable($container);


    //     $container->register('string', $string);
    //     $container->register('array', $array);
    //     $container->register('callback', $callback);

    //     $this->assertEquals($container->get('string'), $string);
    //     $this->assertEquals($container->get('int'), $int);
    //     $this->assertEquals($container->get('float'), $float);
    //     $this->assertEquals($container->get('bool'), $bool);
    //     $this->assertNull($container->get('null'));
    //     $this->assertEquals($container->get('array'), $array);
    //     $this->assertEquals($container->get('callback'), 'this is callback');
    //     $container2 = $container->get('className');
    //     $container3 = $container->get('className');
    //     $this->assertInstanceOf(Container::class, $container2);
    //     $this->assertSame($container2, $container3);
    // }
}
