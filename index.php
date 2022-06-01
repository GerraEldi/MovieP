<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<title>MovieTime</title>

	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- skedaret CSS -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style.css">
	
	<style>
header .top-search input{
background:none;
padding-right:10px;
	}

.slider{
	background:url(https://images.unsplash.com/photo-1535016120720-40c646be5580?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80);
	background-size:cover;
	background-position:center;
	font-family:Lato;
	color:white;
	}
#content{
	text-align:center;
	padding-top:15%;
	text-shadow:0px 4px 3px rgba(0,0,0,0.4),
	            0px 8px 13px rgba(0,0,0,0.1),
				0px 18px 23px rgba(0,0,0,0.1);
	padding-bottom:15%;
}
body{
	font-family: 'Dosis', sans-serif;
	color:white;
}
h1{
	font-family: 'Dosis', sans-serif;
	font-weight:700;
	font-size:5em;
}
html{
	height:100%;
}
hr{
	
	border-top:1px solid #f8f8f8;
	border-bottom: 1px solid rgba(0,0,0,0.2);
}
a.btn{
	background-color: #dd003f;
    color: #ffffff;
    padding: 11px 25px;
	border-radius: 20px;
	font-family: 'Dosis', sans-serif;
	font-size: 14px;
	font-weight: bold;
	cursor: pointer;
}
footer.ht-footer{
	background-color:#020d18;
}

	</style>
</head>
<body>
<!--Fillim | Header -->
<?php include "./header.php" ?>
	</div>
</header>
<!-- Fund | Header -->

<div class="slider movie-items">
	<div class="container">
		<div class="row">
		<div class="col-lg-12">
			<div id="content">
				<h1>MovieTime</h1>
			<h3>Menaxhoni filmat tuaj!</h3>
			<hr>
			<a href="login.php" class="btn"> Kyçu</a>
			<a href="signup.php" class="btn"> Regjistrohu</a>
			</div>
			
</div>
	    </div>
	</div>
</div>
<!-- Fillim | Footer-->
<footer class="ht-footer">
	<div class="ft-copyright">
		<div class="ft-left">
			<p>© 2022 PW. Të gjitha të drejtat të rezervuara.</p>
		</div>
		<div class="backtotop">
			<p><a href="#" id="back-to-top">Kthehu në krye  <i class="ion-ios-arrow-thin-up"></i></a></p>
		</div>
	</div>
</footer>
<!-- Fund | Footer -->

<!-- Scriptet Javascript -->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
