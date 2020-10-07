<?php

class RecapController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
       
       //Pour protéger l'accès la page + éviter les paniers vides ou non existants
       if (isset($_SESSION['cart']) == false || empty($_SESSION['cart'])) {
           $http->redirectTo('/');
       }
   }
}