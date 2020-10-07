<?php

class AdminController {
    
    public function httpGetMethod(Http $http, array $queryFields){}

    public function httpPostMethod(Http $http, array $formFields){
    
        $name = htmlspecialchars($_POST['name']);
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $photo = $_FILES['photo']['name'];
        $url = WWW_PATH.'/images/meals/'.$photo;
        
        move_uploaded_file($_FILES['photo']['tmp_name'], $url);
        
        $model = new Meals();
        $model->addProduct($name, $description, $price, $stock, $photo);
        
        return ['message' => 'produit ajouté'];
    }
}

/*
    var_dump($_FILES);
    
    if( $_FILES['fichier']['type'] != 'image/png')
    {
        die("je veux que des PNG");
    }
    
    if(move_uploaded_file($_FILES['fichier']['tmp_name'], 'upload/'.$_FILES['fichier']['name']) == true )
    {
        echo 'ok';
    }
    else
    {
        echo 'erreur upload';
    }
*/