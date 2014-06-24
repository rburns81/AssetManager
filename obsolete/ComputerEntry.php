<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\HTML.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '\Helpers.php';

echo $header;

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    echo '<h1>Enter Computer Info</h1>';

    // DB Calls to generate option lists for form
    $db = db_connect();
    $Dept = optionList('departments');
    $Locs = optionList('locations');
    db_disconnect();
    
    $license = array('XP', 'Windows 7', 'Vista', 'Unknown');

echo <<<_entryHead
    <fieldset>
    <legend>PC Entry</legend>
    <form action="{$_SERVER['SCRIPT_NAME']}" method="POST">
        <ul>
            <li>Asset Tag: EANW-<input type="text" name="asset" /></li>
            <li>Description: <input type="text" name="desc" /></li>
_entryHead;

    echo '<li>Location: <select name="loc">';
    foreach($Locs as $l) {
        echo $l;
    }
    echo '</select></li>';
    
    echo '<li>Department: <select name="dept">';
    foreach($Dept as $d) {
        echo $d;
    }
    echo '</select></li>';
echo <<<_entryFoot
            <li>Windows 7 Installed? <input type="radio" name="win7" value="1" />Yes
                                     <input type="radio" name="win7" value="0" />No</li>
            <li>Windows License: <select name="lic">
                                    <option value="0">{$license[0]}</option>
                                    <option value="1">{$license[1]}</option>
                                    <option value="2">{$license[2]}</option>
                                    <option value="3">{$license[3]}</option>
                                 </select>
            <li><input type="submit" name="submit" value="Submit" /></li>
        </ul>
    <form>
    </fieldset>

_entryFoot;
/* Form field names:
        asset
        desc
        loc
        dept
        win7
        lic */
        
} elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    //validate
    
    InputValidate($_POST['asset'],'Asset Tag');
    InputValidate($_POST['desc'],'Description');
        
    if(!isset($_POST['win7'])) {
        die('The "Windows 7 Installed" radio button is blank.  Please try again');
    }
    
    if (!isset($_POST['lic'])) {
        die('The "Has Windows License" radio button is blank.  Please try again');
    }
    
    // Validation Done
    // Prep vars for database
    
    $asset = "'" . 'EANW-' . $_POST['asset'] . "'";
    $desc = "'" . htmlspecialchars($_POST['desc'], ENT_QUOTES) . "'";
    $loc =  "'" . $_POST['loc'] . "'";
    $dept = "'" . $_POST['dept'] . "'";
    $win7 = $_POST['win7'];
    $lic =  $_POST['lic'];
   
    // End var prep
    // Start Database Entry
    $db = db_connect();
    
    $sql = "INSERT INTO computers (asset_tag,location,
                description,department,is_deployed,win7_license)
                VALUES ($asset,$loc,$desc,$dept,$win7,$lic)";
                
    if(!sqlsrv_query($db,$sql)) {
        echo 'There was a problem with the query: <pre>';
        die(print_r(sqlsrv_errors(), true));
    }

    echo '<h1>Entry Successful!</h1>';
    echo '<p><a href="ComputerEntry.php">Return to Entry Page</a></p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    db_disconnect();
    
    // End Database Entry
}

echo $footer;
?>