<template>
	<div>
		<div class="form-group row">
			<label for="newTipoProducto" class="col-md-4 col-form-label text-md-right">Tipo producto</label>		
			<div class="col-md-6">
				<select v-model="$store.state.producto.tipoProductoID" id="newTipoProducto" class="form-control">
					<option value="">-- Seleccionar tipo de producto --</option>
					<option v-for="tipoProducto in tiposProductos" v-bind:value="tipoProducto.id_tipoProducto" >{{tipoProducto.descripcion}}</option>
				</select>
				<small v-show="$store.state.ayuda" id="precioAyuda" class="form-text text-muted">Selecciona el tipo de producto, siendo este panificados, gaseosa, jugos, harina, etc. Puede agregar mas tipos pulsando el boton de arriba que dice "Nuevo tipo producto"</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="imagen" class="col-md-4 col-form-label text-md-right">Imagen (opcional)</label>
			<div class="col-md-6">
				<input @change="obtenerImagen" id="imagen" type="file" ref="fileImage" accept="image/*">
				<small v-show="$store.state.ayuda" class="form-text text-muted">Agrega una imagen representativa del producto</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="newNombre" class="col-md-4 col-form-label text-md-right">Nombre producto</label>
			<div class="col-md-6">
				<input v-model="$store.state.producto.nombre" id="newNombre" type="text" class="form-control" required placeholder="Agregar nombre de producto">
				<small v-show="$store.state.ayuda" class="form-text text-muted">Agrega el nombre de tu producto detalladamente. Por ejemplo: coca cola 2l retornable. Pan. Sprite 3l</small>
			</div>
		</div>
		<div class="form-group row">
			<label for="newMarca" class="col-md-4 col-form-label text-md-right">Marca (Opcional)</label>
			<div class="col-md-6">
				<input v-model="$store.state.producto.marca" id="newMarca" type="text" class="form-control" placeholder="Agregar marca del producto" >
				<small v-show="$store.state.ayuda" class="form-text text-muted">Agrega la marca de tu producto. Por ejemplo: coca company, la reina, canga, etc.</small>
			</div>
		</div>
	</div>
</template>
<script>
export default{
	props:['tiposProductos'],
	data(){
		return {
			newTipoProducto: ''
		}
	},
	methods:{
		obtenerImagen(e){
			let file = e.target.files[0];
			let fileReader = new FileReader();
			fileReader.readAsDataURL(file);

			fileReader.onload = (e) =>{
				this.$store.state.producto.imagen = e.target.result;
			}
			//this.$refs.fileImage.value = '';
		}
	}
}
</script>