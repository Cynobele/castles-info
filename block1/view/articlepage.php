<?php
    include("navbar.php");// navigation to get back to index
?>

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
        <?php
            include("../model/get-castles.php") ; //retrieve JSON and decode for each table
            $itemtxt = getAllCastles() ;//get records from castles table
            $item = json_decode($itemtxt) ;

            $articletxt = getArticleRecord();
            $article = json_decode($articletxt);

            $assoctxt = getAssocRecord() ;//get records from association table cas_art
            $assoc = json_decode($assoctxt) ;

            $imagetxt = getImageRecord();//get records from images table
            $image = json_decode($imagetxt);

            $pos = $_GET['id'];//position in database
            //set variable names using data from json
            $article_name = $article[$pos]->article_name;
            $article_text = $article[$pos]->article_text;
            $article_id = $article[$pos]->article_id;
            $article_img = $article[$pos]->img;
        ?>

        <div class="container"> <!-- this container will display all of the information on this page -->
            <?php echo '<h1>'.$article_name.'</h1>';//article name?>
            <div class="card">
                <?php
                    echo '<p> '.$article_text.' </p><br>'; //displays full article text
                    echo '<img src="../image/'.$article_img.'" style="width:600px; height: 500px;">';

                    echo '<hr style="color:#0784B5; background-color: #0784B5;">'; //display links to related castles
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<h4>Castles related to this article</h4>';
                            for($i=0;$i<sizeof($assoc); $i++)
                            {
                                if($assoc[$i]->article_id == $article_id)//compare this article's id with the db
                                {
                                    $castle_id = $assoc[$i]->castle_id; //get castle id if articles match
                                    for($j=0;$j<sizeof($item);$j++)
                                    {
                                        if($castle_id == $item[$j]->castle_id)
                                        {
                                            $castle_name = $item[$j]->name; //get name if id's match
                                            echo '<a href="moreinfo.php?id='.$j.'">'.$castle_name.'</a>';
                                            echo '<br>';
                                        }
                                    }
                                }
                            }
                        echo '</div>';
                    echo '</div>';
                ?> 
            </div>
        </div>


    </body>
    <div id="footer" class="card text-center">
		<p>Email : 1700523@uad.ac.uk</p>
    </div><!-- Footer  row -->
</html>
