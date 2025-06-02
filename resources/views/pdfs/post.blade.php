<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('pdf.Download') }}</title>
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
    <p>{{ __('pdf.Detailed information about the route and recommendations for hikers') }}</p>
</div>

<h2 class="section-title">{{ __('pdf.General Information') }}</h2>
<table class="content-table">
    <tr>
        <th>{{ __('pdf.Location') }}</th>
        <td>{{ $post->province }}</td>
    </tr>
    <tr>
        <th>{{ __('pdf.Route Length') }}</th>
        <td>{{ $post->longitude }} km</td>
    </tr>
    <tr>
        <th>{{ __('pdf.Maximum Altitude') }}</th>
        <td>{{ $post->altitude }} m</td>
    </tr>
    <tr>
        <th>{{ __('pdf.Estimated Time') }}</th>
        <td>
            {{ floor($post->duration / 60) > 0 ? floor($post->duration / 60) . ' h ' : '' }}
            {{ $post->duration % 60 }} {{ __('pdf.min') }}
        </td>
    </tr>
    <tr>
        <th>{{ __('pdf.Difficulty Level') }}</th>
        <td>{{ $post->difficulty }}</td>
    </tr>
</table>

<h2 class="section-title">{{ __('pdf.Route Description') }}</h2>
<p class="description">{!! $post->body !!}</p>

<h2 class="section-title">{{ __('pdf.Recommendations') }}</h2>
<ul class="recommendations">
    <li>{{ __('pdf.Wear appropriate clothing and footwear for high mountain hiking.') }}</li>
    <li>{{ __('pdf.Check the weather forecast before the hike.') }}</li>
    <li>{{ __('pdf.Carry enough water and energy food.') }}</li>
    <li>{{ __('pdf.Respect the natural environment and follow National Park regulations.') }}</li>
    <li>{{ __('pdf.Avoid continuing the ascent in case of fog or bad weather.') }}</li>
</ul>

<h2 class="section-title">{{ __('pdf.Safety and Regulations') }}</h2>
<p class="safety">
    {{ __('pdf.To ensure a safe hike, it is recommended to inform someone about your route before departure and carry a mobile phone with sufficient battery. It is advisable to go accompanied and carry a basic first aid kit. Knowing the weather forecast is important as conditions can change rapidly. In case of emergency, contact rescue services by calling 112 and, if possible, provide exact location coordinates.') }}
</p>

<div class="footer">
    <p>{{ __('pdf.Document prepared by') }} {{ $post->user->name }} - PeakPost | {{ __('pdf.Date') }}: {{ date('d/m/Y') }}</p>
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

