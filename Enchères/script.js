$(document).ready(function () {
    // Timer de compte à rebours
    let timeLeft = 3 * 24 * 60 * 60; // 3 jours en secondes

    const timer = setInterval(function () {
        if (timeLeft <= 0) {
            clearInterval(timer);
            $("#timer").text("Temps écoulé");
            return;
        }

        const days = Math.floor(timeLeft / (24 * 60 * 60));
        const hours = Math.floor((timeLeft % (24 * 60 * 60)) / (60 * 60));
        const minutes = Math.floor((timeLeft % (60 * 60)) / 60);
        const seconds = timeLeft % 60;

        $("#timer").text(`${days} : ${hours} : ${minutes} : ${seconds}`);
        timeLeft--;
    }, 1000);

    // Initialisation du prix proposé
    let prixPropose = 800;
    $('#prixPropose').text(`${prixPropose}€`);

    // Validation de l'offre dans le modal
    $('#validateButton').click(function () {
        const montantSaisi = parseFloat($('#montant').val());

        // Vérification si le montant saisi est valide
        if (!isNaN(montantSaisi) && montantSaisi > 0) {
            if (montantSaisi > prixPropose) {
                // Mise à jour du prix proposé
                prixPropose = montantSaisi;
                $('#prixPropose').text(`${prixPropose}€`);

                // Afficher un message de succès
                $('#successMessage')
                    .text(`Offre acceptée ! Nouveau prix proposé : ${prixPropose}€`)
                    .removeClass('d-none');
                $('#alertMessage').addClass('d-none');
            } else {
                // Message si le montant est inférieur ou égal au prix actuel
                $('#alertMessage')
                    .text('Le montant doit être supérieur au prix proposé actuel.')
                    .removeClass('d-none');
                $('#successMessage').addClass('d-none');
            }

            // Fermer le modal après 3 secondes
            setTimeout(function () {
                $('#paymentModal').modal('hide');
                $('#successMessage, #alertMessage').addClass('d-none'); // Réinitialiser les messages
            }, 3000);
        } else {
            // Message d'erreur pour un montant invalide
            $('#alertMessage')
                .text('Veuillez saisir un montant valide.')
                .removeClass('d-none');
            $('#successMessage').addClass('d-none');

            // Masquer le message d'alerte après 3 secondes
            setTimeout(function () {
                $('#alertMessage').addClass('d-none');
            }, 3000);
        }
    });

    // Ouverture du modal
    $('#button').click(function () {
        // Réinitialiser les messages et le champ montant
        $('#successMessage, #alertMessage').addClass('d-none');
        $('#montant').val('');
        $('#paymentModal').modal('show');
    });
});
