<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos — El Rincón de Hermes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<main class="container py-5">
    <h1 class="h3 mb-4">Próximos eventos</h1>

    <div class="row g-4">
        @forelse ($eventos as $evento)
            <div class="col-md-6">
                <div class="card h-100 shadow-sm">
                    @if ($evento->imagen)
                        <img src="{{ asset($evento->imagen) }}" class="card-img-top" alt="{{ $evento->titulo }}">
                    @endif
                    <div class="card-body">
                        <h2 class="h5 card-title">{{ $evento->titulo }}</h2>
                        <p class="card-text">{{ $evento->descripcion }}</p>
                        <ul class="list-unstyled mb-0 small">
                            <li><strong>Fecha:</strong> {{ $evento->fecha->format('d/m/Y') }}</li>
                            <li><strong>Horario:</strong>
                                {{ substr($evento->hora_inicio, 0, 5) }} a {{ substr($evento->hora_fin, 0, 5) }} hs
                            </li>
                            <li><strong>Lugar:</strong> {{ $evento->lugar }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No hay eventos cargados.</p>
        @endforelse
    </div>

    <p class="mt-4"><a href="/api/eventos">Ver en formato JSON</a></p>
</main>
</body>
</html>