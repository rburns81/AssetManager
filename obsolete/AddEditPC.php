<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\HTML.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '\Helpers.php';

// GET branch

if($_SERVER['REQUEST_METHOD'] === 'GET') {

// Initialize Variables

$asset = '';
$loc = '';
$desc = '';
$dept = '';
$opSys = '';
$win7 = '';
$en = '';
$licval = '';
$active = 1;
$legend = 'Add a PC';
$submitName = 'Add';

$options = activePcOptionList();
$hiddenForm = '<form action="' . $_SERVER['SCRIPT_NAME'] . '" method="GET">';
$hiddenForm .= '<fieldset class="PCReport"><legend>Select a PC to Edit</legend>';
$hiddenForm .= '<select name="asset">';
foreach($options as $option){
        $hiddenForm .= $option;
    }
$hiddenForm .= '</select>';
$hiddenForm .= '<input type="Submit" value="Submit" />';
$hiddenForm .= '</fieldset></form>';

// Process GET data

switch($_SERVER['QUERY_STRING']){
    case 'add':
        $heading = '<h1>Add New PC</h1>';
        $asset = 'EANW-';
        $hiddenForm = '';
        break;
    case 'edit':
        $heading = '<h1>Edit Existing PC</h1>';
        $en = 'disabled';
        $legend = 'Edit PC';
        break;
    case 'del':
        $heading = '<h1>Deactivate a PC</h1>';
        $en = 'disabled';
        $legend = 'Deactivate PC';
        break;
    default:
        if(isset($_GET['asset'])){
            $asset = $_GET['asset'];
            $hiddenForm = '';
            $db = db_connect();
            $sql = "SELECT * FROM computers WHERE asset_tag='$asset'";
            if(!$result = sqlsrv_query($db, $sql)){
                die('Query Error 1');
            }
            $list = array();
            while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
                $asset = $row['asset_tag'];
                $oldAsset = $row['asset_tag'];
                $desc = $row['description'];
                $loc = $row['location'];
                $dept = $row['department'];
                $opSys = $row['license'];
                $win7 = $row['has_win7'];
                $active = $row['is_deployed'];
            }

            db_disconnect();
            $heading = '<h1>Edit Existing PC - ' . $asset . '</h1>';
            $legend = 'Edit PC ' . $asset;
            $submitName = 'Edit';
            $hiddden = 'style="display:none"';
        } else {
            die('Something went wrong.  Please try again');
        }    
}

echo $header;
echo $heading;
echo $hiddenForm;

$db = db_connect();

echo <<<_FormHead
<form action="{$_SERVER['SCRIPT_NAME']}" method="POST">
    <fieldset class="PCReport">
        <legend>{$legend}</legend>
        <ul>
        <li><label for="asset">Asset Tag:</label>
        <input type="text" name="asset" id ="asset" value="{$asset}" {$en} /></li>
        <li><label for="desc">Description:</label>
        <input type="text" name="desc" id ="desc" value="{$desc}" {$en} /></li>
_FormHead;
    
    
    echo '<li><label for="loc">Location:</label>';
    echo '<select name="loc" id="loc"'. $en . '>';
    echo '<option />';
    $locSql = "SELECT * FROM Locations";
    if(!$result = sqlsrv_query($db, $locSql)){
        die('Query Problems with Locations query');
    }
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $sel = $row[0] == $loc ? ' selected' : '';
        echo '<option value="'.$row[0].'"'.$sel.'>'.$row[1].'</option>'."\n";
    }
    echo '</select></li>';

    
    echo '<li><label for="dept">Department:</label>';
    echo '<select name="dept" id="dept"' . $en . '>';
    echo '<option />';
    $depSql = "SELECT * FROM Departments";
    if(!$result = sqlsrv_query($db, $depSql)){
        die('Query Problems with Departments query');
    }
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $sel = $row[0] == $dept ? ' selected' : '';
        echo '<option value="'.$row[0].'"'.$sel.'>'.$row[1].'</option>'."\n";
    }
    echo '</select></li>';
    
    
    echo '<li><label for="lic">License:</label>';
    echo '<select name="lic" id="lic"' . $en . '>';
    echo '<option />';
    $opSysSql = "SELECT * FROM OperatingSystems";
    if(!$result = sqlsrv_query($db, $opSysSql)){
        die('Query Problems with Operating Systems query');
    }
    while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $sel = $row[0] == $opSys ? ' selected' : '';
        echo '<option value="'.$row[0].'"'.$sel.'>'.$row[1].'</option>'."\n";
    }
    echo '</select></li>';
    
    
    echo '<li><label for="win7">Win 7 Installed:</label>';
    if($win7 == 0){
        echo '<input id ="win7" type="radio" name="win7" value="1" ' . $en . ' />Yes';
        echo '<input type="radio" name="win7" value="0"' . $en . ' checked />No</li>';
    } else {
        echo '<input id ="win7" type="radio" name="win7" value="1"' . $en . ' checked />Yes';
        echo '<input type="radio" name="win7" value="0" ' . $en . ' />No</li>';
    }
    
    echo '<li><label for="active">PC is actively in use:</label>';
    if($active == 0){
        echo '<input id ="active" type="radio" name="active" value="1" ' . $en . ' />Yes';
        echo '<input type="radio" name="active" value="0"' . $en . ' checked />No</li>';
    } else {
        echo '<input id ="active" type="radio" name="active" value="1"' . $en . ' checked />Yes';
        echo '<input type="radio" name="active" value="0" ' . $en . ' />No</li>';
    }
    
    if(isset($oldAsset)) {
        echo '<input type="hidden" name="old" value="' . $oldAsset . '" />';
    }
echo <<<_FormFoot
        <li><input type="submit" name="{$submitName}" value="Submit" {$en} /></li>
    </fieldset
</form>
_FormFoot;

} elseif($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Validate input
    InputValidate($_POST['asset'],'Asset Tag');
    InputValidate($_POST['desc'],'Description');
    InputValidate($_POST['loc'],'Location');
    InputValidate($_POST['dept'],'Department');
    InputValidate($_POST['win7'],'Windows 7 Installed');
    InputValidate($_POST['lic'],'Windows License');
        
    // Prep data for DB entry
    
    $asset = "'" . strtoupper($_POST['asset']) . "'";
    $desc = "'" . htmlspecialchars($_POST['desc'], ENT_QUOTES) . "'";
    $loc =  "'" . $_POST['loc'] . "'";
    $dept = "'" . $_POST['dept'] . "'";
    $win7 = "'" . $_POST['win7'] . "'";
    $lic =  "'" . $_POST['lic'] . "'";
    $active = "'" . $_POST['active'] . "'";
    if(isset($_POST['old'])) {
        $oldAsset = "'" . $_POST['old'] . "'";
    }
    
    // Check for add or edit to make appropriate SQL query
    
    if(isset($_POST['Add'])) {
        // Insert query
        $sql = "INSERT INTO computers
                (asset_tag, description, location, department, license, is_deployed, status)
                VALUES ($asset, $desc, $loc, $dept, $lic, $win7, $active)";
        $success = 'Computer successfully added to the database!';
    } elseif(isset($_POST['Edit'])) {
        // Update query
        $sql = "UPDATE computers
                   SET description=$desc, location=$loc,
                       department=$dept, license=$lic, is_deployed=$win7,
                       status=$active
                 WHERE asset_tag=$oldAsset";
        $success = 'Computer sucessfully updated!';
    } else {
        die('Something went wrong with the Add or Edit attempt');
    }
    
    $db = db_connect();
    
    if(sqlsrv_query($db,$sql)){
        db_disconnect();
        echo '<h2>' . $success . '</h2>';
    } else {
        db_disconnect();
        echo '<h2>Your query could not be processed by the database</h2>';
        echo '<pre>';
        echo $sql . '<br />';
        die(print_r(sqlsrv_errors(),true));
    }
    
    echo $header;
    echo '<p><a href="' . $_SERVER['SCRIPT_NAME'] . '?edit">Go to PC edit page</a></p>';
    echo '<p><a href="index.php">Return to Main Page</a></p>';
    echo $footer;
    
}



echo $footer;
?>