'use strict';

class ConfirmCart {

    constructor() {
        $('#confirm').click(this.confirmCart.bind(this));
    }

    confirmCart() {
        
        let url = 'http://remis00.sites.3wa.io/projet_pro/index.php';
        
        let cart = localStorage.getItem('cart');
        
        let clientChoice = {cart: cart}; // !! on ne peut envoyer que des strings
        
        $.post(url + '/confirmcart', clientChoice, this.sendToConfirmationPage);
   }

   sendToConfirmationPage(data) {

        // Récupère dans data le 'true' envoyé par le PHP
        // Permet d'assurer que l'opération s'est bien passée
        if(data == 'true') {
            window.location.href = "http://remis00.sites.3wa.io/projet_pro/index.php/recap";
        }
   }
}

document.addEventListener("DOMContentLoaded", function(e) {
    let cartConfirmation = new ConfirmCart();
});