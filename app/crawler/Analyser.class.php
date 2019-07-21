<?php

class Analyser
{
  private $link = null;
  private $userAgent = null;
  private $httpcode;
  private $responsetime;
  private $sizefile = null;
  private $checkSemantic = null;
  private $numberTag =  null ;
  private $numberScriptTag = null;
  private $msg = null;
  private $curl = null;
  private $title = null;


  function __construct()
  {
    // code...
    $this->curl = curl_init();
  }


  public function getCurl(){
    return $this->curl;
  }

  public function getMessage(){
    return $this->msg;
  }

  public function setMessage($value)
  {
      $this->msg = $value;
  }

  public function getLink(){
    return $this->link;
  }

  public function setLink($value)
  {
      $this->link = $value;
  }

    //CODE HTTP
  public function setHTTPCode($value){
    $this->httpcode = $value;
  }
  public function getHTTPCode(){
    return $this->httpcode;
  }

  //TEMPS DE REPONSE
  public function setResponseTime($value){
    $this->responsetime = $value;
  }
  public function getResponseTime(){
    return $this->responsetime;
  }

  public function setSizeFile($value){
    $this->sizefile = $value;
  }

  public function getSizeFile(){
    return $this->sizefile;
  }

  //Titre de la page  trouvé


  //Vérifier la validité du lien url
  public function urlIsValid($value){
    if(filter_var($value, FILTER_VALIDATE_URL)){
      $this->setMessage(true);
      $this->setLink($value);
      return true;
    }else{
      $message = "URL non valide";
      $this->setMessage($message);
      return false;
    }
  }

  //Communiquer avec un site
  public function curlInit($value){
      $init = curl_init();

      curl_setopt_array($init, array(
          CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $value,
          CURLOPT_USERAGENT => 'Opera/9.80 (Windows NT 6.1; WOW64; U; en) Presto/2.10.229 Version/11.62',
      ));

      // Vérification si une erreur est survenue
      if(!curl_errno($init))
      {
        $resp = curl_exec($init);
        //Le résultat de la page :temps de réponse , code http, url
        $info = curl_getinfo($init);
        $this->setHTTPCode($info["http_code"]);
        $this->setResponseTime($info["connect_time"]);
        $this->setLink($info["url"]);
        $this->setSizeFile($info["download_content_length"]);
        //$this->sizefile = $info["download_content_length"];

        $info = [
          "url"=> $this->getLink(),
          "title" => $this->getTitle($value),
          "http_code"=>$this->getHTTPCode(),
          "response_time" => $this->getResponseTime()." s",
          "size_file" => $this->getSizeFile(). " octets",
          "content" => $this->getContent($value)
        ];
          //Retourner le résultat de l'analyse de la page ici
          return $info;
      }

      // Fermeture du gestionnaire
      curl_close($init);

  }

  //Parser le code HTML : la balise TITLE
  public function getTitle($url){
    $this->title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', file_get_contents($url), $matches) ? $matches[1] : "null" ;
    return  preg_match('/<title[^>]*>(.*?)<\/title>/ims', file_get_contents($url), $matches) ? $matches[1] : "null";
  }

  public function title(){
    return $this->title;
  }

  
  //Parser le code HTML : la balise TITLE
  public function getContent($url){
    return  preg_match('/<body[^>]*>(.*?)<\/body>/ims', file_get_contents($url), $matches) ? $matches[1] : "null";
  }



  //Nombre de balise H1 dans la page web TODO

  //Vérifier le caractère responsive du site TODO

  //Aspirer le code HTML et le regénérer dans le dossier '/cache'.


  //Initialiser un User Agent
  public function setUserAgent($value){
      $this->userAgent = $value;
  }

  public function errorMsg(){
    return $this->msg;
  }

  public function parseUrlSubmitted($field_link){
    //Vérifie si mes champs existent et sont remplis
      if(isset($field_link)){
        if(!empty($field_link)){
          //Appelle du crawler
          //$crawler = new Analyser;

          //Affecte mes valeurs à mon crawler
          if($this->urlIsValid($field_link)){
              //Je communique avec le site appelé puis récupère les résultats de la requête.
              $result = $this->curlInit($this->getLink());
              return $result;
          }
          else{
              //$errorForm = $crawler->urlIsValid($field_link);
              return null;
          }
          //
        }else {
          return false;
          //$msg= "Tous vos champs doivent être remplis";
        }
      }

    //
  }


}
