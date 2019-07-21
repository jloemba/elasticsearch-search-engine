<?php
    require 'app/init.php';
    include "app/crawler/Analyser.class.php";

    if(!empty($_POST)){
        if( isset($_POST['url'] ) ){

            $url = $_POST['url'];

            $crawler = new Analyser();
            $crawl = $crawler->parseUrlSubmitted($url);
            //var_dump($crawler);
            //echo preg_match('/<a[^>]*>(.*?)<\/a>/ims', file_get_contents($url), $matches)
            //echo substr($crawl['url'],10,strlen($crawl['url']));
            if($crawl!= null){
                $index = $es->index([ //es est déclaré dans app/init
                    'index' => 'search_engine' , 
                    'type' => 'sites',
                    'body' => [
                        'link' => $crawl['url'],
                        'title' => $crawl['title'],
                        'content' => $crawl['content']
                    ]
                ]);
    
                
            }else{
                $message = "Ce site n'a pas été indexé soit parce que l'url est invalide ou bien parce que le site existant
                            rencontre des problèmes";
            }
            
           /* $index = $es->index([
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
            } */
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

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">


        <!-- -->
        <div class="row">
            <p> <h1>Indexation de site web | Elastic Search</h1> </p>

            <form action="add.php"  method="post" class="col s12" > 
                <div class="row">
                    <div class="input-field col s6">

                    <h4><label >Le lien URL du site à indexer</label></h4>
                    <input placeholder="Ex : www.awwwards.com" name="url" id="first_name" type="text" class="validate">
                    </div>
                </div>
            </form
        </div>

    <br>

    <?php
        
        //
        if(isset($message)){
            echo $message;   
        }

        //
    
         
                    if(isset($crawler)){
   
                      if($crawler->getHTTPCode() == 200) {



                        ?>

                              <div class="row">
                                <div class="col s12">
                                <div class="card">
    
                                    <div class="card-content">
                                    <span class="card-title"> <h6>Titre de la page indexée</h6> </span>
                                    <span class="teal text-lighten-2" >
                                        <p>
                                            <h7> <?php echo $crawler->title() ?></h7>
                                        </p>
                                    </span>
                                    </div>

    
                                    <div class="card-content">
                                    <span class="card-title"> <h6>Temps de réponse</h6> </span>
                                    <span class="teal text-lighten-2" >
                                        <p>
                                            <h7><?php echo $crawler->getResponseTime() ?> seconde(s)</h7>
                                        </p>
                                    </span>
                                    </div>
    
    
                                    <div class="card-content">
                                    <span class="card-title"> <h6>Poids de la page</h6> </span>
                                    <span class="teal text-lighten-2" >
                                        <p>
                                            <h7><?php echo $crawler->getSizeFile() ?> octet(s) </h7>
                                        </p>
                                    </span>
                                    </div>
    
                              
    
                                    <div class="card-content">
                                    <span class="card-title"> <h6>L'url de la page</h6> </span>
                                    <span class="teal text-lighten-2" >
                                        <p>
                                            <h7> <a href="<?php echo $crawler->getLink() ?>"><?php echo $crawler->getLink() ?></a></h7>
                                        </p>
                                    </span>
                                    </div>
    
                                </div>
                                </div>
                            </div>

                        <?php
        



                
                        
                      }else {
                        echo "Le site recherché n'a visiblement pas été trouvé.";
                      }


                    }

           
                  ?>


  </div><!-- container -->
  </div>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://materializecss.com/bin/materialize.js"></script>
  <script src="https://materializecss.com/templates/starter-template/js/init.js"></script>

</body>
</html>