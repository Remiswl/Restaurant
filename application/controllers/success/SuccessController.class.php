<?php

class SuccessController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
    
        $cart = $_SESSION['cart'];
        
        // Compléter la table orders
        $addToOrders = [
            'user_id' => $_SESSION['id'],
            'price' => $_SESSION['total'],
            'tax' => $_SESSION['vat']
        ];
        
        $addorder = new Success();
    	    
	    $orderId = $addorder->addToOrders($addToOrders);
	    
	    // Compléter la table meal_order
	    for ($i = 0; $i < sizeof($cart); $i++) {
            
    	    $addToMeal_order = [
                'meal_id' => $_SESSION['cart'][$i]->selectedMeal_id,
                'order_id' => $orderId,
                'quantity' => $_SESSION['cart'][$i]->{'selectedQuantity'}
            ];
            
            $addorder = new Success();
        	    
    	    $addorder->addToMeal_order($addToMeal_order);
    	}   
	
	   unset($_SESSION['cart']);
    }
}