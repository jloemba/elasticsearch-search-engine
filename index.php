<?php
    require 'app/init.php';

    if(isset($_GET['query'])){
        $query = $_GET['query']; 
        $query = $es->search([
            'body' => [
                'query'=> [
                    'bool' => [
                        'should' => [
                            'match' => ['title' => $query],
                            'match' => ['link' => $query],
                            'match' => ['content' => $query]
                        ]
                    ]
                ]
            ]
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
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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

                        foreach($results as $r){
                            ?>
                                <section id="about">
                                        <div class="container">

                                        <div class="row">
                                            <div class="col-lg-12 mx-auto">
                                            <h2> <?php echo $r['_source']['title']; ?></h2>
                                            <p class="lead">
                                            <h2> <a href="<?php echo $r['_source']['link']; ?>"></a><?php echo $r['_source']['link']; ?></h2>
                                            </p>

                                            </div>
                                        </div>
                                        </div>
                                    </section>
                                    <?php
                                    }
                                }
                                ?>

        
        <script src="js/extention/choices.js"></script>
        <script src="js/main.js"></script>
        <script src="js/extention/custom-materialize.js"></script>
        <script src="js/extention/flatpickr.js"></script>

</body>
</html>