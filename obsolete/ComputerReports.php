<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\HTML.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '\Helpers.php';

echo $header;
echo '<h1>List of PCs that Need Windows 7</h1>';
echo '<p>This is a list of computers with Windows XP currently installed.
         Some of the newer computers have Windows 7 licenses, which is
         reflected in the counters.</p>';
// Pull list of clinics

$clinics = array();

$clinicSQL = "SELECT id FROM locations";
$db = db_connect();

if(!$result = sqlsrv_query($db,$clinicSQL)) {
    die('There was an error running the query 1');
}
    
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
    $clinics[] = $row[0];
    echo $row[0];
}

// End Clinic list
// Start PC List
$locs = array();
foreach ($clinics as $clinic){
    
    $PcSql = "SELECT asset_tag, description, department, 
              license FROM computers WHERE 
              location='{$clinic}' AND has_win7=0";
    
    if(!$result = sqlsrv_query($db,$PcSql)) {
        die('There was an error running the query 2');
    }
    
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
    switch($row[3]){
        case 0:
            $lic = 'XP';
            break;
        case 1:
            $lic = 'Windows 7';
            break;
        case 2:
            $lic = 'Vista';
            break;
    }
    $locs[] = '<tr><td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' .
                        $row[2] . '</td><td>' . $lic . '</td></tr>';
    }
    
}

$eanwCount = 0;
$eanwWin7Count = 0;

$link = '';
foreach($clinics as $clin) {
    $link .= '<a href="#' . $clin . '">' . $clin . '</a> | ';
}

foreach($clinics as $clinic) {   
    echo '<a name="' . $clinic . '"></a>';
    echo '<h2>' . $clinic . '</h2>';
    echo '<p>Jump to: ' . $link . '</p>';
    
    echo '<table class="PCReport"><tr>';
    echo '<th></th><th>Asset Tag</th><th>Description</th><th>Department</th><th>License</th><th>Sharepoint</th><tr>';
        $PcSql = "SELECT asset_tag, description, department, 
              license FROM computers WHERE 
              location='{$clinic}' AND has_win7=0 AND is_deployed='1'";
    
    if(!$result = sqlsrv_query($db,$PcSql)) {
        die('There was an error running the query 3');
    }
    
    $count = 0;
    $win7count = 0;
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        
        switch($row[3]){
            case 0:
                $lic = 'Windows XP';
                break;
            case 1:
                $lic = 'Windows 7';
                if(!($clinic == 'Spare')) {
                    $win7count++;
                }
                $eanwWin7Count++;
                break;
            case 2:
                $lic = 'Windows Vista';
                break;
            case 3:
                $lic = 'Unknown';
                break;
        }
        echo '<tr><td><a href="AddEditPC.php?asset=' . $row[0] . '">Edit</a></td>
                  <td>' . $row[0] . '</td><td>' . $row[1] . '</td><td>' .
                        $row[2] . '</td><td>' . $lic . '</td>' . 
                        '<td><a href="http://sharepoint/sites/IT/PCs/' . $row[0] . '.docx">Sharepoint</a></td></tr>';
        
        
            
        
        if(!($clinic == 'Spare')) {
            $count++;
            $eanwCount++;
        }
        
    }
    echo '</table>';
    echo '<p><strong>Total to be Replaced: ' . $count . '</strong></p>';
    $clinicTotal = $count - $win7count;
    echo '<p class ="totals">Total New Licenses Required: ' . $clinicTotal . '</p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
}
$spareQuery = "select count(*) from computers WHERE location=6 AND license=1";
if(!$result = sqlsrv_query($db,$spareQuery)) {
    die('There was an error running the query 4');
}
    
while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
    $spares = $row[0];
}
db_disconnect();
$grandTotal = $eanwCount - $eanwWin7Count;




echo '<fieldset class="totals"><legend>Grand Totals</legend>';
echo '<p class="totals"><span class="totals">Total to be Replaced: </span>' . $eanwCount . '</p>';
echo '<p class="totals"><span class="totals">Total New Licenses Required: </span>' . $grandTotal . '</p>';
echo '<p class="totals"><span class="totals">Eligible Spare PCs: </span>' . $spares . '</p>';
echo '<p><a href="index.php">Return to Main Page</a></p>';
echo '</fieldset>';


echo $footer;
?>