<?php
$error_fjalekalim = $error_fjalekalim_i_ri = $error_konf_fjalekalim = $error_username = $u_shtua = "";
$error = array();
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['ndrysho']))
    {
        $username = $_POST['username'];
        $fjalekalim = md5($_POST['fjalekalim']);
        $fjalekalim_i_ri = $_POST['fjalekalim_i_ri'];
        $konf_fjalekalim = $_POST['konf_fjalekalim'];
        //kontrolle per gabime ne inputet e formes se ndryshimit te fjalekalimit
        if (empty($username))
        {
            $error_username = "Ju harruat të vendosnit një username !";
            $error[] = $error_username;
        }
        //kontrollo nese fjalekalimi aktual eshte futur sakte(perputhet me ate te username-it)
        $id_e_perdoruesit = mysqli_query($con, "SELECT password from user where username='$username' ") or die("Nuk u realizua query" . musqli_error());
        $user_row = mysqli_fetch_array($id_e_perdoruesit);
        if ($user_row['password'] != $fjalekalim)
        {
            $error_fjalekalim = "Fjalëkalimi është i gabuar !";
            $error[] = $error_fjalekalim;
        }

        if (empty($fjalekalim))
        {
            $error_fjalekalim = "Ju harruat të plotësonit fjalëkalimin aktual !";
            $error[] = $error_fjalekalim;
        }

        $uppercase = preg_match('@[A-Z]@', $fjalekalim_i_ri);
        $lowercase = preg_match('@[a-z]@', $fjalekalim_i_ri);
        $numer = preg_match('@[0-9]@', $fjalekalim_i_ri);
        $karakterspecial = preg_match('@[?=.*?[#?!$%^&*-]@', $fjalekalim_i_ri);
        if (!$uppercase || !$lowercase || !$numer || !$karakterspecial || strlen($_POST["fjalekalim_i_ri"]) < 8)
        {
            $error_fjalekalim_i_ri = 'Fjalekalimi nuk eshte i sakte. Ai duhet te permbaje minimumi 8 karaktere,ku të paktën të jetë 1 germe te madhe, 1 numer dhe 1 karakter special.';
            $error[] = $error_fjalekalim_i_ri;
            $error[] = $error_fjalekalim_i_ri;
        }
        if (empty($fjalekalim_i_ri))
        {
            $error_fjalekalim_i_ri = "Ju harruat të plotësonit fjalëkalimin e ri !";
            $error[] = $error_fjalekalim_i_ri;
        }

        if (empty($konf_fjalekalim))
        {
            $error_konf_fjalekalim = "Ju harruat të konfirmonit fjalëkalimin e ri  !";
            $error[] = $error_konf_fjalekalim;
        }
        if ($_POST['fjalekalim_i_ri'] != $_POST['konf_fjalekalim'])
        {
            $error_konf_fjalekalim = "Fjalëkalimi i konfirmuar nuk përputhet me fjalëkalimin e ri ! ";
            $error[] = $error_konf_fjalekalim;
        }

        else if (empty($error))
        {
            //$query qe perditeson fjalekalimin
            $query_ndrysho_fjalekalim = "UPDATE user set password=md5('$fjalekalim_i_ri') where username='$username' ";
            $ndrysho_F = mysqli_query($con, $query_ndrysho_fjalekalim);
            if (!$ndrysho_F)
            {
                die("Fjalekalimi nuk u ndryshua" . mysqli_error($con));
            }
            else
            {
                $u_shtua = "Fjalëkalimi u ndryshua me sukses !";
            }

        }
    }
}

?>

<html lang="en" class="no-js">
<head>
<title>Ndrysho fjalekalimin</title>
<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- Skedare CSS -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
  body {background-color: rgb(211, 214, 218);}

div.hero.user-hero{
    background:none;
    background-color: rgb(211, 214, 218)!important;
}
div.ndryshoFDiv{
          width:80%;
        }
span.errors{
  left:700px;
  padding-right:10px;
}

        </style>
</head>
<body>





<!-- FILLIM| Header -->
<?php include "header1.php" ?>
</div>
</header>
<!-- FUND| Header -->

<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="position:relative;left:80px;bottom:120px;color:#1f2e2e">Ndrysho fjalëkalimin</h1>
					
				</div>

			</div>

            
		</div>
	</div>
</div>
<div  class="ndryshoFDiv">
      
         
          <form method="post" action="ndrysho_fjalekalim.php">
          <h5 style="position:relative;bottom:25px;color:red;"><?php echo $u_shtua; ?></h4>
            <div class="rresht">
              <label >
                Username-i:
                <input
                  type="text"
                  name="username"
                  placeholder=""
                  
                 
                />
              </label><span class="errors"><?php echo $error_username; ?></span>
            </div>

            <div class="rresht">
              <label for="password">
                Fjalëkalimi aktual:
                <input
                  type="password"
                  name="fjalekalim"
                  
                  placeholder=""
                  
                
                />
              </label><span class="errors"><?php echo $error_fjalekalim; ?></span>
            </div>
            <div class="rresht">
              <label for="password-2">
                Fjalëkalimi i ri:
                <input
                  type="password"
                  name="fjalekalim_i_ri"
                  
                  placeholder=""
                 
                />
              </label><span class="errors"><?php echo $error_fjalekalim_i_ri; ?></span>
            </div>
            <div class="rresht">
              <label for="repassword-2">
                Konfirmo fjalëkalimin e ri:
                <input
                  type="password"
                  name="konf_fjalekalim"
                  
                  placeholder=""
                  
                  
                />
              </label><span class="errors"><?php echo $error_konf_fjalekalim; ?></span>
            </div>
            <div>
              <button type="submit" class="ndryshoFBtn" name="ndrysho">
                Ndrysho fjalëkalimin
              </button>
              </div>
              </form>
             <button class="kthehu"> 
            <a href="profili_im.php" style="color:white;" >Kthehu te profili</a>
            </button>
        </div>
      </div>
    </div>
    <!-- mbaron ndrysho fjalekalimin-->
</body>
</html>
