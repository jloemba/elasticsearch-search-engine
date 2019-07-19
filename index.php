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
                            'match' => ['body' => $query],
                            'match' => ['keywords' => $query]

                        ]
                    ]
                ]
            ]
        ]);

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
</head>
<body>

        <form action="/" autocomplete="off" method="get" >
            <label ></label>
            <input type="text" name="query" placeholder="Recherchez quelque chose">
        
            <input type="submit" value="Rechercher">
        </form>
        <hr>
        <br>
        <?php

            if(isset($results)){
                foreach($results as $r){
                    ?>
                        <div class="result">
                            
                            <a href="#<?php echo $r['_id']; ?>">
                                <?php echo $r['_source']['title']; ?>
                            </a>

                            <div class="extract-body">
                            <?php echo substr($r['_source']['body'],0,100) ; ?>
                            </div>

                            <div class="result-keywords">
                              <b><?php echo $r['_source']['keywords'] ; ?></b>
                            </div>
                            <br>
                            <br>
                        </div>
                    <?php
                }
            }
            ?>


        

</body>
</html>