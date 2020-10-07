<?php

class AdduserController {
    
    public function httpGetMethod(Http $http, array $queryFields) {}

    public function httpPostMethod(Http $http, array $formFields) {
        
        $first_name = htmlspecialchars($_POST['first_name']);
    	$last_name = htmlspecialchars($_POST['last_name']);
    	$dob = htmlspecialchars($_POST['year'] . "-" .  $_POST['month'] . "-" .  $_POST['day']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
    	$zipcode = htmlspecialchars($_POST['zipcode']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_BCRYPT);
        // OU:  $salt = '$2y$11$'.substr(bin2hex(openssl_random_pseudo_bytes(32)), 0, 22);
        //      $password = crypt($_POST['password'], $salt);
        
        $values = [
            $first_name,
        	$last_name,
            $dob,
            $address,
            $city,
        	$zipcode,
            $phone,
            $email,
            $password];
        
        // Vérification des champs
        $pattern_last_name = '#[a-z-\s]#';
        $pattern_password = '#[A-Z]+#';
        
        // Créer un tableau dans lequel on mettra les erreurs
        $errors = [];
        
        if(empty($first_name)){
            array_push($errors, 'Le champ Prénom est requis.');
        }
        if(empty($last_name)){
            array_push($errors, 'Le champ Nom est requis');
        }
        if(empty($address)){
            array_push($errors, 'Le champ Adresse est requis.');
        }
        if(empty($city)){
            array_push($errors, 'Le champ Ville est requis.');
        }
        if(empty($zipcode)){
            array_push($errors, 'Le champ Code postal est requis.');
        }
        if(empty($phone)){
            array_push($errors, 'Le champ Téléphone est requis');
        }
        if(empty($email)){
            array_push($errors, 'Le champ E-mail est requis.');
        }
        if(empty($password)){
            array_push($errors, 'Le champ Mot de passe est requis.');
        }
        if ((!empty($last_name)) && (preg_match($pattern_last_name, $last_name) ==  0) ) {
            array_push($errors, 'Le champ Nom ne peut contenir que des lettres, des tirets ou des espaces.');
        }
        if(!empty($zipcode) && strlen($zipcode) != 5) {
            array_push($errors, 'Le Code Postal doit comporter cinq chiffres.');
        }
        if(!empty($phone) && ((strlen($phone) < 8) || (strlen($phone) > 15))) {
            array_push($errors, 'Le Téléphone doit contenir huit à quinze caractères.');
        }
        if((!empty($email)) && (filter_var($email, FILTER_VALIDATE_EMAIL) == false)) {
            array_push($errors, 'Le format de l\'email n\'est pas valide.');
        }
        if(!empty($password) && (strlen($_POST['password']) < 10)) {
            array_push($errors, 'Le Mot de passe doit contenir au moins 10 caractères.');
        }
        if(!empty($password) && (strlen($_POST['password']) >= 10) && preg_match($pattern_password, $_POST['password']) == 0) {
            array_push($errors, 'Le Mot de passe doit contenir au moins une majuscule.');
        }
        
        // vérifier si l'email n'est pas déjà pris
        try {
            if(count($errors) == 0) {
                
                $adduser = new Adduser();
    	    
    	        $adduser->addAUser($values, $email);
    	    
    	        $http->redirectTo('/');
    	        
            } else {
                return ['errors' => $errors];
            }
        }
        catch(Exception $e) {
            array_push($errors, $e->getMessage());
            
            return ['errors' => $errors];
        }
         
        /*
        // Si tout va bien, rentrer les données dans la BDD
        if(empty($errors)) {
            
            $adduser = new Adduser();
    	    
    	    $adduser->addAUser($values);
    	    
    	    $http->redirectTo('/');
    	 
        } else {
            return ['errors' => $errors];
        }
        */
    }
}