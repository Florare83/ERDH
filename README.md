# El Rincón de Hermes — Sitio Web

Maquetación web del club y tienda de juegos de mesa **El Rincón de Hermes**, desarrollada a partir de los wireframes y el mockup diseñados en Figma en los trabajos prácticos anteriores.

## 🔗 Enlaces

- **Sitio desplegado: https://github.com/Florare83/clubjuegosdemesa 
- **Diseño en Figma: https://www.figma.com/design/hipG4LOssrktKAuL9P4VDI/ERDH?node-id=16-458&t=eVWlSxP531yBRfNM-1

## 🛠️ Tecnologías utilizadas

- **HTML5** — estructura semántica de las 12 vistas
- **CSS3** — estilos personalizados (`css/estilos.css`)
- **Bootstrap 5.3** (vía CDN) — sistema de grillas, navbar, acordeón y componentes base
- **Prettier** — formateo automático de código
- **Lighthouse (Chrome DevTools)** — auditoría de accesibilidad y rendimiento

## 📁 Estructura del proyecto

```
mi-sitio-juegos/
├── css/
│   └── estilos.css
├── js/
│   └── main.js
├── img/
├── docs/
│   └── auditoria-lighthouse.md
├── index.html
├── club.html
├── tienda.html
├── prestamo-infantil.html
├── prestamo-familiar.html
├── prestamo-experto.html
├── venta-infantil.html
├── venta-familiar.html
├── venta-experto.html
├── eventos.html
├── faq.html
├── contacto.html
└── README.md
```

## 📄 Vistas incluidas (12)

| # | Vista | Archivo |
|---|-------|---------|
| 1 | Nosotros (Home) | `index.html` |
| 2 | Club | `club.html` |
| 3 | Juegos en Préstamo — Infantil | `prestamo-infantil.html` |
| 4 | Juegos en Préstamo — Familiar | `prestamo-familiar.html` |
| 5 | Juegos en Préstamo — Experto | `prestamo-experto.html` |
| 6 | Tienda | `tienda.html` |
| 7 | Juegos a la Venta — Infantil | `venta-infantil.html` |
| 8 | Juegos a la Venta — Familiar | `venta-familiar.html` |
| 9 | Juegos a la Venta — Experto | `venta-experto.html` |
| 10 | Eventos | `eventos.html` |
| 11 | Preguntas Frecuentes | `faq.html` |
| 12 | Contacto | `contacto.html` |

## ♿ Accesibilidad

- Imágenes (placeholders y futuras fotos) con texto alternativo descriptivo.
- Navegación por teclado con foco visible (`:focus-visible`).
- Un único `<h1>` semántico por página.
- Componentes interactivos (acordeón, formulario) con atributos ARIA correspondientes.
- Auditoría completa documentada en [`docs/auditoria-lighthouse.md`](./docs/auditoria-lighthouse.md).

## 🚀 Cómo ver el sitio localmente

No requiere instalación ni build: al ser HTML/CSS/JS estático, alcanza con abrir `index.html` en el navegador, o servirlo con cualquier servidor estático, por ejemplo:

```bash
npx serve .
```

## 🌳 Flujo de trabajo con Git

Este proyecto siguió el siguiente flujo:

1. `git init` + estructura de carpetas (`css/`, `js/`, `img/`)
2. Rama de trabajo: `git checkout -b feature/maquetacion`
3. Maquetación de las 12 vistas en HTML5 + Bootstrap
4. Formateo con Prettier + auditoría de Lighthouse (documentada en `/docs`)
5. `git push origin feature/maquetacion` + Pull Request hacia `main`
6. Revisión y Merge del Pull Request
7. Despliegue estático en GitHub Pages

## 👤 Autor

Lidia Florencia Areco
