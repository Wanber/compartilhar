<?php get_header('blog'); ?>

<?php $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); ?>

    <section class="breadc" style="margin-top: 176px">
        <div class="breadcrumb container">
            <div class="row">
                <div class="col">
                    <h1><?php echo $curauth->display_name ?></h1>
                    <span class="linha"></span>
                    <p>
						<?php if (get_the_author_meta('facebook') != NULL) : ?>
                            <a href="<?php the_author_meta('facebook') ?>" target="_blank">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
						<?php endif; ?>
						<?php if (get_the_author_meta('twitter') != NULL) : ?>
                            <a href="<?php the_author_meta('twitter') ?>" target="_blank">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
						<?php endif; ?>
						<?php if (get_the_author_meta('instagram') != NULL) : ?>
                            <a href="<?php the_author_meta('instagram') ?>" target="_blank">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
						<?php endif; ?>
						<?php if (get_the_author_meta('linkedin') != NULL) : ?>
                            <a href="<?php the_author_meta('linkedin') ?>" target="_blank">
                                <i class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
						<?php endif; ?>
						<?php if (get_the_author_meta('email') != NULL) : ?>
                            <a href="mailto:<?php the_author_meta('email') ?>">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </a>
						<?php endif; ?>
                    </p>
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
				<?php get_sidebar('blog') ?>
            </div>

        </div>

    </section>

<?php get_footer('blog'); ?>