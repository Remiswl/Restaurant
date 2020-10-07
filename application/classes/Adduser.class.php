<?php

class Adduser {

    public function addAUser($values, $email) {
        
        $adduser = new Database();
    	
    	// vérifier si l'email n'est pas deja utilisé
        $sql = 'SELECT * FROM users WHERE email = ?';
        
        $user = $adduser->query($sql, [$email]);
        
        if($user != null) {
            throw new Exception('Email déjà utilisé');
        }
        
        // Insérer les données dans la BDD    
    	$sql = ("
    	    INSERT INTO users (
                first_name, 
                last_name,
                dob,
                address,
                city,
                zipcode,
                phone,
                email,
                password)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);
        ");
    	
    	$result = $adduser->executeSql($sql, $values);
    	
    	$pdo = null;
    }
} 