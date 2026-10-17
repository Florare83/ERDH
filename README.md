# Descripción
Aplicación web para el club y tienda de juegos de mesa El Rincón de Hermes, desarrollada a partir de los wireframes y el mockup diseñados en Figma en trabajos prácticos anteriores.

El proyecto fue refactorizado de páginas HTML independientes a una estructura basada en PHP, incorporando plantillas reutilizables mediante header.php, nav.php y footer.php, navegación dinámica y configuración mediante variables de entorno.

## Enlaces
Repositorio: https://github.com/Florare83/ERDH
Wireframes y Mockups en Figma: https://www.figma.com/design/hipG4LOssrktKAuL9P4VDI/ERDH?node-id=16-458&t=eVWlSxP531yBRfNM-1

## Tecnologías utilizadas
- HTML5 — estructura semántica de las vistas.
- CSS3 — estilos personalizados mediante estilos css.
- Bootstrap 5.3 — sistema de grillas, navegación y componentes.
- JavaScript — funcionalidades e interacción del sitio.
- PHP 8.x — refactorización de las páginas y generación de contenido dinámico.
- XAMPP — servidor local utilizado para ejecutar Apache y PHP.
- Prettier — formateo automático del código.
- Lighthouse (Chrome DevTools) — auditoría de accesibilidad.

## Refactorización a PHP
Durante la refactorización se reemplazaron las páginas HTML por archivos PHP.
Se implementó una estructura modular mediante plantillas reutilizables:
includes/
├── header.php
├── nav.php
└── footer.php
Las páginas principales reutilizan estas plantillas mediante require_once, evitando repetir el código del encabezado, menú de navegación y pie de página.
También se implementó navegación dinámica mediante la variable $pagina_actual, que permite determinar qué sección del menú debe mostrarse como activa.
Además, el título de cada página se establece mediante la variable $titulo_pagina.

## Variables de entorno
El proyecto utiliza un archivo .env para almacenar valores de configuración.
Las variables utilizadas son:
APP_NAME="El Rincón de Hermes"
APP_EMAIL="email@ejemplo.com"
APP_ENV=local
El archivo .env no se incluye en el repositorio y está excluido mediante .gitignore.
Para indicar las variables necesarias para ejecutar el proyecto se incluye el archivo:
.env.example
La configuración es cargada desde:
config/
└── env.php
La carpeta node_modules/ no se incluye en el repositorio porque sus dependencias pueden instalarse nuevamente mediante npm.

## Instalación y ejecución local
1. Clonar el repositorio
git clone https://github.com/Florare83/ERDH.git
2. Colocar el proyecto en XAMPP
Copiar o clonar el proyecto dentro de la carpeta:
C:\xampp\htdocs\
3. Crear archivo .env
Copiar .env.example y crear un archivo .env
Configurar las variables correspondientes:
APP_NAME="El Rincón de Hermes"
APP_EMAIL="email@ejemplo.com"
APP_ENV=local
4. Iniciar XAMPP
Abrir el panel de XAMPP e iniciar:
Apache
5. Abrir el proyecto
Ingresar desde el navegador a:
http://localhost/ERDH/clase5/index.php

## Servidor local ejecutándose
![Servidor](clase5/img/servidor_local.png)

## Estructura Modular (SSI):
Utilización de las plantillas PHP reutilizables:
header.php
nav.php
footer.php
![SSI](clase5/img/ssi.png)

## Navegación dinámica
Las páginas utilizan un título dinámico mediante $titulo_pagina y determinan la sección activa del menú mediante $pagina_actual.
![Navegacion1](clase5/img/navegacion_club.png)
![Navegacion2](clase5/img/navegacion_juegos.png)

## Configuración de variables de entorno
El archivo .env.example contiene las variables necesarias para la configuración del proyecto.
![env](clase5/img/env.png)

## Resultado de la prueba de accesibilidad
![Accesibilidad](clase5/img/accesibilidad.png)

## Estructura
![Estructura](clase5/img/estructura.png)

## Clase 5 – Procesamiento de Formularios y Seguridad Web

### Formulario POST – Contacto (`contacto.php`)
Formulario con nombre, correo y mensaje. Valida en servidor que los campos
no estén vacíos y que el correo tenga formato válido. Sanitiza con
`trim()` y `htmlspecialchars()`. Ante errores conserva los datos ingresados.

### Formulario GET – Buscador (`buscar.php`)
Módulo de búsqueda que recibe el término por `$_GET['q']`, lo sanitiza,
valida que no esté vacío y muestra los resultados coincidentes.

### Seguridad
Todas las variables de `$_POST` y `$_GET` se sanitizan con la función
`limpiar()` (`includes/funciones.php`) para prevenir XSS.

### Capturas

**1. Contacto vacío: errores de validación**

![Contacto vacío, aparecen los errores](clase5/img/error_validacion.png)

**2. Correo inválido: error de formato y campos conservados**

![Correo abc, error de formato y los campos se conservan](clase5/img/validacion_correo.png)

**3. Envío correcto**

![Envío correcto](clase5/img/envio_correcto.png)

**4. XSS en contacto**

![XSS en contacto](clase5/img/xss.png)

**5. Búsqueda por GET**

![Búsqueda catan](clase5/img/busqueda_get.png)

**6. Búsqueda vacía**

![Búsqueda vacía](clase5/img/busqueda_vacia.png)

**7. XSS en el buscador**

![XSS en el buscador](clase5/img/busqueda_xss.png)