<?php
require "models/SamplesModel.php";
require "dbcon.php";
//Create db connection
$db = readDatabase();

//load db connection into model object
$sampleModel = new SamplesModel($db);

//Retrieve list of items from database
$sampleList = $sampleModel->getAllSamples();

include "views/samples-list.php";

$db = null;
?>
