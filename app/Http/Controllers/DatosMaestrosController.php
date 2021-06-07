<?php

namespace App\Http\Controllers;

//use App\Models\Ejemplo;
use App\Data\Respuesta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;  

class DatosMaestrosController extends Controller{

 
    public function GetZafras()
    {
        $respuesta = new Respuesta();
        
        try {

            $SQL = "SELECT *  FROM empleado";

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

    public static function GetZafraxId($IdZafra)
    {
        $respuesta = new Respuesta();
        try {
            
            return DB::table("logistica.Zafras")
                            ->where("IdZafra", $IdZafra)
                            ->select("BkZafra")
                            ->get();
        } catch (Execption $e) {
            return 0;
        }
    }

    public static function GetZafraActiva()
    {
        try {
            
            return DB::table("VW_Zafras")
                            ->where("BkEstado", 1)
                            ->select("IdZafra")
                            ->get();
        } catch (Execption $e) {
            return 0;
        }
    }


    public function GetSemanas(REquest $request)
    {
        $respuesta = new Respuesta();
        try {
    
            $Respuesta = DB::table("logistica.Semanas")
                            ->where("Anio",$request->Anio)
                            ->orderBy('FechaIni', 'desc')
                            ->select(
                                DB::raw("idSemana IdSemana"), 
                                DB::raw("CONCAT(Semana,': ',CONVERT(varchar, FechaIni,103),'-',CONVERT(varchar, FechaFin,103)) Semana")
                                )
                            ->get();
            $respuesta->codigo = "00";
            $respuesta->mensaje = "Información Procesada con éxito!";
            $respuesta->data  = $Respuesta;

        } catch (Exception $e) {
            $respuesta->codigo = "01";
            $respuesta->mensaje = "Error al obtener los usuarios!";
        }
        return $respuesta;
    }

    public function GetIngenios()
    {
        $respuesta = new Respuesta();
        try {
            $Respuesta = DB::table("dbo.Ingenios")
                            ->select("IdIngenio","BkIngenio", "DsIngenio")
                            ->get();
            $respuesta->codigo = "00";
            $respuesta->mensaje = "Información Procesada con éxito!";
            $respuesta->data  = $Respuesta;

        } catch (Exception $e) {
            $respuesta->codigo = "01";
            $respuesta->mensaje = "Error al obtener los usuarios!";
        }
        return $respuesta;
    }

    public static function GetIngenioxId($IdIngenio)
    {
        // print_r($IdIngenio);
        $respuesta = new Respuesta();
        try {
            
            return DB::table("dbo.Ingenios")
                            ->where("IdIngenio", $IdIngenio)
                            ->select("BkIngenio")
                            ->get();
        } catch (Execption $e) {
            return 0;
        }
    }

    public static function GetIngenioxBk($BkIngenio)
    {
        // print_r($IdIngenio);
        $respuesta = new Respuesta();
        try {
            
            return DB::table("dbo.Ingenios")
                            ->where("BkIngenio", $BkIngenio)
                            ->select("IdIngenio")
                            ->get();
        } catch (Execption $e) {
            return 0;
        }
    }

    public function GetHaciendasAutocomplete(REquest $request)
    {
        $respuesta = new Respuesta();
        try {   
            return DB::table("Planeacion.Haciendas")
                            ->where("BkHacienda",'LIKE','%'.$request->q.'%')
                            ->orWhere("DsHacienda",'LIKE','%'.$request->q.'%')
                            ->select("IdHacienda", "BkHacienda",
                                    DB::raw("BkHacienda+'-'+NomLegal Hacienda"))
                            ->whereNotNull("NomLegal")
                            ->get();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetHaciendas()
    {
        $respuesta = new Respuesta();
        try {   
            return DB::table("Planeacion.Haciendas")
                            ->select("IdHacienda", "BkHacienda",
                                    DB::raw("BkHacienda+'-'+NomLegal Hacienda"))
                            ->whereNotNull("NomLegal")
                            ->get();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetHdaXLibActiva()
    {
        $respuesta = new Respuesta();
        try {   
            $GetZafra = $this->GetZafraActiva();
            $IdZafra = $GetZafra[0]->IdZafra;
            return DB::table("Planeacion.VW_OrdenCosecha AS O")
                            ->join("Planeacion.Haciendas AS H", "O.IdHacienda","=", "H.IdHacienda")
                            ->select("O.IdHacienda",
                                    DB::raw("O.BkHacienda+'-'+NomLegal AS Hacienda")
                                    )
                            ->where("BkEstado","1")
                            ->where("O.IdZafra",$IdZafra)
                            ->whereNotNull("NomLegal")
                            ->distinct()
                            ->get();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetLotesLibActivas(REquest $request)
    {
        try {   
            $GetZafra = $this->GetZafraActiva();
            $IdZafra = $GetZafra[0]->IdZafra;
            return DB::table("Planeacion.VW_OrdenCosecha")
                            ->select("IdLoteProveedor AS IdLote",
                                    DB::raw("BkLote+'-'+DsLote Lote")
                                    )
                            ->where("BkEstado","1")
                            ->where("IdZafra",$IdZafra)
                            ->where("IdHacienda",$request->IdHacienda)
                            ->whereNotNull("DsLote")
                            ->distinct()
                            ->get();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetLibActivasxLote(REquest $request)
    {
        $respuesta = new Respuesta();
        try {
            return DB::table("Planeacion.VW_OrdenCosecha")
                            ->where("IdLoteProveedor",$request->IdLote)
                            ->where("BkEstado","1")
                            ->select("IdOrdenCosecha",
                                    DB::raw("CONVERT(varchar,BkLibera) +' - '+ DsTipOrdCos OrdenCosecha"))
                            ->get();        
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetLotesXIdHacienda(REquest $request)
    {
        $respuesta = new Respuesta();
        try {
            return DB::table("Planeacion.Lotes")
                            ->where("IdHacienda",$request->IdHacienda)
                            ->select("IdLote", "BkLote",
                                    DB::raw("BkLote+'-'+DsLote Lote"))
                            ->get();
                            
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetOrdenCosechaxLote(REquest $request)
    {
        $respuesta = new Respuesta();
        try {
            return DB::table("Planeacion.VW_OrdenCosecha")
                            ->where("IdLoteProveedor",$request->IdLote)
                            ->where("BkEstado","1")
                            ->select("IdOrdenCosecha",
                                    DB::raw("BkLibera Liberacion"))
                            ->get();        
        } catch (Exception $e) {
            return 0;
        }
    }

    public static function GetEquiposXEtapaOp(REquest $request)
    {
        $respuesta = new Respuesta(); 
         
        try { 
       
            
            $params = array(
                $request->IdIngenio, 
                $request->Modo,
                $request->IdEtapaOperacion        
            );
     
            $Respuesta = DB::select('SET NOCOUNT ON; EXEC [logistica].[ConsultaEquiposPorEtapaOperacion] ?,?,?', $params);
            $respuesta->codigo = "00";
            $respuesta->mensaje = "Información Procesada con éxito!";
            $respuesta->data  = $Respuesta;

        } catch (Exception $e) {
            $respuesta->codigo = "01";
            $respuesta->mensaje = "Error al obtener los Equipos por etapa de operación!";
        }
        return $respuesta;
    }

    public function GetFlotasxHacienda(REquest $request)
    { 
        $respuesta = new Respuesta();
        try {
            return DB::table("logistica.FlotasHacienda AS O")
                            ->join("logistica.Flota AS E","O.Flota","=","E.Flota" )
                            ->where("O.IdHacienda",$request->IdHacienda)
                            ->select("O.Flota","E.NomFlota")
                            ->get();        
        } catch (Exception $e) {
            return 0;
        }
    }

    public function GetMotivosDeRechazo()
    {
        $respuesta = new Respuesta();
        try {   
            return DB::table("logistica.Inconsistencia")
                            ->select("IdInconsistencia", "DsInconsistencia")
                            ->where("IdOperacionLogistica",8)
                            ->get();
        } catch (Exception $e) {
            return 0;
        }
    } 

    public static function GetEquipoxCod($CodEquipo)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        try {
            return DB::table("logistica.Equipos")
                        ->where("CodEquipo", "=", $CodEquipo)
                        ->select("*")             
                        ->get();
        } catch (\Throwable $th) {
            var_dump("Error al obtener equipo por codigo",$th);
        } 
        
        
    }

}  