<?php

namespace Bcchicr\StudentList\Models\Watcher;


use Bcchicr\StudentList\Models\Model;

class IdentityWatcher
{
    private array $all = [];

    public function add(Model $obj): void
    {
        $className = get_class($obj);
        $id = $obj->getId();
        $this->all[$className][$id] = $obj;
    }
    public function has(string $className, int $id): bool
    {
        return isset($this->all[$className][$id]);
    }
    public function get(string $className, int $id): ?Model
    {
        if (!$this->has($className, $id)) {
            return null;
        }
        return $this->all[$className][$id];
    }
}
