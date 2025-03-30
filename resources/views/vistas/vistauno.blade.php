<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Créditos</title>
</head>
<body>
    <h1>Simulador de Crédito</h1>
    
    <form action="{{ route('calcular.intereses') }}" method="post">
        @csrf

        <div>
            <label for="monto">Monto del crédito ($):</label>
            <input type="number" step="0.01" id="monto" name="monto" value="{{ old('monto') }}" required>
            @error('monto') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="tasa">Tasa de interés mensual (%):</label>
            <input type="number" step="0.01" id="tasa" name="tasa" value="{{ old('tasa', 1.78) }}" required>
            @error('tasa') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="meses">Plazo en meses:</label>
            <input type="number" id="meses" name="meses" value="{{ old('meses') }}" required>
            @error('meses') <div>{{ $message }}</div> @enderror
        </div>

        <div>
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            @error('fecha_nacimiento') <div>{{ $message }}</div> @enderror
        </div>

        <button type="submit">Calcular</button>
    </form>

    @if(isset($cuota))
        <h2>Resultados del Crédito</h2>
        <p><strong>Monto solicitado:</strong> ${{ number_format($monto, 2) }}</p>
        <p><strong>Tasa mensual:</strong> {{ $tasa }}%</p>
        <p><strong>Plazo:</strong> {{ $meses }} meses</p>
        <p><strong>Edad:</strong> {{ $edad }} años</p>
        <p><strong>Cuota mensual estimada:</strong> ${{ number_format($cuota, 2) }}</p>

        <h3>Proyección</h3>
        <table border="1">
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Saldo</th>
                    <th>Interés</th>
                    <th>Capital</th>
                    <th>Cuota</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tablaAmortizacion as $fila)
                <tr>
                    <td>{{ $fila['mes'] }}</td>
                    <td>${{ number_format($fila['saldo'], 2) }}</td>
                    <td>${{ number_format($fila['interes'], 2) }}</td>
                    <td>${{ number_format($fila['capital'], 2) }}</td>
                    <td>${{ number_format($fila['cuota'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>