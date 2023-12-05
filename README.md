<h1>USO DE API EXTERNA</h1>

Para la resolución del ejercicio de uso de API externa se creó la migración y el modelo de Photo para poder crear la tabla en nuestra base de datos con los siguientes atributos:

     'albumId',
        'id',
        'title',
        'url',
        'thumbnailUrl'



Una vez corrida la migración y creada la tabla en nuestra base de datos, creamos el controlador PhotoController para manejar la petición HTTP a la API externa y poder traer los datos que brinda.


Primero se prueba la conexión del endpoint de la API externa mediante el try catch, en la cual le delimitamos 5 intentos como máximo y un time out. 

Una vez que validemos que la conexión es exitosa, recibimos la respuesta de la petición en formato JSON y la almacenamos en la variable $photos

Antes de crear nuestro nuevo objeto Photo, tenemos que validar si los datos que recibimos de la API coinciden con los formatos que necesitamos en nuestra base de datos. Esto es para que en el camino no pase nada con la información que pueda perjudicar las reglas de nuestro objeto.

Luego, se iteran los datos que nos devuelve la API externa y se crea una instancia de nuestro modelo Photo por cada una de las iteraciones, llenando sus atributos con los atributos que vienen por JSON. 


Finalmente devolvemos la response con un mensaje y un código de estado 200 (ok).



<h1>AUTOMATIZANDO LA SINCRONIZACIÓN DE FOTOS</h1>

En un escenario real, si dependemos de una API externa para sincronizar las fotos a nuestro sistema o nuestra base de datos, esta sincronización tiene que estar constantemente actualizada para que los usuarios vean las fotos que nosotros queremos mostrar siempre, sin importar que cambie la base de datos de la API externa.

Por lo tanto, creamos procesos programados para que la función de sincronizar fotos se ejecute en cada minuto para no perdernos ninguna imagen de la API externa.

Para eso se realizó un comando en el schedule y se ejecuta mediante el Kernel de laravel.


<h1>CONSUMIR API EXTERNA</h1>

Entonces los pasos a seguir para el consumo de la api externa son:

<h2>Clona el repositorio de GitHub:</h2>
git clone https://github.com/severloth/mailup-using-api

<h2>Instala las dependencias:</h2>
	composer install

<h2>Migra la base de datos para obtener la tabla photos:</h2>
	php artisan migrate
	
<h2>Inicializa el servidor</h2>
	php artisan serve

<h2>Ejecuta el schedule para que realice la sincronización cada minuto </h2>
	php artisan schedule:work

