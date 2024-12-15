<?php include 'header.php'; ?>
<style>
  body {
    font-family: "Satoshi", sans-serif;
  }

  /* .sidebar {
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
} */

  /* footer {
    text-align: center;
    margin-top: 20px;
} */

  .main {
    margin-left: 13px;
  }

  .list-group-item {
    display: flex;
    align-items: flex-start;
    padding: 10px;
  }

  .list-group-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .d-flex {
    display: flex;
  }

  .img-thumbnail {
    width: 90px;
    height: 120px;
    object-fit: contain
  }

  .btn-lg {
    margin-left: auto;
  }

  .list-group-item .w-100 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 110px;
  }

  .text {
    margin-left: 30px;
  }

  .prix {
    margin-bottom: 5px;
    margin-right: 105px;
  }

  .stock {
    font-size: 0.9rem;
    color: green;
    margin-top: -20px;
    margin-bottom: -20px;
    /* margin-right: 100px; */
    margin-left: 795px;
  }

  .stockEpuise {
    font-size: 0.9rem;
    color: blue;
    margin-top: -20px;
    margin-bottom: -20px;
    /* margin-right: 63px; */
    margin-left: 793px;
  }

  .supprimer {
    margin-right: 60px;

  }

  .acheter {
    margin-left: 30px;
    border-radius: 4px;
    width: 110px;
    height: 30px;
    text-align: center;
  }


  .toutAcheter {
    margin-bottom: 4px;
    border-radius: 4px;
    width: 200px;
    height: 30px;
  }

  .list-group-item .btn-primary {
    align-self: flex-start;
    /* Place le bouton en bas à gauche */
    margin-top: auto;
    /* Colle au bas de l'image */
  }

  .list-group-item .supprimer {
    align-self: flex-end;
    /* Bouton "Supprimer" aligné à droite */
    margin-top: auto;
  }

  .prixTotal {
    margin-left: 650px;
    margin-right: 7px;
    height: 33px;
    width: 180px;
    margin-bottom: 5px;
    text-align: center;
    margin-top: 3px;
    /* Ajustez cette valeur pour uniformiser l'espacement en haut */
    display: flex;
    align-items: center;
  }

  .titre {
    position: relative;
    padding-left: 10px;
    font-size: 1.5rem;
    /* Ajustez la taille de la police selon vos besoins */
    color: #000;
    /* Couleur du texte */
  }

  .titre::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 7px;
    /* Largeur du rectangle */
    background-color: blue;
    /* Couleur du rectangle */
  }

  .payment-logo {
    width: 50px;
    /* Ajustez la taille selon vos besoins */
    margin: 0 10px;
    /* Espace entre les logos */
  }
</style>
<main role="main" class="col-md-2 ml-sm-4 col-lg-9 px-0 main">
  <div class="row">
    <div class="col-md-9 mt-4">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="titre">Vos différents produits</h5>
        <div class="alert alert-info prixTotal">Total: 897€</div>
        <button class="btn btn-primary btn-sm toutAcheter">
          Tout acheter
        </button>
      </div>
      <div class="list-group main">
        <div class="list-group-item d-flex align-items-start">
          <img
            src="images/montre 1.png"
            alt="Couronne "
            class="img-thumbnail text" />
          <div
            class="d-flex flex-column justify-content-between w-100 ml-3">
            <div>
              <div
                class="d-flex justify-content-between align-items-start">
                <span class="text">Couronne</span>
                <span class="badge badge-primary prix">399€</span>
              </div>
              <p class="text">Couronne en diamant.</p>
              <p class="text-right stock">En stock</p>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <button class="btn btn-primary btn-sm acheter">
                Acheter
              </button>
              <button class="btn btn-dark btn-sm ml-2 supprimer">
                Supprimer
              </button>
            </div>
          </div>
        </div>

        <div class="list-group-item d-flex align-items-start">
          <img src="images/montre 1.png" alt="Robe" class="img-thumbnail text" />
          <div
            class="d-flex flex-column justify-content-between w-100 ml-3">
            <div>
              <div
                class="d-flex justify-content-between align-items-start">
                <span class="text">Robe d'opéra</span>
                <span class="badge badge-primary prix">399€</span>
              </div>
              <p class="text">Robe d'opéra en soie.</p>
              <p class="text-right stock">En stock</p>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <button class="btn btn-primary btn-sm acheter">
                Acheter
              </button>
              <button class="btn btn-dark btn-sm ml-2 supprimer">
                Supprimer
              </button>
            </div>
          </div>
        </div>

        <div class="list-group-item d-flex align-items-start">
          <img
            src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg"
            alt="Talon"
            class="img-thumbnail text" />
          <div
            class="d-flex flex-column justify-content-between w-100 ml-3">
            <div>
              <div
                class="d-flex justify-content-between align-items-start">
                <span class="text">Talon</span>
                <span class="badge badge-primary prix">199€</span>
              </div>
              <p class="text">Talon à aiguille.</p>
              <p class="text-right stockEpuise">Stock épuisé</p>
            </div>
            <div class="d-flex justify-content-between align-items-end">
              <button class="btn btn-primary btn-sm acheter">
                Acheter
              </button>
              <button class="btn btn-dark btn-sm ml-2 supprimer">
                Supprimer
              </button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</main>

<div
  class="modal fade"
  id="paymentModal"
  tabindex="-1"
  aria-labelledby="paymentModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">
          Veuillez entrer vos informations de paiement
        </h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Message d'alerte -->
        <div class="alert alert-success d-none" id="successMessage">
          Les éléments ont été ajoutés avec succès !
        </div>
        <div class="alert alert-danger d-none" id="alertMessage"></div>
        <!-- Logos de paiement -->
        <div class="text-center mb-3">
          <img src="assets/visa-logo-svgrepo-com.svg" alt="Visa" class="payment-logo" />
          <img
            src="assets/mastercard-svgrepo-com.svg"
            alt="CB"
            class="payment-logo" />
          <img src="assets/paypal-svgrepo-com.svg" alt="PayPal" class="payment-logo" />
          <img
            src="assets/paypal-svgrepo-com.svg"
            alt="Apple Pay"
            class="payment-logo" />
          <img
            src="assets/google-pay-primary-logo-logo-svgrepo-com.svg"
            alt="Google Pay"
            class="payment-logo" />
        </div>
        <form id="paymentForm">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="name">Nom *</label>
              <input
                type="text"
                class="form-control"
                id="name"
                required
                pattern="[A-Za-z\s]+"
                title="Veuillez entrer uniquement des lettres." />
            </div>
            <div class="form-group col-md-6">
              <label for="cardNumber">N° de carte *</label>
              <input
                type="text"
                class="form-control"
                id="cardNumber"
                required
                pattern="\d{16}"
                title="Le numéro de carte doit comporter 16 chiffres." />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="expiryDate">Date d'expiration *</label>
              <input
                type="text"
                class="form-control"
                id="expiryDate"
                placeholder="MM/AA"
                required
                pattern="(0[1-9]|1[0-2])\/\d{2}"
                title="Format requis : MM/AA." />
            </div>
            <div class="form-group col-md-6">
              <label for="securityCode">N° de sécurité *</label>
              <input
                type="text"
                class="form-control"
                id="securityCode"
                required
                pattern="\d{3,4}"
                title="Le code de sécurité doit comporter 3 ou 4 chiffres." />
            </div>
          </div>
          <div class="form-group">
            <label>Total</label>
            <input
              type="text"
              class="form-control"
              value="1750€"
              id="totalAmount"
              readonly />
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-danger"
          data-dismiss="modal">
          Annuler
        </button>
        <button
          type="button"
          class="btn btn-primary"
          id="validateButton">
          Valider
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de Confirmation de suppression -->
<div
  class="modal fade"
  id="confirmationModal"
  tabindex="-1"
  aria-labelledby="confirmationModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">
          Confirmer la Suppression
        </h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer cet article ?
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-dismiss="modal">
          Annuler
        </button>
        <button type="button" class="btn btn-danger" id="confirmDelete">
          Supprimer
        </button>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<script src="panier.js"></script>

<?php include 'footer.php'; ?>