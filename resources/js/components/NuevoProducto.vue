<template>
	<form v-on:submit.prevent="addNewProducto">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Nuevo Producto</h5>

			<button v-on:click.prevent="obtenerAyuda" v-if="!$store.state.ayuda" type="button" class="btn btn-sm btn-outline-info mr-5">{{ $store.state.info }}</button><!--Obtener ayuda -->
			<button v-on:click.prevent="ocultarAyuda" v-else type="button" class="btn btn-sm btn-outline-info mr-5">{{ $store.state.info }}</button><!--Ocultar ayuda -->

			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form-producto :tiposProductos="$store.state.tiposProductos" />
			<form-precio/>
			<form-stock/>
		</div>
		<slot></slot>
	</form>
</template>
<script>
import { mapActions } from 'vuex';
export default{
	data(){
		return{
			tipo: ''
		}
	},
	methods:{
		...mapActions(['obtenerAyuda', 'ocultarAyuda','vaciarDatosProductos']),
		addNewProducto(){
			const producto = this.$store.state.producto;
			axios.post('/api/v1/productos',{
				tipoProducto_id: producto.tipoProductoID,
				imagen: producto.imagen,
				nombre: producto.nombre,
				marca: producto.marca,
				precio: producto.precio,
				precioCantidad: producto.precioCantidad,
				precioMedida: producto.precioMedida,
				stock: producto.stock,
				stockMedida: producto.stockMedida
			}).then( response => {
				swal("Nuevo producto agregado", "Haz click en el boton para continuar", "success");
				$('#modalProducto').modal('hide');
				this.$emit('getProductos')
				this.vaciarDatosProductos();
			}).catch( error => {
				swal("Error, asegurate de completar los campos obligatorios", "Haz click en el boton para continuar", "error");
			});
		}
	}
}
</script>