<?php

error_reporting(E_ALL);

session_start();


$skema  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$folder = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');

// Spasi dan karakter khusus pada nama folder harus di-encode (spasi -> %20)
$folder = implode('/', array_map('rawurlencode', explode('/', $folder)));

define("URL", $skema . '://' . $_SERVER['HTTP_HOST'] . $folder);
define("AST", URL . "/layouts/assets");

// Path root
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Fungsi bantu: cetak teks dengan aman di view (mencegah XSS)
function e($teks)
{
	return htmlspecialchars((string) $teks, ENT_QUOTES, 'UTF-8');
}

// Autoload
require_once ROOT. "vendor/autoload.php";

// Whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();