<?php

class Success {
    
    public function addToOrders($values) {
        
        $addorder = new Database();
    	
    	$sql = ("
    	    INSERT INTO orders (
                user_id,
                price,
                tax
            )
            VALUES (
                :user_id,
                :price,
                :tax
            );
        ");
    	
    	$orderId = $addorder->executeSql($sql, $values);
    	
        $pdo = null;
    	
    	return $orderId;
    }
    
    public function addToMeal_order($values) {
        
        $addorder = new Database();
    	
    	$sql = ("
    	    INSERT INTO meal_order (
                meal_id,
                order_id,
                quantity
            )
            VALUES (
                :meal_id,
                :order_id,
                :quantity
            )
        ");
    	
    	$query = $addorder->executeSql($sql, $values);
    	
    	$pdo = null;
    }
}