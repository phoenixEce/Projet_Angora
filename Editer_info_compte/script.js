$(document).ready(function () {
    $('#profileForm').on('submit', function (event) {
        event.preventDefault();

        const newPassword = $('#newPassword').val();
        const confirmPassword = $('#confirmPassword').val();

        // Vérifiez si le nouveau mot de passe correspond à la confirmation
        if (newPassword !== confirmPassword) {
            const alertMessage = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Les mots de passe ne correspondent pas. Veuillez réessayer.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `;
            $('#alertContainer').html(alertMessage);
            return; // Arrêtez la soumission si les mots de passe ne correspondent pas
        }

        // Ajoutez un message de validation si les mots de passe correspondent
        const alertMessage = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil modifié avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        $('#alertContainer').html(alertMessage);

        // Réinitialiser les champs de mot de passe après un court délai
        setTimeout(() => {
            $('#password').val('');
            $('#newPassword').val('');
            $('#confirmPassword').val('');
        }, 2000);
    });

    $('#cancelBtn').on('click', function () {
        // Réinitialiser les champs de mot de passe uniquement
        $('#password').val('');
        $('#newPassword').val('');
        $('#confirmPassword').val('');
    });

    // Fonctionnalité de bascule pour voir/cacher les mots de passe
    $('.toggle-password').on('click', function () {
        const targetId = $(this).data('target');
        const targetInput = $(`#${targetId}`);
        const icon = $(this).find('i');

        if (targetInput.attr('type') === 'password') {
            targetInput.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            targetInput.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
});
