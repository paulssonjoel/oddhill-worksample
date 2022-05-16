<?php

namespace App\Utilities;

class Search
{
    // Searches for $values' values in the columns specified by $values' keys
    public static function search($query, $values)
    {
        foreach($values as $dbKey => $input) {
            if($input) {
                $query = $query->where($dbKey, 'like', '%'.$input.'%');
            }
        }

        return $query;
    }
}
