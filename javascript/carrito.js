document.addEventListener('DOMContentLoaded', () => {
  const carritoItems = document.querySelectorAll('.carrito-item');
  const totalPagar = document.querySelector('.carrito-resumen h3');

  function actualizarTotales() {
    let subtotal = 0;

    carritoItems.forEach(item => {
      const precioTexto = item.querySelector('.item-info p').textContent;
      // Extraer el precio numérico (ej: "Precio unitario: $10.00" => 10.00)
      const precio = parseFloat(precioTexto.replace(/[^0-9.]/g, '')) || 0;

      const inputCantidad = item.querySelector('.cantidad');
      let cantidad = parseInt(inputCantidad.value);
      if (cantidad < 1 || isNaN(cantidad)) cantidad = 1;

      // Actualiza el input con la cantidad válida (evitar cero o NaN)
      inputCantidad.value = cantidad;

      const totalItem = precio * cantidad;
      subtotal += totalItem;

      // Actualizar total parcial en el DOM
      const totalItemP = item.querySelector('.item-total p');
      totalItemP.textContent = `Total: $${totalItem.toFixed(2)}`;
    });

    // Actualizar subtotal general
    totalPagar.textContent = `Total a pagar: $${subtotal.toFixed(2)}`;
  }

  // Escuchar cambios en las cantidades para actualizar totales
  carritoItems.forEach(item => {
    const inputCantidad = item.querySelector('.cantidad');
    inputCantidad.addEventListener('change', () => {
      actualizarTotales();
    });
  });

  // Inicializa los totales al cargar
  actualizarTotales();
});
