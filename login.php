<?php
$err_username = $err_fjalekalimi = $err = $err1 = $sukses = "";
if (isset($_POST["kycu"]))
{ //kontrollohet nqs eshte shtypur butoni Kycu
    if (!empty($_POST['user']) && !empty($_POST['fjalekalim']))
    { //kontrollohet nqs jane plotesuar fushat user dhe fjalekalim
        $user = $_POST['user'];
        $pass = md5($_POST['fjalekalim']);
        require ('connect.php'); //behet lidhja me db
        if (empty($user)) //nqs nuk eshte plotesuar fusha username
        
        {
            $err_username = 'Ju lutem plotësoni username-in.';
        }
        if (empty($pass)) //nqs nuk eshte plotesuar fusha e fjalekalimit
        
        {
            $err_fjalekalimi = 'Ju lutem plotësoni fjalëkalimin.';
        }

        if (!empty($errors))
        {
            foreach ($errors as $value) echo $value . "<br/>"; //afishim i erroreve nqs ka
            
        }
        else
        {

            $query = mysqli_query($con, "SELECT * FROM user WHERE username='" . $user . "' AND password='" . $pass . "'"); //query per te marre te dhenat nga db
            $numrows = mysqli_num_rows($query);
            if ($numrows != 0)
            {
                while ($row = mysqli_fetch_assoc($query))
                {
                    $dbusername = $row['username'];
                    $dbfjalekalimi = $row['password'];
                }
                if ($user == $dbusername && $pass == $dbfjalekalimi) //nqs username dhe fjalekalim i vendosur si input nga perdoruesi gjendet dhe ne db
                
                {
                    if (isset($_POST['mbaj_mend']))
                    { //ne nqs klikohet checkbox Me mbaj mend
                        setcookie('username', $_POST['user'], time() + 3600, '', ''); //krijohet cookie per username
                        setcookie('password', $_POST['fjalekalim'], time() + 3600, '', ''); //krijohet cookie per fjalekalimin
                        
                    }
                    $sukses = "Ju u loguat. Mirësevini.";
                    session_start(); //fillim i session
                    $_SESSION['username'] = $user;
                    header("location:welcome.php"); //ridrejtim per ne faqen Home per perdorues te kycur
                    
                } 
            
            }
            else
            {
                $err = 'Username ose fjalëkalimi nuk është i saktë.';
            }
        }
    }
    else
    {
        $err1 = "Duhet të plotësoni të gjitha fushat";
    }
}
?>



<html lang="en" class="no-js">
<head>
<title>Kycu</title>
<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">
    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">
	<!-- Skedaret CSS-->
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
<!-- Fillim |Header -->
<?php include "./header.php" ?>
      </div>
      </header>
<!-- Fund |Header -->
<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1 style="position:relative;left:80px;bottom:120px;color:#1f2e2e">Kyçu</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div  class="ndryshoFDiv">
<h4 style="position:relative;bottom:25px;color:red;"><?php echo $err; ?></h4>
<h4 style="position:relative;bottom:25px;color:red;"><?php echo $err1; ?></h4>
<h4 style="position:relative;bottom:25px;color:red;"><?php echo $sukses; ?></h4>
    <!-- Fillon forma e logimit-->    
          <form method="post" action="login.php">
            <div class="rresht">
              <label >
                Username:
                <input id="username"
                  type="text"
                  name="user"
                  placeholder=""     
                />
            </div>
            <div class="rresht">
              <label for="fjalekalimi">
                Fjalëkalimi:
                <input id="password"
                  type="password"
                  name="fjalekalim"
                  placeholder=""
                />
            </div>
            <div class="row">
            	<div class="remember">
					<div>
						<input type="checkbox" name="mbaj_mend" value="1"><span style="padding-left:10px;">Më mbaj mend</span><br><br>
					</div>
            	</div>
            </div>
            <div>
              <button type="submit" class="ndryshoFBtn" name="kycu">
                Kycu
              </button>
              </div>
              </form>
        </div>
      </div>
    </div>
    <!-- mbaron forma e logimit-->
</body>
</html>
<?php
if (isset($_COOKIE['username']) && isset($_COOKIE['password']))
{ //nqs eshte krijuar cookie per username dhe password
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
    //perdoret script per te mbajtur fushat te plotesuara
    echo "<script>  
     document.getElementById('username').value='$username'; 
     document.getElementById('password').value='$password';
     </script>";
}
?>
