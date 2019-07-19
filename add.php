<?php
    require 'app/init.php';

    if(!empty($_POST)){
        if(isset($_POST['title'] , $_POST['body'] , $_POST['keywords'] )){

            $title = $_POST['title'];
            $body = $_POST['body'];
            $keyword = $_POST['keywords'];

            //echo $title;
            //echo $body;
            //echo $keyword;

            $index = $es->index([
                'index' => 'articles' , 
                'type' => 'article',
                'body' => [
                    'title' => $title,
                    'body' => $body,
                    'keywords' => $keyword
                ]
            ]);

            if($index){
                //print_r($index);
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter quelque chose à l'index | Elastic search</title>

    <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://materializecss.com/dist/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://materializecss.com/templates/starter-template/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
<body>
    
    <form action="add.php" method="post">

        <label>
            Le titre
            <input type="text" name="title">
        </label>
        
        <label>
            Le content
            <textarea name="body" id="" cols="30" rows="10"></textarea>
        </label>

        <label for="">
            Keywords
            <input type="text" name="keywords" placeholder="comma,separator">
        </label>

        <input type="submit" value="Rajouter">
    </form>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://materializecss.com/bin/materialize.js"></script>
  <script src="https://materializecss.com/templates/starter-template/js/init.js"></script>

</body>
</html>