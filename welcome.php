<?php
session_start(); //fillim i session

?>
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
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
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
	padding-top:5%;
	text-shadow:0px 4px 3px rgba(0,0,0,0.4),
	            0px 8px 13px rgba(0,0,0,0.1),
				0px 18px 23px rgba(0,0,0,0.1);
	padding-bottom:10%;
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
<!-- Fillim | Header-->
<?php include "./header1.php" ?>
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
			</div>
			
</div>
	    </div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="title-hd">
					<h2>Filma</h2>
					<a href="moviegrid.php" class="viewall">Shiko të gjithë filmat<i class="ion-ios-arrow-right"></i></a>
				</div>
				<div class="topbar-filter">
				<?php require ('connect.php'); //kryhet lidhja me DB
$query = "SELECT * FROM movie WHERE movie_id  IN (30,31,32,33,34,35)"; //query per te selektuar disa filma nga DB
$result = mysqli_query($con, $query);
$numrows = mysqli_num_rows($result);
echo '</div>
								<div class="flex-wrap-movielist">';
while ($row = mysqli_fetch_assoc($result))
{
    $image_name = $row['image_name'];
    $titulli = $row['title'];
    $avg_rate = $row['avg_rate'];
    $movie_id = $row['movie_id'];
?>
									 <div class="movie-item-style-2 movie-item-style-1">
									 <?php echo "<img src='images/" . $row['image_name'] . "'>"; // afishim i filmave
     ?>
										 <div class="mv-item-infor">
											 <h6><a href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'><?php echo $titulli; ?></a></h6>
											 <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
										 </div>	
									 </div>
									 <?php
} ?> 				
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
<!-- Fund | Footer-->

<!-- Scripte Javascript-->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
