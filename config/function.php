<?php
function strposa(string $haystack, array $needles, int $offset = 0): bool
{
	foreach ($needles as $needle) {
		if (strpos($haystack, $needle, $offset) !== false) {
			return true; // stop on first true result
		}
	}
	return false;
}

function getPOST($key)
{
    $key = strtolower($key);
    $value = '';
    if (isset($_POST[$key])) {
        $value = $_POST[$key];
    }
    return $value;
}
function getCOOKIE($key)
{
    $key = strtolower($key);
    $value = '';
    if (isset($_COOKIE[$key])) {
        $value = $_COOKIE[$key];
    }
    return $value;
}
function getGET($key)
{
    $key = strtolower($key);
    $value = '';
    if (isset($_GET[$key])) {
        $value = $_GET[$key];
    }
    return $value;
}
function getREQUEST($key)
{
    $key = strtolower($key);
    $value = '';
    if (isset($_REQUEST[$key])) {
        $value = $_REQUEST[$key];
    }
    return $value;
}

function formatPrice($price)
{
    return number_format($price, 0, ',', '.');
}
