const container = document.getElementById('container');
const toSignUp = document.getElementById('toSignUp');
const toLogin = document.getElementById('toLoginBtn');

// Switch to the Sign Up view
toSignUp.addEventListener('click', () => {
    container.classList.add('active');
});

// Switch back to the Login view
toLogin.addEventListener('click', () => {
    container.classList.remove('active');
});