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
            $itemname = $item[$pos]-> name;
            $desc = $item[$pos]->castle_text;
            $author = $item[$pos]->author;
            $date = $item[$pos]->year_written;
            $link = $item[$pos]->link;
            $castle_id = $item[$pos]->castle_id
            
        ?>

        <div class="container"> <!-- this container will display all of the information on this page -->
            <?php echo '<h1>'.$itemname.'</h1>';//castle name?>
            <div class="card">
                <?php
                    echo '<h1>Archaeology Notes</h1>'; //article name
                    echo '<hr style="color:#0784B5; background-color: #0784B5;">';
                    echo '<p> '.$desc.' </p><br>'; //displays full article text
                    echo '<p>Written by '.$author.' in '.$date.'</p>'; //displays author name and year written
                    echo '<a href="'.$link.'">Source</a>';
                    echo '<br><br>';
                    echo '<div class = "row">'; //displays image(s) in a row under article text
                    for($i=0;$i<sizeof($image);$i++)
                    {
                        if($image[$i]->castle_id == $castle_id) //only display image if it has the correct castle_id
                            { echo '<img src="../image/'.$image[$i]->image_name.'" style="width: 350px; height: 350px;">';}
                    }
                    echo '</div>';
                    echo '<hr style="color:#0784B5; background-color: #0784B5;">';
                    echo '<div class="container">';
                    echo '<h4>Articles related to this castle</h4>';
                    for($j=0; $j<sizeof($assoc);$j++)
                    {
                        //if castle id matches current castle id, print link to article
                        if($assoc[$j]->castle_id == $castle_id)
                        {
                            //get article id and title from db
                            $article_id = $assoc[$j]->article_id;

                            for($k=0; $k<sizeof($article); $k++)//loop for length of articles db
                            {
                                if($article_id == $article[$k]->article_id)//compare article_id with current value
                                {
                                    $article_name = $article[$k]->article_name; //get title if id's match
                                    echo '<a href="articlepage.php?id='.$k.'">'.$article_name.'</a>';
                                    echo '<br>';
                                }
                            }

                        }
                    }
                    echo '</div>'
                ?> 
            </div>

        </div>


    </body>
    <div id="footer" class="card text-center">
		<p>Email : 1700523@uad.ac.uk</p>
    </div><!-- Footer  row -->
</html>
