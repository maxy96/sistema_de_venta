<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\PreciosTraits;
use App\Traits\StockTraits;
use App\Traits\Image;

use App\Models\Productos;

class ProductosController extends Controller
{
    use Image, PreciosTraits, StockTraits;

    public function index(Request $request)
    {   
        if ($request->input('client') ) {
            return Productos::select()
            ->get();
        }

        $columns = ['id_producto', 'imagen' ,'nombre', 'tipo','marca', 'precio', 'stock'];
        $column = $request->input('column'); //Index
        $length = $request->input('length');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Productos::select('productos.*', 'precios.precio', 'precios.por_cantidad', 'precios.medida as precioMedida', 'precios.por_cantidad', 'stocks.stock', 'stocks.medida as stockMedida' , 'tipos_productos.descripcion as tipo')
        ->Join('precios', 'precios.producto_id', '=', 'id_producto')
        ->Join('stocks', 'stocks.producto_id', '=', 'id_producto')
        ->join('tipos_productos', 'id_tipoProducto', '=', 'tipoProducto_id')
        ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('nombre', 'like', '%' . $searchValue . '%')
                ->orWhere('marca', 'like', '%' . $searchValue . '%')
                ->orWhere('stock', 'like', '%' . $searchValue . '%')
                ->orWhere('precio', 'like', '%' . $searchValue . '%');
            });
        }

        $productos = $query->paginate($length);
        return ['data' => $productos, 'draw' => $request->input('draw')];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(method_exists($this,'guardarImagen')){
            $fileName = $this->guardarImagen($request->imagen);
        }else{
            return response(['error' => "error"], 404);
        }
        
        $productoID = $this->guardarProducto($request->all(), $fileName);
        $stock = $this->guardarStockProducto($request->all(), $productoID);
        $precio = $this->guardarPrecioProducto($request->all(), $productoID);

        return response(['data' => 'Success'], 201);
    }

    public function guardarProducto(array $data, $fileName)
    {
        $producto = Productos::create([
            'tipoProducto_id' => $data['tipoProducto_id'],
            'nombre' => $data['nombre'],
            'marca' => $data['marca'],
            'imagen' => $fileName
        ]);
        return $producto->id_producto;
    }
    
    public function actualizarProducto(array $data, $productoID, $fileName)
    {
        return Productos::find($productoID)->update([
            'tipoProducto_id' => $data['tipoProducto_id'],
            'nombre' => $data['nombre'],
            'marca' => $data['marca'],
            'imagen' => $fileName
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(method_exists($this,'actualizarImagen')){
            $fileName = $this->actualizarImagen($request->imagen);
        }

        $this->actualizarProducto($request->all(), $id, $fileName);
        $this->actualizarPrecioProducto($request->all(), $id);
        $this->actualizarStockProducto($request->all(), $id);

        return response(['data' => 'success'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
