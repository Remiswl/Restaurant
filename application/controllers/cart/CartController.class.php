<?php

// Instancier la classe Cart
//( Le panier doit utiliser le localStorage )

class CartController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
        var_dump('ok');
    }
}