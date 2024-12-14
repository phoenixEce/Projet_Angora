// Variable pour stocker l'élément à supprimer
let itemToDelete;

// Fonction pour mettre à jour le total
function updateTotal() {
    let total = 0;
    document.querySelectorAll('.list-group-item').forEach(item => {
        const price = parseFloat(item.querySelector('.badge').innerText.replace('€', '').trim());
        total += price;
    });
    document.querySelector('.prixTotal').innerText = 'Total: ' + total + '€';
}

// Gestionnaire d'événements pour le bouton de suppression
document.querySelectorAll('.supprimer').forEach(button => {
    button.addEventListener('click', function() {
        // Stocker l'élément à supprimer
        itemToDelete = this.closest('.list-group-item');
        
        // Afficher le modal de confirmation
        $('#confirmationModal').modal('show');
    });
});

// Gestionnaire d'événements pour le bouton de confirmation de suppression
document.getElementById('confirmDelete').addEventListener('click', function() {
    // Supprimer l'élément si l'utilisateur confirme
    if (itemToDelete) {
        itemToDelete.remove();
        updateTotal(); // Mettre à jour le total après la suppression
        itemToDelete = null; // Réinitialiser la variable
    }
    // Fermer le modal
    $('#confirmationModal').modal('hide');
});

// Gestionnaire d'événements pour les boutons d'achat
document.querySelectorAll('.acheter').forEach(button => {
    button.addEventListener('click', function() {
        // Récupérer le prix de l'article correspondant
        const prixElement = this.closest('.list-group-item').querySelector('.prix');
        const prixAmount = prixElement.textContent; // Récupère le texte du prix

        // Mettre à jour le champ de total dans le modal
        document.getElementById('totalAmount').value = prixAmount;

        // Afficher le modal
        $('#paymentModal').modal('show');
    });
});

// Gestionnaire d'événements pour le bouton payer tous les articles
document.querySelector('.toutAcheter').addEventListener('click', function() {
    // Récupérer le prix total
    const totalText = document.querySelector('.prixTotal').textContent;
    const totalAmount = totalText.replace('Total: ', ''); // Enlève le texte "Total: "
    
    // Mettre à jour le champ de total dans le modal
    document.getElementById('totalAmount').value = totalAmount;

    // Afficher le modal
    $('#paymentModal').modal('show');
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('validateButton').addEventListener('click', function() {
        const form = document.getElementById('paymentForm');

        // Vérifier la validité du formulaire
        if (!form.checkValidity()) {
            const alertMessage = document.getElementById('alertMessage');
            alertMessage.classList.remove('d-none');
            alertMessage.textContent = "Veuillez remplir correctement tous les champs.";
            return;
        }

        // Cacher le message d'alerte s'il est valide
        document.getElementById('alertMessage').classList.add('d-none');

        // Si tous les champs sont valides, appeler la fonction submitForm
        submitForm();
    });

    function submitForm() {
        const successMessage = document.getElementById('successMessage');
        successMessage.classList.remove('d-none');

        setTimeout(() => {
            successMessage.classList.add('d-none');
            $('#paymentModal').modal('hide');
        }, 3000);
    }
});