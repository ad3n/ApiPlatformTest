<?php

namespace AppBundle\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class CamelCaseToWord
{
    /**
     * @param string $string
     *
     * @return string
     */
    public static function convert(string $string): string
    {
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $string, $matches);

        return implode(' ', $matches[1]);
    }
}
