<?php

namespace App\Http\Controllers;

//use App\Models\Ejemplo;
use App\Data\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;  

class ProveedorController extends Controller{

 
    public function GetProveedor()
    {
        $respuesta = new Respuesta();
        
        try {

            $SQL = "SELECT *  FROM proveedor";

            $Respuesta = DB::select($SQL);
  
            $respuesta->codigo = "00";
            $respuesta->mensaje = "Información Procesada con éxito!";
            $respuesta->data  = $Respuesta;

        } catch (Exception $e) {
            $respuesta->codigo = "01";
            $respuesta->mensaje = "Error al obtener los usuarios!";
        }
        return $respuesta;
    }

  



}  