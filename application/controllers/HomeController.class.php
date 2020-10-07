<?php

class HomeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	 $menu = new Meals();
    	 $meals= $menu->getMeals();
    	 
    	 return [
    	   'meals' => $meals
    	 ]; // Pour le Controller, il faut obligatoirement renvoyer un objet
    	 
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    }
}