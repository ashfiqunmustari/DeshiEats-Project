<?php
session_start();
include("connect.php");
include("functions.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">   
        <!-- Bootstrap CSS -->    
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">   
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="css/DeStylesheet.css"/>  
		
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link type="text/css" rel="stylesheet" href="css/AboutUs.css"/>
		<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500&family=Poppins:wght@200&display=swap" rel="stylesheet">	 		
        <title>About DeshEats</title>
    </head>

    <body>
		<?php
        include "header.php" ;
      ?>	
	  <section class="aboutus"> 
		<div class="content">
			<h2> Deshi Eats</h2>
			<p>Taste the Cuisine of Bangladesh</p>
		</div>
		<div class="container">
		<div class="StoryBox">
        <h2>Our Story</h2>
        <p>
            There are many men and women in our country who are amazingly skilled in cooking and serving but cannot own restaurants due to insufficient funds, shortage of suitable property, and lack of management skills. On the other hand, there are many food enthusiasts in our country who love trying different cuisines but do not find the opprotunity to do so! 
        <br>
        <br>
       
            So we thought, why not bring a platform for all the food enthusiasts and cooks of our country?
            <br>
            <br>
            Our platform is a great replacement for owning a physical restaurant. In our platform, the home cooks and small entrepreneurs can be an owner of their own cloud restaurant without the hassle of owning and maintaining a physical restaurant. The owners can reach out to their customers and showcase their culinary skills with a very low-cost promotion and advertisement. Our platform is also a community of food enthusiasts who love to try a variety of cuisines and share the love for home-cooked meals.
            <br>
            <br>
            With a simple and user-friendly design, easy to use features, a variety of well-functioned features, online bill payment systems, and own delivery system; we aim to connect all home cooks and food enthusiasts under one platform.
            <br>
            <br>
            </p>
		</div>					
		</div>
		
		<div class="DevTitle">
		<h2>Meet The Developers</h2>
		</div>
		<div class="cards_wrap">
			<?php  
                $sql = "SELECT * FROM developersinfo";
				$result = mysqli_query($link, $sql);
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
            ?>
                <div class="card_item">
                    <div class="card_inner">
                        <img src="<?php echo $row["DevImage"] ?>" alt="">
                        <div class="dev_name">
                            <?php echo $row["DevName"]; ?>
                        </div>
                    </div>
                </div>
			<?php  
                     }  
                }  
            ?>
        </div>
		<button class="ContactBtn">
            <a href="Contact.php">Get In Touch</a>
        </button>
	  </section>

          <?php
            include "footer.php";
          ?>

	</body>
	

</html>