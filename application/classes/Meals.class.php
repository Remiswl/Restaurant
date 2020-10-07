<?php

class Meals {
    public function addProduct($name, $description, $prix, $stock, $photo){
        $pdo = new PDO
    	(
    		'mysql:host=home.3wa.io:3307;dbname=live-33_remis00_Resto',
            'remis00',
            '97b61d90ODM0YWQxNzBhZDBjYTNkYTY5MzMxMTM163237559',
    	    [
    	    	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    	        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // fetchall en tableau associatif automatiquement
    	    ]
        );
        
        $sql = "INSERT INTO meals(title, description, price, stock, photo) 
        VALUES(?,?,?,?,?)";
        
        $query = $pdo->prepare($sql);
        
        $query->execute([$name, $description, $prix, $stock, $photo]);
    }
        
        
    public function getMeals() {
        
        $menu = new Database();
    	
    	$sql = ("SELECT * FROM meals");
    	  
    	$result = $menu->query($sql);
    	
    	$pdo = null;
    	
    	return $result ; // Hors Controller, on peut renvoyer n'importe quoi
    }
}