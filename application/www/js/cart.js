'use strict';

class Cart {

   constructor() {
        this.addToCart = document.getElementById('addToCart');
        this.addToCart.addEventListener('click', this.updateCart.bind(this));
        
        this.list = document.getElementById('listOfProducts');
    }
    
    updateCart(event) {
        event.preventDefault();
        
        this.addProduct();
        
        this.displayProducts();
    }
    
    addProduct() {
        this.meal = document.getElementById('meal');
        this.selectedMeal = this.meal.options[this.meal.selectedIndex].label;
        this.selectedMeal_id = this.meal.options[this.meal.selectedIndex].value;
        this.unitPrice = parseFloat(document.getElementById('unitPrice').firstChild.data);
        this.selectedQuantity = parseInt(document.getElementById('quantity').value);

        //console.log(this.selectedMeal_id);

        this.choice = {
            selectedMeal_id: this.selectedMeal_id,
            selectedMeal: this.selectedMeal,
            unitPrice: this.unitPrice,
            selectedQuantity: this.selectedQuantity
        };

        this.cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // On commence par s'assurer que le produit n'est pas déjà dans le panier
        this.isInCart = false;
        
        
        for (let i = 0; i < this.cart.length; i++) {
            // Si on trouve une correspondance, alors on sait que le produit est dans le panier
            if(this.cart[i].selectedMeal == this.selectedMeal) {
                
                this.isInCart = true;
                
                this.cart[i].selectedQuantity += this.selectedQuantity;
            } 
        }
        
        // Mais si il n'y a pas de correspondances, alors le produit n'est pas dans le panier --> on le rjaoute
        if (this.isInCart == false) {
            // Ajouter le produit au local storage
            this.cart.push(this.choice);
        }
      
        localStorage.setItem('cart', JSON.stringify(this.cart));
    }
    
    displayProducts() {
        this.selectedProducts = JSON.parse(localStorage.getItem('cart'));
        
        this.list.innerHTML = '';
        
        for (let i = 0; i < this.selectedProducts.length; i++) {
            this.displayProduct(i);
        }
    }
    
    displayProduct(index) {
        this.tr = document.createElement('tr');
        this.tr.classList.add('choice');
        this.list.appendChild(this.tr);
        
        this.tr.innerHTML += `<td>${this.selectedProducts[index]['selectedMeal']}</td>`;
        this.tr.innerHTML += `<td>${this.selectedProducts[index]['unitPrice']} €</td>`;
        this.tr.innerHTML += `<td>${this.selectedProducts[index]['selectedQuantity']}</td>`;
        this.tr.innerHTML += `<td>${this.selectedProducts[index]['unitPrice'] * this.selectedProducts[index]['selectedQuantity']} €</td>`;
        this.tr.innerHTML += `<td><button class="delete" type="button" data-index="${index}"><i class="fas fa-trash-alt" data-index="${index}"></i></button></tr>`;
    
        this.deleteAProduct = document.getElementsByClassName('delete');
        this.deleteAProduct[index].addEventListener('click', this.deleteProduct.bind(this));
    }
    
    deleteProduct() {
        // Récupérer l'index de l'élément à supprimer
        this.indexToDelete = event.target.dataset.index;
        
        // Ouvrir le local storage
        this.productToDelete = JSON.parse(localStorage.getItem('cart'));
        
        // Supprimer un des produits
        this.productToDelete.splice(this.indexToDelete, 1);
        
        // Remettre le panier dans le local storage
        localStorage.setItem('cart', JSON.stringify(this.productToDelete));
        
        // Ré-afficher la liste
        this.displayProducts();
    }
    
}

document.addEventListener('DOMContentLoaded', () => {
    let cart = new Cart();
    
    cart.displayProducts();
});

/* Correction avec jQuery

'use strict'

class Cart
{
    constructor()
    {
        this.products = [];
        
        $('#add').click( this.addProduct.bind(this) );
        $(document).on('click' , '.delete' , this.deleteProduct.bind(this));
        
        // charger les produits du localStorage
        // si le localstorage n'est pas vide
        
        if ( window.localStorage.getItem('cart') != null )
        {
            let json = window.localStorage.getItem('cart');
            this.products = JSON.parse(json);
        }
        
        // reafficher le panier au demarrage de la page
        
        this.displayProducts();
    }
    
    deleteProduct( event )
    {
        let id = $(event.target).data('id');
        $(`tr[data-id=${id}]`).remove();
        
        for( let i = 0 ; i < this.products.length ; i++)
        {
            if ( this.products[i].id == id)
            {
                // suppression de l'index du tableau
                this.products.splice(i,1);
                break;
            }
        }
        
        window.localStorage.setItem('cart', JSON.stringify(this.products));
    }
    
    addProduct()
    {
        let price = parseFloat($("#price").text());
        let name = $("#name").text();
        let quantity = parseInt($("#quantity").val());
        let id = $("#product").val();
        
        let product = {
            'price' : price,
            'name' : name,
            'quantity' : quantity,
            'id' : id
        }
        
        let isInCart = false;
        
        // recherche du produit dans le panier
        
        for( let i = 0; i < this.products.length;i ++)
        {
            // si il existe : mettre à jour la quantité
            if ( this.products[i].id == id )
            {
                isInCart = true;
                this.products[i].quantity += quantity;
            }
        }
        
        // si le produit n'existe pas : ajouter
        
        if( isInCart == false)
        {
            this.products.push(product);
        }

        this.displayProducts();
        
        // JSON : javascript object notation
        
        window.localStorage.setItem('cart', JSON.stringify(this.products));
    }
    
    displayProduct( price , name, quantity , id)
    {
        let html = `<tr data-id='${id}'> 
            <td>${quantity}</td> 
            <td>${name}</td> 
            <td>${price}</td>
            <td>${quantity * price}</td>
            <td> <button class="delete" data-id='${id}'> X </button></td>
        </tr>`
        $('#cart tbody').append(html);
    }
    
    displayProducts()
    {
        $('#cart tbody').empty();
        
        for( let i = 0 ; i < this.products.length; i++)
        {
            this.displayProduct(
                this.products[i].price, 
                this.products[i].name, 
                this.products[i].quantity,
                this.products[i].id);
        }
    }
}

document.addEventListener('DOMContentLoaded' , function()
{
    let cart = new Cart();
    
})

*/