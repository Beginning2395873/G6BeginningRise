const documentoInput = document.getElementById('documento');

documentoInput.addEventListener('input', function () {
    // Obtener el valor actual del input
    let valor = documentoInput.value.trim();

    // Verificar si el valor es un número
    if (isNaN(valor)) {
        documentoInput.value = '';
    }
});

const telefonoInput = document.getElementById('telefono');

telefonoInput.addEventListener('input', function () {
    // Obtener el valor actual del input
    let valor = telefonoInput.value.trim();

    // Verificar si el valor es un número
    if (isNaN(valor)) {
        telefonoInput.value = '';
    }
});
