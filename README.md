## [Agenda Symfony](https://www.github.com/Hugo-Perez/Symfony-contacts)
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
Desde la página principal podremos acceder a los 3 tipos de agenda que tenemos: normal, profesional y general (ambas).

En la barra de navegación tenemos dos enlaces desde los que podremos acceder a la página principal o crear un nuevo contacto.

En el apartado de agenda podremos ver una tabla con todos nuestros contactos, mostrando únicamente su información básica y sus controles. Estos controles nos sirven para ver nuestro contacto en detalle, editarlo, o eliminarlo.

## Datos guardados
En esta aplicación podremos guardar los siguientes datos de nuetros contactos:

| Campo:      | Id   | Nombre | Apellidos | Telefono          | Email         | Tipo         | Notas |
|-------------|------|--------|-----------|-------------------|---------------|--------------|-------|
| Formato:    | Int  | String | String    | String (Telephone)| String (Email)| String (Enum)| Text  |
| Necesario?  | ✅   | ✅     | ✅       | ✅                | ❌            | ✅           | ❌    |


## Ejemplo de código

```php
 /**
 * @Route("/list/{type}", 
 * name="list")
 */
public function list(Request $request, $type): Response
{
    // Devolvemos una lista de contactos filtrando por el tipo de los mismos
    // y guardamos el tipo escogido como variable de sesión.
    if ($type == "general") {
        $contacts = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->findAll();
    } else {
        $croppedType = substr($type, 0, 3);

        $contacts = $this->getDoctrine()
        ->getRepository(Contact::class)
        ->findBy(['type' => $croppedType]);
    }
    $session = $request->getSession();
    $session->set("lastType", $type);
    return $this->render('Contact/list.html.twig', [
        'type' => $type,
        'list' => $contacts
    ]);
}
```

## Licencia y contacto
- *Licencia: [GNU GPL v3](http://www.gnu.org/licenses/gpl-3.0.html)*
- *Autor: [Hugo Pérez Candal](https://www.github.com/Hugo-Perez)*
- *Email: [hugoperez.contacto@gmail.com](mailto:hugoperez.contacto@gmail.com)*

Si deseas contribuir con este proyecto contacta conmigo vía Github o Email.