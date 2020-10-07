'use strict';

document.addEventListener('DOMContentLoaded', function() {
    // Commandes (AJAX) :
        // 1. Récupérer la value de l'option sélectionnée
    let meal = document.getElementById('meal');
    let url = getRequestUrl();
    let url2 = getWwwUrl();
    let description = document.getElementById('description');
    
        // 2. Envoyer la value dans une requête SQL (pour in fine récupérer la description et le prix associés)
        // 3. Récupérer dans la bdd la description et le prix associés dans JS
    function changedetails() {
        let selectedOption = meal.options[meal.selectedIndex].value;
        let selection = {selectedOption: selectedOption};
        
        $.post(url + '/getdetails', selection, ajaxLoaded);
    }

    function ajaxLoaded(data) {
        let meal = JSON.parse(data); 
        // --> bien s'assurer qu'on a enlevé TOUS les var_dump du fichier PHP
      
        displayDetails(meal);
    }
    
    function displayDetails(meal) {
        // 4. Afficher la description et le prix dans la div correspondante
        description.innerHTML = '';
        description.innerHTML += '<img src="' + url2 + '/images/meals/' + meal['photo'] + '" alt="' + meal['title'] + '"/>';
        description.innerHTML += '<p>' + meal['description'] + '</p>';
        description.innerHTML += '<p>Prix: <span id="unitPrice">' + meal['price'] + '</span>€</p>';     
    }
    
    /* Ou en jQuery:
        $("#name").text(product.title);
        $("#description").text(product.description);
        $("#price").text(product.price);
        $("#photo").attr('src', getWwwUrl()+'/images/meals/'+product.photo);
    */
    
    meal.addEventListener('change', changedetails);
    
    // déclencher une première requête AJAX au démarrage de la page (pour afficher le produit sélectionn d'office)
    let event = new Event('change');
    meal.dispatchEvent(event);
    
});