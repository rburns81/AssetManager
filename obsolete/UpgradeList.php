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


$pcSql = "SELECT * FROM Computers WHERE has_win7=0 AND is_deployed=1";

$db = db_connect();
    if(!$result = sqlsrv_query($db, $pcSql)){
        die('Query Problems with Computers query');
    }
db_disconnect();
$sortCriteria = array();
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        
        
        $sortCriteria[$Locations[$row['location']]][] = array(
                      'asset' =>         $row['asset_tag'], 
                      'description' =>   $row['description'], 
                      'location' =>      $row['location'], 
                      'department' =>    $row['department'], 
                      'license' =>       $row['license']
                      );
    }
ksort($sortCriteria);

include 'TableMaker.php';

echo $footer;
?>