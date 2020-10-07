<?php

class GetdetailsController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
        // Récupérer les description et les prix des plats en fonction de l'option choisie
        
        $selectedMeal = array($_POST['selectedOption']);
        
        $details = new Getdetails();
        $mealsDescriptionAndPrice= $details->getDescriptionAndPrice($selectedMeal);
        
        $json = json_encode($mealsDescriptionAndPrice);
        echo $json;
        
        die();
    }
}