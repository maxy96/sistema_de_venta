<template>
	<div class="container my-4">
		<button class="btn btn-primary" v-on:click="setComponente('nuevo-producto', 'Guardar Producto')" data-toggle="modal" data-target="#modalProducto">
			<i class="fa fa-plus mr-2"></i> Nuevo producto
		</button>
		<div class="card shadow mt-3 border-0">
			<div class="card-body">
				<h3 class="card-title text-uppercase"><strong>Gestionar productos</strong></h3>
				<hr  class="hr-text">
				<div class="row">
					<div class="col-md-6 form-group row">
						<label class="col-md-4 col-sm-4 col-form-label text-md-right">Filas</label>
						<select v-model="tableData.length" @change="getProductos()" class="form-control col-md-4 col-sm-6">
							<option v-for="(records, index) in perPage" :key="index" :value="records">{{records}}</option>
						</select>
					</div>
					<div class="col-md-6 form-group row">
						<label class="col-4 col-form-label text-md-right">Buscar</label>
						<input v-model="tableData.search" @input="getProductos()" type="text" class="form-control col-6" placeholder="Buscar...">
					</div>
				</div>
				<datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
					<tbody>	
						<tr v-for="producto in productos">
							<td>{{producto.id_producto}}</td>
							<td><img :src="`/imagen/${producto.imagen}`" style="height:4rem; width:4rem;" alt=""></td>
							<td>{{producto.nombre}}</td>
							<td>{{producto.marca}}</td>
							<td>{{producto.tipo}}</td>
							<td>{{producto.stock}}{{producto.stockMedida}}</td>
							<td>${{producto.precio}}/{{producto.por_cantidad}}{{producto.precioMedida}}</td>
							<td>
								<button class="btn btn-success" v-on:click="setComponente('actualizar-producto', 'Actualizar producto'); capturarProducto(producto);" data-toggle="modal" data-target="#modalProducto">
									<i class="fa fa-edit mr-2"></i>Editar
								</button>
							</td>
						</tr>
					</tbody>
				</datatable>

				<div class="row">		
					<div class="col-12">
						<pagination :pagination="pagination"
						@prev="getProductos(pagination.prevPageUrl)"
						@next="getProductos(pagination.nextPageUrl)" />
					</div>
				</div>		

			</div>					
		</div>
		<div class="modal fade bd-example-modal-lg" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="modalProducto" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<dropdown-modal :titulo="'Nuevo tipo de producto'">
						<form-tipoProducto @change="getTiposProductos()"/>
					</dropdown-modal>
					<component :is="componente" @getProductos="getProductos">					
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
							<button type="submit" class="btn btn-primary">{{botonAccion}}</button>
						</div>
					</component>
				</div>
			</div>	
		</div>
	</div>			
</template>
<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue';
import { mapActions } from 'vuex'
export default{
	components: { datatable: Datatable, pagination: Pagination },	
	data() {
		let sortOrders = {};

		let columns = [
		{width: '10%', label: 'ID', name: 'id_productos' },
		{width: '20%', label: 'Imagen', name: 'imagen' },
		{width: '20%', label: 'Nombre', name: 'nombre' },
		{width: '20%', label: 'Marca', name: 'marca' },
		{width: '20%', label: 'Tipo', name: 'tipo'},
		{width: '10%', label: 'Stock', name: 'stock'},
		{width: '20%', label: 'Precio', name: 'precio'}
		];

		columns.forEach((column) => {
			sortOrders[column.name] = -1;
		});
		return {
			columns: columns,
			sortKey: 'id_productos',
			sortOrders: sortOrders,
			perPage: ['10', '20', '30'],
			tableData: {
				draw: 0,
				length: 10,
				search: '',
				column: 0,
				dir: 'desc',
			},

			loading: false,

			pagination: {
				lastPage: '',
				currentPage: '',
				total: '',
				lastPageUrl: '',
				nextPageUrl: '',
				prevPageUrl: '',
				from: '',
				to: ''
			},

			productos: [],

			componente: '',
			botonAccion: ''
		}
	},
	created(){
		this.getTiposProductos();
		this.getProductos();
	},
	mounted(){
		const self = this;
		$('#modalProducto').on('hidden.bs.modal', function (e) {
			self.vaciarDatosProductos();
			self.$refs.fileImage.value = '';
		})
	},
	methods:{
		...mapActions(['getTiposProductos', 'setProducto', 'vaciarDatosProductos']),
		setComponente(componente, accion){
			this.botonAccion = accion;
			this.componente = componente;
		},
		getProductos(url = '/api/v1/productos'){
			this.tableData.draw++;
			axios.get(url, {params: this.tableData})
			.then(response => {
				let data = response.data;
				if (this.tableData.draw == data.draw) {
					this.productos = data.data.data;
					this.configPagination(data.data);
				}
				//this.$refs.fileImage.value = '';
			})
			.catch(errors => {
				console.log(errors);
			});
		},
		configPagination(data) {
			this.pagination.lastPage = data.last_page;
			this.pagination.currentPage = data.current_page;
			this.pagination.total = data.total;
			this.pagination.lastPageUrl = data.last_page_url;
			this.pagination.nextPageUrl = data.next_page_url;
			this.pagination.prevPageUrl = data.prev_page_url;
			this.pagination.from = data.from;
			this.pagination.to = data.to;
		},

		sortBy(key) {
			this.sortKey = key;
			this.sortOrders[key] = this.sortOrders[key] * -1;
			this.tableData.column = this.getIndex(this.columns, 'name', key);
			this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
			this.getProductos();
		},

		getIndex(array, key, value) {
			return array.findIndex(i => i[key] == value)
		},

		capturarProducto(producto){
			this.setProducto(producto);
		} 
	}
}
</script>