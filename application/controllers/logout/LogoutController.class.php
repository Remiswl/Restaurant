<?php

class LogoutController {
    
    public function httpGetMethod(Http $http, array $queryFields){
        
        // On détruit notre session
        session_destroy ();
    
        // On redirige le visiteur vers la page d'accueil
        $http->redirectTo('/');
    }

   public function httpPostMethod(Http $http, array $formFields){}
}