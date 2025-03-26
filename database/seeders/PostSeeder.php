<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Pico mas alto de Murcia - Revolcadores',
                'slug' => Str::slug('Ascenso al Macizo de Revolcadores'),
                'body' => '<p>El <strong>Macizo de Revolcadores</strong> es una de las rutas más importantes de la <strong>Sierra del Segura</strong>, con una altitud de <strong>1.835 metros</strong>. El recorrido es moderado, y la mayoría de los montañistas inician el ascenso desde la localidad de <strong>Yeste</strong>. La ruta es de dificultad media, pero cuenta con tramos rocosos y pendientes exigentes.</p><br>
                <p>A lo largo del trayecto, se atraviesan bosques de pino y zonas de alta montaña, con vistas excepcionales a los valles cercanos. El tramo final es empinado, y el uso de <strong>pico</strong> es recomendable, especialmente durante el invierno.</p><br>
                <p>Es importante llevar un equipo adecuado, con ropa de abrigo, especialmente en los tramos más altos. El clima puede cambiar rápidamente, por lo que se debe estar preparado para las bajas temperaturas y la posibilidad de lluvia o nieve.</p><br>
                <p>La subida es algo empinada en las últimas fases, por lo que es aconsejable ir a un ritmo constante para no agotarse. La orientación en la ruta es sencilla, pero un GPS será útil si el clima empeora.</p><br>
                <p>En la cima, las vistas de la sierra y los valles de la región son impresionantes. Es un lugar perfecto para una pausa antes de comenzar el descenso, que aunque es más sencillo, también requiere atención.</p><br>
                <p>Es importante llevar ropa adecuada, botas de montaña resistentes y equipo de orientación como un <strong>GPS</strong>. Además, se recomienda llevar suficiente agua y alimentos energéticos, ya que la zona no tiene muchas fuentes.</p>',
                'image' => '/storage/posts/revolcadores.jpg',
                'province' => 'Murcia',
                'difficulty' => 'Moderado',
                'longitude' => 15.5,
                'altitude' => 1835,
                'time' => '05:31:27',
                'track' => 'tracks/revolcadores.kml',
                'user_id' => 1,
                'is_approved' => 1,
            ],
            [
                'title' => 'Cumbre del Aneto por el glacial',
                'slug' => Str::slug('Ascenso al Aneto'),
                'body' => '<p>El <strong>Aneto</strong>, con sus <strong>3.404 metros de altitud</strong>, es la montaña más alta de los Pirineos. El ascenso es un reto técnico que requiere preparación adecuada. La ruta más común comienza en el <strong>Refugio de la Renclusa</strong>, donde los montañistas se preparan para enfrentar las pendientes empinadas y los glaciares. La ruta se caracteriza por tramos rocosos y algunas partes de nieve, por lo que se recomienda el uso de <strong>crampones y piolet</strong>.</p><br>
                <p>En el ascenso, se atraviesa un terreno rocoso con una inclinación moderada, pero al acercarse al glaciar, la dificultad aumenta. A medida que se asciende, la respiración se vuelve más difícil debido a la altitud. Se recomienda hacer paradas regulares y aclimatarse a la altura. Desde el <strong>Collado de Coronas</strong>, se accede a la cima tras una subida algo empinada, pero la recompensa es una vista panorámica impresionante de los Pirineos.</p><br>
                <p>En las primeras horas del ascenso, el terreno se presenta rocoso y a menudo resbaladizo, por lo que es fundamental llevar <strong>botas de montaña</strong> adecuadas. El uso de bastones de trekking ayudará a mantener el equilibrio y aliviará el impacto sobre las articulaciones.</p><br>
                <p>A lo largo de la ruta, la altitud va incrementando considerablemente. Esto puede causar mal de altura, por lo que se debe estar preparado con agua, alimentos energéticos, y ropa apropiada para el frío. En zonas cercanas al glaciar, el viento puede ser muy fuerte, por lo que se recomienda llevar ropa de abrigo, además de protección para el rostro.</p><br>
                <p>El último tramo hasta la cumbre, una vez superado el glaciar, se caracteriza por una fuerte pendiente que requiere técnica y concentración. Al llegar a la cima, las vistas son inigualables y abarcan el vasto paisaje montañoso de los Pirineos. Asegúrate de disfrutar de este momento de logro antes de comenzar el descenso.</p><br>
                <p>Es necesario llevar ropa adecuada para la alta montaña, incluyendo <strong>ropa técnica</strong>, <strong>botas de montaña</strong> resistentes y gafas de sol. Además, siempre es recomendable portar <strong>agua</strong> y <strong>comida energética</strong> durante el trayecto.</p>',
                'image' => '/storage/posts/aneto.jpg',
                'province' => 'Huesca',
                'difficulty' => 'Difícil',
                'longitude' => 19.7,
                'altitude' => 3404,
                'time' => '07:20:36',
                'track' => 'tracks/aneto.kml',
                'user_id' => 1,
                'is_approved' => 1,
            ],
            [
                'title' => 'Ascenso al Puigmal',
                'slug' => Str::slug('Ascenso al Puigmal'),
                'body' => '<p>El <strong>Puigmal</strong> se encuentra en el Pirineo oriental, con una altitud de <strong>2.910 metros</strong>. La ruta más popular comienza en el <strong>Refugio de la Coma de l\'Embut</strong> y sigue hacia la cima del Puigmal. El ascenso es moderadamente difícil, con tramos rocosos y algunas zonas cubiertas de nieve. Se recomienda el uso de bastones de trekking y crampones en invierno.</p><br>
                <p>A lo largo del recorrido, el paisaje varía, desde los bosques de pino hasta las zonas de alta montaña con vistas espectaculares de los valles pirenaicos. El último tramo es bastante empinado, pero la cima ofrece una vista impresionante del <strong>Macizo del Canigó</strong> y otras cumbres cercanas.</p><br>
                <p>Durante el ascenso, los montañistas deben estar atentos a los cambios de clima, ya que las condiciones en las cumbres de los Pirineos pueden cambiar rápidamente. La ruta sigue un trazado marcado, pero en invierno es recomendable llevar un <strong>GPS</strong> para evitar perderse.</p><br>
                <p>En las primeras fases de la subida, el terreno es relativamente sencillo, pero conforme se asciende, las pendientes aumentan. Es importante asegurarse de tener suficiente agua y comida energética para el trayecto. La altitud puede afectar la respiración, por lo que las pausas regulares son clave.</p><br>
                <p>Al llegar a la cima, las vistas son espectaculares. Se puede ver gran parte de los Pirineos, y en días despejados, es posible observar el mar Mediterráneo. El descenso, aunque menos exigente, también requiere precaución, especialmente en condiciones de nieve.</p><br>
                <p>El equipo necesario incluye <strong>ropa térmica</strong>, <strong>botas de montaña</strong>, <strong>gafas de sol</strong> y un <strong>GPS</strong> para la orientación. Asegúrate de llevar suficiente agua y comida energética para el ascenso.</p>',
                'image' => '/storage/posts/puigmal.jpg',
                'province' => 'Girona',
                'difficulty' => 'Moderado',
                'longitude' => 8.4,
                'altitude' => 2910,
                'time' => '06:34:50',
                'track' => 'tracks/puigmal.kml',
                'user_id' => 1,
                'is_approved' => 1,
            ],
            [
                'title' => 'El Camino de Santiago: Ruta del Francés',
                'slug' => Str::slug('El Camino de Santiago'),
                'body' => '<p>El <strong>Camino de Santiago</strong> es una de las rutas de peregrinación más importantes del mundo, con siglos de historia. La <strong>Ruta del Francés</strong> es la más popular, partiendo desde <strong>Saint-Jean-Pied-de-Port</strong> en Francia y recorriendo más de <strong>750 kilómetros</strong> hasta la majestuosa <strong>Catedral de Santiago de Compostela</strong>. Esta travesía ofrece una experiencia espiritual, cultural y física inolvidable.</p><br>
                <p>El camino atraviesa diversas regiones de España, desde los paisajes montañosos de los Pirineos hasta los valles de Navarra, los campos de Castilla y la exuberante Galicia. Cada etapa tiene su propio encanto, con pequeñas aldeas, impresionantes monasterios y ciudades históricas como <strong>Pamplona, Burgos y León</strong>. Es un recorrido que permite descubrir la riqueza arquitectónica y gastronómica de cada región.</p><br>
                <p>Uno de los grandes retos del Camino es la resistencia física y mental. Se recomienda caminar entre <strong>20 y 25 kilómetros al día</strong>, lo que significa un esfuerzo considerable. A lo largo del trayecto, los peregrinos pueden alojarse en <strong>albergues</strong> públicos o privados, donde es posible conocer a otros caminantes y compartir experiencias únicas.</p><br>
                <p>El clima es otro factor a considerar. Dependiendo de la época del año, los peregrinos pueden enfrentarse a intensos calores en Castilla o lluvias persistentes en Galicia. Es fundamental llevar ropa adecuada, calzado cómodo y una mochila bien organizada con lo esencial para el viaje. También es recomendable llevar un botiquín con vendas y ungüentos para tratar las inevitables ampollas en los pies.</p><br>
                <p>Al llegar a <strong>Santiago de Compostela</strong>, la sensación de logro y emoción es indescriptible. La catedral, con su imponente fachada barroca y el sepulcro del Apóstol Santiago, marca el final del camino. Muchos peregrinos asisten a la misa del peregrino y disfrutan de la hospitalidad gallega, con platos típicos como el pulpo a la gallega y la tarta de Santiago.</p><br>
                <p>El Camino de Santiago no es solo un viaje físico, sino una experiencia de transformación personal. Ya sea por motivos religiosos, culturales o de superación personal, cada peregrino encuentra en la ruta un significado especial. Es un camino de reflexión, amistad y autodescubrimiento que deja una huella imborrable en quienes lo recorren.</p>',
                'image' => '/storage/posts/santiago.jpg',
                'province' => 'Asturias',
                'difficulty' => 'Moderado',
                'longitude' => 52.4,
                'altitude' => 267,
                'time' => '17:32:05',
                'track' => 'tracks/santiago.kml',
                'user_id' => 1,
                'is_approved' => 1,
            ],
            [
                'title' => 'Ascenso al Almanzor por el valle',
                'slug' => Str::slug('Ascenso al Almanzor'),
                'body' => '<p>El <strong>Almanzor</strong>, con sus <strong>2.592 metros de altitud</strong>, es la cima más alta del Sistema Central. La ruta más popular comienza en el <strong>Refugio de la Portilla del Tiétar</strong> y sigue hasta la cumbre a través de una serie de tramos rocosos y empinados. La ruta es bastante técnica y requiere un buen estado físico.</p><br>
                <p>En el último tramo del ascenso, la inclinación se hace más pronunciada, por lo que se recomienda utilizar <strong>bastones de trekking</strong> y llevar el equipo adecuado para evitar lesiones. La vista desde la cima es impresionante, abarcando el <strong>Valle del Tiétar</strong> y las sierras circundantes.</p><br>
                <p>Es fundamental que los montañistas estén preparados para el clima cambiante, ya que el tiempo en la cima puede ser impredecible. Se recomienda llevar ropa adecuada para el frío y el viento, así como un buen equipo de protección para la cara y las manos.</p><br>
                <p>El último tramo hasta la cima es exigente, con una subida empinada y rocas sueltas. La técnica y el paso seguro son esenciales para evitar caídas. En invierno, es necesario llevar <strong>crampones</strong> y <strong>piolet</strong> para evitar resbalones en el hielo.</p><br>
                <p>Una vez en la cima, la panorámica es impresionante. Las vistas se extienden por el Valle del Tiétar, los montes cercanos, y se pueden ver las otras cumbres del Sistema Central. El regreso es por la misma ruta, pero se debe tener en cuenta que el descenso también puede ser complicado en zonas rocosas.</p><br>
                <p>Es importante llevar ropa técnica, botas de montaña resistentes y equipo de seguridad como un <strong>casco</strong> y <strong>cuerdas</strong> para las secciones más complicadas. También se recomienda llevar suficiente agua y alimentos energéticos durante el ascenso.</p>',
                'image' => '/storage/posts/almanzor.jpg',
                'province' => 'Ávila',
                'difficulty' => 'Difícil',
                'longitude' => 13.0,
                'altitude' => 2592,
                'time' => '08:12:09',
                'track' => 'tracks/almanzor.kml',
                'user_id' => 1,
                'is_approved' => 1,
            ],
            [
                'title' => 'La Sagra por el collado de las víboras',
                'slug' => Str::slug('Ascenso a La Sagra'),
                'body' => '<p><strong>La Sagra</strong>, con una altitud de <strong>2.382 metros</strong>, es una montaña situada en la provincia de <strong>Granada</strong>, famosa por su espectacular vista de los alrededores. La ruta de ascenso más común comienza en la aldea de <strong>La Sagra</strong> y sigue un sendero forestal hacia la cumbre. El recorrido es largo y exigente, con tramos de subida pronunciada.</p><br>
                <p>A medida que se asciende, el terreno cambia de bosque a zonas de roca y piedra, y la dificultad aumenta conforme se alcanzan los últimos 600 metros de desnivel. El uso de <strong>bastones de trekking</strong> es altamente recomendable, y las vistas desde la cima son impresionantes.</p><br>
                <p>La montaña tiene un clima impredecible, y las temperaturas pueden bajar considerablemente conforme se gana altitud. Es recomendable llevar suficiente ropa de abrigo, como chaquetas aislantes y guantes. Además, no se debe olvidar llevar un protector solar, ya que en los días soleados la radiación UV en la alta montaña puede ser fuerte.</p><br>
                <p>Al llegar a la cumbre, se disfruta de una vista impresionante de la Vega de Granada, y en días despejados, se puede ver la <strong>Alpujarra granadina</strong> y otras montañas cercanas. El descenso no es complicado, pero es necesario tener cuidado en las zonas pedregosas.</p><br>
                <p>El equipo necesario incluye <strong>ropa térmica</strong>, <strong>botas de montaña</strong>, <strong>gafas de sol</strong> y un <strong>GPS</strong> para la orientación. Asegúrate de llevar suficiente agua y comida energética para el ascenso.</p><br>
                <p>Es recomendable planificar el ascenso con antelación y estar bien preparado para cualquier eventualidad, ya que la montaña puede ser exigente y el clima puede cambiar en cualquier momento.</p>',
                'image' => '/storage/posts/sagra.jpg',
                'province' => 'Granada',
                'difficulty' => 'Moderado',
                'longitude' => 21.9,
                'altitude' => 2382,
                'time' => '07:32:18',
                'track' => 'tracks/sagra.kml',
                'user_id' => 1,
                'is_approved' => 1,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
