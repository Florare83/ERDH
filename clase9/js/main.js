// El Rincón de Hermes — lógica del sitio
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formBusqueda');
    const input = document.getElementById('inputBusqueda');
    const contenedor = document.getElementById('resultados');
    const estado = document.getElementById('estadoBusqueda');

    // Este script se carga en todas las páginas: si no es el buscador, no hace nada
    if (!form || !input || !contenedor) return;

    const API_URL = contenedor.dataset.api;
    let controlador = null;   // para cancelar la petición anterior
    let temporizador = null;  // para el debounce

    // ---------- Petición ----------
    async function buscar(q) {
        if (controlador) controlador.abort();
        controlador = new AbortController();
        estado.textContent = 'Buscando…';

        try {
            const response = await fetch(`${API_URL}?q=${encodeURIComponent(q)}`, {
                signal: controlador.signal,
                headers: { Accept: 'application/json' },
            });

            // Los errores 400/500 también traen JSON con un mensaje útil
            let res = null;
            try { res = await response.json(); } catch { /* respuesta no-JSON */ }

            if (!response.ok || !res || res.status !== 'success') {
                throw new Error(res?.message ?? `Error HTTP: ${response.status}`);
            }

            renderizar(res.data);
            estado.textContent = res.total === 0
                ? 'No se encontraron juegos.'
                : `${res.total} juego(s) encontrado(s).`;

        } catch (error) {
            if (error.name === 'AbortError') return; // fue cancelada a propósito
            contenedor.replaceChildren();
            estado.textContent = error instanceof TypeError
                ? 'No hay conexión con el servidor.'
                : error.message;
            console.error('Error al realizar la petición:', error);
        }
    }

    // ---------- DOM ----------
    // Se usa textContent (no innerHTML): si un título tuviera <script> o HTML,
    // se muestra como texto y no se ejecuta (protección XSS, como en la clase 7).
    function crear(tag, clase, texto) {
        const nodo = document.createElement(tag);
        if (clase) nodo.className = clase;
        if (texto !== undefined) nodo.textContent = texto;
        return nodo;
    }

    function crearMeta(j) {
        const ul = crear('ul', 'game-card-meta');
        [
            ['Jugadores', `${j.jugadores_min}-${j.jugadores_max}`],
            ['Duración', `${j.duracion_min}-${j.duracion_max} min`],
            ['Edad', `${j.edad_minima}+`],
        ].forEach(([etiqueta, valor]) => {
            const li = crear('li');
            li.append(crear('span', null, etiqueta), crear('span', null, valor));
            ul.appendChild(li);
        });
        return ul;
    }

    function renderizar(juegos) {
        contenedor.replaceChildren();

        juegos.forEach((j) => {
            const col = crear('div', 'col-md-4');
            col.setAttribute('role', 'listitem');

            const card = crear('article', 'game-card');
            const caja = crear('div', 'img-placeholder');
            if (j.imagen) {
                const img = crear('img');
                img.src = j.imagen;
                img.alt = `Portada de ${j.titulo}`;
                caja.appendChild(img);
            }

            const cuerpo = crear('div', 'game-card-body');
            cuerpo.append(
                crear('h3', null, j.titulo),
                crear('p', 'editorial', j.editorial),
                crearMeta(j),
                crear('p', 'game-card-precio', '$' + Number(j.precio).toLocaleString('es-AR'))
            );

            card.append(caja, cuerpo);
            col.appendChild(card);
            contenedor.appendChild(col);
        });
    }

    // ---------- Eventos ----------
    function iniciar(q) {
        if (q.length === 1) { // evitamos pedirle al servidor algo que va a rechazar
            if (controlador) controlador.abort();
            contenedor.replaceChildren();
            estado.textContent = 'Escribí al menos 2 caracteres.';
            return;
        }
        buscar(q);
    }

    input.addEventListener('input', () => {
        clearTimeout(temporizador);
        temporizador = setTimeout(() => iniciar(input.value.trim()), 300); // debounce
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();               // sin recarga de página
        clearTimeout(temporizador);
        iniciar(input.value.trim());
    });

    buscar(''); // carga inicial: lista de juegos sin que el usuario haga nada
});