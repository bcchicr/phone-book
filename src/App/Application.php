<?php

namespace Bcchicr\StudentList\App;

use PDO;
use PDOException;
use RuntimeException;
use Bcchicr\Container\Container;
use Bcchicr\StudentList\App\Conf;

class Application extends Container
{
    public function __construct(
        private string $basePath
    ) {
        parent::__construct();
        $this->readConf();
        $this->establishDBConnection();
    }
    private function readConf(): void
    {
        $confPath = $this->basePath . '/config/config.ini';
        $this->instance(
            Conf::class,
            new Conf($confPath)
        );
    }
    private function establishDBConnection(): void
    {
        /**
         * @var Conf
         */
        $dbConfig = $this->get(Conf::class);
        $dsn = sprintf(
            '%s:host=%s;dbname=%s',
            $dbConfig->get('db.connection'),
            $dbConfig->get('db.host'),
            $dbConfig->get('db.database')
        );
        try {
            $pdo = new PDO(
                $dsn,
                $dbConfig->get('db.user'),
                $dbConfig->get('db.password')
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->instance(
                PDO::class,
                $pdo
            );
        } catch (PDOException $e) {
            throw new RuntimeException("Unable to establish a connection with database: " . $e->getMessage());
        }
    }
}
