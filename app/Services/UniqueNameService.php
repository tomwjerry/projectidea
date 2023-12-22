<?php
namespace App\Services;

class UniqueNameService
{
    public static function generateUniqueName(
        $query,
        $sourceName = '',
        $ambiguousNames = [],
        $field = 'identification_name'
    )
    {
        $ambiguousNames[] = 'edit';
        $ambiguousNames[] = 'new';

        $sourceName = strtolower($sourceName);
        $sourceName = trim($sourceName);
        $sourceName = preg_replace('/\W+/', '', $sourceName);

        if (empty($sourceName) || in_array($sourceName, $ambiguousNames))
        {
            $sourceName .= random_int(0, 99);
        }

        $nameIsUnique = false;
        $attempts = 10;

        for ($i = $attempts; $i > 0; $i--)
        {
            $uniqueQuery = clone $query;
            $foundOther = $uniqueQuery->where($field, $sourceName)->first();

            if (empty($foundOther))
            {
                $nameIsUnique = true;
                break;
            }
            else
            {
                $sourceName .= random_int(0, 99);
            }
        }

        if ($nameIsUnique)
        {
            return $sourceName;
        }

        return false;
    }
}
