<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/* 
 * * Clase de Ejemplo de la estructura de un modelo
 *  */
class Ejemplo extends Model{
        protected $primaryKey = 'Id_Usuario'; //Definición de la clave primaria de la tabla    
        protected $table = 'Usuario';         //Nombre de la tabla de la base de datos   
         public $timestamps = false;           //Se deshabilita el control interno que lleva laravel para el manejo de fecha de modificación/insercción/Eliminación        
         protected $fillable = ["Nombre","Apellido", "Edad", "Password"]; //Definición de los campos que se van a utilizar para el modelo de la tabla definida en $table
        }