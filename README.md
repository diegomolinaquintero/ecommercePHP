<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p> -->

<!-- <p align="center"> -->
<!-- <a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p> -->

## Como iniciar
*debes tener instalado Composer y npm
Usa la terminal de VS Code para no perder tiempo
- Clonar el repositorio de git
- Composer require facade/ignition
- sudo apt-get install php7.4-curl
- Composer install
- Reivas si eciste el archivo llamdo .env de lo contrario
    -cp .env.example .env
- php artisan key:generate
    -vamos configurar la base de datos postgres si usas linux habilita en el php.ini el modulo de postgres
        - revisa el .env y escribe estos valores (crea una base de datos llamada MVCTarea y un super usuario llamado igual con password 123)
        DB_CONNECTION=pgsql
        DB_HOST=127.0.0.1
        DB_PORT=5432
        DB_DATABASE=MVCTarea
        DB_USERNAME=MVCTarea
        DB_PASSWORD=123

- php artisan cache:clear && php artisan view:clear && php artisan migrate:refresh --seed
- luego ejecuta en postgres el archivo sqlPostgres.sql para ingresar los datos iniciales
- Si no deseas usar link simbolico 
    -php artisan serve
- disfruta del uso web de la aplicacion.

## Usar la Api

Debes tener tiendas, vendedores y productos registrados. hacer esto se hace de forma facil:
    -Ingresa http://127.0.0.1:8000/  (varia segun tus preferencias en el compu)
    - Ingresa con el usuario admin@admin.com con contrase;a 123456789
        -con el admin crea tiendas y usuarios
    - Ingresa con un usuario creado anteriormente, diferente a admin
        -crea productos con este usuario intenta crear varios
        - si tienes tiempo crea productos con los otros usuaios
Luego de tener todo registrado podemos usar postman o mi favorito Thunder client para vs code

prueba que te funsiona escribiendo:
    -http://127.0.0.1:8000/api/product con metodo get

SI esto te funciona es hora de mandar un post:

    ~~~
    {
        "email": "pepito@pepito.com",
        "producto" : [
            {
                "product_id": 1,
                "cantidad": 100
            },
            {
                "product_id": 2,
                "cantidad": 200
            }
        ]
    }
    ~~~
Para mandar ese JSON la url en metodo post es http://127.0.0.1:8000/api/order

## C'omo se crea un pedido

Se agregan dos tablas una llamada pedidos donde se guarda el email con un id y fecha de cada pedido.
tambien se agrega una tabla llamada pedidos_productos donde se relacion el pedido con el producto la cantidad.

Asi podemos tener un registro historico de los pedidos.

La ruta post http://127.0.0.1:8000/api/order nos envia al controlador Api donde creamos toda la logica necesaria



## Contributing

Si alguien quiere descargar es totalmente libre puede modifcar y escribir para poder hacer realese

## Code of Conduct

Descargalo y usalo, esto es educativo, me sirve para practicar y espero que para ti tambien.      



## License

Este ecommers is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
