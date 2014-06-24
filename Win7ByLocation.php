<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\Functions.php';

// Header stuff
$pageTitle = 'PCs that need Windows 7 by Location';
include 'Header.php';

// Define breakdown of tables using computer
// $property = column name from Computer table
// $table = table name, which should be the plural version of the property

$column = 'location';
$table = $column . 's';

// Define additional where clauses, if necessary
// start with AND

$whereClause = 'AND condition=1 AND has_win7=0';

// Define counter

$count = "SELECT location, count(location) as Count
            FROM Computers
           WHERE has_win7 = 0 AND condition = 1
           GROUP BY location";
$total = makeArrayFromTable('Locations',$count);



include 'TableMaker.php';

include 'footer.php';
?>