<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de asistencia</title>
</head>

<body>
    <br>
    <h1>Reporte de asistencias</h1>
    <table id="example1" class="table table-bordered table-striped table-sm" border="1">
        <thead class="thead">
            <tr>
                <th>No</th>

                <th>Fecha</th>
                <th>Nombres y apellidos del Miembro</th>
            </tr>
        </thead>
        <tbody>
            <?php $contador_de_asistencia = 1; ?>
            @foreach ($asistencias as $asistencia)
            <tr>
                <td><?= $contador_de_asistencia++; ?></td>

                <td>{{ $asistencia->fecha }}</td>
                <!-- llamando a la funcion miembro desde el modelo Asistencia -->
                <td>{{ $asistencia->miembro->nombre_apelllido }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>