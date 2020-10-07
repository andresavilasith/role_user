# Laravel 7 Sistema de roles y permisos

>Basado en el sistema de roles y permisos de [Jhonatan David Fernandez Rosa(You Tube)](https://www.youtube.com/playlist?list=PLtg6DxcGyHSvB6xvQbacVfL83UoFEvOGz)

### Mejoras implementadas:

- [x] TDD(Feature test driven development)
- [x] Uso de la plantilla [Adminlte](https://github.com/ColorlibHQ/AdminLTE/releases/tag/v3.0.5) - Datatables.js
- [x] Creación de tabla categories (Base de datos) para mejor organización de permisos
- [x] Uso de nav tabs para asignación, vista y modificación de permisos(Gestión de roles)

## Instalacion  
1. Instalar [Wamp(Solo Windows)](https://www.wampserver.com/en/) , [Xampp](https://www.apachefriends.org/es/index.html) u otro segun su preferencia 
2. Instalar composer [Descargar composer](https://getcomposer.org/download/)
3. Clonar el repositorio en el directorio de tu eleccion
>git clone https://github.com/andres6266/role_user
4. Instalar composer  
>composer install 
5. Cambiar el nombre del archivo **.env.example** a **.env**
7. Crear una base de datos en phpMyAdmin y configurar el archivo .env 
   * DB_CONNECTION=mysql
   * DB_HOST=127.0.0.1   
   * DB_PORT=3306
   * DB_DATABASE=Nombre de Base De Datos Creada En phpMyAdmin
   * DB_USERNAME=Nombre de Usuario en phpMyAdmin
   * DB_PASSWORD=Contraseña en phpMyAdmin
#### En mi caso es:

   * DB_CONNECTION=mysql
   * DB_HOST=127.0.0.1
   * DB_PORT=3306    
   * DB_DATABASE=inven 
   * DB_USERNAME=root    
   * DB_PASSWORD=
7. Generar una nueva llave de laravel con el comando:
>php artisan key:generate

8. Ejecutar migraciones con el siguiente comando: 
>php artisan migrate

9. Ejecutar seeder para alimentar la base de datos con el comando:

>php artisan db:seed --class=RoleUserSeeder

10. Ejecutar el proyecto: 
>php artisan serve

11. Entrar a [http://127.0.0.1:8000](http://127.0.0.1:8000) para ingresar al proyecto hacer click en login y entrar con:
	```php
    E-Mail Address: admin@admin.com
    ```
    ```php
    Password: 1234 
    ```
12. Comandos para verificacion de test
	```php
	php artisan test
	```
	
	```php
	php vendor/phpunit/phpunit/phpunit
	```
	
