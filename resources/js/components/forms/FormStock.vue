<template>
	<div class="form-group row">
		<label class="col-md-4 col-form-label text-md-right" for="stock">Stock</label>
		<div class="input-group col-md-6">
			<input type="number" v-model="$store.state.producto.stock" class="form-control" placeholder="Agregar cantidad total" aria-label="Agregar cantidad total" aria-describedby="basic-addon2" min="0">
			<div class="input-group-append">
				<select v-model="$store.state.producto.stockMedida" class="input-group-text">
					<option value="">Medida</option>
					<option value="kg">Kilogramos</option>
					<option value="g">Gramos</option>
					<option value="u">Unidad</option>
				</select>
			</div>
			<small v-show="$store.state.ayuda" class="form-text text-muted">Agrega la cantidad total que posees del producto.</small>
		</div>
	</div>
</template>
<script>
export default{

}
</script>