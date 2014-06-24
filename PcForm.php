<?php
$Locations = makeArrayFromTable('Locations');
$Departments = makeArrayFromTable('Departments');
$Licenses = makeArrayFromTable('Licenses');
$Conditions = makeArrayFromTable('Conditions');
$asset = isset($asset) ? $asset : '';
$description = isset($description) ? $description : '';
$location = isset($location) ? $location : '';
$department = isset($department) ? $department : '';
$license = isset($license) ? $license : '';
$condition = isset($condition) ? $condition : '';
$win7 = isset($win7) ? $win7 : '';
$id = isset($id) ? $id : '';
?>

<h1><?php echo $pageTitle; ?></h1>

<form action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" method="POST" role="form">
    <div class="form-group">
        <label for="asset">Asset Tag:</label>
        <input type="text" class="form-control" name="asset" id ="asset" value="<?php echo $asset; ?>" />
    </div>
    <div class="form-group">
        <label for="desc">Description:</label>
        <input type="text" class="form-control" name="desc" id ="desc" value="<?php echo $description; ?>" />
    </div>
    <div class="form-group">
        <label for="loc">Location:</label>
        <select class="form-control" name="loc" id="loc">
            <option />
    <?php foreach($Locations as $locId=>$name){ 
            $selected = $location == $locId ? ' selected' : '';
    ?>
            <option value="<?php echo $locId; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
    <?php } ?>
        </select>
    </div>
    <div class="form-group">
            <label for="dept">Department:</label>
            <select class="form-control" name="dept" id="dept">
                <option />
    <?php foreach($Departments as $deptId=>$name){ 
            $selected = $department == $deptId ? ' selected' : '';
    ?>
                <option value="<?php echo $deptId; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
    <?php } ?>
            </select>
    </div>
    <div class="form-group">
            <label for="lic">license:</label>
            <select class="form-control" name="lic" id="lic">
                <option />
    <?php foreach($Licenses as $licId=>$name){ 
            $selected = $license == $licId ? ' selected' : '';
    ?>
                <option value="<?php echo $licId; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
    <?php } ?>
            </select>
    </div>
    <div class="form-group">
            <label for="con">Condition:</label>
            <select class="form-control" name="con" id="con">
                <option />
    <?php foreach($Conditions as $conId=>$name){ 
            $selected = $condition == $conId ? ' selected' : '';
    ?>
                <option value="<?php echo $conId; ?>"<?php echo $selected; ?>><?php echo $name; ?></option>
    <?php } ?>
            </select>
    </div>
    <div class="form-group">
        
        <label for="win7installed">Windows 7 Installed:</label>
        <div class="radio">
            <label>
                <input id ="win7installed" type="radio" name="haswin7" value="1" <?php $checked = $win7 == 1 ? ' checked' : ''; echo $checked; ?>>Yes
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="haswin7" value="0" <?php $checked = $win7 == 0 ? ' checked' : ''; echo $checked; ?> />No
            </label>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>" />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

