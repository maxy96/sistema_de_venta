<template>
	<form v-on:submit.prevent="updateProducto">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLongTitle">Actualizar Producto</h5>

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
	methods:{
		...mapActions(['obtenerAyuda', 'ocultarAyuda', 'vaciarDatosProductos']),
		updateProducto(){
			const producto = this.$store.state.producto;
			axios.put('/api/v1/productos/'+producto.id,{
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
				swal("Producto actualizado", "Haz click en el boton para continuar", "success");
				$('#modalProducto').modal('hide');
				this.$emit('getProductos')
				this.vaciarDatosProductos();
			}).catch( error => {
				swal("Error, asegurate que los datos estén correctos", "Haz click en el boton para continuar", "error");
				$('#modalProducto').modal('hide');
			})
		}

	}
}
</script>