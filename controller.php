<?php

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

require_once('DirectoryWork.php');

$dirObject = new DirectoryWork();

if ($_POST['folder']) {
	$dirObject->setDir($_POST['folder']);
} else {
	$dirObject->setDir('/Users/evgenia/Desktop/Programming/');
}

$dir = $dirObject->getDir();

echo "<span style=\"color: orange\"> Root folder = " . $_POST['folder'] . "</span>" . "<br />";

$dirObject->buildDirectoriesTree($dir, 0);

echo "<br />";
echo "<br />";

echo "<span style=\"color: orange\"> Result = " . $dirObject->getSum() . "</span>" . "<br />";