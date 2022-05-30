<?php

namespace App\Traits;

trait Search
{
    // Returns query for $values' values in the columns specified by $values' keys
    public static function search($values)
    {
        $q = new self();
        foreach ($values as $dbKey => $input) {
            if ($input) {
                $q = $q->where($dbKey, 'like', '%' . $input . '%');
            }
        }

        return $q;
    }
}
