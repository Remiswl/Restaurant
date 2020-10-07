<?php

class LoginController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
    	
    	$email = htmlspecialchars($_POST['email']);
    	$password = htmlspecialchars($_POST['password']);
    	
    	// On crée un compteur d'erreur. A la fin de la boucle, si le compteur est égal à True, alors on affiche un message d'erreur.
    	$loginError = false;
    	
    	$checkEmail = [$email];
    	
    	// On accède à la BDD et on récupère une seule ligne
    	$login = new Login();
    	    
	    $result = $login->logVisitor($checkEmail);
	    
	    // On compare le mdp rentré avec le mdp de la BDD
        if (($email == '') || ($password == '') || (sizeof($result) == 0) || (password_verify($password, $result[0]['password']) == false)) {
            
            $loginError = true;
            
            return ['loginError' => $loginError];
            
        } else if(password_verify($password, $result[0]['password'])) {
            
    		// On enregistre les paramètres du visiteur comme variables de session
    		$_SESSION['id'] = intval($result[0]['id']);
    		$_SESSION['first_name'] = $result[0]['first_name'];
    		$_SESSION['last_name'] = $result[0]['last_name'];
    		$_SESSION['address'] = $result[0]['address'];
    		$_SESSION['city'] = $result[0]['city'];
    		$_SESSION['zipcode'] = $result[0]['zipcode'];
    		$_SESSION['logged_in'] = true;
    		
    		$http->redirectTo('/');
        }
    }
}
      

/* OU: si on récupère toutes les paires email/password:

for ($index = 0; $index < sizeof($result); $index++) {
    // Si la paire entrée correspond à une des paires de la BDD: 
    if(($email == $result[$index]['email']) && 
        (password_verify($password, $result[$index]['password']))) {
        
        // On démarre la session
	    //session_start ();
		
		// On enregistre les paramètres du visiteur comme variables de session
		$_SESSION['first_name'] = $result[$index]['first_name'];
		$_SESSION['logged_in'] = true;
		
		$http->redirectTo('/');
    } else {
        $loginError += 1;
    }
}    
 
if ($loginError == sizeof($result)) {

    $loginError = true;
    
    return ['loginError' => $loginError];
} 
*/