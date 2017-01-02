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
    public static function underScoreToCamelCase(string $string): string
    {
        return preg_replace_callback('/_([a-z])/', function ($match) {
            return strtoupper($match[1]);
        }, strtolower($string));
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function camelCaseToUnderScore($string): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }
}
