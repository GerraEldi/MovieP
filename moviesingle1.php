<?php
require ('connect.php'); //behet lidhja me db
$kerkimi = mysqli_real_escape_string($con, $_GET['id']); //merret id i filmit specifik
$query = "SELECT * FROM movie WHERE movie_id='$kerkimi'"; //query per te marre filmin me id specifik
$result = mysqli_query($con, $query);
$numrows = mysqli_num_rows($result);
session_start(); //fillon session
$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- Skedaret CSS -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style.css">
<style>
.social-btn a.parent-btn{
margin-right:0px;
margin-left:10px;}


input[type="submit"]{
	border:none;
	font-family:Dosis;
	color:#dd003f;
	font-weight:bold;
	text-transform:uppercase;
	background-color:#66000000;
}
.koment{
	width:600px;
	height:100px;
	border:1 px solid #66000000;
}
.btnKom{
	position:relative;
	text-align:center;
	left:250px;
}

div.hero.mv-single-hero{
    background:none;
    background-color: rgb(211, 214, 218)!important;
}
footer.ht-footer{
	background-color:#020d18;
}


button{
	font-family: 'Dosis', sans-serif;
    font-size: 14px;
    color: #dd003f;
    font-weight: bold;
    text-transform: uppercase;
	margin-right: 35px;
	background-color:white;;
}
</style>
</head>
<body>

<!-- Fillim | Header -->
<?php include "./header1.php" ?>
</div>
</header>
<!-- Fund | Header -->
<?php
$queryUser = "SELECT * FROM user WHERE username='$username'"; //query per te marre nga db rezultate ku username eshte username i perdoruesit aktual
$result1 = mysqli_query($con, $queryUser);
$row1 = mysqli_fetch_array($result1);
$user_id = $row1['user_id'];

$numrows = mysqli_num_rows($result);

if ($numrows != 0)
{ //afishojme te dhenat per filmin specifik te zgjedhur
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<div class='hero mv-single-hero'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-12'>
			</div>
		</div>
	</div>
</div>
	<div class='page-single movie-single movie_single'>
	<div class='container'>
		<div class='row ipad-width2'>
			<div class='col-md-4 col-sm-12 col-xs-12'>
				<div class='movie-img sticky-sb'>
					<img src='images/" . $row['image_name'] . "'>
				</div>
			</div>
			<div class='col-md-8 col-sm-12 col-xs-12'>
				<div class='movie-single-ct main-content'>
					<h1 class='bd-hd'>" . $row['title'] . "<span> ( 2017 )</span></h1>
					<div class='social-btn'>";

        $movie_id = $row['movie_id'];

        //nqs shtohet filmi tek Filma per tu pare
        if (isset($_POST['submit_mtw']))
        {
            $query_shto_tek_mtw = "INSERT INTO movie_to_whatch(user_id,movie_id) values('$user_id','$movie_id') ";
            mysqli_query($con, $query_shto_tek_mtw) or die("Nuk u shtua tek Filma te pare" . mysqli_error($con));

        }
        //nqs shtohet filmi tek Fima te pare
        if (isset($_POST['submit_wm']))
        {
            $query_shto_tek_wm = "INSERT INTO watched_movie(user_id,movie_id) values('$user_id','$movie_id') ";
            mysqli_query($con, $query_shto_tek_wm) or die("Nuk u shtua tek Filma te pare" . mysqli_error($con));

        }
        //kontrolle nese filmat jane shtuar me pare ne listat perkatese
        $check = mysqli_query($con, "SELECT movie_id from watched_movie where user_id='$user_id'
                    and movie_id= '$movie_id' ") or die("Nuk u gjet" . mysqli_error($con));

        $check2 = mysqli_query($con, "SELECT movie_id from movie_to_whatch where user_id='$user_id'
and movie_id= '$movie_id' ") or die("Nuk u gjet" . mysqli_error($con));

        if ((mysqli_num_rows($check) > 0))
        {
            if (mysqli_num_rows($check2) > 0) //kontrollon nese shtimi i filmit eshte kryer nga perdoruesi
            
            {
?>
					   <a href='#'class='parent-btn'><i class='ion-heart'></i></a>
                       <button type="button" ><i>Shtuar tek "Filma të parë" </button><?php
                mysqli_query($con, "DELETE FROM movie_to_whatch where user_id='$user_id'
					   and movie_id= '$movie_id'") or die("Nuk u fshi" . mysqli_error($con));
            }
            else
            { ?>
						<a href='#'class='parent-btn'><i class='ion-heart'></i></a>
						<button type="button" ><i>Shtuar tek "Filma të parë" </button>
					  <?php
            }

        }
        else
        {
            if (mysqli_num_rows($check2) > 0)
            { ?>
				    <form method="post" action="" >
					  <a href='#'class='parent-btn'><i class='ion-heart'></i></a>
					  <button name="submit_wm"> Shto tek "Filma të parë"</button> 
							</form><!--mbaron forma-->
					<a href='#'class='parent-btn'><i class='ion-heart'></i></a>
					<button type="button" ><i>Shtuar tek "Filma për t'u parë" </button>

				 <?php
            }
            else
            { ?>

<form method="post" action="" >
					  <a href='#'class='parent-btn'><i class='ion-heart'></i></a>
					  <button name="submit_wm"> Shto tek "Filma të parë"</button> 
							</form><!--mbaron forma-->
							<form method="post" action="" >
				  <a href='#'class='parent-btn'><i class='ion-heart'></i></a>
            <button name="submit_mtw"> Shto tek "Filma për t'u parë"</button>
					   </form>

				 <?php
            }
        }
        //nqs fshihet komenti
        if (isset($_POST['fshij_k']))
        {
            $komenti = $_POST['kom'];
            mysqli_query($con, "DELETE FROM comment_movie where movie_id='$movie_id' and user_id='$user_id' and comment='$komenti'") or die("Nuk u fshi komenti" . mysqli_error($con));

        }
        //kur shtohet nje koment
        if (isset($_POST['submit_koment']))
        {
            $komenti = $_POST['komenti'];
            $query_shto_kom = "INSERT into `comment_movie`(`user_id`,`movie_id`,`comment`,`data`)
				values('$user_id','$movie_id','$komenti',NOW())";
            mysqli_query($con, $query_shto_kom) or die("Nuk u shtua komenti" . mysqli_error($con));
        }

        //nxjerrja e numrit te komenteve
        $rez_nr_kom = mysqli_query($con, "SELECT * from comment_movie where movie_id='$movie_id'") or die("Nuk u zgjodhen" . mysqli_error($con));
        if (!$rez_nr_kom)
        {
            $nr_kom = 0;
        }
        else
        {
            $nr_kom = mysqli_num_rows($rez_nr_kom);
        }

        echo "</div>

						
						
					
					<div class='movie-rate'>
						<div class='rate'>
							<i class='ion-android-star'></i>
							<p><span>" . $row['avg_rate'] . "</span> /10<br>
								<span class='rv'>$nr_kom komente</span>
							</p>
						</div>
					</div>
					<div class='movie-tabs'>
						<div class='tabs'>
							<ul class='tab-links tabs-mv'>
								<li class='active'><a href='#overview'>Përmbledhje</a></li>
								<li><a href='#reviews'> Komente</a></li>                        
							</ul>
						    <div class='tab-content'>
						        <div id='overview' class='tab active'>
						            <div class='row'>
						            	<div class='col-md-8 col-sm-12 col-xs-12'>
						            		<p>" . $row['summary'] . "</p>
						            	</div>
						            	<div class='col-md-4 col-xs-12 col-sm-12'>
						            		<div class='sb-it'>
						            			<h6>Regjisori: </h6>
						            			<p>" . $row['director'] . "</p>
											</div>
											<div class='sb-it'>
						            			<h6>Tipi: </h6>
						            			<p>" . $row['type'] . "</p>
											</div>
											<div class='sb-it'>
											<h6>Vendi i prodhimit: </h6>
											<p>" . $row['production_place'] . "</p>
										</div>";
        $query1 = "SELECT * FROM genre";
        $result1 = mysqli_query($con, $query1);
        $numrows1 = mysqli_num_rows($result1);
        if ($numrows1 != 0)
        {
            while ($row1 = mysqli_fetch_assoc($result1))
            {
                if ($row['gnr_id'] == $row1['gnr_id'])
                {
                    echo "<div class='sb-it'>
					<h6>Zhanri:</h6>
						            			<p>" . $row1['title'] . "</p>
						            		</div>
						            	</div>
						            </div>
						        </div>";
                }
            }
        }
    }
}
?>
						        <div id="reviews" class="tab review">
							
								
						           <div class="row">
								   <form method="post" action="#commment" >
<textarea class="koment"name="komenti" rows="4" cols="50" placeholder="Komento..." ></textarea><br>
<button name="submit_koment" class="redbtn btnKom">Shto komentin</button>
</form>

<?php

//selektimi i komenteve te filmit korrent
$rez_nr_kom = mysqli_query($con, "SELECT * from comment_movie where movie_id='$movie_id'") or die("Nuk u zgjodhen" . mysqli_error($con));
if (!$rez_nr_kom)
{
    $nr_kom = 0;
}
else
{
    $nr_kom = mysqli_num_rows($rez_nr_kom);
}
?>
<br><br>
						            	<div class="topbar-filter">
											<p>U gjetën <span><?php echo $nr_kom; ?> komente </span> në total</p>
										</div>

<?php

if (!$rez_nr_kom)
{
    echo " Nuk ka asnjë koment për këtë film .";
}
else
{
    while ($row_kom = mysqli_fetch_array($rez_nr_kom))
    {

        $rez_username = mysqli_query($con, "SELECT username FROM user where user_id='" . $row_kom['user_id'] . "'") or die("Nuk u nxoren" . mysqli_error($con));
        $row_username = mysqli_fetch_array($rez_username);

?>
	<!-- shfaqja e komenteve per fimin-->
										<div class="mv-user-review-item" id="comment">
											<div class="user-infor">
												<div>
													<h3><?php echo $row_kom['data'] ?></h3>
													
													<p class="time">
														nga <a> <?php echo $row_username['username']; ?></a>
													</p>
												</div>
											</div>
											<p> <?php echo $row_kom['comment']; ?></p>
<!-- butoni i fshirjes, vetem kur useri eshte pronar i komentit-->
											<?php if ($username == $row_username['username'])
        { ?>
	<form method="post" action="#comment"><button type="submit" name="fshij_k">Fshij</button>
	<input type="hidden" name="kom" value='<?php echo $row_kom['comment']; ?>'></form><?php
        } ?>
										</div> <?php
    }
} ?>
						            </div>
						        </div>	
						    </div>
						</div>
					</div>
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
