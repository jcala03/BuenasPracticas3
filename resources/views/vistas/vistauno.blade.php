<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Créditos</title>
    
    
    
    
    <!-- Incluir Bootstrap CSS desde CDN -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h1>Simulador de Crédito</h1>
    
    <form action="{{ route('calcular.intereses') }}" method="post">
        @csrf

        <div>
            <label for="monto">Monto del crédito ($):</label>
            <input type="number" step="0.01" id="monto" name="monto" value="{{ old('monto') }}" required>
            @error('monto') <div>{{ $message }}</div> @enderror
            <p>

            </p>



        </div>

        <div>
            <label for="tasa">Tasa de interés mensual (%):</label>
            <input type="number" step="0.01" id="tasa" name="tasa" value="{{ old('tasa', 1.78) }}" required>
            @error('tasa') <div>{{ $message }}</div> @enderror
        </div>
        <p>

        </p>

        <div>
            <label for="meses">Plazo en meses:</label>
            <input type="number" id="meses" name="meses" value="{{ old('meses') }}" required>
            @error('meses') <div>{{ $message }}</div> @enderror
        </div>
        <p>

        </p>

        <div>
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
            @error('fecha_nacimiento') <div>{{ $message }}</div> @enderror
        </div>
        <p>

        </p>

        <button type="submit">Calcular</button>
        <p>

        </p>
    </form>

    @if(isset($cuota))
        <h2>Resultados del Crédito</h2>
        <p><strong>Monto solicitado:</strong> ${{ number_format($monto, 2) }}</p>
        <p><strong>Tasa mensual:</strong> {{ $tasa }}%</p>
        <p><strong>Plazo:</strong> {{ $meses }} meses</p>
        <p><strong>Edad:</strong> {{ $edad }} años</p>
        <p><strong>Cuota mensual estimada:</strong> ${{ number_format($cuota, 2) }}</p>

        <div class="mt-4">
            <h3 class="mb-3 text-primary">Proyección de Pagos</h3>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped rounded shadow-sm">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th scope="col" class="bg-info text-white">Mes</th>
                            <th scope="col">Saldo</th>
                            <th scope="col">Interés</th>
                            <th scope="col">Capital</th>
                            <th scope="col" class="bg-success text-white">Cuota</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tablaAmortizacion as $fila)
                        <tr class="text-center {{ $fila['mes'] % 2 == 0 ? 'table-light' : '' }}">
                            <td class="fw-bold bg-info text-white">{{ $fila['mes'] }}</td>
                            <td class="text-danger">${{ number_format($fila['saldo'], 2) }}</td>
                            <td class="text-muted">${{ number_format($fila['interes'], 2) }}</td>
                            <td class="text-primary">${{ number_format($fila['capital'], 2) }}</td>
                            <td class="fw-bold bg-success text-white">${{ number_format($fila['cuota'], 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-dark">
                        <tr class="text-center">
                            <th colspan="3">Total pagado:</th>
                            <th colspan="2">${{ number_format($tablaAmortizacion[0]['cuota'] * count($tablaAmortizacion), 2) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="alert alert-info mt-3">
                <i class="bi bi-info-circle-fill me-2"></i> Esta proyección muestra el desglose de pagos mensuales durante el período del préstamo.
            </div>
        </div>
        
        <!-- Agregar iconos de Bootstrap -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    @endif
    
</html>