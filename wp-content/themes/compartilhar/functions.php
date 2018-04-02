<?php

define('THEME_DOMAIN_NAME', 'vda_compartilhar');

global $actual_link;
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

//redirecionamentos site antigo
/*add_action('parse_request', function () {

	//$base = '/' . pathinfo(__DIR__)['basename'];
	$base = '';
	$requested_page = $_SERVER["REQUEST_URI"];

	switch ($requested_page) {
		case $base . '/como-funciona/aperfeicoamento':
			wp_redirect(get_page_link(get_page_id_by_slug('como-funciona-aperfeicoamento')), 301);
			exit;
			break;
		case $base . '/tportal':
			wp_redirect('http://ava.ucamprominas.com.br/tportal', 301);
			exit;
			break;
		case $base . '/portal':
			wp_redirect('http://ava.ucamprominas.com.br/tportal', 301);
			exit;
			break;
		case $base . '/tportal/principal':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/principal', 301);
			exit;
			break;
		case $base . '/tportal/materiaisdidaticos':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/materiaisdidaticos', 301);
			exit;
			break;
		case $base . '/tportal/avaliacoes':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/avaliacoes', 301);
			exit;
			break;
		case $base . '/tportal/meusboletos':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/meusboletos', 301);
			exit;
			break;
		case $base . '/tportal/boletim':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/boletim', 301);
			exit;
			break;
		case $base . '/tportal/solicitacaodedeclaracao':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/solicitacaodedeclaracao', 301);
			exit;
			break;
		case $base . '/tportal/meutcc':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/meutcc', 301);
			exit;
			break;
		case $base . '/tportal/meusdados':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/meusdados', 301);
			exit;
			break;
		case $base . '/tportal/meucertificado':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/meucertificado', 301);
			exit;
			break;
		case $base . '/tportal/agenda':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/agenda', 301);
			exit;
			break;
		case $base . '/tportal/saladeestudos':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/saladeestudos', 301);
			exit;
			break;
		case $base . '/tportal/atividadeseminario':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/atividadeseminario', 301);
			exit;
			break;
		case $base . '/tportal/acervobibliotecario':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/acervobibliotecario', 301);
			exit;
			break;
		case $base . '/tportal/checkout':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/checkout', 301);
			exit;
			break;
		case $base . '/tportal/forgot':
			wp_redirect('http://ava.ucamprominas.com.br/tportal/forgot', 301);
			exit;
			break;
		case $base . '/gestor':
			wp_redirect('http://ava.ucamprominas.com.br/gestor', 301);
			exit;
			break;
		case $base . '/gestor/principal':
			wp_redirect('http://ava.ucamprominas.com.br/gestor', 301);
			exit;
			break;
		case $base . '/quem-somos':
			wp_redirect(get_page_link(get_page_id_by_slug('sobre')), 301);
			exit;
			break;
		case $base . '/inscricao/dados-basicos':
			wp_redirect(get_page_link(get_page_id_by_slug('matricula')), 301);
			exit;
			break;
		case $base . '/secretaria/pagamentos':
			wp_redirect(get_page_link(get_page_id_by_slug('secretaria')), 301);
			exit;
			break;

		case $base . '/pos-graduacao':
			wp_redirect(get_page_link(get_page_id_by_slug('cursos')) . 'pos-graduacao', 301);
			exit;
			break;
		case $base . '/extensao':
			wp_redirect(get_page_link(get_page_id_by_slug('cursos')) . 'extensao', 301);
			exit;
			break;
		case $base . '/aperfeicoamento':
			wp_redirect(get_page_link(get_page_id_by_slug('cursos')) . 'aperfeicoamento', 301);
			exit;
			break;
		case $base . '/promocoes':
			wp_redirect(get_page_link(get_page_id_by_slug('home')), 301);
			exit;
			break;
		case $base . '/consultores':
			wp_redirect(get_page_link(get_page_id_by_slug('home')), 301);
			exit;
			break;
		case $base . '/depoimentos':
			wp_redirect(get_page_link(get_page_id_by_slug('home')), 301);
			exit;
			break;
	}
});*/

//desativa a edição do tema
!defined('DISALLOW_FILE_EDIT') ?: define('DISALLOW_FILE_EDIT', true);
//remove a barra de admin
add_filter('show_admin_bar', '__return_false');
//remove a tag do generator
remove_action('wp_head', 'wp_generator');
//habilita ediçao de menus
add_theme_support('menus');
//habilita thumb em posts
add_theme_support('post-thumbnails');
//habilita ediçao de titulo de pagina
add_theme_support('title-tag');
//habilita tags html5
add_theme_support('html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
]);

//setar api key maps
add_action('acf/init', function () {
    acf_update_setting('google_api_key', 'AIzaSyDb6EpT9bn598bzPmpf9b2to5qT6E3__Hg ');
});

add_filter('acf/prepare_field/name=_post_title', function ($field) {
    if (is_page('cadastrar-empresa')) {
        $field['label'] = "Nome";
    }

    if ($field) {
        return $field;
    } else {
        exit;
    }
});

//custom post types
add_action('init', 'custom_post_types', 0);

function custom_post_types()
{
    $empresas_labels = [
        'name' => _x('Empresas', 'Post Type General Name', THEME_DOMAIN_NAME),
        'singular_name' => _x('Empresa', 'Post Type Singular Name', THEME_DOMAIN_NAME),
        'menu_name' => __('Empresas', THEME_DOMAIN_NAME),
        'all_items' => __('Todas as Empresas', THEME_DOMAIN_NAME),
        'view_item' => __('Ver Empresa', THEME_DOMAIN_NAME),
        'add_new_item' => __('Adicionar nova Empresa', THEME_DOMAIN_NAME),
        'add_new' => __('Adicionar Empresa', THEME_DOMAIN_NAME),
        'edit_item' => __('Editar Empresa', THEME_DOMAIN_NAME),
        'update_item' => __('Atualizar Empresa', THEME_DOMAIN_NAME),
        'search_items' => __('Procurar Empresa', THEME_DOMAIN_NAME),
    ];

    $args_empresas = [
        'label' => __('Empresas', 'empresas'),
        'labels' => $empresas_labels,
        'menu_icon' => 'dashicons-location-alt',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes'],
        'capability_type' => 'post',
        'taxonomies' => [],
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'show_in_rest' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'menu_position' => 5,
    ];

    register_post_type('empresas', $args_empresas);
    flush_rewrite_rules();
}

//custom taxonomies
//add_action('init', 'custom_taxonomies', 0);

/*function custom_taxonomies()
{

    $tipos_labels = [
        'name'                       => _x('Tipo', 'Taxonomy General Name', THEME_DOMAIN_NAME),
        'singular_name'              => _x('Tipo', 'Taxonomy Singular Name', THEME_DOMAIN_NAME),
        'menu_name'                  => __('Tipos', THEME_DOMAIN_NAME),
        'all_items'                  => __('Todas os Tipos', THEME_DOMAIN_NAME),
        'parent_item'                => __('Tipo pai', THEME_DOMAIN_NAME),
        'parent_item_colon'          => __('Tipos pai:', THEME_DOMAIN_NAME),
        'new_item_name'              => __('Novo nome do Tipo', THEME_DOMAIN_NAME),
        'add_new_item'               => __('Adicionar novo Tipo', THEME_DOMAIN_NAME),
        'edit_item'                  => __('Editar Tipo', THEME_DOMAIN_NAME),
        'update_item'                => __('Atualizar Tipo', THEME_DOMAIN_NAME),
        'separate_items_with_commas' => __('Separar Tipos entre vírgulas', THEME_DOMAIN_NAME),
        'search_items'               => __('Buscar Tipos', THEME_DOMAIN_NAME),
        'add_or_remove_items'        => __('Adicionar ou remover Tipos', THEME_DOMAIN_NAME),
        'choose_from_most_used'      => __('Escolher os Tipos mais usadas', THEME_DOMAIN_NAME),
    ];

    $tipos_args = [
        'labels'            => $tipos_labels,
        'hierarchical'      => false,
        'rewrite'           => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => false,
    ];

    register_taxonomy('tipos', 'empresas', $tipos_args);
    flush_rewrite_rules();
}*/

//seta post por pagina no archive
add_action('pre_get_posts', function (WP_Query $query) {
    if ($query->is_main_query()) {
        if ($query->is_archive) {
            $query->set('posts_per_page', '5');
        }

        if ($query->is_search) {
            $query->set('post_type', 'post');
            $query->set('posts_per_page', '5');
        }
    }
});

//remove msg boas vindas
remove_action('welcome_panel', 'wp_welcome_panel');

//add base href
add_action('wp_head', function () {
    echo '<base href="' . get_site_url() . '">';
});

//hook into the administrative header output
add_action('wp_before_admin_bar_render', function () {
    echo '
        <style type="text/css">
            #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
                background-image: url(' . get_bloginfo('stylesheet_directory') . '/images/logo-admin.png) !important;
                background-position: 0 0;
                background-size: 100% 100%;
                color:rgba(0, 0, 0, 0);
            }
            #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
                background-position: 0 0;
            }
        </style>
    ';
});

//estilo personalizado para o admin
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('theme-admin', get_template_directory_uri() . '/css/admin.css', false, NULL, 'all');
});

/*//remover categorias internas da saida widget
add_filter('widget_categories_args', function ($cat_args) {
	$exclude_arr = [4, 6];

	if (isset($cat_args['exclude']) && !empty($cat_args['exclude']))
		$exclude_arr = array_unique(array_merge(explode(',', $cat_args['exclude']), $exclude_arr));
	$cat_args['exclude'] = implode(',', $exclude_arr);

	return $cat_args;
}, 10, 1);*/

//add widget do tema nna pag inicial do painel
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', 'Mensagem do desenvolvedor', function () {
        echo '<p>Bem vindo ao meu tema! precisa de ajuda?  Contate-me <a href="mailto:wanber@outlook.com">wanber@outlook.com</a></p>';
    });
});

//adiciona campos no usuario
add_filter('user_contactmethods', function ($contactmethods) {
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['instagram'] = 'Instagram';
    $contactmethods['linkedin'] = 'Linkedin';

    return $contactmethods;
}, 10, 1);

/*//Cria conta admin se nao houver
add_action('init', function () {
	$user = 'tiprominas';
	$pass = 'YbNTC&6!c3@mpDqZSxbPYdoY';
	$email = 'ti@institutoprominas.com';
	if (!username_exists($user) && !email_exists($email)) {
		$user_id = wp_create_user($user, $pass, $email);
		$user = new WP_User($user_id);
		$user->set_role('administrator');
	}
});*/

//crons
/*add_action('init', function () {
	if (!wp_next_scheduled('clear_cf_entries')) {
		wp_schedule_event(time(), 'daily', 'clear_cf_entries');
	}
});

add_action('clear_cf_entries', function () {
	if (is_plugin_active('caldera-forms/caldera-core.php')) {
		global $wpdb;
		$tables = [
			$wpdb->prefix . 'cf_form_entries',
			$wpdb->prefix . 'cf_form_entry_meta',
			$wpdb->prefix . 'cf_form_entry_values',
		];

		foreach ($tables as $table)
			$wpdb->query("TRUNCATE TABLE $table");
	}
});*/

//processar requests
add_action('init', function () {

    if (isset($_REQUEST['email'])) {

        $email = trim($_REQUEST['email']);

        if (!is_email($email)) {
            add_action('wp_footer', function () {
                echo '
				<script>
					jQuery(function ($) {
					    swal({
							text: "O Email informado é inválido",
							type: "warning",
							confirmButtonText: "ok"
						});
					});
				</script>
				';
            });

            return;
        }

        @require 'rd-station/Rdstation.php';

        @$rdstation = new Rdstation();
        @$cadastrou = $rdstation->send($email, []);

        if ($cadastrou == 'success') {
            add_action('wp_footer', function () {
                echo '
				<script>
					jQuery(function ($) {
					    swal({
							text: "Você foi inscrito em nossa newsletter",
							type: "success",
							confirmButtonText: "ok"
						});
					});
				</script>
				';
            });
        } else {
            add_action('wp_footer', function () {
                echo '
				<script>
					jQuery(function ($) {
					    swal({
							text: "Nāo foi possível se inscrever",
							type: "error",
							confirmButtonText: "ok"
						});
					});
				</script>
				';
            });
        }
    }
});

//criar rotas customizadas
/*add_filter('rewrite_rules_array', function ($rules) {
	$newrules = [];
	$newrules['cursos/(.*)/(.*)$'] = 'index.php?pagename=cursos&tipo=$matches[1]&area=$matches[2]';
	$newrules['cursos/(.*)$'] = 'index.php?pagename=cursos&tipo=$matches[1]';
	$newrules['curso/(.*)$'] = 'index.php?pagename=curso&curso=$matches[1]';
	$newrules['parceiro/(.*)$'] = 'index.php?parceiro_id=$matches[1]';
	$newrules['matricula/(.*)$'] = 'index.php?pagename=matricula&parceiro_id=$matches[1]';
	$newrules['campanha/(.*)$'] = 'index.php?campanha=$matches[1]';

	//redirects site antigo
	$newrules['public/(.*)$'] = 'index.php?pagename=redirect-permanente&link=http://ava.ucamprominas.com.br/public/$matches[1]';
	//$newrules['noticias/(.*)$'] = 'index.php?pagename=noticias';//nao pode ter isso por causa da paginacao
	$newrules['duvidas/(.*)$'] = 'index.php?pagename=duvidas';

	$newrules['pos-graduacao/(.*)/(.*)$'] = 'index.php?pagename=cursos&tipo=pos-graduacao&area=$matches[1]';
	$newrules['extensao/(.*)/(.*)$'] = 'index.php?pagename=cursos&tipo=extensao&area=$matches[1]';
	$newrules['aperfeicoamento/(.*)/(.*)$'] = 'index.php?pagename=cursos&tipo=aperfeicoamento&area=$matches[1]';
	$newrules['pos-graduacao/(.*)$'] = 'index.php?pagename=cursos&tipo=pos-graduacao';
	$newrules['extensao/(.*)$'] = 'index.php?pagename=cursos&tipo=extensao';
	$newrules['aperfeicoamento/(.*)$'] = 'index.php?pagename=cursos&tipo=aperfeicoamento';

	//fim

	return $newrules + $rules;
});

add_filter('query_vars', function ($vars) {
	array_push($vars, 'area');
	array_push($vars, 'curso');
	array_push($vars, 'tipo');
	array_push($vars, 'parceiro_id');
	array_push($vars, 'campanha');
	array_push($vars, 'link');

	return $vars;
});

add_action('wp_loaded', function () {
	$rules = get_option('rewrite_rules');

	if (!isset($rules['parceiro/(.*)$']) || !isset($rules['cursos/(.*)$']) || !isset($rules['curso/(.*)$'])
		|| !isset($rules['cursos/(.*)/(.*)$']) || !isset($rules['matricula/(.*)$']) || !isset($rules['campanha/(.*)$'])
		|| !isset($rules['public/(.*)$']) || !isset($rules['duvidas/(.*)$'])) {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
});*/

//retornar somente texto no excerpt
add_filter('the_excerpt', function ($content) {
    // return strip_tags(strip_shortcodes($content));
    return strip_shortcodes($content);
});

//limitar excerpt
add_filter('excerpt_length', function () {
    return 50;
});

//texto more excerpt
add_filter('excerpt_more', function () {
    return '[...] <a class="read-more" href="' . esc_url(get_permalink(get_the_ID())) . '">ver tudo</a>';
});

//intermediador de menu
add_filter('wp_nav_menu', function ($ulclass) {
    return $ulclass;
});

//registrar espaço para widgets
function registrar_sidebars()
{
    register_sidebar([
        'id' => 'sidebar',
        'name' => 'Sidebar',
        'description' => 'Espaço para widget sidebar ',
        'before_widget' => '<div class="widget-box">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ]);

    register_sidebar([
        'id' => 'sidebar-single',
        'name' => 'Sidebar single',
        'description' => 'Espaço para widget sidebar single',
        'before_widget' => '<div class="widget-box">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ]);
}

add_action('widgets_init', 'registrar_sidebars');

//ativar single.php para categorias
add_filter('single_template', function ($t) {
    foreach ((array)get_the_category() as $cat) {
        if (file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php"))
            return TEMPLATEPATH . "/single-{$cat->slug}.php";

        if ($cat->parent) {
            $cat = get_the_category_by_ID($cat->parent);

            if (@file_exists(TEMPLATEPATH . "/single-{@$cat->slug}.php"))
                return TEMPLATEPATH . "/single-{@$cat->slug}.php";
        }
    }

    return $t;
});

//separa templates de paginas por pasta
add_filter('page_template', function ($template) {
    global $post;

    if ($post->post_parent) {

        // get top level parent page
        $parent = get_post(
            @reset(array_reverse(get_post_ancestors($post->ID)))
        );

        // or ...
        // when you need closest parent post instead
        // $parent = get_post($post->post_parent);

        $child_template = locate_template(
            [
                $parent->post_name . '/page-' . $post->post_name . '.php',
                $parent->post_name . '/page-' . $post->ID . '.php',
                $parent->post_name . '/page.php',
            ]
        );

        if ($child_template)
            return $child_template;
    }

    return $template;
});

//Segurança
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

//funçoes uteis
function pegaMeioStr($inicio, $fim, $str)
{
    @$ex = explode($inicio, $str);
    @$ex2 = explode($fim, $ex[1]);

    return $ex2[0];
}

function get_attachment_url_by_slug($slug)
{
    $args = [
        'post_type' => 'attachment',
        'name' => sanitize_title($slug),
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    ];
    $_header = get_posts($args);
    $header = $_header ? array_pop($_header) : NULL;

    return $header ? wp_get_attachment_url($header->ID) : '';
}

function get_page_id_by_slug($page_slug)
{
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return NULL;
    }
}

function contato($nome, $email, $assunto, $mensagem)
{
    $headers = 'From: ' . $nome . ' <' . $email . '>' . "\r\n";
    $mensagem .= '<br /><br />Mensagem enviada via formulário de contato pelo site <i>' . bloginfo('name') . '</i>';
    wp_mail(get_bloginfo("admin_email"), $assunto, $mensagem, $headers);

    return true;
}

function api_request($request, $parametros, $single = false)
{
    $api_base_url = 'api-legacy.institutoprominas.com.br/ucam/';

    $url = "http://" . $api_base_url . $request . '/';

    if ($single)
        $url .= $parametros;
    else
        $url .= '?' . http_build_query($parametros, '', '&');

    $api_response = wp_remote_get($url);

    $response['headers'] = wp_remote_retrieve_headers($api_response);
    $response['data'] = @json_decode(wp_remote_retrieve_body($api_response), true)['data'];
    $response['status'] = wp_remote_retrieve_response_code($api_response);

    return $response;
}

//adiciona o css/js do tema ao header
add_action('wp_enqueue_scripts', function () {

    $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    echo '<link rel="alternate" hreflang="pt-br" href="' . $actual_link . '"/>';
    //echo '<meta name="google-site-verification" content="YnDXwMKnHyprtIWc3camrIJmbRxeGzOa10POlbZH9uo"/>';

    //scripts obrigatorios header
    //echo '<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>';
    //echo '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';

    echo '<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js"></script>';

    //wp_enqueue_style('webfont-loader', 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js', false, null, 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/libs/bootstrap/dist/css/bootstrap.min.css', false, NULL, 'all');
    wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.0.8/css/all.css', false, NULL, 'all');
    //wp_enqueue_style('font-awesome', get_template_directory_uri().'/libs/font-awesome-4.7.0/css/font-awesome.min.css', false, null, 'all');
    //wp_enqueue_style('font-Titillium', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,500,700', false, null, 'all');
    //wp_enqueue_style('font-Poppins', 'https://fonts.googleapis.com/css?family=Poppins:400,500,600,700', false, null, 'all');
    //wp_enqueue_style('slick-slider', get_template_directory_uri() . '/libs/slick-1.8.0/slick/slick.css', false,NULL, 'all');
    //wp_enqueue_style('slick-slider-theme', get_template_directory_uri() . '/libs/slick-1.8.0/slick/slick-theme
    //.css', false, NULL, 'all');
    //wp_enqueue_style('owl-slider', get_template_directory_uri() . '/libs/OwlCarousel2-2.2.1/dist/assets/owl.carousel.min.css', false, null, 'all');
    //wp_enqueue_style('owl-theme', get_template_directory_uri() . '/libs/OwlCarousel2-2.2.1/dist/assets/owl.theme.default.min.css', false, null, 'all');
    //wp_enqueue_style('datatables', 'https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css', false, null, 'all');
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/libs/jquery-ui-1.12.1/jquery-ui.min.css', false, NULL, 'all');
    //wp_enqueue_style('sweetalert', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.min.css', false, NULL, 'all');
    wp_enqueue_style('theme-style', get_stylesheet_uri(), false, NULL, 'all');
    //wp_enqueue_style('font-Lato', 'https://fonts.googleapis.com/css?family=Lato:400,700,900', false, NULL, 'all');

    wp_enqueue_script('jquery');
    //wp_dequeue_script('jquery');
    wp_enqueue_script('theme-js', get_template_directory_uri() . '/js/main.js', [], NULL, true);
    wp_enqueue_script('tether-js', get_template_directory_uri() . '/libs/tether-1.3.3/dist/js/tether.min.js', [], NULL, true);
    wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js', [], NULL, true);
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/libs/bootstrap/dist/js/bootstrap.min.js', [], NULL, true);
    //wp_enqueue_script('slick-slider-js', get_template_directory_uri() . '/libs/slick-1.8.0/slick/slick.min.js',[], NULL, true);
    //wp_enqueue_script('owl-js', get_template_directory_uri() . '/libs/OwlCarousel2-2.2.1/dist/owl.carousel.min', array(), null, true);
    //wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/v/bs4/dt-1.10.16/af-2.2.2/datatables.min.js', array(), null, true);
    wp_enqueue_script('jquery-ui-js', get_template_directory_uri() . '/libs/jquery-ui-1.12.1/jquery-ui.min.js', [], NULL, true);
    wp_enqueue_script('sweetalert-js', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js', [], NULL, true);

    if (is_home())
        add_action('wp_footer', function () {
            wp_dequeue_script('googlemaps-api');
        });
});

//texto do rodape admin
add_filter('admin_footer_text', function () {
    $my_theme = wp_get_theme();
    echo 'Desenvolvido por: ' . $my_theme->get('Author') . ' - <a href="mailto:wanber@outlook.com">wanber@outlook.com</a>';
});

//adiciona contador de visualizaçoes aos posts
add_action('wp_head', function ($post_id) {
    if (!is_single())
        return;

    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
});

//adiciona contador de comentarios e compartilhamentos do fb
add_action('wp_head', function ($post_id) {
    if (!is_single())
        return;

    if (empty ($post_id)) {
        global $post;
        $post_id = $post->ID;
    }

    $json = @file_get_contents('http://graph.facebook.com/' . get_the_permalink($post_id));
    $obj = @json_decode($json);

    $num_comentarios = @$obj->share->comment_count;
    $num_comp = @$obj->share->share_count;

    if (!is_numeric($num_comentarios) || !is_numeric($num_comp))
        return;

    $comen_key = 'wpb_fb_comments';
    $comp_key = 'wpb_fb_comp';

    $atual_coment_num = get_post_meta($post_id, $comen_key, true);
    $atual_comp_num = get_post_meta($post_id, $comp_key, true);

    if ($atual_coment_num == '') {
        delete_post_meta($post_id, $comen_key);
        add_post_meta($post_id, $comen_key, $num_comentarios);
    } else {
        update_post_meta($post_id, $comen_key, $num_comentarios);
    }
    if ($atual_comp_num == '') {
        delete_post_meta($post_id, $comp_key);
        add_post_meta($post_id, $comp_key, $num_comp);
    } else {
        update_post_meta($post_id, $comp_key, $num_comp);
    }
});

class CSS_Menu_Walker extends Walker
{
    var $db_fields = ['parent' => 'menu_item_parent', 'id' => 'db_id'];

    function start_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = [])
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {

        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? [] : (array)$item->classes;

        /* Add active class */
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
            unset($classes['current-menu-item']);
        }

        /* Check for children */
        $children = get_posts(['post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID]);
        if (!empty($children)) {
            $classes[] = 'has-sub';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names . '>';

        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '><span>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</span></a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $output .= "</li>\n";
    }
}