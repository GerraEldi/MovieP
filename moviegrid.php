<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<title>Lista e filmave</title>
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

footer.ht-footer{
	background-color:#020d18;
}
div.hero.common-hero{
	background:url(https://images.unsplash.com/photo-1535016120720-40c646be5580?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80);
	background-size:cover;
	background-position:center;
	}
        </style>

</head>
<body>
<!-- Fillim| Header -->
<?php include "./header1.php" ?>
<!--Fillon forma e kerkimit-->
         <form method="post" action="moviegrid.php"> 
	    <div class="top-search">
        <input type="text"name="fusha_kerko" placeholder="Kërko një film, një dokumentar apo një serial">
            <input style="padding-right:20px;" type="submit" name="kerko" value="Kërko">
</form>
<!--Mbaron forma e kerkimit-->
	    </div>
        </div>
</header>
<!-- Fund| Header -->

<div class="hero common-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1> Lista e filmave</h1>
					<ul class="breadcumb">
						<li class="active"><a href="welcome.php">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span> Lista e filmave</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="topbar-filter">
                 <?php require ('connect.php'); //behet lidhja me DB
if (isset($_POST['kerko'])) //Nqs eshte shtypur butoni kerko

{
    if (!empty($_POST['fusha_kerko'])) //nqs fusha e kerko nuk eshte kene bosh
    
    {
        $kerko = mysqli_real_escape_string($con, $_POST['fusha_kerko']);
        $query = "SELECT * FROM movie WHERE title LIKE'%$kerko%'"; //query per te kerkuar rezultatet e ngjashme ne db me ate qe ka kerkuar perdoruesi sipas titullit
        $result = mysqli_query($con, $query);
        $numrows = mysqli_num_rows($result);
        if ($numrows != 0)
        { ?>        <!--Numri i rezultateve te gjetura per kerkimin ne DB-->
                    <p>U gjetën <span><?php echo $numrows; ?></span> rezultate për kërkimin tuaj.</p> 
                    <?php
        }
        else
        {
            echo '<p> Nuk u gjet asnje rezultat per kerkimin tuaj.</p>';
        } ?>
                </div>
                <div class="flex-wrap-movielist">
               <?php while ($row = mysqli_fetch_assoc($result))
        {

            $image_name = $row['image_name'];
            $titulli = $row['title'];
            $avg_rate = $row['avg_rate'];
            $movie_id = $row['movie_id'];

?>                      <!--Afishimi i rezultateve-->
						<div class="movie-item-style-2 movie-item-style-1">
                            <?php echo "<img src='images/" . $row['image_name'] . "'>"; ?>
							<div class="hvr-inner">
	            				<a  href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
                            </div>
							<div class="mv-item-infor">
								<h6><a href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'><?php echo $titulli; ?></a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
                            </div>	
                        </div>
                        <?php
        } ?> 				
                </div>
                <?php
    }
}
else if (isset($_POST['filtro'])) //nqs eshte shtypur butoni filtro per te kerkuar filmat

{
    if (!empty($_POST['vendi_prodhimit'])) //nqs perdoruesi po kerkon te filtroje sipas vendit te prodhimit te filmit
    
    {
        $kerko = mysqli_real_escape_string($con, $_POST['vendi_prodhimit']);
        $query = "SELECT * FROM movie WHERE production_place LIKE'%$kerko%'";
        $result = mysqli_query($con, $query);
        $numrows = mysqli_num_rows($result);
        if ($numrows != 0)
        { ?>           <!--Numri i rezultateve te gjetura per kerkimin ne DB-->
                    <p>U gjetën <span><?php echo $numrows; ?></span> rezultate për kërkimin tuaj.</p>
                    <?php
        }
        else
        {
            echo '<p> Nuk u gjet asnje rezultat per kerkimin tuaj.</p>';
        } ?>
                </div>
                <div class="flex-wrap-movielist">
               <?php while ($row = mysqli_fetch_assoc($result))
        {

            $image_name = $row['image_name'];
            $titulli = $row['title'];
            $avg_rate = $row['avg_rate'];
            $movie_id = $row['movie_id'];

?>                       <!--Afishimi i rezultateve-->
						<div class="movie-item-style-2 movie-item-style-1">
                            <?php echo "<img src='images/" . $row['image_name'] . "'>"; ?>
							<div class="hvr-inner">
	            				<a  href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
                            </div>
							<div class="mv-item-infor">
								<h6><a href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'><?php echo $titulli; ?></a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
                            </div>	
                        </div>
                        <?php
        } ?> 				
                </div>
                <?php
    }
    else if (!empty($_POST['zhanri']))
    { //nqs perdoruesi po kerkon te filtroje sipas zhanrit
        $kerko = mysqli_real_escape_string($con, $_POST['zhanri']);
        $query = "SELECT * FROM movie INNER JOIN genre ON movie.gnr_id=genre.gnr_id WHERE genre.title LIKE'%$kerko%'";
        $result = mysqli_query($con, $query);
        $numrows = mysqli_num_rows($result);
        if ($numrows != 0)
        { ?>        <!--Numri i rezultateve te gjetura per kerkimin ne DB-->
                    <p>U gjetën <span><?php echo $numrows; ?></span> rezultate për kërkimin tuaj.</p>
                    <?php
        }
        else
        {
            echo '<p> Nuk u gjet asnje rezultat per kerkimin tuaj.</p>';
        } ?>
                </div>
                <div class="flex-wrap-movielist">
               <?php while ($row = mysqli_fetch_assoc($result))
        {

            $image_name = $row['image_name'];
            $titulli = $row['title'];
            $avg_rate = $row['avg_rate'];
            $movie_id = $row['movie_id'];

?>                       <!--Afishimi i rezultateve-->
						<div class="movie-item-style-2 movie-item-style-1">
                            <?php echo "<img src='images/" . $row['image_name'] . "'>"; ?>
							<div class="hvr-inner">
	            				<a  href='moviesingle1.php?id=<?php echo $movie_id; ?>''> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
                            </div>
							<div class="mv-item-infor">
                                <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
                            </div>	
                        </div>
                        <?php
        } ?> 				
                </div>
                <?php
    }
    else if (!empty($_POST['regjisori'])) //nqs perdoruesi po kerkon te filtroje sipas regjisorit
    
    {
        $kerko = mysqli_real_escape_string($con, $_POST['regjisori']);
        $query = "SELECT * FROM movie WHERE director LIKE'%$kerko%'";
        $result = mysqli_query($con, $query);
        $numrows = mysqli_num_rows($result);
        if ($numrows != 0)
        { ?>             <!--Numri i rezultateve te gjetura per kerkimin ne DB-->
                        <p>U gjetën <span><?php echo $numrows; ?></span> rezultate për kërkimin tuaj.</p>
                        <?php
        }
        else
        {
            echo '<p> Nuk u gjet asnje rezultat per kerkimin tuaj.</p>';
        } ?>
                    </div>
                    <div class="flex-wrap-movielist">
                   <?php while ($row = mysqli_fetch_assoc($result))
        {

            $image_name = $row['image_name'];
            $titulli = $row['title'];
            $avg_rate = $row['avg_rate'];
            $movie_id = $row['movie_id'];

?>                          <!--Afishimi i rezultateve-->
                            <div class="movie-item-style-2 movie-item-style-1">
                                <?php echo "<img src='images/" . $row['image_name'] . "'>"; ?>
                                <div class="hvr-inner">
                                    <a  href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
                                </div>
                                <div class="mv-item-infor">
                                    <h6><a href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'><?php echo $titulli; ?></a></h6>
                                    <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
                                </div>	
                            </div>
                            <?php
        } ?> 				
                    </div>
                    <?php
    }
    else if (!empty($_POST['tipi'])) //nqs perdoruesi po kerkon te filtroje sipas tipit
    
    {
        $tipi = $_POST['tipi'];
        $kerko = mysqli_real_escape_string($con, $_POST['tipi']);
        $query = "SELECT * FROM movie WHERE type='" . $tipi . "'";
        $result = mysqli_query($con, $query);
        $numrows = mysqli_num_rows($result);
        if ($numrows != 0)
        { ?>             <!--Numri i rezultateve te gjetura per kerkimin ne DB-->
                        <p>U gjetën <span><?php echo $numrows; ?></span> rezultate për kërkimin tuaj.</p>
                        <?php
        }
        else
        {
            echo '<p>Nuk u gjet asnje rezultat per kerkimin tuaj.</p>';
        } ?>
                    </div>
                    <div class="flex-wrap-movielist">
                   <?php while ($row = mysqli_fetch_assoc($result))
        {

            $image_name = $row['image_name'];
            $titulli = $row['title'];
            $avg_rate = $row['avg_rate'];
            $movie_id = $row['movie_id'];

?>                          <!--Afishimi i rezultateve-->
                            <div class="movie-item-style-2 movie-item-style-1">
                                <?php echo "<img src='images/" . $row['image_name'] . "'>"; ?>
                                <div class="hvr-inner">
                                    <a  href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
                                </div>
                                <div class="mv-item-infor">
                                    <h6><a href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'><?php echo $titulli; ?></a></h6>
                                    <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
                                </div>	
                            </div>
                            <?php
        } ?> 				
                    </div>
                    <?php
    }
}
else
//nqs akoma nuk eshte bere asnje kerkim apo filtrim, shfaqen filmat ne rend zbrites sipas titullit

{
    $query = "SELECT * FROM movie ORDER BY title ASC";
    $result = mysqli_query($con, $query);
    $numrows = mysqli_num_rows($result);
    if ($numrows != 0)
    { ?>             <!--Numri i rezultateve te gjetura per kerkimin ne DB-->
                    <p>U gjetën <span><?php echo $numrows; ?></span> rezultate.</p>
                    <?php
    }
    echo '</div>
                   <div class="flex-wrap-movielist">';
    while ($row = mysqli_fetch_assoc($result))
    {
        $image_name = $row['image_name'];
        $titulli = $row['title'];
        $avg_rate = $row['avg_rate'];
        $movie_id = $row['movie_id'];
?>                       <!--Afishimi i rezultateve-->
						<div class="movie-item-style-2 movie-item-style-1">
                        <?php echo "<img src='images/" . $row['image_name'] . "'>"; ?>
							<div class="hvr-inner">
	            				<a  href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
                            </div>
							<div class="mv-item-infor">
								<h6><a href='moviesingle.php?titulli=<?php echo $titulli; ?>&id=<?php echo $movie_id; ?>'><?php echo $titulli; ?></a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span><?php echo $avg_rate; ?></span> /10</p>
                            </div>	
                        </div>
                        <?php
    } ?> 				
                </div>
                <?php
} ?>
                   </div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="sidebar">
					<div class="searh-form">
						<h4 class="sb-title">Kërkoni për një film</h4>
                         <!--Fillimi i formes per te filtruar filmat-->
						<form method="POST" class="form-style-1" action="moviegrid.php">
							<div class="row">
								<div class="col-md-12 form-it">
									<label>Zhanri</label>
									<input type="text" name='zhanri' placeholder="Kërko një zhanër">
                                </div>
                                <div class="col-md-12 form-it">
									<label>Vendi i prodhimit</label>
									<input type="text" name="vendi_prodhimit" placeholder="Kërko një vend prodhimi">
                                </div>
                                <div class="col-md-12 form-it">
									<label>Regjisori</label>
									<input type="text" name="regjisori" placeholder="Kërko nje regjisor">
								</div>
								<div class="col-md-12 form-it">
									<label>Lloji</label>
									<div class="group-ip">
										<select name="tipi" class="ui fluid dropdown">
											<option value="" disabled selected>Zgjidh një lloj</option>
											<option value="Film">Film</option>
					                        <option value="Serial">Serial</option>
					                        <option value="Documentary">Dokumentar</option>
										</select>
									</div>	
								</div>
								<div class="col-md-12 ">
									<input class="submit" type="submit" name="filtro" value="Kërko">
								</div>
							</div>
						</form>
                          <!--Fundi i formes per te filtruar filmat-->
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
 
 <!-- Script Javascript -->
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
