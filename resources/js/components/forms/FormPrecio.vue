<template>
	<div class="form-group row">
		<label for="precio" class="col-md-4 col-form-label text-md-right">Precio</label>
		<div class="input-group col-md-6">
			<input v-model="$store.state.producto.precio" type="number" class="form-control" placeholder="Agregar precio" aria-label="Agregar precio" aria-describedby="precioAyuda" min="0.01" step="0.01">
			<div class="input-group-append">
				<span class="input-group-text">Por</span>
			</div>
			<input v-model="$store.state.producto.precioCantidad" type="number" placeholder="Cantidad" class="form-control" min="1">
			<div class="input-group-append">
				<select v-model="$store.state.producto.precioMedida" class="input-group-text">
					<option value="">Medida</option>
					<option value="kg">Kilogramos</option>
					<option value="g">Gramos</option>
					<option value="u">Unidad</option>
				</select>
			</div>
		<small v-show="$store.state.ayuda" id="precioAyuda" class="form-text text-muted">Agrega el precio dependiendo la cantidad necesaria y su medida. Por ejemplo: Precio '10.5' por '100' g</small>
		</div>
	</div>
</template>
<script>
export default {

}
</script>