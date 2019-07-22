<?php
    require 'app/init.php';

    if(isset($_GET['query'])){
        $q = $_GET['query']; 
        $query = $es->search([
            'body' => [
                'query'=> [
                    'bool' => [
                        'should' => [
                            'wildcard' => [
                                'title' => '*'.$q.'*'
                            ],
                            'wildcard' => [
                                    'link'=> '*'.$q.'*'
                            ],
                            'wildcard' => [ 
                                    'content'=>'*'.$q.'*'
                            ] 
                        ]
                    ]
                ]
            ]
                        
            //'from' => 0,
            //'size' => 10
        ] );

        if( $query['hits']['total'] >= 1 ){
            $results =  $query['hits']['hits'];
        }
        //echo '<pre>',print_r($query), '</pre>';
    }
    
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moteur de recherche | Elastic search</title>

   
  <!-- Bootstrap core CSS -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://materializecss.com/dist/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="https://materializecss.com/templates/starter-template/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<!-- Custom styles for this template -->
<link href="css/scrolling-nav.css" rel="stylesheet">

</head>
<body id="page-top">

          <section class="bg-primary text-white">
    <div class="container text-left">
      <h1>Votre moteur de recherche</h1>
      <br>
      <br>
      <form action="/" autocomplete="off" method="get" >
          <div class="md-form">
              <input type="text" name="query" class="form-control" placeholder="Votre recherche.." id="">

            </div>
            <input type="submit"  class="btn btn-primary"  value="Envoyer">

      </form>
    </div>
  </section>

       

        <br>
       
                    <?php

                    if(isset($results)){
                        if(count($results) >0){
                            foreach($results as $r){
                                ?>
                               
                               <div class="row container">
                                    <div class="col s12">
                                    <div class="card">
                                                <div class="card-content">
                                                <span class="card-title"> <h7><?php echo $r['_source']['title']; ?></h7> </span>
                                                <span class="teal text-lighten-2" >
                                                    <p>
                                                        <h6>  <a href="<?php echo $r['_source']['link']; ?>"><?php echo $r['_source']['link']; ?></a></h6>
                                                    </p>
                                                </span>
                                                </div>
                                    </div>
                                    </div>
                                </div>
                                        <?php
                                        }
                        }else{
                            ?>
                            <div class="container">
                                <hr>
                                <span class="card-title">
                                <p><?php echo count($query['hits']['hits']) ?> résultat(s)</p>
                                </span>
                            </div>
                            
                            <?php
                        }
                        
                    }
                                ?>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://materializecss.com/bin/materialize.js"></script>
  <script src="https://materializecss.com/templates/starter-template/js/init.js"></script>

</body>
</html>