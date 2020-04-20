Guía de instalación
==================

1. Instalar composer de php. Detalles en https://getcomposer.org/download/
2. Ejecutar composer install en la base del directorio, de los archivos que adjunto.
3. Configurar apache para que la carpeta root del dominio configurado sea la htdocs que está en la raíz de los archivos enviados.
4. Modificar el archivo .env que está en la raíz del directorio enviado, en este están los datos de la base de datos y el dominio provisorio o final. Las opciones a modificar de ese archivos son:
	a. APP_URL: URL del sitio.
	b. WP_URL= URL donde está el wordpress, debería ser la misma de arriba pero agregando cms al final, vienen unas seteadas puede tomar de base esa.
	c. DATABASE_NAME: nombre base de datos.
	d. DATABASE_USER: usuario de la base de datos
	e. DATABASE_PASSWORD: contraseña de la base de datos
	f. DATABASE_HOST: IP del servidor de base de datos, si es local sería localhost o 127.0.01.
5. Ejecutar el script sql que va en el archivo que adjunto sobre la base de datos.
6. Instalar los siguientes plugins en htdocs/content/plugins:
	a. advanced-custom-fields-pro
	b. classic-editor
	c. custom-post-type-ui
	d. mailgun
7. Modificar el archivo .htaccess del directorio htdocs, va con el ejemplo de la URL utilizada en el archivo .env

Una ves que todos estos pasos estén completados y este la aplicación funcionando se debe ejecutar el comando [php console command:loadData] en la raíz del proyecto.



Themosis framework
==================

[![Build Status](https://travis-ci.org/themosis/themosis.svg?branch=dev)](https://travis-ci.org/themosis/themosis)

The Themosis framework is a tool aimed to WordPress developers of any levels. But the better WordPress and PHP knowledge you have the easier it is to work with.

Themosis framework is a tool to help you develop websites and web applications faster using [WordPress](https://wordpress.org). Using an elegant and simple code syntax, Themosis framework helps you structure and organize your code and allows you to better manage and scale your WordPress websites and applications.

Development team
----------------
The framework was created by [Julien Lambé](https://www.themosis.com/), who continues to lead the development.

Contributing
------------
Any help is appreciated. The project is open-source and we encourage you to participate. You can contribute to the project in multiple ways by:

- Reporting a bug issue
- Suggesting features
- Sending a pull request with code fix or feature
- Following the project on [GitHub](https://github.com/themosis)
- Following us on Twitter: [@Themosis](https://twitter.com/Themosis)
- Sharing the project around your community

For details about contributing to the framework, please check the [contribution guide](https://framework.themosis.com/docs/1.3/contributing).

License
-------
The Themosis framework is open-source software licensed under [GPL-2+ license](http://www.gnu.org/licenses/gpl-2.0.html).