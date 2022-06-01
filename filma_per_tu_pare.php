<?php 
include 'connect.php';
$vleresim_error="";
$shfaq_faqosjen=true;

session_start();//fillim i sesionit
if (isset($_SESSION['username']))
 {  $user_korr=$_SESSION['username'];//merret nga sesioni username i user-it korrent
 }
 //zbatohet query per gjetjen e  id-se se user-it korrent
$query_user_id=mysqli_query($con,"SELECT user_id from user where username='$user_korr'") 
or die ("Nuk u realizua query".mysqli_error($con));
$user_i=mysqli_fetch_array($query_user_id);
$user_korrent_id=$user_i['user_id'];

//nese eshte shtypur butoni i fshirjes
if (isset($_POST['submitFshij']))
 {$film_per_tu_fshire=$_POST['film_per_tu_fshire'];
 //query per fshirjen e filmit 
  mysqli_query($con,"DELETE FROM movie_to_whatch where movie_id='$film_per_tu_fshire'and user_id='$user_korrent_id' ") or 
  die("Filmi nuk arriti të fshihej !".mysqli_error());
 }?>


<!--kodi html-->
<!DOCTYPE html>
<html lang="en" class="no-js" style="overflow-x:hidden;">
<head>
<title>Profili im</title>
<meta charset="UTF-8">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<link rel="profile" href="#">

<!--Fonte nga Google-->
 <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
<!-- meta per Mobile-->
 <meta name=viewport content="width=device-width, initial-scale=1">
 <meta name="format-detection" content="telephone-no">

<!-- file-t CSS -->
<link rel="stylesheet" href="css/plugins.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/styles.css">
<style>
.xB {
  position: relative;
  bottom: 301px ;
  left: 135px ;
  background-color: red ;
  color: white ;
  font-weight: 900 ;
  border-radius: 30% ;
}
.titulli_Listes {
  text-align: center ;
  color: #9dc0e3 ;
  position: relative ;
  bottom: 30px ;
  font-family: times new roman ;
  font-family: Arial, Helvetica, sans-serif ;
}

div.hero.user-hero{
           background:none;
           background-color: rgb(211, 214, 218)!important;
		}
		
	footer.ht-footer{
	background-color:#020d18;
}
div.hero.user-hero{
	background:url(https://images.unsplash.com/photo-1535016120720-40c646be5580?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80);
	background-size:cover;
	background-position:center;
	}
	.popcorn {
  height: 70px;
  width: 70px;
  object-fit: cover;
  background-color: #92adc7;
  border-radius: 50%;
}
</style>
</head>

<body>
<!-- FILLIM| Header -->
<?php include "header1.php"?>
</div>
</header>
<!-- FUND| Header -->

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="position:relative;left:160px;color:white;">Profili im</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img" id="tab1">
					<a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
						<a href="#" class="redbtn"><?php echo $user_korr;?></a>
					</div>
					<div class="user-fav">
					<p>Listat e mia</p>
					<ul>
					<li ><a href="profili_im.php#tab1">Filma të parë</a></li>
					<li class="active"><a href="filma_per_tu_pare.php#tab1">Filma për t'u parë</a></li>
					</ul>
					</div>
					<div class="user-fav">
						<p>Të tjera</p>
						<ul>
						<li><div ><a  href="ndrysho_fjalekalim.php">Ndrysho fjalëkalimin</a></div></li>
						<li><a href="logout.php">Dil</a></li>
						</ul>
					</div>
				</div>
			</div>

<?php 
//query per selektimin e filmave "per tu pare" nga perdoruesi
$filmat_rez=mysqli_query($con,"SELECT movie_id from movie_to_whatch where user_id='$user_korrent_id'") 
or die('Nuk u nxoren'.mysqli_error());
$nr_filmash=mysqli_num_rows($filmat_rez);

//ndarja ne faqe e filmave
$filma_per_faqe = 10;
$nr_faqesh = ceil($nr_filmash/$filma_per_faqe);
if (!isset($_GET['page']))
 {
  $faqe = 1;
 }
else
 {
  $faqe = $_GET['page'];
 }
$rez_pare_i_faqes = ($faqe-1)*$filma_per_faqe;
$sql="SELECT movie_id from movie_to_whatch where user_id='$user_korrent_id' LIMIT  ". $rez_pare_i_faqes . "," .  $filma_per_faqe;
$rezultat2 = mysqli_query($con, $sql);
?>
			
  <!--lista e filmave per tu parë-->
  <div class="col-md-9 col-sm-12 col-xs-12" id="tab2" >
		<h3 class="titulli_Listes">FILMA PËR T'U PARË <img src="images/wm.webp" class="popcorn" ></h3>
			<div class="topbar-filter user">
			<p>U gjetën <span><?php echo $nr_filmash;?> filma</span> në total</p>
			</div>
  <div class="flex-wrap-movielist grid-fav" style="overflow-x:hidden;">
<?php 
//nese nuk gjendet asnje film
 if($nr_filmash<1)
 {
	 $shfaq_faqosjen=false;?>
     <tr >Lista juaj është boshe !</tr></tbody></table><?php
  
 }
else {//nese gjenden filma 
        while ($row=mysqli_fetch_array($rezultat2))//marrja e filmave rresht pas rreshti
         {
		   $filmi_id=$row['movie_id'];
          //query qe merr te dhenat e secilit film 
           $query_per_film_detaje="SELECT * FROM movie where movie_id='$filmi_id' ";
           $rez_film_detaje=mysqli_query($con,$query_per_film_detaje);
           $row_film=mysqli_fetch_array($rez_film_detaje);//nxjerrja e detajeve te filmit?>

           <!-- shfaqja e secilit film-->
           <div class="movie-item-style-2 movie-item-style-1 style-3" id="div_<?php echo $row_film['movie_id'] ;?>">
				     <img src= "images/<?php echo $row_film['image_name'];?>" alt="<?php echo $row_film['movie_id'];?>.png"style="height:231px;width:301px;">
				       <div class="hvr-inner">
	              <a  href='moviesingle1.php?id=<?php echo $filmi_id; ?>'> Lexo më shumë <i class="ion-android-arrow-dropright"></i> </a>
	             </div>
				    <div class="mv-item-infor">
				    <h6><a href='moviesingle1.php?id=<?php echo $filmi_id; ?>'><?php echo $row_film['title'];?></a></h6>
				    <p class="rate"><i class="ion-android-star"></i><span>
				   	<?php echo $row_film['avg_rate'];?></span> /10
				    </p>
				    <!-- forma e fshirjes se filmit -->
                    <form action="filma_per_tu_pare.php#tab2" method='post' role="form">
                      <p>
			        	<input type="hidden" required name="film_per_tu_fshire" value='<?php echo $filmi_id ?>'/>
                        <input type="submit" name="submitFshij" id="fshij" class='xB'value="X" 
				          onclick= "deleteAjax('<?php echo $row_film['movie_id'] ; ?>')"  />
				     </p>
                   </form>
                </div>
            </div><?php 
         }
}?>
</div>

<!-- shfaqja e faqosjes-->
	<div class="topbar-filter" id="tobe">
	    <div class="pagination2">
          <?php if($shfaq_faqosjen)
		  {?>
			<span>Faqja <?php 
			if (!isset($_GET['page'])) 
				{$faqja = 1;}
			else {$faqja = $_GET['page'];}
			echo $faqja ;?> nga <?php echo $nr_faqesh;?>
			</span>
			<span style=" padding-left:240px;">
			<?php for ($faqe=1;$faqe<=$nr_faqesh;$faqe++) {?>
			<a class="active" href="filma_per_tu_pare.php?page=<?php echo $faqe;?>"><?php echo $faqe;?> </a><?php } ?>
			</span><?php
			 }?>
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

<script>//funksion per zbehjen e filmit te  fshire
 function deleteAjax(id) 
 {
  jQuery('#div_'+id).hide(1000);
  console.log("u fshi");
}
</script>
<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
											
						
					
					
						
				






						
	            		
						
	            		
						
	            		
	            		
	            		
	            		
					
	