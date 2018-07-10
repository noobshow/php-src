--TEST--
ZipArchive Bug #76524 (memory leak with ZipArchive::OVERWRITE flag and empty archive)
--SKIPIF--
<?php
if(!extension_loaded('zip')) die('skip');
?>
--FILE--
<?php

$filename = __DIR__ . '/nonexistent.zip';

$zip = new ZipArchive();
$zip->open($filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);
echo 'ok';

/* Zip-related error messages depend on platform and libzip version,
   so the regex is used to check that Zend MM does NOT show warnings
   about leaks: */
?>
--EXPECTREGEX--
ok((?!memory leaks detected).)*
