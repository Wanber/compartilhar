<?php get_header('mapa'); ?>

<?php $the_query = new WP_Query(array('post_type' => 'empresas')); ?>
<?php $empresas = [] ?>

<?php
while ($the_query->have_posts()) : $the_query->the_post();

    $fields = get_fields();

    $item = [];
    $item['nome'] = get_the_title();
    $item['descricao'] = preg_replace("/\r\n|\r|\n/", '<br/>', $fields['descricao']);
    $item['telefone'] = $fields['telefone'];
    $item['telefone'] = $fields['telefone'];
    $item['email'] = $fields['email'];
    $item['site'] = $fields['site'];
    $item['logo'] = $fields['logo'];
    $item['endereco'] = $fields['localizacao']['address'];
    $item['lat'] = $fields['localizacao']['lat'];
    $item['lng'] = $fields['localizacao']['lng'];

    $empresas[$fields['tipo']][] = $item;

endwhile;
?>

    <style>
        html, body {
            height: 100vh;
            width: 100vw;
            max-width: 100vw;
            max-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            overflow: hidden;
        }

        #map {
            height: 100vh;
            flex: 1;
        }

        .painel {
            width: 260px;
            height: 100%;
            float: right;
            background: rgb(32, 52, 64);
        }

        .painel .header {
            padding: 10px;
            text-align: center;
            position: relative;
        }

        .painel .header h3 {

            font-weight: 100;
            color: white;
        }

        .painel .header h3 p {
            margin-top: 7px;
            margin-bottom: 10px;
        }

        .painel .rodape {
            position: absolute;
            bottom: 0;
            background: #324b5a;
            width: 100%;
            height: 50px;
            padding: 10px;
            color: white;
            font-weight: 100;
        }

        .titulo-empresa img {
            width: 26px;
            height: 26px;
        }

        .titulo-empresa span {
            display: none;
        }

        #cadastrarEmpresa {
            position: fixed;
            bottom: 55px;
            left: 34px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.87rem;
            padding: 0 0 5px 0;
        }

        .ui-accordion .ui-accordion-header {
            display: block;
            cursor: pointer;
            position: relative;
            margin: 2px 0 0 0;
            padding: .5em .5em .5em .7em;
            font-size: 100%;
        }

        .ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
            border-top-right-radius: 3px;
        }

        .ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
            border-top-left-radius: 3px;
        }

        .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
            border: none;
            background: #314050;
        }

        .ui-accordion .ui-accordion-header {
            outline: none;
        }

        .ui-accordion .ui-accordion-content {
            padding: 1em 1.8em .1em 1.8em;
            background: #ececec;
        }

        .ui-accordion .ui-accordion-content p {
            cursor: pointer;
        }

        .ui-accordion .ui-accordion-content p:hover {
            color: rgb(47, 93, 112);
        }
    </style>

    <div id="map"></div>

    <div class="painel">
        <div class="header">
            <h3>O que você está procurando?</h3>
        </div>

        <div id="accordion">

            <?php foreach ($empresas as $tipo_empresa => $item) : ?>
                <h3 class="titulo-empresa">
                    <img src="<?php echo get_template_directory_uri() . '/images/map-icons/' . $tipo_empresa . '.png' ?>"/>
                    <?php echo ucfirst($tipo_empresa) ?>
                </h3>
                <div>
                    <?php foreach ($item as $empresa) : ?>
                        <p onclick="openMarker('<?php echo sanitize_file_name($empresa['nome']) . '-' . $empresa['lat'] . $empresa['lng'] ?>')"><?php echo $empresa['nome'] ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="rodape">
            &copy; Compartilhar - 2018
        </div>

        <!-- Button trigger modal -->
        <button type="button" id="cadastrarEmpresa" class="btn btn-primary" data-toggle="modal"
                data-target="#cadastrarModal" data-tooltip="tooltip" data-placement="top" title="Cadastre sua empresa">
            +
        </button>

        <!-- Modal -->
        <div class="modal fade" id="cadastrarModal" tabindex="-1" role="dialog" aria-labelledby="cadastrarModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cadastrarModalLabel">Cadastrar Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe frameborder="0" width="100%" style="height: 70vh"
                                src="<?php the_permalink(get_page_id_by_slug('cadastrar-empresa')) ?>">
                        </iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map;
        var markers = [];

        function initMap() {

            var valeDoAco = new google.maps.LatLng(-19.5106789, -42.59246375);
            var ipatinga = new google.maps.LatLng(-19.4707617, -42.5480125);
            var timoteo = new google.maps.LatLng(-19.5815631, -42.64752);
            var c_fabriciano = new google.maps.LatLng(-19.5189968, -42.628205);

            var pins = [
                <?php foreach ($empresas as $tipo_empresa => $item) : ?>
                <?php foreach ($item as $empresa) : ?>
                {
                    titulo: '<?php echo $empresa['nome'] ?>',
                    site: '<?php echo $empresa['site'] ?>',
                    tipo: '<?php echo $tipo_empresa ?>',
                    telefone: '<?php echo $empresa['telefone'] ?>',
                    email: '<?php echo $empresa['email'] ?>',
                    endereco: '<?php echo $empresa['endereco'] ?>',
                    descricao: '<?php echo $empresa['descricao'] ?>',
                    logo: '<?php echo $empresa['logo'] ?>',
                    cords: new google.maps.LatLng('<?php echo $empresa['lat'] ?>', '<?php echo $empresa['lng'] ?>'),
                    alias: '<?php echo sanitize_file_name($empresa['nome']) . '-' . $empresa['lat'] . $empresa['lng'] ?>'
                },
                <?php endforeach; ?>
                <?php endforeach; ?>
            ];

            var circles = [
                {
                    strokeColor: '#ff8097',
                    strokeOpacity: 0.05,
                    strokeWeight: 2,
                    fillColor: '#ff1e20',
                    fillOpacity: 0.1,
                    radius: 1500,
                    coords: ipatinga
                },
                {
                    strokeColor: '#3e8eff',
                    strokeOpacity: 0.05,
                    strokeWeight: 2,
                    fillColor: '#1f1bff',
                    fillOpacity: 0.1,
                    radius: 1200,
                    coords: c_fabriciano
                },
                {
                    strokeColor: '#ff62ec',
                    strokeOpacity: 0.05,
                    strokeWeight: 2,
                    fillColor: '#ff00d1',
                    fillOpacity: 0.1,
                    radius: 400,
                    coords: timoteo
                }
            ];

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: valeDoAco,
                mapTypeId: 'roadmap'
            });

            pins.forEach(function (pin) {
                var marker = new google.maps.Marker({
                    position: pin.cords,
                    icon: '<?php echo get_template_directory_uri() . '/images/map-icons/' ?>' + pin.tipo + '.png',
                    title: pin.titulo,
                    alias: pin.alias,
                    animation: google.maps.Animation.DROP,
                    map: map
                });

                var boxContent = '';

                boxContent += '<div style="float: left; max-width: 300px">';
                boxContent += '<h4>' + pin.titulo + '</h4>';
                boxContent += '<div>' + pin.descricao + '</div>';
                boxContent += '<p>';
                boxContent += '<br/>' + pin.telefone + '<br/>' + pin.email + '<br/>' + pin.endereco;
                boxContent += '</p>';
                if (pin.site != null)
                    boxContent += '<br/><a target="_blank" href="' + pin.site + '">' + pin.site + '</a>'
                boxContent += '</div>';
                boxContent += '<div style="float: right; width: 180px; height: 180px; background: url(' + pin.logo + ') no-repeat center center;"></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: boxContent
                });

                marker.addListener('mouseover', function () {
                    infowindow.open(map, marker);
                });

                marker.addListener('mouseout', function () {
                    infowindow.close();
                });

                if (pin.site != null)
                    marker.addListener('click', function () {
                        window.open(pin.site, '_blank');
                    });

                markers.push({info: marker, infowindow: infowindow});
            });

            circles.forEach(function (circle) {
                new google.maps.Circle({
                    strokeColor: circle.strokeColor,
                    strokeOpacity: circle.strokeOpacity,
                    strokeWeight: circle.strokeWeight,
                    fillColor: circle.fillColor,
                    fillOpacity: circle.fillOpacity,
                    center: circle.coords,
                    radius: Math.sqrt(circle.radius) * 100,
                    map: map
                });
            });

        }

        function openMarker(alias) {

            markers.forEach(function (marker) {
                if (marker.info.alias === alias) {
                    marker.infowindow.open(map, marker.info);
                    marker.info.setAnimation(google.maps.Animation.BOUNCE);
                    setTimeout(function () {
                        marker.info.setAnimation(null);
                    }, 1000);
                }
                else
                    marker.infowindow.close();
            });
        }
    </script>

    <script>
        jQuery(function ($) {
            jQuery("#accordion").accordion();

            jQuery(function () {
                jQuery('[data-tooltip="tooltip"]').tooltip()
            })
        });
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDb6EpT9bn598bzPmpf9b2to5qT6E3__Hg &callback=initMap"></script>

<?php get_footer() ?>