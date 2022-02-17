<?php

namespace App\Custom;

class RandomName
{

    /**
     * sreturn name aleatory according param the entry
     *
     * @param Int $digit
     * @return String
     */
    public static function randomName(int $digit): String
    {
        $key = '';
        $keys = array_merge(range('a', 'z'), range(0, 9));
        for ($i = 0; $i < $digit; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
}
