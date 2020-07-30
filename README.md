<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Instalación

- git clone https://github.com/ogarciasantacruz/peliculas.git
- composer install
- configurar la conexión a BD en .env
- php artisan migrate
- php artisan db:seed
- php artisan key:generate

El sistema cuenta con roles y pérmisos, hay 2 tipos de rol de usuario que son administrador y cliente.
El rol de administrador puede registrar y editar generos y películas además de poder visualizar a la lista de usuarios registrados y sus películas favoritas.
También puede registrar sus propias películas favoritas.

Para ingresar con un perfil de administrador se puede ingresar con los siguientes datos de acceso:

Usuario: admin@demo.com
Contraseña: abcd1234

El rol de cliente solo puede registrar sus películas favoritas.
Para ingresar con un perfil de cliente se puede ingresar registrandose en el sitio o con los siguientes datos de acceso:

Usuario: user@demo.com
Contraseña: abcd1234




