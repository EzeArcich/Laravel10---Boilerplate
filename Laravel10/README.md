//Para el contenedor de PostgreSQL
apt-get update
apt-get install -y procps


//Instalar proyecto Laravel version 10
composer create-project --prefer-dist laravel/laravel:^10.0 nombre_proyecto
Esto instalará Laravel 10 en un directorio llamado nombre_proyecto dentro del contenedor.

//Preguntar para que era
composer require --dev predis/predis

//Supuestamente me deja acceder a los archivos desde VSC
docker run -v /ruta/local/a/tu/proyecto:/var/www/html/nombre_proyecto -p 8080:80 -it nombre_de_tu_imagen_php:tag

//Para obtener el id del contenedor que corre la DDBB de PostgreSQL y ponerlo en el campo DB_HOST del .env
docker inspect -f '{{.Name}} - {{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $(docker ps -aq)

Contraseña de DB spyciTool2023!

Esto es necesario para los permisos, sino tira errores de log:

Luego de clonar el repositorio:

//Para otorgar los permisos necesarios, dentro del contenedor de la app ejecutar:
chmod -R 775 /var/www/html/SpyciTool/storage
chown -R www-data:www-data /var/www/html/SpyciTool/storage

//Instalar git en el contenedor
apt-get update
apt-get install git

//Desde dentro del contenedor de Laravel, instalar composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"

// Instalar Laravel Passport, correr sus migracionese instalar las claves de cliente de Passport
composer require laravel/passport
php artisan migrate
php artisan passport:install

// Instalar Spatie Laravel Permission (Para asignar roles y permisos), y correr sus migraciones
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate

//Instalar Paquete para JWT y publicarlo
composer require tymon/jwt-auth
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"






