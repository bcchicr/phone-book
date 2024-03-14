<?php

namespace Bcchicr\StudentList\Models\Assembler;

use PHPUnit\Framework\TestCase;
use Bcchicr\StudentList\App\Application;
use Bcchicr\StudentList\Models\Factory\UserFactory;
use Bcchicr\StudentList\Models\StudentData;
use Bcchicr\StudentList\Models\Identity\StudentDataIdentity;
use Bcchicr\StudentList\Models\Identity\UserIdentity;
use Bcchicr\StudentList\Models\User;
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
