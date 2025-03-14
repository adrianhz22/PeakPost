<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Descarga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            color: #333;
        }
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo img {
            width: 120px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        h1 {
            color: #222;
            font-size: 26px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .content-table th, .content-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 14px;
        }
        .content-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        .section-title {
            font-size: 18px;
            color: #222;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .description, .recommendations, .safety {
            font-size: 14px;
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #555;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>

<div class="logo">
    <img src="{{ public_path('assets/logo.png') }}" alt="Logo">
</div>

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
        <td>{{ $post->time }}</td>
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
<p class="safety">Para garantizar una excursión segura, se recomienda informar a alguien sobre la ruta antes de partir y llevar un teléfono móvil con batería suficiente. Se aconseja ir acompañado y portar un botiquín básico. Es importante conocer la previsión meteorológica, ya que las condiciones pueden cambiar rápidamente. En caso de emergencia, contactar con los servicios de rescate llamando al 112 y, si es posible, proporcionar coordenadas exactas de la ubicación.</p>
<div class="footer">
    <p>Documento elaborado por {{ $post->user->name }} - PeakPost | Fecha: {{ date('d/m/Y') }}</p>
</div>

</body>
</html>
