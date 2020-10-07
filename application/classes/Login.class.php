<?php

class Login {

    public function logVisitor($checkEmail) {
        
        // Récupération des infos de la BDD
        $logUser = new Database();
    	
    	$sql = ("SELECT * FROM users WHERE email = ?;");
    	  
    	$result = $logUser->query($sql, $checkEmail);

    	$pdo = null;
    	
    	return $result;
    }
}