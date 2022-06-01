<?php
$error_username = $error_fjalekalimi = $error_konfirmo_fjalekalimin = $rregj_sukses = "";
if (isset($_POST['rregjistrohu']))
{ //nqs eshte shtypur butoni rregjistohu
    $username = $_POST['username'];
    $fjalekalimi = $_POST['fjalekalimi'];
    $konfirmo_fjalekalimin = $_POST['konfirmo_fjalekalim'];
    require "connect.php"; //behet lidhja me db
    //nese form eshte submitted atehere validohen fushat input
    if (empty($username)) //nqs username nuk eshte plotesuar
    
    {
        $error_username = 'Ju lutem plotesoni username-in.';
    }

    $uppercase = preg_match('@[A-Z]@', $fjalekalimi); //kontrollet per fjalekalimin
    $lowercase = preg_match('@[a-z]@', $fjalekalimi);
    $numer = preg_match('@[0-9]@', $fjalekalimi);
    $karakterspecial = preg_match('@[?=.*?[#?!$%^&*-]@', $fjalekalimi);
    if (!$uppercase || !$lowercase || !$numer || !$karakterspecial || strlen($fjalekalimi) < 8)
    {
        $error_fjalekalimi = 'Fjalëkalimi nuk është i saktë. Ai duhet të përmbajë jo më pak se 8 karaktere nga të cilat minimumi 1 gërmë të madhe, 1 numër dhe 1 karakter special.';
    }
    if (empty($fjalekalimi))
    {
        $error_fjalekalimi = 'Ju lutem plotësoni fjalëkalimin.';
    }
    if (empty($konfirmo_fjalekalimin))
    {
        $error_konfirmo_fjalekalimin = 'Ju lutem plotësoni konfirmimin e fjalëkalimit.';
    }
    else if ($konfirmo_fjalekalimin != $fjalekalimi)
    {
        $error_konfirmo_fjalekalimin = 'Fjalëkalimi nuk përputhet! Ju lutem rishkruani edhe njëherë fjalëkalimin.';
    }
    if (!empty($errors))

    {
        foreach ($errors as $value) echo $value . "<br/>"; //afishim i erroreve nqs ka
        
    }

    else
    {
        $query = mysqli_query($con, "SELECT * FROM user WHERE username='" . $username . "'"); //query per te kontrolluar nqs ka user me nje username te tille ne db
        $numrows = mysqli_num_rows($query);
        if ($numrows == 0) //nqs username nuk egziston ne db, useri mund te rregjistrohet
        
        {
            if (!empty($username) && !empty($fjalekalimi) && !empty($konfirmo_fjalekalimin))
            { //kontrollon qe jane plotesuar te gjitha fushat
                if ($fjalekalimi == $konfirmo_fjalekalimin)
                { //kontrollon qe fjalekalimet perputhen
                    $sql = "INSERT INTO user(username, password) VALUES ('$username', md5('$fjalekalimi') )"; //rregjitrohen te dhenat ne db
                    $result = mysqli_query($con, $sql);
                    if ($result)
                    {
                        $rregj_sukses = "Llogaria juaj u krijua me sukses!";
                        header("refresh:3;url=login.php"); // ridrejtim per tu kycur me username dhe password te krijuar  
                    }
                }
                else
                {
                    echo "Rregjistrimi nuk mund te behet.";
                }
            }
        }
        else
        {
            $error_username = "Ky username egziston tashmë. Provoni një username tjetër.";
        }
    }
} //nqs ka tashme nje user ne db me kete username

?>
    

<html lang="en" class="no-js">
<head>
<title>Rregjistrohu</title>
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
    <link rel="stylesheet" href="css/styles.css">
    <style>
        div.user-hero {
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
<!-- Fillim| Header -->
<?php include "./header.php" ?>
      </div>
      </header>
<!-- Fund| Header -->
<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="position:relative;left:80px;bottom:120px;color:#1f2e2e">Regjistrohu</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div  class="ndryshoFDiv">
  <h4 style="position:relative;bottom:25px;color:red;"><?php echo $rregj_sukses ?></h4>
    <!-- Fillon forma e rregjistrimit-->    
          <form method="post" action="signup.php">
         
            <div class="rresht">
              <label >
                Username:
                <input
                  type="text"
                  name="username"
                  placeholder=""     
                />
              </label><span class="errors"><?php echo $error_username; ?></span>
            </div>
            <div class="rresht">
              <label for="fjalekalimi">
                Fjalëkalimi:
                <input
                  type="password"
                  name="fjalekalimi"
                  placeholder=""
                />
              </label><span class="errors"><?php echo $error_fjalekalimi; ?></span>
            </div>
            <div class="rresht">
              <label for="konfirmo_fjalekalimin">
                Konfirmo fjalëkalimin:
                <input
                  type="password"
                  name="konfirmo_fjalekalim"  
                  placeholder=""
                />
              </label><span class="errors"><?php echo $error_konfirmo_fjalekalimin; ?></span>
            </div>
            <div>
              <button type="submit" class="ndryshoFBtn" name="rregjistrohu">
                Regjistrohu
              </button>
              </div>
              </form>
        </div>
      </div>
    </div>
    <!-- mbaron forma e rregjistrimit-->
</body>
</html>
