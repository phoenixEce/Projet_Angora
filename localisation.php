<?php
include "header.php";
?>
<style>
    .location-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .location-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 24px;
        color: #333;
    }

    .map-container {
        position: relative;
        width: 100%;
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .apply-button {
        background: #0dcaf0;
        color: white;
        border: none;
        padding: 10px 32px;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .apply-button:hover {
        background: #0bb5d9;
    }
</style>
<div class="location-container">
    <h2 class="location-title">Localisation de notre boutique</h2>

    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.476042667663!2d2.3518099999999997!3d48.851333!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671e4dd3e9d89%3A0x308b32ab20694195!2sECE%20Paris%20Lyon!5e0!3m2!1sfr!2sfr!4v1635774283457!5m2!1sfr!2sfr"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <button class="apply-button">Appliquer</button>
</div>
<?php
include "footer.php";
?>