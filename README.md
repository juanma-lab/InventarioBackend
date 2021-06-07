# Proyecto BackendPHP Laravel - CASSA V 7.0
 
### Instalación del proyecto
 
 * Se utiliza [Composer](https://getcomposer.org/).

 * Clonar el repositorio 

 * Instalación de CLI de laravel para ambiente de desarrollo

     * Haciendo uso de la consola de Windows(CMD) ejecutar el comando:

 ```sh
 composer global require laravel/installer
 ```
 * Ubicarse dentro de la carpeta del proyecto ``BackendPHP``
 * Levantar el proyecto

     * Haciendo uso de la consola ejecutar el comando:

 ```sh
 php artisan serve
 ```
 
 
### Estructura del proyecto
 
La estructura principal del proyecto esta compuesta por
 
 * ``app/Data``:Carpeta que cotiene archivos de clases que no pertenecen a un controlador o Modelo. El proyecto incluye un archivo de ejemplo de una estructura de clase sencilla llamada
 
             Respuesta.php            

* ``app/http/Controllers``:Carpeta que almacena los controladores de la aplicación. Se posee un controlador de Ejemplo para ser consumido con apiREST

             EjemploController.php
* ``app/Models``: Carpeta que almacena los modelos de la aplicación. La creación de los modelos es agregando un nuevo archivo a esta carpeta no es necesario un comando en especial.Archivo de ejemplo dentro de la carpeta
* 
            Ejemplo.php
 
 ### Configuración de Base de Datos
 
Para realizar la configuración de la conexión a la base de datos es necesario establecerlo en el archivo ``.env`` ubicado en la raíz del proyecto, configurar el apartado

        DB_CONNECTION=mysql
		DB_HOST=127.0.0.1
		DB_PORT=3306
		DB_DATABASE=laravel
		DB_USERNAME=root
		DB_PASSWORD=

Para conocer la configuración de los driver soportados por Laravel ubicarse en la carpeta y archivo ``config/database.php``, ubicar la configuración correspondiente por ejemplo SQLServer

        'sqlsrv' => [
                driver' => 'sqlsrv',
	            'host' => env('DB_HOST'),
        	    'port' => env('DB_PORT'),
            	'database' => env('DB_DATABASE'),
	            'username' => env('DB_USERNAME'),
            	'password' => env('DB_PASSWORD'),
	            'charset' => 'utf8',
        	    'prefix' => '',
                ],
 
## Creación de Controladores
Para la creación de controladores para el uso de apiREST, utilizar la consola y ejecutar el comando:

 ```sh
 php artisan make:controller nombreController --api  
 ```
Creara una plantialla con las funciones que pueden ser mapeadas como apiRest, se puede utilizar el parametro ``Request $request`` para obtener los elementos enviados por la petición HTTP correspondiente (Ver archivo de ejemplo ``EjemploController.php``) . 

## Configuración de Rutas 
Para realizar el mapeo de las funciones y que estas puedan ser consultadas como apiREST es necesario configurar el archivo ``routes/api.php``, configuración de routas de ejemplo incluidas en el proyecto:

    Route::get('/Ejemplo', 'EjemploController@index');
    Route::put('/Ejemplo/actualizar', 'EjemploController@update');
    Route::post('/Ejemplo/guardar', 'EjemploController@store');
    Route::delete('/Ejemplo/borrar/{Id_Usuario}', 'EjemploController@destroy');
    Route::get('/Ejemplo/buscar', 'EjemploController@show');

Se define el metodo de acceso HTTP y como primer parametro la mascara utilizada para su acceso ``/Ejemplo/guardar``, como segundo parametro el nombre del controlador después del ``@`` le nombre de la función. Para acceder a la dirección se realizaria de la siguiente manera ``http://localhost:8000/api/Ejemplo/guardar``

## Configuración de CORS [Opcional]
Laravel por defecto viene configurado para poder responder a opciones CORS, si es necesario realizar alguna configuración adicional, dicha configuración se puede realizar en el archivo ``config/cors.php ``

#### Recomendaciones 
* Se recomienda la creación de los modelos creando el archivo sin comandos para evitar configuraciones adicionales que pueda ofrecer el  [Eloquent ORM](https://laravel.com/docs/7.x/eloquent), ya que agrega campos adicionales de configuración.
* Si se desea crear un proyecto desde cero utilizar la siguiente linea de comandos:

        composer create-project laravel/laravel=7.0 project-name --prefer-dist
    Para trabajar con la versión 7 de Laravel, si no se define una versión se descargara la ultima versión disponible.
    
* Laravel viene configurado para evitar el uso del controlador principal para que la urls sean mas accesibles, si existe algún problema con el formato de url verificar configuración recomendada para [URLs Laravel](https://laravel.com/docs/7.x/installation#pretty-urls)
* Para mayor información  consultar [Documentación v7.0 Laravel](https://laravel.com/docs/7.x)