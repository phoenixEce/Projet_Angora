// Password visibility toggle
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.querySelector('input[name="password"]');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    
    // Toggle icon
    const img = this.querySelector('img');
    if (type === 'password') {
        img.src = 'assets/eye-icon.svg';
    } else {
        img.src = 'assets/eye-off-icon.svg';
    }
});