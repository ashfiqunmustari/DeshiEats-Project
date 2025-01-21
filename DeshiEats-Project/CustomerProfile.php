<?php 
  session_start();
  include("connect.php");
  include("functions.php");
  
  if(isset($_SESSION['ID'])){
    $id=$_SESSION['ID'];
    $type=$_SESSION['type'];
    
    $displayinfo=userInfoGet($CON,$id,$type);

    $showName=$displayinfo['CustName'];
    $showEmail=$displayinfo['CustEmail'];
    $showContact=$displayinfo['CustContactNumber'];
    $showAddress=$displayinfo['CustAddress'];
    $showArea=$displayinfo['CustArea'];
    
    
  }else{

  }


  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_SESSION['ID'])){
    
    $id=$_SESSION['ID'];
    $type=$_SESSION['type'];
    
    $fullName=$_POST['userprofilename'];
    $email=$_POST['userprofileemail'];
    $contact=$_POST['userprofilecontactno'];
    $password=$_POST['userPassword'];
    
    $area=$_POST['userarea'];
    $Address=$_POST['useraddress'];
    $chefImg="";
    
    

    if(!empty($fullName)  && !empty($contact) && !empty($email) && !empty($password)){
      if(UpdateUserInfo($CON,$id,$fullName,$email,$contact,$password,$area,$Address,$chefImg,$type)){      
        ?>
        <script type="text/javascript">
          alert("User Updated!");
          window.location.href = "CustomerProfile.php"
        </script>
        <?php
      }else{    
        ?>
        <script type="text/javascript">
          alert("Error! cant update check customer Update function");
          window.location.href = "CustomerProfile.php"
        </script>
        <?php
      }
    }else{
      ?>
        <script type="text/javascript">
          alert("Some fields are empty.Check again");
          window.location.href = "CustomerProfile.php"
        </script>
      <?php

    }


  }else{

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

  <link type="text/css" rel="stylesheet" href="css/DeStylesheet2.css" />


  <title>Deshieats_CustomerProfile_Page</title>

</head>

<body>

  <?php
  include "header.php";
  ?>
  <div class="container userprofileform">

    <div class="row userprofileformrow">

      <div class="col-7 userprofiledit ">
        <div class="userprofileheading mt-4">
          <p class="userprofileheadinguser">Customer's Profile</p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Full Name:</p>
            <input type="text" placeholder=" <?php echo $showName; 
                                                      ?>" name="userprofilename" value="" class="form-control userformholders" />
          </div>

          <!-- **********available Name er ekta variable thakbe... edit button click korle edit kora jabe.*********** -->

          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Email:</p>
            <input type="email" placeholder="<?php echo $showEmail;?>" name="userprofileemail" value="<?php echo $showEmail;?>" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Contact No:</p>
            <input type="text" placeholder="<?php echo $showContact ;?>" name="userprofilecontactno" value="" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Password:</p>
            <input type="password" placeholder="Password is hidden<?php //echo $password ?>" name="userPassword" value="" class="form-control userformholders" />
          </div>
          
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">User Address:</p>
            <input type="text" placeholder="<?php echo $showAddress; ?>" name="useraddress" value="" class="form-control userformholders" />
          </div>
          
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">User Area:</p>
            <input type="text" placeholder="<?php echo $showArea; ?>" name="userarea" value="" class="form-control userformholders" />
          </div>
          


          <div class="userprofileallbuttons">
            <button type="submit" name="UserProfileconfirm" value="Save changes" class="btn-submit" onclick=" "> Submit</button>
            <!--<input type="submit" name="UserProfilePasswordChange" value="Change Password" class="passwordchangebutton" onclick=" "/>-->
          </div>
        </form>
      </div>
    </div>

  </div>

  <?php
  include "footer.php";
  ?>




  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>









</html>