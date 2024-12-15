<?php
include "header.php";
?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .form-container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-top: 50px;
    }

    .form-title {
        color: #00a8ff;
        margin-bottom: 30px;
    }

    .form-control {
        background-color: #f1f3f5;
        border: none;
        padding: 12px;
    }

    .btn-primary {
        background-color: #00a8ff;
        border: none;
        padding: 10px 30px;
    }

    .btn-secondary {
        background-color: #343a40;
        border: none;
        padding: 10px 30px;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 form-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="form-title">Modifier votre profil</h2>
                <p class="text-muted">Bienvenue! Njeunkom Sandrine!</p>
            </div>
            <form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" value="Njeunkam">
                    </div>
                    <div class="col-md-6">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" value="Sandrine">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="njeunsandrine@gmail.com">
                    </div>
                    <div class="col-md-6">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" value="Paris, 75015, France">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="mot-de-passe-actuel" class="form-label">Mot de passe actuel</label>
                    <input type="password" class="form-control" id="mot-de-passe-actuel">
                </div>
                <div class="mb-3">
                    <label for="nouveau-mot-de-passe" class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" id="nouveau-mot-de-passe">
                </div>
                <div class="mb-4">
                    <label for="confirmer-mot-de-passe" class="form-label">Confirmer votre nouveau mot de passe</label>
                    <input type="password" class="form-control" id="confirmer-mot-de-passe">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary me-2">Valider</button>
                    <button type="button" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>