<?php
// Header
require_once $_SERVER['DOCUMENT_ROOT'] . '\HTML.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '\Helpers.php';

echo $header;

$pageTitle = 'PCs That Need Windows 7 Sorted by Location';
$countCriteria = 'location';

$Locations =    makeArrayFromTable('Locations');
$Departments =  makeArrayFromTable('Departments');
$Licenses =     makeArrayFromTable('OperatingSystems');
$countString = "SELECT $countCriteria, count($countCriteria) as Count FROM Computers GROUP BY $countCriteria";
$arrayCount =   makeArrayFromTable('Computer', $countString);
$sorter = 'abbreviation';
$pcSql = "SELECT Computers.asset_tag, Computers.description,
                 Computers.location, Computers.department,
                 Computers.license, Locations.abbreviation
            FROM Computers 
           INNER JOIN Locations
              ON Computers.location = Locations.id
           WHERE has_win7=0 
             AND is_deployed=1";

$db = db_connect();
    if(!$result = sqlsrv_query($db, $pcSql)){
        die('Query Problems with Computers query');
    }
db_disconnect();


include 'TableMakerTest.php';

echo $footer;
?>