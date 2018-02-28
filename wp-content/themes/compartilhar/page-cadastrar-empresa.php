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

        .acf-field input[type="text"], .acf-field input[type="password"], .acf-field input[type="number"], .acf-field input[type="search"], .acf-field input[type="email"], .acf-field input[type="url"], .acf-field textarea, .acf-field select {
            width: 100%;
            padding: 7px 12px;
            resize: none;
            margin: 0;
            box-sizing: border-box;
            font-size: 14px;
            line-height: 1.4;
            border: 1px solid #ededed;
            border-radius: 6px;
            font-weight: 100;
        }

        .acf-input-wrap input[type="text"], .acf-field input[type="password"], .acf-field input[type="number"], .acf-field input[type="search"], .acf-field input[type="email"], .acf-field input[type="url"], .acf-field textarea, .acf-field select {
            height: auto;
        }

        .acf-button.button.button-primary.button-large {
            background: rgb(32, 52, 64);
            border: none;
            font-weight: 100;
            color: white;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        a.acf-button.button {
            background: #8d8d8d;
            padding: 8px;
            text-decoration: none;
            color: white;
            border-radius: 4px;
            font-weight: 100;
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