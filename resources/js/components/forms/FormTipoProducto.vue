<template>
	<form class="px-4 py-3" method="POST" v-on:submit.prevent="addNewTipoProducto" >
		<div class="form-group">
			<label for="descripcion">Nuevo Tipo de producto</label>
			<input type="text" v-model="tipoProductoDescripcion" class="form-control" id="descripcion" placeholder="Ejemplo: harina.">
		</div>
		<button type="submit" :class="{disabled: (!tipoProductoDescripcion)}" class="btn btn-primary">Guardar</button>
	</form>
</template>
<script>
import { mapActions } from 'vuex'
	export default{
		data(){
			return{
				tipoProductoDescripcion: '',
			}
		},
		methods:{
			...mapActions(['getTiposProductos']),
			addNewTipoProducto(){
				axios.post('/api/v1/tipos-productos',{
					descripcion: this.tipoProductoDescripcion
				}).then(response => {
					this.getTiposProductos();
					swal("Nuevo tipo de producto agregado", "Haz click en el boton para continuar", "success");
					this.tipoProductoDescripcion = '';
				})
				.catch(error => {
					swal("Hubo un error, asegurate que ese dato no exista", "Haz click en el boton para continuar", "error");
					this.tipoProductoDescripcion = '';
					console.log(error.data)
				});
			}
		}
	}
</script>