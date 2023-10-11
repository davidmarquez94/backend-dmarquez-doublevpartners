<h3>Prueba Backend DAVID FELIPE MÁRQUEZ</h3>
<br /><br />
<h6>Sistema de Tickets</h6>
<br /><br />
Para comenzar, por favor ejecutar el comando <strong>composer install</strong><br />
Generar el archivo .env a partir del archivo .env.example <br />
El sistemna es multilenguaje, por lo tanto, no olvidar la variable APP_LANG en el archivo .env<br /><br />
<strong>Crear la base de datos correspondiente</strong><br /><br />
Ejecutar los siguientes comandos:<br />
* php artisan key:generate<br />
* php artisan migrate<br />
* php artisan db:seed --class=TicketsSeeder<br /><br />
A continuación, puede hacer las pruebas del sitio ejecutando Postman, en el directorio <strong>test-site</strong> dejo algunas capturas de pantalla<br /><br />
<h5>Rutas:</h5>
GET: http://localhost:8000/api/tickets/all (Esta ruta recibe 2 parámetros opcionales para filtrar los resultados, id y status[open, closed])<br />
POST: http://localhost:8000/api/tickets/create (Debe especificar los campos username y description para la generación de un ticket nuevo)<br />
POST: http://localhost:8000/api/tickets/update (Debe especificar id, username, description y status [open, closed])<br />
POST: http://localhost:8000/api/tickets/destroy (Debe especificar el id del ticket)<br /><br />
Se implementa la clase "validator" para las validaciones correspondientes en el controlador. <br /><br />
Las pruebas unitarias se realizan sobre el llamado a los tickets, se encuentran en el directorio <strong>test/Feature/TicketTest.php</strong><br />
Para correr las pruebas del sitio, se debe emplear el comando <strong>php artisan test</strong>
<br /><br />
Gracias por su atención y tiempo.