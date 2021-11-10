<?php
if (!function_exists("formatNumber")) {
    function formatNumber($num, $digits = null)
    {
        $pow = pow(10, $digits === null ? 6 : $digits);
        return round($num * $pow) / $pow;
    }
}
if (!function_exists("trim")) {
    function trim($str)
    {
        return trim($str);
    }
}
if (!function_exists("splitWords")) {
    function splitWords($str)
    {
        $text = trim($str);
        return explode(" ", $text);
    }
}
if (!function_exists("wrapNum")) {
    function wrapNum($x, array $range, $includeMax = false)
    {
        $max = $range[1];
        $min = $range[0];
        $d = $max - $min;
        return $x === $max && $includeMax ? $x : (($x - $min) % $d + $d) % $d + $min;
    }
}