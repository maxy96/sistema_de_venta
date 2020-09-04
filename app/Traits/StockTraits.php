<?php 

namespace App\Traits;

use App\Models\Stocks;

trait StockTraits{

	public function guardarStockProducto(array $data, $productoID)
	{
		return Stocks::create([
			'producto_id' => $productoID,
			'stock' => $data['stock'],
			'medida' => $data['stockMedida']
		]);
	}

	public function actualizarStockProducto(array $data, $productoID)
	{
		return Stocks::find($productoID)->update([
			'stock' => $data['stock'],
			'medida' => $data['stockMedida']
		]);	
	}

}