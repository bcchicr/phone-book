<?php

namespace Bcchicr\Framework\Models\Assembler;

use PHPUnit\Framework\TestCase;
use Bcchicr\Framework\App\Application;
use Bcchicr\Framework\Models\Factory\UserFactory;
use Bcchicr\Framework\Models\StudentData;
use Bcchicr\Framework\Models\Identity\StudentDataIdentity;
use Bcchicr\Framework\Models\Identity\UserIdentity;
use Bcchicr\Framework\Models\User;
use DateTime;

class ModelAssemblerTest extends TestCase
{
    private Application $app;
    public function setUp(): void
    {
        $this->app = require_once __DIR__ . '/../../../bootstrap.php';
    }
    public function testBasic()
    {
        /**
         * @var UserAssembler
         */
        $assembler = $this->app->get(UserAssembler::class);
        $studentData = new StudentData(null, 'name1', 'surname1', 'm', new DateTime(), 'g100', 100);
        $user = new User(1, 'login1', 'email1', 'pass1', $studentData);
        $assembler->upsert($user);
        $collection = $assembler->findAll();
        $student = $collection->getIterator()->current();
    }
}
