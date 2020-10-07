<?php

class Order {
    
    public function getMealsNames() {
        
        $menu = new Database();
    	
    	$sql = ("SELECT * FROM meals");
    	  
    	$result = $menu->query($sql);
    	
    	$pdo = null;
    	
    	return $result ;
    }

}