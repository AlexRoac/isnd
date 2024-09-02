
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita la recarga de la página

    const formData = new FormData(this); // Crea un objeto FormData con los datos del formulario

    fetch('login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'index.php'; // Redirige a una página protegida
        } else {
            alert(data.message); // Muestra un mensaje de error si las credenciales son incorrectas
        }
    })
    .catch(error => console.error('Error:', error));
});

