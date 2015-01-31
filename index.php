<?php include 'includes/connection/session.php'; ?>
<html ng-app="myAdminApp">
<head>
      <meta charset="utf-8">
            
      <title>ESN - Survival Guide</title>
      
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta name="apple-mobile-web-app-capable" content="yes">
            
      <link rel="shortcut icon" href="css/img/logo.ico" type="image/vnd.microsoft.icon" />
      
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
      
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
      <link href="css/font-awesome.css" rel="stylesheet">
      
      <link href="css/pages/signin.css" rel="stylesheet">

      <link href="css/xeditable.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      
      <script src="js/jquery-1.7.2.min.js"></script> 
      <script src="js/bootstrap.js"></script>
      <script src="js/angular.min.js"></script>
      
      <script src="js/angularApp/app.js"></script>
      <script src="js/angularApp/controllers.js"></script>
      <script src="js/angularApp/services.js"></script>

      <script src="js/xeditable.js"></script>
</head>

<body>
	<header></header>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
		<div class="container">
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
		  </a>
		  <a class="brand" href="">ESN - Survival Guide </a>
		  <div class="nav-collapse">
			<?php if(isset($_SESSION['username']) && isset($_SESSION['code_section'])){ ?>
			<ul class="nav pull-right">
				<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><?php echo $_SESSION['username'];?><b class="caret"></b></a>
				<ul class="dropdown-menu">
					  <li><a href="includes/connection/logout.php">Logout</a></li>
				</ul>
			  </li>
			</ul>
			<?php } ?>
		  </div>
		</div>
	  </div>
	</div>
		<?php
		if(isset($_SESSION['username']) && isset($_SESSION['code_section']))
		{
			include 'includes/partials/guide.php';
		}
		else
		{
			include 'includes/partials/login.php';
		}
		?>
</body>
</html>
