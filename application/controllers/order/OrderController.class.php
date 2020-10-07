<?php

class OrderController {
    
    public function httpGetMethod(Http $http, array $queryFields){
        
        // Permet de sécuriser la page, de ne pas y accéder si on n'ets pas connecté
        if( isset($_SESSION['logged_in']) == false ){
            $http->redirectTo('/');    
        }
         
        // Récupérer les noms des plats
        $menu = new Order();
        $mealsNames= $menu->getMealsNames();

        return ['meals' => $mealsNames];
    }

    public function httpPostMethod(Http $http, array $formFields){}
}