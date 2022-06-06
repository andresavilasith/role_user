<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# Laravel 9 Sistema de roles y permisos
# PHP version 8.0.1

- Para que funcione correctamente deberias tener instalado PHP 8.0.1 

## Cambiar la version de php del proyecto
>Se puede entrar en el archivo composer.json y escribir su version de php que tiene que ser superior o igual a 7.3.0 y reemplazar a la version 8.0.1
```php
   "require": {
        "php": "^7.3.0",
    },
```


- Basado en el sistema de roles y permisos de [Jhonatan David Fernandez Rosa(You Tube)](https://www.youtube.com/playlist?list=PLtg6DxcGyHSvB6xvQbacVfL83UoFEvOGz)

### Mejoras implementadas:

- [x] TDD(Feature test driven development) [Tutorial de Alfredo Mendoza](https://youtu.be/_GwqxAi_ly0)
- [x] Uso de la plantilla [Adminlte](https://github.com/ColorlibHQ/AdminLTE/releases/tag/v3.0.5) - Datatables.js
- [x] Creación de tabla categories (Base de datos) para mejor organización de permisos
- [x] Uso de nav tabs para asignación, vista y modificación de permisos(Gestión de roles) - [Bootstrap](https://getbootstrap.com/docs/4.5/components/navs/)
- [x] Validación de datos mediante Request en formularios

## Instalacion  
1. Instalar [Wamp(Solo Windows)](https://www.wampserver.com/en/) , [Xampp](https://www.apachefriends.org/es/index.html) u otro segun su preferencia 
2. Instalar composer [Descargar composer](https://getcomposer.org/download/)
3. Clonar el repositorio en el directorio de tu eleccion
```
git clone https://github.com/andresaviladw/role_user.git
```
4. Instalar composer  
```
composer install
```
5. Cambiar el nombre del archivo **.env.example** _(Si esta como **env.example**)_ a **.env**
6. Crear una base de datos en phpMyAdmin y configurar el archivo .env

```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1   
   DB_PORT=3306
   DB_DATABASE=Nombre de Base De Datos Creada En phpMyAdmin
   DB_USERNAME=Nombre de Usuario en phpMyAdmin
   DB_PASSWORD=Contraseña en phpMyAdmin
   
   ```
#### En mi caso es:
```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306    
   DB_DATABASE=inven 
   DB_USERNAME=root    
   DB_PASSWORD=
 ```
7. Generar una nueva llave de laravel con el comando:
```
php artisan key:generate
```
8. Ejecutar migraciones con el siguiente comando: 
```
php artisan migrate
```
9. Ejecutar seeder para alimentar la base de datos con el comando:
```
php artisan db:seed --class=RoleUserSeeder
```
10. Ejecutar el proyecto: 
```
php artisan serve
```

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
	
