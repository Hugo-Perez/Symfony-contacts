## Agenda Symfony
Este proyecto consiste en una agenda web en la que podemos ver, crear nuestros contactos.

Está basado en las tecnologías Symfony, SQLite y Twig.

## Instalación y ejecución
Para ejecutar el proyecto necesitamos tener instalado en nuestro ordenador el framework [Symfony](https://symfony.com/download) y el gestor de paquetes [Composer](https://getcomposer.org/download/).

Además, debemos ejecutar los comandos necesarios para que Symfony nos cree la base de datos del programa.
> $ php bin/console doctrine:database:create

> $ php bin/console make:migration

> $ php bin/console doctrine:migrations:migrate

Por último debemos comprobar que nuestro proyecto cuenta con sus dependencias. 
En caso de que falten podemos instalarlas usando el siguiente comando: 
> $ composer install

**Una vez tenemos todo instalado y listo para ejecutar podemos lanzar la aplicación con el comando:**
> $ symfony serve

## Uso del programa
Desde la página principal podremos acceder a los 3 tipos de agenda que tenemos: normal, profesional y general(ambas).

En la barra de navegación tenemos dos enlaces desde los que podremos acceder a la página principal o crear un nuevo contacto.

En el apartado de agenda podremos ver una tabla con todos nuestros contactos, mostrando únicamente su información básica y sus controles. Estos controles nos sirven para ver nuestro contacto en detalle, editarlo, o eliminarlo.
