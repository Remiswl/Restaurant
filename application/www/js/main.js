'use strict';

document.addEventListener('DOMContentLoaded', function() {

// Formulaire d'incription
    let days = document.getElementById('day');
    let years = document.getElementById('year');
    let currentYear = new Date().getFullYear();
    
    let submitForm = document.getElementById('confirmRegistration');
    let last_name = document.getElementById('last_name');
    let zipcode = document.getElementById('zipcode');
    let phone = document.getElementById('phone');
    let pattern_last_name = RegExp('^[a-zA-Z-\' ]+$');
    
    let inputs = document.querySelectorAll('input');
    let errorContainer = document.createElement('p');
    errorContainer.style.color = "red";
    
    // Générer des listes de dates 
    for (let i = 1; i <= 31; i++) {
        days.innerHTML += '<option value="' + i + '">' + i + '</option>';
    }
    
    for (let i = 1930; i <= currentYear - 18; i++) {
        years.innerHTML += '<option value="' + i + '">' + i + '</option>';
    }
    
    // Vérification en temps réel du formulaire 
    function checkForm() {
        if(this.value == '') {
            this.classList.add('invalid');
        } else {
            this.classList.remove('invalid');
        }
    }
    
    // Vérification finale du formulaire
    function preventSendForm(e) {
        
        errorContainer.textContent = '';
        
        for (let i = 0; i < inputs.length - 1; i++) {
            
            if (inputs[i].value == '') {
                
                e.preventDefault();
                console.log('ok');
                errorContainer.textContent = 'Erreur : vous devez compléter tous les champs';
                
                inputs[i].classList.add('invalid');
            }
        }
        
        if ((last_name.value != '') && (pattern_last_name.test(last_name.value) == false)) {
            
            e.preventDefault(); 
            
            errorContainer.textContent = 'Le nom ne peut comporter que des lettres (majuscules ou minuscules), des espaces et des tirets';
            
            last_name.parentElement.append(errorContainer);
            
            last_name.classList.add('invalid');
        }

        if ((zipcode.value != '') && (zipcode.value.length != 5)) {
            
            e.preventDefault(); 
            
            errorContainer.textContent = 'Le code postal doit contenir cinq chiffres';
            
            zipcode.parentElement.append(errorContainer);
            
            zipcode.classList.add('invalid');
        }
        
        if ((phone.value != '') && ((phone.value.length < 8) || (phone.value.length > 10))) {
            
            e.preventDefault(); 
            
            errorContainer.textContent = 'Le numéro de téléphone doit contenir 8 à 10 chiffres';
            
            phone.parentElement.append(errorContainer);
            
            phone.classList.add('invalid');
        }
    }


    // Vérification en temps réel du formulaire
    for (let i = 0; i < inputs.length - 1; i++) {
        inputs[i].addEventListener('blur', checkForm);
    }
    
    // Vérification finale du formulaire
    submitForm.addEventListener('click', preventSendForm);




/* Correction création de compte:

function isFieldEmpty( name, errorMessage , event ){
    let field = document.getElementById(name);
    
    if ( field.value.length == 0 )    {
        document.getElementById(name+'_error').textContent = errorMessage;
        field.classList.add('error');
        // annuler un evenement
        // bloquer le submit du formulaire
        event.preventDefault();
    }
}

function resetErrors(){
    // retirer les bordures rouges
    
    let inputs = document.querySelectorAll('#register input');
    
    for( let i = 0; i < inputs.length; i++ )
    {
        inputs[i].classList.remove('error');
    }
    
    // retirer les textes 
    
    let texts = document.querySelectorAll('#register fieldset p');
    
    for( let i = 0; i < texts.length; i++ )    {
        texts[i].textContent = "";
    }
}

function onRegisterSubmit( event ){
    resetErrors();
    
    isFieldEmpty( 'firstname', "Le prenom ne doit pas etre vide", event );
    isFieldEmpty( 'lastname', "Le nom ne doit pas etre vide", event );
    isFieldEmpty( 'address', "L'adresse ne doit pas etre vide", event );
    isFieldEmpty( 'phone', "Le telephone ne doit pas etre vide", event  );
    isFieldEmpty( 'email', "L'email ne doit pas etre vide", event  );
    isFieldEmpty( 'password', "Le mot de passe ne doit pas etre vide", event  );
    isFieldEmpty( 'city', "La ville ne doit pas etre vide", event  );
    isFieldEmpty( 'zipcode', "Le code postal ne doit pas etre vide", event  );
    
    let zipcode = document.getElementById('zipcode');
    
    if ( zipcode.value.length != 5 )    {
        document.getElementById('zipcode_error').textContent = "Le code postal doit faire 5 caracteres";
        zipcode.classList.add('error');
        // annuler un evenement
        // bloquer le submit du formulaire
        event.preventDefault();
    }
}

document.addEventListener('DOMContentLoaded' , function(){
    let form = document.getElementById('register');
    
    form.addEventListener('submit', onRegisterSubmit);
})

*/

});