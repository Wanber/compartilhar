<?php acf_form_head(); ?>
<?php get_header(); ?>

    <style>
        #message {
            background: #208a20b3;
            color: white;
            font-weight: 100;
            padding: 15px 10px 1px 10px;
            text-align: center;
        }
    </style>

<?php
acf_form(array(
    'post_id' => 'new_post',
    'post_title' => true,
    'post_content' => false,
    'new_post' => array(
        'post_type' => 'empresas',
        'post_status' => 'pending'
    ),
    'submit_value' => 'Cadastrar',
    'updated_message' => 'Empresa cadastrada!<br/>Agora é só esperar ela ser aprovada e aparecerá para toda nossa comunidade<br/>:D'
));
?>

<?php get_footer() ?>