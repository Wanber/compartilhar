<?php get_header() ?>
<?php
acf_form(array(
    'post_id'		=> 'new_post',
    'post_title'	=> true,
    'post_content'	=> true,
    'new_post'		=> array(
        'post_type'		=> 'empresas',
        'post_status'	=> 'publish'
    ),
    'submit_value'	=> 'Enviar'
));
?>
<?php get_footer() ?>
