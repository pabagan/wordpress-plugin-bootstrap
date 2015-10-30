# Geniux Blank plugin

Clase con la estructura básica para plugin de Wordpress en `/geniux-blank.php`. 


Está preparado para que Nodejs, Grunt y Bower hagan su magia entre los directorios `/assets` y `/src`. Debemos tener instalado:

* [Node.js](nodejs.org/en/)
* [Grunt](gruntjs.com/)
* [Bower](nodejs.org/en/)

Para usar Livereload hay que descargar [extensión de navegador](http://livereload.com/extensions/).

## Rock and Roll
```bash
# Acceder a carpeta de plugins
cd www/wordpress/wp-content/plugins

# Clonar repositorio
git clone https://github.com/pabagan/wp-blank-plugin.git

# Acceder a carpeta
cd wp-blank-plugin

# Instalar módulos de node
npm install

# Iniciar Grunt watch
grunt watch
```

Trabajar sobre el directorio `/src` y automáticamente generara archivos js y css a `/assets`.

