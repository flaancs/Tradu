# Tradu
* Control de cuentas de usuarios: 100% <br>
* Opciones : 100% <br>
* Menú : 100% <br>
* Juego : 100% <br>
* Panel de administracion : 100% <br>


+---------htaccess--------+<br>
Por alguna razón github lo omite, asi que ruego crear el archivo .htaccess con el siguiente contenido <3<br>
<br>
Options -Indexes<br>
RewriteEngine on    <br>
RewriteRule ^profile/(.*)$ profile.php?user=$1<br>
RewriteRule ^panel/(.*)$ panel.php?action=$1<br>
RewriteCond %{REQUEST_FILENAME} !-d<br>
RewriteCond %{REQUEST_FILENAME} !-f<br>
RewriteRule ^(.*)$ $1.php<br>
