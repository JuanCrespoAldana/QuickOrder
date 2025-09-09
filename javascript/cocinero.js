async function cargarPedidos() {
    try {
        const response = await fetch('../controlador/obtener_pedidos.php');
        const pedidos = await response.json();

        // Limpiar contenedores
        document.getElementById('ordersList').innerHTML = '';
        document.getElementById('cocinando').innerHTML = '';
        document.getElementById('emplatando').innerHTML = '';
        document.getElementById('listo').innerHTML = '';

        pedidos.forEach(pedido => {
            // Crear elemento contenedor del pedido
            const pedidoDiv = document.createElement('div');
            pedidoDiv.classList.add('pedido-card');
            pedidoDiv.innerHTML = `
  <h4>Pedido #${pedido.idpedido}</h4>
  <p><strong>Cliente:</strong> ${pedido.mesero}</p>
  <p><strong>Hora:</strong> ${pedido.hora}</p>
  <ul>
    ${pedido.detalles.map(d => `<li>${d.cantidad} x ${d.platillo}</li>`).join('')}
  </ul>
  <button class="btn-cambiar-estado" data-id="${pedido.idpedido}">Cambiar Estado</button>
`;

            // Agregar al contenedor según estado
            switch (pedido.estado) {
                case 'nuevo':
                    document.getElementById('ordersList').appendChild(pedidoDiv);
                    break;
                case 'cocinando':
                    document.getElementById('cocinando').appendChild(pedidoDiv);
                    break;
                case 'emplatando':
                    document.getElementById('emplatando').appendChild(pedidoDiv);
                    break;
                case 'listo':
                    document.getElementById('listo').appendChild(pedidoDiv);
                    break;
            }
        });

        // Agregar evento para cambiar estado
        document.querySelectorAll('.btn-cambiar-estado').forEach(btn => {
            btn.addEventListener('click', () => {
                const idPedido = btn.getAttribute('data-id');
                cambiarEstadoPedido(idPedido);
            });
        });

    } catch (error) {
        console.error('Error al cargar pedidos:', error);
    }
}

async function cambiarEstadoPedido(idPedido) {
    const estados = ['nuevo', 'cocinando', 'emplatando', 'listo', 'entregado'];

    try {
        const res = await fetch('../controlador/cambiar_estado.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `idpedido=${idPedido}`
        });
        const data = await res.json();
        if (data.success) {
            alert('Estado actualizado');
            cargarPedidos(); // recargar la lista
        } else {
            alert('Error al actualizar estado');
        }
    } catch (e) {
        alert('Error de red al actualizar estado');
    }
}

// Cargar pedidos cuando la página cargue
window.onload = cargarPedidos;
