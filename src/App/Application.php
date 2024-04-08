<?php

namespace Bcchicr\Framework\App;

use Bcchicr\Container\Container;
use Bcchicr\Framework\App\Conf;

class Application extends Container
{
    public function __construct(
        private string $basePath
    ) {
        parent::__construct();
        $this->readConf();
        $this->registerJsonMapper();
    }
    private function readConf(): void
    {
        $confPath = $this->basePath . '/config/config.ini';
        $this->instance(
            Conf::class,
            new Conf($confPath)
        );
    }
    private function registerJsonMapper(): void
    {
        /**
         * @var Conf
         */
        $conf = $this->get(Conf::class);
        $path = $this->basePath . $conf->get('json.path');
        $this->instance(
            JsonMapper::class,
            new JsonMapper($path)
        );
    }
}
