<?php

namespace AppBundle\Util;

/**
 * @author Muhammad Surya Ihsanuddin <surya.kejawen@gmail.com>
 */
class StringUtil
{
    /**
     * @param string $string
     *
     * @return string
     */
    public static function camelCaseToWord(string $string): string
    {
        preg_match_all('/((?:^|[A-Z])[a-z]+)/', $string, $matches);

        return implode(' ', $matches[1]);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function underScoreToCamelCase(string $string)
    {
        return preg_replace_callback('/_([a-z])/', function ($match) {
            return strtoupper($match[1]);
        }, strtolower($string));
    }
}
