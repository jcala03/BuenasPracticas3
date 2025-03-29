<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de intereses</title>
</head>
<body>
    <form action="/my-handling-form-page" method="post" target="_self">
        <ul>
            <li>
                <label for="monto">Monto</label>
                    <input type="text" id="monto" name="monto" required>
            </li>
            <li>
                <label for="meses">¿A cuántos meses?</label>
                <input type="number" id="meses" name="meses" required>
            </li>
            <li>
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </li>
        </ul>
        <input type="submit" value="Simular">
    </form>
</body>
</html>