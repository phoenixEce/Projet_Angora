 // Sélectionner une ligne
 document.addEventListener("DOMContentLoaded", function () {
    const tableRows = document.querySelectorAll("#user-table tr");

    tableRows.forEach((row) => {
      row.addEventListener("click", function () {
        // Remove 'selected' class from all rows
        tableRows.forEach((r) => r.classList.remove("selected"));
        // Add 'selected' class to the clicked row
        this.classList.add("selected");
      });
    });
  });

  // Filtre par type d'utilisateur
  document
    .getElementById("filter-type")
    .addEventListener("change", function () {
      const filterType = this.value;
      const filterCity = document.getElementById("filter-city").value;
      const rows = document.querySelectorAll("#user-table tr");

      let foundUser = false;

      rows.forEach(function (row) {
        const rowType = row.getAttribute("data-type");
        const rowCity = row.getAttribute("data-city");

        if (
          (filterType === "" || rowType === filterType) &&
          (filterCity === "" || rowCity === filterCity)
        ) {
          row.style.display = "";
          foundUser = true;
        } else {
          row.style.display = "none";
        }
      });

      if (!foundUser) {
        document.getElementById("no-users-message").style.display = "block";
      } else {
        document.getElementById("no-users-message").style.display = "none";
      }
    });

  // Filtre par ville
  document
    .getElementById("filter-city")
    .addEventListener("change", function () {
      const filterCity = this.value;
      const filterType = document.getElementById("filter-type").value;
      const rows = document.querySelectorAll("#user-table tr");

      let foundUser = false;

      rows.forEach(function (row) {
        const rowType = row.getAttribute("data-type");
        const rowCity = row.getAttribute("data-city");

        if (
          (filterType === "" || rowType === filterType) &&
          (filterCity === "" || rowCity === filterCity)
        ) {
          row.style.display = "";
          foundUser = true;
        } else {
          row.style.display = "none";
        }
      });

      if (!foundUser) {
        document.getElementById("no-users-message").style.display = "block";
      } else {
        document.getElementById("no-users-message").style.display = "none";
      }
    });

  // Ouvrir le modal d'ajout d'utilisateur
  document
    .getElementById("openModalUser")
    .addEventListener("click", function () {
      const userModal = new bootstrap.Modal(
        document.getElementById("userModal")
      );
      userModal.show();
    });

  // Ajouter un utilisateur
  document
    .getElementById("Addbutton")
    .addEventListener("click", function () {
      const form = document.getElementById("userForm");

      // Vérifier si le formulaire est valide
      if (form.checkValidity()) {
        const newUser = {
          firstName: form.firstName.value,
          lastName: form.lastName.value,
          email: form.email.value,
          phone: form.phone.value,
          address: form.address.value,
          zip: form.zip.value,
          city: form.city.value,
          type: form.type.value,
        };

        const table = document.getElementById("user-table");
        const newRow = document.createElement("tr");
        newRow.setAttribute("data-type", newUser.type);
        newRow.setAttribute("data-city", newUser.city);

        newRow.innerHTML = `
    <td>${table.rows.length + 1}</td>
    <td>${newUser.firstName}</td>
    <td>${newUser.lastName}</td>
    <td>${newUser.email}</td>
    <td>${newUser.address}</td>
    <td>${newUser.city}</td>
    <td>${newUser.zip}</td>
    <td>${newUser.type}</td>
    <td>${newUser.phone}</td>
  `;

        table.appendChild(newRow);
        form.reset();

        // Fermer le modal après l'ajout
        bootstrap.Modal.getInstance(
          document.getElementById("userModal")
        ).hide();
      } else {
        // Afficher un message d'erreur ou style de validation
        form.classList.add("was-validated");
      }
    });

  // Réinitialiser le formulaire lors de la fermeture/l'annulation du pop-up
  document
    .getElementById("userModal")
    .addEventListener("hidden.bs.modal", function () {
      const form = document.getElementById("userForm");
      form.reset();
    });

  // Ouvrir le modal de suppression
  document
    .getElementById("openModalDelete")
    .addEventListener("click", function () {
      const deleteModal = new bootstrap.Modal(
        document.getElementById("deleteModal")
      );
      deleteModal.show();
    });

  // Confirmer la suppression
  document
    .getElementById("confirmDelete")
    .addEventListener("click", function () {
      const selectedUser = document.querySelector(
        "#user-table tr.selected"
      );
      if (selectedUser) {
        selectedUser.remove();
      }
      bootstrap.Modal.getInstance(
        document.getElementById("deleteModal")
      ).hide();
    });

  // Sélectionner un utilisateur pour la suppression
  document
    .getElementById("user-table")
    .addEventListener("click", function (event) {
      const row = event.target.closest("tr");
      if (row) {
        document
          .querySelectorAll("#user-table tr")
          .forEach((tr) => tr.classList.remove("selected"));
        row.classList.add("selected");
      }
    });

  document
    .getElementById("user-table")
    .addEventListener("click", function (event) {
      var selectedRow = event.target.closest("tr");
      if (selectedRow) {
        // Retirer la classe 'selected' de toutes les autres lignes
        var rows = document.querySelectorAll("#user-table tr");
        rows.forEach(function (row) {
          row.classList.remove("selected");
        });

        // Ajouter la classe 'selected' à la ligne cliquée
        selectedRow.classList.add("selected");
      }
    });

  // Changer de page pour la pagination
  function changePage(link) {
    document.querySelectorAll(".page-item").forEach((item) => {
      item.classList.remove("active");
    });
    link.parentElement.classList.add("active");
    // Load the new page data here
  }