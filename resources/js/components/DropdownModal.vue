<template>
	<div class="dropdown d-inline-block mx-2">
		<button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ titulo }}</button>
		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			<slot></slot>
		</div>
	</div>
</template>
<script>
	export default{
		props: ['titulo']
	}
</script>