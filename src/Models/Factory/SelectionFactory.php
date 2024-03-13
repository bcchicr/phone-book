<?php

namespace Bcchicr\StudentList\Models\Factory;

use Bcchicr\StudentList\Models\Identity\IdentityObject;

abstract class SelectionFactory
{
    abstract public function newSelection(IdentityObject $obj): array;
    public function buildWhere(IdentityObject $obj): array
    {
        if ($obj->isVoid()) {
            return ['', []];
        }
        $compStrings = [];
        $values = [];
        foreach ($obj->getComps() as $comp) {
            $compStrings[] = "{$comp['name']} {$comp['operator']} ?";
            $values[] = $comp['value'];
        }
        $where = "WHERE " . implode(" AND ", $compStrings);
        return [$where, $values];
    }
}
