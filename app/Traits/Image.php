<?php 

namespace App\Traits;

use Illuminate\Support\Str as Str;

trait Image{
	public function guardarImagen($imagen)
    {
        if($imagen == null){
            return 'default.png';
        }
        $exploded = explode(',', $imagen);
        $decoded = base64_decode($exploded[1]);

        if(Str::contains($exploded[0], 'jpeg')){
            $extension = '.jpg';
        }else{
            $extension = '.png';
        }

        $fileName = Str::random().$extension;
        $path = public_path().'/imagen/'.$fileName;
        file_put_contents($path, $decoded);

        return $fileName;
    }

    public function actualizarImagen($imagen)
    {
        if (preg_match("/,/", $imagen)) {
            $fileName = $this->guardarImagen($imagen);
        }else{
            $fileName = $imagen;
        }

        return $fileName;
    }
 }
