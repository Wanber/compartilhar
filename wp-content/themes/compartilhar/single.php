<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <section class="container menu-blog-space">

        <div class="row">

            <div class="col-12 banner-center d-none d-md-block">
				<?php echo do_shortcode('[wp_bannerize_pro numbers="1" orderby="random" categories="blog-interno"]') ?>
            </div>

            <div class="col-12 col-lg-8">

				<?php while (have_posts()) : the_post(); ?>

                    <article <?php post_class('article hentry'); ?> id="post-<?php the_ID(); ?>" itemscope
                                                                    itemtype="http://schema.org/Article">
                        <h3 class="post-title"><?php the_title() ?></h3>

                        <div class="blog-tags">
							<?php if ($cats = get_the_category()) : ?>

                                <span>
                                    <?php foreach ($cats as $cat) : ?>
                                        <a href="<?php echo get_term_link($cat) ?>">
                                            <?php echo $cat->name ?>
                                        </a>
									<?php endforeach; ?>
                                </span>

							<?php endif; ?>
                        </div>

                        <img class="single-featured" src="<?php echo get_the_post_thumbnail_url() ?>">

                        <p><?php the_content() ?></p>

                        <hr class="clearfix" />

                        <div class="social-share"><?php echo do_shortcode('[wpusb]') ?></div>

                        <div class="tag-blog-info text-center">
							<?php if ($tags = get_the_tags()) : ?>
                                Tags:
                                <span class="span-blog-tags">
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="<?php echo get_term_link($tag) ?>">
                                            <?php echo $tag->name ?>
                                        </a>
									<?php endforeach; ?>
                                 </span>

							<?php endif; ?>
                        </div>

                        <div class="author-p">
                            <div class="row">
                                <div class="avatar-author col-3 d-none d-sm-block"><?php echo get_avatar(get_the_author_meta('user_email'), $size = '150'); ?></div>
                                <div class="col-9">
                                    <h3 class="authorperfil">
                                        Autor:
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
											<?php the_author() ?>
                                        </a>
                                    </h3>
                                    <p><?php the_author_meta('description') ?></p>

                                    <div class="author-redes">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr />

						<?php comments_template() ?>

                    </article>

				<?php endwhile; ?>

            </div>

            <div class="col-12 col-lg-4">
				<?php get_sidebar('single') ?>
            </div>

        </div>

    </section>

<?php endif; ?>

<?php get_template_part('script', 'copy-protection') ?>

<?php get_footer(); ?>