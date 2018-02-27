<?php get_header(); ?>

    <section class="breadc" style="margin-top: 176px">
        <div class="breadcrumb container">
            <div class="row">
                <div class="col">
                    <h1>
						<?php _e('Pesquisar', 'prominas-theme'); ?> &quot;<?php the_search_query(); ?>&quot;
                    </h1>
                    <span class="linha"></span>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-12 col-lg-8">

				<?php if (have_posts()) : ?>

					<?php while (have_posts()) : the_post(); ?>

						<?php get_template_part('content', 'list'); ?>

					<?php endwhile; ?>

                    <div class="row bt-pagina">
                        <div class="col">
							<?php echo paginate_links() ?>
                        </div>
                    </div>

				<?php else : get_template_part('content', 'none'); endif; ?>

            </div>

            <div class="col-12 col-lg-4">
				<?php get_sidebar(); ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>