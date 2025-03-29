<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Intereses</title>
</head>
<body>
    <form action="{{ route('calcular.intereses') }}" method="post">
        @csrf

        <ul>
            <li>
                <label for="monto">Monto:</label>
                <input type="text" id="monto" name="monto" required>
            </li>
            <li>
                <label for="meses">¿A cuántos meses?</label>
                <input type="number" id="meses" name="meses" required>
            </li>
            <li>
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </li>
        </ul>
        <input type="submit" value="Simular">
    </form>

    @if(isset($cuota))
        <h2>Resultados:</h2>
        <p>Monto solicitado: ${{ number_format($monto, 2) }}</p>
        <p>Plazo: {{ $meses }} meses</p>
        <p>Edad: {{ $edad }} años</p>
        <p>Cuota mensual: ${{ number_format($cuota, 2) }}</p>
    @endif
</body>
</html>
