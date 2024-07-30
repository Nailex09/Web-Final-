document.getElementById('agregarArticulo').addEventListener('click', function() {
    var articuloDiv = document.createElement('div');
    articuloDiv.className = 'articulo';

    articuloDiv.innerHTML = `
        <label for="nombre_articulo">Nombre:</label>
        <input type="text" name="nombre_articulo[]" required>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad[]" required>
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" name="precio[]" required>
        <label for="total">Total:</label>
        <input type="number" step="0.01" name="total[]" readonly>
    `;

    document.getElementById('articulos').appendChild(articuloDiv);
    attachEventHandlers();
});

function attachEventHandlers() {
    document.querySelectorAll('.articulo').forEach(function(articulo) {
        var cantidadInput = articulo.querySelector('input[name="cantidad[]"]');
        var precioInput = articulo.querySelector('input[name="precio[]"]');
        var totalInput = articulo.querySelector('input[name="total[]"]');

        cantidadInput.addEventListener('input', updateTotal);
        precioInput.addEventListener('input', updateTotal);

        function updateTotal() {
            var cantidad = parseFloat(cantidadInput.value) || 0;
            var precio = parseFloat(precioInput.value) || 0;
            var total = cantidad * precio;
            totalInput.value = total.toFixed(2);
            updateTotalPagar();
        }
    });
}

function updateTotalPagar() {
    var totalPagar = 0;
    document.querySelectorAll('input[name="total[]"]').forEach(function(totalInput) {
        totalPagar += parseFloat(totalInput.value) || 0;
    });
    document.getElementById('total_pagar').value = totalPagar.toFixed(2);
}

attachEventHandlers();
