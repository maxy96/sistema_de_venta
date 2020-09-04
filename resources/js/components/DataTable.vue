<template>
	<div class="table-responsive">
		<table class="table table-striped table-hover table-dark">
			<thead>
				<tr>
					<th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
					:class="[sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting']"
					:style="'cursor:pointer;'">
					<span class="left">{{column.label}}</span> 

					<i class="fa fa-sort" v-if="sortKey === column.name && sortOrders[column.name] > 0 "></i>
					<i class="fa fa-sort" v-else></i>

				</th>
				<th class="grey-text">Accion</th>
			</tr>
		</thead>
		<slot></slot>
	</table>
</div>
</template>

<script>
export default {
	props: ['columns', 'sortKey', 'sortOrders']
}
</script>