<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en" dir="ltr">
<head>
    <title><?php echo $pageTitle ?></title>
    <meta name="Author" content="Richard Burns" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        body { padding-top: 70px; }
    </style>
</head>
<body>
    <a style="padding-top:70px" id="top" />
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-point">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://eanwit">PC Tracker</a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-point">
          <ul class="nav navbar-nav">
            <li><a class="pill" href="AddPc.php">Add a PC</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">PC Lists <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="AllPcsByCondition.php">By Condition/Deployment</a></li>
                <li class="disabled"><a href="AllPcsByLocation.php">By Location - Coming Soon</a></li>
                <li class="disabled"><a href="AllPcsByDepartment.php">By Department - Coming Soon</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Windows 7 Upgrade Plan <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="Win7ByLocation.php">By Location</a></li>
                <li><a href="Win7ByDepartment.php">By Department</a></li>
                <li class="disabled"><a href="EligibleSpares.php">Eligible Spare PCs - Coming Soon</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#top">Return to Top <span class="glyphicon glyphicon-chevron-up"></span></a></li>
          </ul>
          
        </div>
      </div>    
    </nav>
    
    <div class="container">