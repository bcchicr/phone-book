<?php

namespace Bcchicr\Framework\Models\Identity;

use PHPUnit\Framework\TestCase;

class IdentityObjectTest extends TestCase
{
    public function testBasic()
    {
        $studentIdentity = new StudentDataIdentity();
        $this->assertTrue($studentIdentity->isVoid());
        $studentIdentity = $studentIdentity->field('student_id');
        $this->assertFalse($studentIdentity->isVoid());
        $studentIdentity = $studentIdentity->ge(1);
        $this->assertEquals([
            [
                'name' => 'student_id',
                'operator' => '>=',
                'value' => 1
            ]
        ], $studentIdentity->getComps());
    }
}
