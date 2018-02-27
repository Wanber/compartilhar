<?php get_header(); ?>

<?php if (have_posts()) : ?>

	<?php while (have_posts()) : the_post(); ?>

		<?php $breadcrumb = get_field('image_breadcrumb', get_the_ID()) ?>

        <section class="breadc"
			<?php if ($breadcrumb != '') : ?>
                style="background-image: url(<?php echo $breadcrumb ?>)"
			<?php else: ?>
                style="background-image: url(<?php the_field('imagem_breadcrumb_padrao', get_page_id_by_slug('cursos')) ?>)"
			<?php endif; ?>>>
            <div class="breadcrumb container">
                <div class="row">
                    <div class="col"><h1><?php the_title() ?></h1><span class="linha"></span>
                        <p><?php the_field('descricao_pagina') ?></p></div>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row">
                <div class="col-12 col-md-12">
					<?php the_content() ?>
                </div>
            </div>
        </section>

	<?php endwhile; ?>

<?php else: ?>
    <p>Nenhum post encontrado!</p>
<?php endif; ?>

<?php get_footer(); ?>