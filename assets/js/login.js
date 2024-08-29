
const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const loginBtn = document.getElementById('loginBtn');
const modal = document.getElementById('myModal');
const modalMessage = document.getElementById('modalMessage');
const closeBtn = document.querySelector('.close');

const validUsername = "usuario123";
const validPassword = "contraseña123";


loginBtn.addEventListener('click', function() {
    const username = usernameInput.value;
    const password = passwordInput.value;

    if (username === "" || password === "") {
        modalMessage.textContent = "Por favor, llena todos los campos.";
        modalMessage.style.color = "red";
        modal.style.display = "block";
        return;
    }

    // 6. Comparamos con los valores correctos.
    if (username === validUsername && password === validPassword) {
        modalMessage.textContent = "Login exitoso!";
        modalMessage.style.color = "green";
        modal.style.display = "block";
        console.log("Usuario autenticado:", username);
    } else {
        modalMessage.textContent = "Usuario o contraseña incorrectos.";
        modalMessage.style.color = "red";
        modal.style.display = "block";
    }
});

closeBtn.addEventListener('click', function() {
    modal.style.display = "none";
});

// 8. Cerrar la modal si el usuario hace clic fuera de ella.
window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});