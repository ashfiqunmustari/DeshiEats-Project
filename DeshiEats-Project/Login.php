<?php 
    session_start();
    include("connect.php");
    include("functions.php");
    if(isset($_SESSION["ID"]))
    {
            if($_SESSION['type']=="customer"){
                echo "<script> 
                alert('User already logged in.');
                window.location.href='Index.php';</script>";
            }else{
                ?><script>
                alert('User already logged in.');
                window.location.href="Chef'sExhibition.php";</script>
                <?php 
            }
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email=$_POST['useremail'];
        $pass=$_POST['userpassword'];
        if(isset($_POST['flexRadioDefault']))
        $utype=$_POST['flexRadioDefault'];
        else
        $utype="";

        if(!empty($email) && !empty($pass) && !empty($utype)){
            
            loginUser($CON,$email,$pass,$utype); //this function is defined in functions.php . check there

        }elseif($email=="Admin" && $pass=="admin" && empty($utype)){
               $_SESSION["ID"]="000";
               $_SESSION["type"]="Admin";
               ?><script>window.location.href="AdminPanel.php";</script><?php

        }else{
            ?>
            <script type="text/javascript">
               alert("User name or password empty or the type not chosen. Check please.");
               window.location.href = "Login.php"
            </script>
            <?php
        }

    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- Bootstrap CSS -->
    

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <link type="text/css" rel="stylesheet" href="css/DeStylesheet.css"/>
    
        <title>DeshiEats_Login_Page</title>

    </head>

    <body class="bg-dark">

      <?php
        include "header.php" ;
      ?>

        <div class="container">
            <div class="row rowbg pt-3 pb-3">
                <div class="col-6">
                    <img class="img-fluid" src="images/LoginBurger.jpg">
                </div>
                <div class="col-6 formbox">
                    <form action=" "method="POST">
                        <div class="loginlog">
                            <img src="images/Login/deshi.png">
                        </div>
                        <div class="formbox welcome">
                            <p>WELCOME  !!</p>
                        </div>
                        <div class="formbox">
                            <p class="dont">Sign in with your email address and password.</p>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group formbox mb-3"> 
                                <label class="mb-3 formlabel">Email address</label>
                                <input type="text" placeholder="Enter your email address" name="useremail" value="" class="form-control" />
                            </div>
                            <div class="form-group formbox mb-3"> 
                                <label class="mb-3 formlabel">Password</label>
                                <input type="password" placeholder="Enter your password" name="userpassword" value="" class="form-control" />
                            </div>
                            <div class="domatch">
                               <!-- <label>Invalid credentials</label> -->
                            </div>
                            <!-- <div class="form-group formbox mb-3"> 
                                <input type="checkbox" name="rememberme" class="form-check-input" />
                                <label class="dontre">Remember me</label>
                            </div> -->
                            <div class="form-check f_swi">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="chef">
                                <label class="form-check-label labe" for="flexRadioDefault1">
                                I'm a chef
                                </label>
                            </div>
                            <div class="form-check f_swi">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="customer">
                                <label class="form-check-label labe" for="flexRadioDefault2">
                                I'm a customer
                                </label>
                            </div>
                            <div class="formbox formbuto"> 
                                <input type="submit" name="Signin" value="Sign In" class="btn" />
                            </div>
                        </form>
                        <div class="signup formbox mb-3"> 
                            <p class="dont">Don't have an account??</p>
                            <a class="signupregi" href="Register.php">Sign Up</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <?php
          include "footer.php";
        ?>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
    </html>