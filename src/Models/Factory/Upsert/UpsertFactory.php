<?php

namespace Bcchicr\Framework\Models\Factory\Upsert;

use Bcchicr\Framework\Models\Model;

abstract class UpsertFactory
{
    abstract public function newUpdate(Model $obj): array;
    protected function buildStatement(string $table, array $fields, ?array $conditions = null): array
    {
        $terms = [];
        if (!is_null($conditions)) {
            $query = "UPDATE {$table} SET ";
            $query .= implode(" = ?,", array_keys($fields)) . " = ?";
            $terms = array_values($fields);
            $cond = [];
            $query .= " WHERE ";
            foreach ($conditions as $key => $val) {
                $cond[] = "$key = ?";
                $terms[] = $val;
            }
            $query .= implode(" AND ", $cond);
        } else {
            $qs = [];
            $query = "INSERT INTO {$table} (";
            $query .= implode(',', array_keys($fields));
            $query .= ") VALUES (";
            foreach ($fields as $name => $value) {
                $terms[] = $value;
                $qs[] = '?';
            }
            $query .= implode(',', $qs);
            $query .= ")";
        }
        return [$query, $terms];
    }
}
