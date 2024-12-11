
        // Set the countdown date (3 days, 23 hours, 19 minutes, 56 seconds from now)
        const countDownDate = new Date().getTime() + (3*24*60*60*1000) + (23*60*60*1000) + (19*60*1000) + (56*1000);

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
