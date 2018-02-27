<?php get_header(); ?>

<?php $the_query = new WP_Query(array('post_type' => 'empresas')); ?>
<?php $empresas = [] ?>

<?php
while ($the_query->have_posts()) : $the_query->the_post();

    $fields = get_fields();

    $item = [];
    $item['nome'] = get_the_title();
    $item['descricao'] = $fields['descricao'];
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

        #cadastrarEmpresa {
            position: fixed;
            bottom: 55px;
            left: 34px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.88rem;
            padding: 0 0 5px 0;
        }

        .tooltip .tooltip-inner {
            background-color: green;
        }

        .tooltip .arrow::before {
            border-left-color: green;
        }
    </style>

    <div id="map"></div>

    <div class="painel">
        <div class="header">
            <h3>O que você está procurando?</h3>
        </div>

        <div id="accordion">

            <?php foreach ($empresas as $tipo_empresa => $item) : ?>
                <h3><?php echo ucfirst($tipo_empresa) ?></h3>
                <div>
                    <?php foreach ($item as $empresa) : ?>
                        <p onclick="openFeature('<?php echo sanitize_file_name($empresa['nome']) . '-' . $empresa['lat'] . $empresa['lng'] ?>')"><?php echo $empresa['nome'] ?></p>
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

            var valeDoAco = new google.maps.LatLng(-19.50073310865667, -42.58720278739929);

            var features = [
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

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: valeDoAco,
                mapTypeId: 'roadmap'
            });

            features.forEach(function (feature) {
                var marker = new google.maps.Marker({
                    position: feature.cords,
                    icon: '<?php echo get_template_directory_uri() . '/images/map-icons/' ?>' + feature.tipo + '.png',
                    title: feature.titulo,
                    alias: feature.alias,
                    animation: google.maps.Animation.DROP,
                    //animation: google.maps.Animation.BOUNCE, //para pular
                    map: map
                });

                var boxContent = '';

                boxContent += '<div style="float: left; max-width: 300px">';
                boxContent += '<h4>' + feature.titulo + '</h4>';
                boxContent += '<div>' + feature.descricao + '</div>';
                boxContent += '<p>';
                boxContent += '<br/>' + feature.telefone + '<br/>' + feature.email + '<br/>' + feature.endereco;
                boxContent += '</p>';
                if (feature.site != null)
                    boxContent += '<br/><a target="_blank" href="' + feature.site + '">' + feature.site + '</a>'
                boxContent += '</div>';
                boxContent += '<div style="float: right; width: 180px; height: 180px; background: url(' + feature.logo + ') no-repeat center center;"></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: boxContent
                });

                marker.addListener('mouseover', function () {
                    infowindow.open(map, marker);
                });

                marker.addListener('mouseout', function () {
                    infowindow.close();
                });

                if (feature.site != null)
                    marker.addListener('click', function () {
                        window.open(feature.site, '_blank');
                    });

                markers.push({info: marker, infowindow: infowindow});
            });
        }

        function openFeature(alias) {

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