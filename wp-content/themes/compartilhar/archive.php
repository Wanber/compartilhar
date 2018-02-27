<?php get_header(); ?>

<?php $queried_object = get_queried_object(); ?>

    <section class="breadc" style="margin-top: 176px">
        <div class="breadcrumb container">
            <div class="row">
                <div class="col">
                    <h1><?php echo $queried_object->name ?></h1>
                    <span class="linha"></span>
                    <p></p>
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

					<?php wp_reset_postdata(); ?>

				<?php else: ?>
					<?php get_template_part('content', 'none') ?>
				<?php endif; ?>

            </div>

            <!--sidebar-->
            <div class="col-12 col-lg-4">
				<?php get_sidebar() ?>
            </div>

        </div>

    </section>

<?php get_footer(); ?>