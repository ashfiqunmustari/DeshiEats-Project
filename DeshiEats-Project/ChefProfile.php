<?php
session_start();
include("connect.php");
include("functions.php");

if(isset($_SESSION["ID"])){
  if($_SESSION["type"]=="customer"){
    ?>
      <script type="text/javascript">
        alert("Invalid user");
        window.location.href = "Index.php"
      </script>
     <?php 
  }
}else{
  ?>
<script type="text/javascript">
  alert("User needs to be logged In");
  window.location.href = "Login.php"
</script>
<?php
}
$sql = "SELECT * FROM chef where ChefID=".$_SESSION["ID"];
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_assoc($result);


//Update chef code starts here
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_SESSION['ID'])){
    
  $id=$_SESSION['ID'];
  $type=$_SESSION['type'];
  
  $fullName=$_POST['userprofilename'];
  $email=$_POST['userprofileemail'];
  $contact=$_POST['userprofilecontactno'];
  $password=$_POST['userPassword'];
  
  $chefDesc=$_POST['userprofileshortdescription'];
  $chefAddress=$_POST['userprofileaddress'];
  
  
  $destination="images/Uploaded/$id";
  $destination_file="";
  

  $destination_file=$destination.basename($_FILES['userimage']['name']);
  move_uploaded_file($_FILES['userimage']['tmp_name'],$destination_file);
  
  $chefImg=$destination_file;              


  if(!empty($fullName)  && !empty($contact) && !empty($email) && !empty($password) && !empty($chefDesc) && !empty($chefAddress) && !empty($chefImg)){
    if(UpdateUserInfo($CON,$id,$fullName,$email,$contact,$password,$chefDesc,$chefAddress,$chefImg,$type)){
      
      ?>
      <script type="text/javascript">
        alert("User Updated!");
        window.location.href = "ChefProfile.php"
      </script>
      <?php

    }else{
      
      ?>
      <script type="text/javascript">
        alert("Error! cant update check chef Update function");
        window.location.href = "ChefProfile.php"
      </script>
      <?php

    }
  }else{
    
    ?>
      <script type="text/javascript">
        alert("Some fields are empty.Check again");
        window.location.href = "ChefProfile.php"
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


  <title>Deshieats_ChefProfile_Page</title>

</head>

<body>

  <?php
  include "header.php";
  ?>

  <div class="container userprofileform">

    <div class="row userprofileformrow">
      <!--image container div-->
      <div class="col-5 upload">
        <?php
        if(isset($row["ChefImage"])){
          ?>
          <img src="<?php echo $row["ChefImage"] ?>" width=150 height=150 alt="">
          <?php
        }else{?>
<img src="images/profile.png" width=150 height=150 alt="">
<?php
        }
        ?>
        
        <div class="round">
          <input type="file">
          <i class="fa fa-camera" style="color:aliceblue"></i>
        </div>
      </div>

      <div class="col-7 userprofiledit ">
        <div class="userprofileheading mt-4">
          <p class="userprofileheadinguser">Chef's Profile</p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Full Name:</p>
            <input type="text" placeholder="<?php echo $row["ChefName"] ?>" name="userprofilename" value="<?php echo $row["ChefName"] ?>" class="form-control userformholders" />
          </div>

          <!-- **********available Name er ekta variable thakbe... edit button click korle edit kora jabe.*********** -->

          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Email:</p>
            <input type="email" placeholder="<?php echo $row["ChefEmail"] ?>" name="userprofileemail" value="<?php echo $row["ChefEmail"] ?>" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Description:</p>
            <input type="text" placeholder="<?php echo $row["ChefDescription"] ?>" name="userprofileshortdescription" value="<?php echo $row["ChefDescription"] ?>" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Contact No:</p>
            <input type="text" placeholder="<?php echo $row["ChefContactNumber"] ?>" name="userprofilecontactno" value="<?php echo $row["ChefContactNumber"] ?>" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Address:</p>
            <input type="text" placeholder="<?php echo $row["ChefAddress"] ?>" name="userprofileaddress" value="<?php echo $row["ChefAddress"] ?>" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">Password:</p>
            <input type="password" placeholder="<?php echo $row["ChefPassword"] ?>" name="userPassword" value="<?php echo $row["ChefPassword"] ?>" class="form-control userformholders" />
          </div>
          <div class="mb-4 mt-2 userprofilecontents">
            <p class="userprofilelabels">User Name:</p>
            <input type="text" placeholder="<?php echo $row["ChefName"] ?>" name="username" value="<?php echo $row["ChefName"] ?>" class="form-control userformholders" disabled />
          </div>
          <div class="round">
            <input type="file" name="userimage">
            <p class="userprofilelabels">Profile Pic Upload:</p>
            <i class="fa fa-camera" style="color:aliceblue"></i>
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




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>









</html>