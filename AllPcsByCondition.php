<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\Functions.php';

// Header stuff
$pageTitle = 'All EANW PCs';
include 'Header.php';

// Define breakdown of tables using computer
// $property = column name from Computer table
// $table = table name, which should be the plural version of the property

$column = 'condition';
$table = $column . 's';

// Define the where clause, if necessary
// Start with AND

$whereClause = '';

$count = "SELECT condition, count(condition) as Count
            FROM Computers
           GROUP BY condition";
$total = makeArrayFromTable('Conditions', $count);
include 'TableMaker.php';

include 'footer.php';
?>