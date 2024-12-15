<?php
include "header.php";
?>
<style>
    .product-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .welcome-message {
        margin-bottom: 24px;
        text-align: end;
    }

    .user-name {
        color: #0dcaf0;
    }

    .product-image {
        width: 100%;
        border-radius: 8px;
        background: #000;
        margin-bottom: 24px;
    }

    .product-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .rating {
        color: #ffc107;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .product-description {
        color: #666;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .countdown-section {
        margin-bottom: 32px;
    }

    .countdown-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .countdown-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .countdown-item {
        text-align: center;
    }

    .countdown-value {
        font-size: 32px;
        font-weight: bold;
    }

    .countdown-separator {
        font-size: 32px;
        font-weight: bold;
        color: #dc3545;
    }

    .countdown-label {
        font-size: 12px;
        color: #666;
    }

    .price-section {
        margin-bottom: 32px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .price-label {
        font-size: 20px;
        font-weight: 600;
    }

    .price-value {
        font-size: 24px;
        font-weight: bold;
    }

    .offer-button {
        background: #0dcaf0;
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 6px;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .offer-button:hover {
        background: #0bb5d9;
    }
</style>

<div class="product-container">
    <div class="welcome-message mb-5">
        Bienvenue! <span class="user-name">Njeunkam Sandrine!</span>
    </div>

    <div class="row">
        <div class="col-md-6">
            <img src="images/montre 1.png" alt="Couronne en diamant" class="product-image">
        </div>

        <div class="col-md-6">
            <h1 class="product-title">Couronne en diamant</h1>

            <div class="rating">
                <span>★</span>
                <span>★</span>
                <span>★</span>
                <span>★</span>
                <span>☆</span>
            </div>

            <p class="product-description">
                Couronne en diamant de très bonne qualité, alliant élégance et raffinement,
                idéale pour les occasions spéciales ou pour sublimer votre collection de bijoux
            </p>

            <div class="countdown-section">
                <h2 class="countdown-title">Temps restant</h2>
                <div class="countdown-container">
                    <div class="countdown-item">
                        <div class="countdown-value" id="days">03</div>
                        <div class="countdown-label">Jours</div>
                    </div>
                    <div class="countdown-separator">:</div>
                    <div class="countdown-item">
                        <div class="countdown-value" id="hours">23</div>
                        <div class="countdown-label">Heures</div>
                    </div>
                    <div class="countdown-separator">:</div>
                    <div class="countdown-item">
                        <div class="countdown-value" id="minutes">19</div>
                        <div class="countdown-label">Minutes</div>
                    </div>
                    <div class="countdown-separator">:</div>
                    <div class="countdown-item">
                        <div class="countdown-value" id="seconds">56</div>
                        <div class="countdown-label">Seconds</div>
                    </div>
                </div>
            </div>

            <div class="price-section">
                <div class="price-row">
                    <div class="price-label">Prix fixé</div>
                    <div class="price-value">399€</div>
                </div>
                <div class="price-row">
                    <div class="price-label">Prix proposé max</div>
                    <div class="price-value">800€</div>
                </div>
            </div>

            <button class="offer-button">Proposer une offre</button>
        </div>
    </div>
</div>

<script>
    // Set the countdown date (3 days, 23 hours, 19 minutes, 56 seconds from now)
    const countDownDate = new Date().getTime() + (3 * 24 * 60 * 60 * 1000) + (23 * 60 * 60 * 1000) + (19 * 60 * 1000) + (56 * 1000);

    // Update the countdown every second
    const countdown = setInterval(function() {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        // Calculate days, hours, minutes, seconds
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the results with leading zeros
        document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
        document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
        document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
        document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

        // If the countdown is finished, display zeros
        if (distance < 0) {
            clearInterval(countdown);
            document.getElementById("days").innerHTML = "00";
            document.getElementById("hours").innerHTML = "00";
            document.getElementById("minutes").innerHTML = "00";
            document.getElementById("seconds").innerHTML = "00";
        }
    }, 1000);
</script>
<?php
include "footer.php";
?>