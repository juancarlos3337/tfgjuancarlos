document.addEventListener("DOMContentLoaded", () => {
// cargo el carrito para que aparezca en todas las páginas

cargarCarrito();
});
function cargarCarrito() {
	const carrito = JSON.parse(localStorage.getItem(`carrito_${usuactual}`)) || [];
	let compras = document.querySelector(".compras");
	let compraDinamica = document.getElementById("compraDinamica");
	
	compraDinamica.innerHTML = "";

	//si el carrito tiene de longitud 0, mandamos un mensaje que no hay productos seleccionados
	if (carrito.length === 0) {
		compraDinamica.innerHTML = `<p class="text-center text-[#5C3B1E]">No hay productos seleccionados</p>
		`;
		return;
	}

	//por cada elemento del carrito lo imprimimos
	carrito.forEach((patata) => {
		compraDinamica.innerHTML += `
			<div class="flex items-center justify-around w-full border-b border-[#5C3B1E] pb-2 mb-2">
				<img src="${patata.img}" class="w-12 h-12 object-cover rounded mr-3">
				<div class="flex items-center justify-around w-[50%]">
					<p class="text-lg">${patata.nombre}</p>
					<p class="text-md">${patata.precio}€ x ${patata.cantidad}</p>
				</div>
				<button onclick="borrarPatataCarrito('${patata.id}')" class="text-red-500 hover:text-red-700 text-2xl font-bold cursor-pointer">&times;</button>
			</div>
		`;
	});

	if (carrito.length > 0) {
		compraDinamica.innerHTML += `
		  <div class="mt-4 text-center">
			<a href="index.php?action=verPedido" class="cursor-pointer bg-[#5C3B1E] mx-3 mb-3 px-8 py-2 rounded-lg hover:bg-[#D9984D] text-white hover:text-[#8C512B] transition duration-300 font-bold">Realizar pedido</a>
		  </div>
		`;
	  }
	
	//llamar aqui
}
function agregarAlCarrito(id, nombre, precio, img) {
	const carrito = JSON.parse(localStorage.getItem(`carrito_${usuactual}`)) || [];

	const index = carrito.findIndex(p => p.id === id);
	if (index !== -1) {
		carrito[index].cantidad += 1;
	} else {
		carrito.push({ id, nombre, precio, img, cantidad: 1 });
	}

	localStorage.setItem(`carrito_${usuactual}`, JSON.stringify(carrito));
	//llamar aquiu
}


function borrarPatataCarrito(id) {
	let carrito = JSON.parse(localStorage.getItem(`carrito_${usuactual}`)) || [];
	carrito = carrito.filter(p => p.id !== id);
	localStorage.setItem(`carrito_${usuactual}`, JSON.stringify(carrito));
	//aqui llamar
	cargarCarrito();
}
