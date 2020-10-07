<?php

class Getdetails {

    public function getDescriptionAndPrice($criteria) {
        
        $details = new Database();
    	
    	$sql = ("SELECT description, price, photo FROM meals WHERE id = ?");
    	  
    	$result = $details->queryOne($sql, $criteria);
    	
    	$pdo = null;

    	return $result;
    }
    
    
    public function showCart() {
        
        $showCart = new Database();
    	
    	$sql = ("");
    	
    	$result = $showCart->query($sql, $criteria);
    	
    	$pdo = null;
    	
    	return $result ;
    }
}