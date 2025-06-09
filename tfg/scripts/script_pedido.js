document.addEventListener("DOMContentLoaded", () => {
// cargo el carrito para que aparezca en todas las páginas
mostrarDatosPedido();
});
function mostrarDatosPedido(){
    const carrito = JSON.parse(localStorage.getItem(`carrito_${usuactual}`)) || [];
    let datosPedi = document.getElementById("datosPedido");
	let datosOcultos= document.getElementById("datos_ocultos_pedido");
	let total =0 ;
	let totalPedido=0;
    datosPedi.innerHTML ="";
	datosOcultos.innerHTML ="";

    if (carrito.length === 0) {
		datosPedi.innerHTML = `<p class="text-center text-white">No hay productos seleccionados</p>`;
		return;
	}

    carrito.forEach((patata,indice) => {
		datosPedi.innerHTML += `
			<div class="flex flex-col 2xl:w-[70%] 2xl:m-auto justify-center sm:flex-row items-center w-full mb-10 border-b border-[#5C3B1E] pb-2 mb-2">
				<div class="w-[49%] sm:w-[40%]">
                    <img src="${patata.img}" class="w-full object-cover rounded mr-3">
                </div>
                <div class=" text-center w-full">
					<p class="text-xl text-[#5C3B1E] font-bold sm:pl-7">${patata.nombre}</p>
				</div>
                <div class="text-center w-full">
					<p class="text-lg text-[#5C3B1E] font-bold">${patata.precio}€ x ${patata.cantidad} = ${total =patata.precio * patata.cantidad} €</p>
				</div>
                <button onclick="borrarPatataCarrito('${patata.id}')" class="cursor-pointer text-red-500 hover:text-red-700 text-2xl font-bold">&times;</button>
			</div>

		`;

		datosOcultos.innerHTML+=`
			<input type="hidden" name="patatas[${indice}][idPatata]" value="${patata.id}">
			<input type="hidden" name="patatas[${indice}][nombrePatata]" value="${patata.nombre}">
			<input type="hidden" name="patatas[${indice}][cantidadPatata]" value="${patata.cantidad}">
			<input type="hidden" name="patatas[${indice}][precioPatata]" value="${patata.precio}">
			<input type="hidden" name="patatas[${indice}][totalDeCadaPatata]" value="${total}">
		`;
		totalPedido+= total;
	});

	datosOcultos.innerHTML+=`
		<div class="bg-[#F8E5B2] p-6 rounded-xl shadow-md w-full max-w-md mx-auto mt-10">
			<div class="mb-4 text-center">
				<h3 class="text-2xl font-bold text-[#5C3B1E]">Selecciona la hora</h3>
			</div>

			<div class="mb-4">
				<label for="hora" class="block mb-2 text-[#5C3B1E] font-semibold">Hora:</label>
				<select id="hora" name="hora" class="w-full p-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#D9984D]">
				</select>
			</div>

			<div>
				<label for="minuto" class="block mb-2 text-[#5C3B1E] font-semibold">Minuto:</label>
				<select id="minuto" name="minuto" class="w-full p-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#D9984D]">
				</select>
			</div>
		</div>
		<input type="hidden" name="totalPedido" value="${totalPedido}">
		<input type="submit" value="Finalizar Pedido" class="cursor-pointer bg-[#5C3B1E] mx-3 mb-3 px-8 py-2 rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold">
	`;
    if (carrito.length > 0) {
		datosPedi.innerHTML += `
		  <div class="mt-7 text-center 2xl:w-[70%] 2xl:m-auto 2xl:pt-7 sm:text-end">
		  		
			<p class="text-xl text-[#5C3B1E] font-bold">Total a pagar: ${totalPedido} €</p>
		  </div>
		`;
	  }

	//<------------------------------SELECCION DE HORA DEL PEDIDO HORA-------------------------------------->   
	const horaSeleccionada = document.getElementById('hora');
	const minutoSeleccionado = document.getElementById('minuto');

	const fechaActual = new Date();
	const horaActual = fechaActual.getHours();
	const minutoActual = fechaActual.getMinutes();

	// solo  de 19 a 23
	for (let hora = 19; hora <= 23; hora++) {
		const opcion = document.createElement('option');
		opcion.value = hora;
		opcion.textContent = hora.toString().padStart(2, '0');
		if (hora < horaActual) {
		opcion.disabled = true;
		}
		horaSeleccionada.appendChild(opcion);
	}

	// funcion para llenar los minutos
	function actualizarMinutos() {
		const horaSelec = parseInt(horaSeleccionada.value);
		minutoSeleccionado.innerHTML = ''; // limpia las opciones anterirores

		for (let minuto = 0; minuto < 60; minuto += 10) {
		const opcion = document.createElement('option');
		opcion.value = minuto;
		opcion.textContent = minuto.toString().padStart(2, '0');

		// Deshabilita minutos anterirores al actual
		if (horaSelec === horaActual && minuto < minutoActual) {
			opcion.disabled = true;
		}

		minutoSeleccionado.appendChild(opcion);
		}
	}

	horaSeleccionada.addEventListener('change', actualizarMinutos);

	// Inicializa minutos al cargar
	actualizarMinutos();
}
