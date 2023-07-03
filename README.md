Guia de despliegue

Programas previamente instalados y necesarios
Xampp - PHP => v8.
Laravel => v10.
Composer.
React => v18.

Comenzaremos por abrir la consola (CMD en windows) y ejecutar el siguiente comando  cd C:\xampp\htdocs y crearemos una carpeta llamada my-store-test (md my-store-test).
Ahora colocaremos los repositorios correspondientes
git clone https://github.com/DanielBorussia/front-my-store.git
git clone https://github.com/DanielBorussia/back-my-store.git
Deberá quedar las siguientes carpetas:
📁 my-store-test.
📁  front-my-store
📁  back-my-store

Entramos a la carpeta de front-my-store (cd front-my-store) y ejecutamos el comando (npm install) el cual descargara todas las dependencias para el front.
Repetimos el paso anterior con el back-my-store (cd back-my-store) y ejecutamos el comando (composer install) para instalar los paquetes de laravel para el back.

Base de datos
Tener activo el servidor de Mysql (Xampp Panel). Luego abrimos un gestor de base de datos  y nos conectamos al servidor con los siguientes datos:
Port : 3306
Username: root
Password: 
host : 127.0.0.1 ó localhost
Ahora crearemos la base de datos con el nombre : “store” y luego importamos el archivo DB_my-store-test.sql (se encuentra anexo al documento) que contiene las tablas necesarias.

Despliegue del front
Entraremos ahora a la carpeta del front (cd front-my-store) y ejecutaremos el comando npm start para dar inicio al despliegue del proyecto después de unos segundos se abre una nueva pestaña con la ruta http://localhost:3000/


