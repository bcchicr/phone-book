<?php

namespace Bcchicr\StudentList\Container;

use PHPUnit\Framework\TestCase;

class CallableDefinitionTest extends TestCase
{
    public function testResolve(): void
    {
        $container = new Container();
        $id = 'test';
        $value = 'resolve';
        
        $definition = new CallableDefinition($id, fn () => $value);
        $this->assertEquals($value, $definition->resolve($container));
    }
}
