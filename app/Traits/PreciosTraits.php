<?php 

namespace App\Traits;

use App\Models\Precios;

trait PreciosTraits{

	public function guardarPrecioProducto(array $data, $productoID)
	{
		return Precios::create([
			'producto_id' => $productoID,
			'precio' => $data['precio'],
			'por_cantidad' => $data['precioCantidad'],
			'medida' => $data['precioMedida']
 		]);
	}

	public function actualizarPrecioProducto(array $data, $productoID)
	{
		return Precios::find($productoID)->update([
			'precio' => $data['precio'],
			'cantidad' => $data['precioCantidad'],
			'medida' => $data['precioMedida']
		]);	
	}

}