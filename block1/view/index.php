<!DOCTYPE html> 
<html>
    <head>  
        <meta charset="utf-8">
	    <title>CMP306 - Dynamic Web Development 2</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	
	   	<!-- The site uses Bootstrap v5 -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	
		<!-- add a local stylesheet -->
		<link rel="stylesheet" href="nationalpark.css" />
		
    </head>
	<body>
		<div class="container">
			<h1 style="text-align:center;">Block 1</h1>
			<hr style="color:#0784B5; background-color: #0784B5;">
		</div>
		<div class="row"><!-- should display 3 on each row -->
			<?php
				include("../model/get-castles.php") ; //execute sql to return all castles from db
				$itemtxt = getAllCastles() ;
				$item = json_decode($itemtxt) ; //decode json from getAllCastles()

				for ($i=0 ; $i<sizeof($item) ; $i++) { //use json data to print out bootstrap cards
					echo '<div class="col-sm-4">' ;
					echo '<div class="card" style="width: 32rem;">' ;
					echo '<div class="card-header">' ;
					//next line redirects user to the castle individual article
					echo '<a href="moreinfo.php?id='.$i.'">'.$item[$i] -> name.'</a>' ;//uses var to find the correct PHP file
					echo '</div>' ;
					echo '<div class="card-body">' ;
					echo '<img src="../image/'.$item[$i]->image.'" style="width:400px;"/>' ;
					echo '<p>'.$item[$i] -> description.'</p>' ; 
					echo '</div>' ;
					echo '</div>' ;
					echo '</div>' ;
					echo '<br/><br/>' ;
					}
			?>
		</div>
	</body>
	
	<div id="footer" class="card text-center">
		<p>Email : 1700523@uad.ac.uk</p>
    </div><!-- Footer  row -->
			
</html>