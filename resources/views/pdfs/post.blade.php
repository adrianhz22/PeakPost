<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Descarga</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 30px 40px;
            color: #222;
            background-color: #fff;
            font-size: 15px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 25px 20px;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 30px;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0 0 8px 0;
            color: #1a1a1a;
            letter-spacing: 1.2px;
        }

        .header p {
            font-size: 14px;
            color: #555;
            margin: 0;
            font-style: italic;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            box-shadow: 0 0 6px rgb(0 0 0 / 0.05);
            border-radius: 6px;
            overflow: hidden;
        }

        .content-table th,
        .content-table td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
            vertical-align: middle;
        }

        .content-table th {
            background-color: #f7f9fc;
            font-weight: 700;
            color: #333;
            border-bottom: 2px solid #bbb;
        }

        .content-table tr:last-child td {
            border-bottom: none;
        }

        .section-title {
            font-size: 22px;
            color: #222;
            font-weight: 700;
            margin: 30px 0 12px 0;
            border-bottom: 3px solid #3a87ad;
            padding-bottom: 5px;
            letter-spacing: 0.05em;
        }

        .description, .recommendations, .safety {
            font-size: 15px;
            color: #444;
            line-height: 1.65;
        }

        ul.recommendations {
            margin-left: 20px;
            list-style-type: disc;
            color: #444;
        }

        ul.recommendations li {
            margin-bottom: 8px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            font-style: italic;
        }
    </style>
</head>
<body>

<script type="text/php">
    if (isset($pdf)) {
        $font = $fontMetrics->get_font("Helvetica", "normal");
        $size = 9;

        $pdf->page_text(40, 25, "peakpost.test", $font, $size);
        $pdf->page_text(40, 40, "peakpost@gmail.com", $font, $size);
        $pdf->page_text(40, 55, "@peakpost_es", $font, $size);

        $pdf->image(public_path('assets/logo.png'), 500, 20, null, 50);
    }
</script>

<div class="header">
    <h1>{{ $post->title }}</h1>
    <p>Información detallada sobre la ruta y recomendaciones para excursionistas</p>
</div>

<h2 class="section-title">Datos Generales</h2>
<table class="content-table">
    <tr>
        <th>Ubicación</th>
        <td>{{ $post->province }}</td>
    </tr>
    <tr>
        <th>Longitud del recorrido</th>
        <td>{{ $post->longitude }} km</td>
    </tr>
    <tr>
        <th>Altitud máxima</th>
        <td>{{ $post->altitude }} m</td>
    </tr>
    <tr>
        <th>Tiempo estimado</th>
        <td>
            {{ floor($post->duration / 60) > 0 ? floor($post->duration / 60) . ' h ' : '' }}
            {{ $post->duration % 60 }} min
        </td>
    </tr>
    <tr>
        <th>Nivel de dificultad</th>
        <td>{{ $post->difficulty }}</td>
    </tr>
</table>

<h2 class="section-title">Descripción de la Ruta</h2>
<p class="description">{!! $post->body !!}</p>

<h2 class="section-title">Recomendaciones</h2>
<ul class="recommendations">
    <li>Usar ropa y calzado adecuados para senderismo en alta montaña.</li>
    <li>Consultar la previsión meteorológica antes de la excursión.</li>
    <li>Portar suficiente agua y alimentos energéticos.</li>
    <li>Respetar el entorno natural y seguir las normativas del Parque Nacional.</li>
    <li>En caso de niebla o mal tiempo, evitar continuar el ascenso.</li>
</ul>

<h2 class="section-title">Seguridad y Normativas</h2>
<p class="safety">Para garantizar una excursión segura, se recomienda informar a alguien sobre la ruta antes de partir y
    llevar un teléfono móvil con batería suficiente. Se aconseja ir acompañado y portar un botiquín básico. Es
    importante conocer la previsión meteorológica, ya que las condiciones pueden cambiar rápidamente. En caso de
    emergencia, contactar con los servicios de rescate llamando al 112 y, si es posible, proporcionar coordenadas
    exactas de la ubicación.</p>

<div class="footer">
    <p>Documento elaborado por {{ $post->user->name }} - PeakPost | Fecha: {{ date('d/m/Y') }}</p>
</div>

<script type="text/php">
    if (isset($pdf)) {
        $font = $fontMetrics->get_font("Helvetica", "normal");
        $size = 10;
        $x = 560;
        $y = 800;
        $text = "{PAGE_NUM}";
        $pdf->page_text($x, $y, $text, $font, $size);
    }
</script>

</body>
</html>
