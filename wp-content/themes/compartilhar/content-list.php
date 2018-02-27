<?php $excluded_post_categories = ['DADOS DO CURSO']; ?>
<?php $excluded_categories_list = ['BLOG', 'NOTÍCIAS']; ?>

<?php $categories = get_the_category(); ?>

<?php foreach ($categories as $category)
	if (in_array($category->name, $excluded_post_categories)) return; ?>

<?php $thumb = get_the_post_thumbnail_url('', 'content-list'); ?>

<article <?php post_class('article'); ?> id="post-<?php the_ID(); ?>" itemscope
                                         itemtype="http://schema.org/CreativeWork">
    <div class="box-post">
        <div class="row">
            <div class="col-12 col-md-5">
                <div class="image-post"><a href="<?php the_permalink() ?>">
                        <img src="<?php echo $thumb ?>"/></a>
                </div>
            </div>
            <div class="col-12 col-md-7">
				<?php foreach ($categories as $category) : ?>
					<?php if (in_array($category->name, $excluded_categories_list)) continue; ?>
                    <h5 class="categoria-post">
                        <a href="<?php echo get_category_link($category->cat_ID) ?>">
							<?php echo $category->name ?>
                        </a>
                    </h5>
				<?php endforeach; ?>

                <h1 class="titulo-post">
                    <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                </h1>
                <a href="<?php the_permalink() ?>">
                    <p class="resumo-post">
						<?php echo wp_trim_words(get_the_excerpt(), 30) ?>
                    </p>
                </a>
                <span class="author">
                    <img class="icon"
                         src="<?php echo get_template_directory_uri() ?>/images/Entypo+/user.svg"
                         alt="User">
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
                        <?php the_author() ?>
                    </a>
                </span>
                <span class="data">
                    <img class="icon"
                         src="<?php echo get_template_directory_uri() ?>/images/Entypo+/clock.svg"
                         alt="User">
					<?php echo get_the_date('d M, Y') ?>
                </span>
            </div>
        </div>
    </div>

</article><!-- .article -->