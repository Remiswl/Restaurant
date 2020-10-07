<?php

class ConfirmcartController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
        
        $cart = json_decode($_POST['cart']);
        
        $_SESSION['cart'] = $cart;

        // Calcul du montant total de la commande
        $total = 0;
        
        foreach ($_SESSION['cart'] as $product) {
        
            $total += $product->{'selectedQuantity'} * $product->{'unitPrice'};
        }
                
        $_SESSION['total'] = $total;
        $_SESSION['vat'] = $total * 0.20;
        
        // Récupération de la date
        $_SESSION['date'] = date('d M Y \à G \h i');
        $_SESSION['time'] = strtotime ('now');
        
        // Permet de renvoyer une string à JS :
        echo 'true';
        
        die(); 
    }
}