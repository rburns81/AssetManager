<?php
$headerdate = date('F d, Y');
$style = '';
$header = <<<_HEADER
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr">
<head>
<title>EANW Test site</title>
<meta name="Author" content="Richard Burns" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link href="reset.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
$style</style>
</head>
<body>
<div style="display:none">
<!--div id="wrapper"-->
<div id="header">
	<a href="index.php"><img src="eanwlogo.png" alt="EANW logo" width="129" height="87" /></a>
	<p>Eye Associates Northwest, PC<br />homepage</p>
</div>
<div id="dateWrap">
<div id="date">
$headerdate
</div>
</div>
<div id="nav">
	<ul>
		<li><a href="">About</a></li>
		<li><a href="">Administration</a></li>
		<li><a href="">Calendars</a></li>
		<li><a href="">Call Schedule</a></li>
		<li><a href="">Classifieds</a></li>
		<li><a href="">Clinics</a></li>
		<li><a href="">Directories</a></li>
		<li><a href="">Forms</a></li>
		<li><a href="">Links</a></li>
		<li><a href="">Training</a></li>
		<li><a href="">Virtual Library</a></li>
	</ul>
</div>
</div>
<div id="content">
_HEADER;


$footer = <<<_FOOTER
</div>
</body>
</html>
_FOOTER;



?>