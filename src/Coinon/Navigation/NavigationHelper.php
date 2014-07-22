<?php namespace Coinon\Navigation;

/**
 * Provide a few helper functions needed by this package
 */
class NavigationHelper {

    /**
     * Concats strings into a path, taking care of all separators
     *
     * @param  array  $strings
     * @param  string $separator
     * @return string
     */
    public static function concatPath(array $strings, $separator='/')
    {
        $concat = '';

        for ($stringIndex=0; $stringIndex < count($strings); $stringIndex++) {
            // Ensure we only have one separator in between each string
            $concat = rtrim($concat, $separator);
            if ($concat != '') $concat .= $separator;
            $concat .= ltrim($strings[$stringIndex], $separator);
        }

        return $concat;
    }

    /**
     * Determine whether $url is absolute
     *
     * @param  string  $url
     * @return boolean
     */
    public static function isAbsoluteUrl($url)
    {
        return (preg_match('#^(//|https?://|ftp://)#i', $url) === 1);
    }

}
