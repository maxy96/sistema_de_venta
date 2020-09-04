import Vuex from 'vuex'

//COMPONENTES
Vue.component('nuevo-producto', require('./components/NuevoProducto.vue').default);
Vue.component('dropdown-modal', require('./components/DropdownModal.vue').default);
Vue.component('gestionar-productos', require('./components/GestionarProductos.vue').default);
Vue.component('actualizar-producto', require('./components/ActualizarProducto.vue').default);

//COMPONENTES FORMULARIOS
Vue.component('form-stock', require('./components/forms/FormStock.vue').default);
Vue.component('form-precio', require('./components/forms/FormPrecio.vue').default);
Vue.component('form-producto', require('./components/forms/FormProducto.vue').default);
Vue.component('form-tipoProducto', require('./components/forms/FormTipoProducto.vue').default);

Vue.use(Vuex);

const store = new Vuex.Store({
	state: {
		tiposProductos:[],
		ayuda: false,
		info: 'Ayuda',
		producto:{
			id: '',
			tipoProductoID: '',
			imagen: '',
			nombre: '',
			marca: '',
			precio: '',
			precioCantidad: '',
			precioMedida: '',
			stock: '',
			stockMedida: ''
		}
	},
	actions:{
		getTiposProductos({state}){
			axios.get('/api/v1/tipos-productos').then( response => {
				state.tiposProductos = response.data;
			});
		},
		obtenerAyuda({state}){
			state.ayuda = true;
			state.info = 'Ocultar';
		},
		ocultarAyuda({state}){
			state.ayuda = false;
			state.info = 'Ayuda';
		},
		setProducto({state}, producto){
			state.producto.id = producto.id_producto;
			state.producto.tipoProductoID = producto.tipoProducto_id;
			state.producto.imagen = producto.imagen;
			state.producto.nombre = producto.nombre;
			state.producto.marca = producto.marca;
			state.producto.precio = producto.precio;
			state.producto.precioCantidad = producto.por_cantidad;
			state.producto.precioMedida = producto.precioMedida;
			state.producto.stock = producto.stock;
			state.producto.stockMedida = producto.stockMedida;
		},
		vaciarDatosProductos({state}){
			state.producto.tipoProductoID = '';
			state.producto.imagen = '';
			state.producto.nombre = '';
			state.producto.marca = '';
			state.producto.precio = '';
			state.producto.precioCantidad = '';
			state.producto.precioMedida = '';
			state.producto.stock = '';
			state.producto.stockMedida = '';
		}
	}
});

const app = new Vue({
	el: '#app',
	store
})