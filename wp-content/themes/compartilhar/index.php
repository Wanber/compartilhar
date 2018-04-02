<?php get_header(); ?>

    <section class="slider">
        <?php echo do_shortcode('[rev_slider alias="home"]') ?>
    </section>

    <section class="sec-comunidade">
        <div class="container">

            <div class="row">

                <div class="col-12 col-md-5">
                    <h5>COMUNIDADE COMPARTILHAR</h5>

                    <div class="row">

                        <div class="media col">
                            <img class="align-self-center mr-3"
                                 src="<?php echo get_template_directory_uri() . '/images/compartilhar.png' ?>">
                            <div class="media-body">
                                <p class="mb-0">
                                    Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo.
                                </p>
                            </div>
                        </div>

                        <div class="media col">
                            <img class="align-self-center mr-3"
                                 src="<?php echo get_template_directory_uri() . '/images/compartilhar.png' ?>">
                            <div class="media-body">
                                <p class="mb-0">
                                    Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo.
                                </p>
                            </div>
                        </div>

                        <div class="media col">
                            <img class="align-self-center mr-3"
                                 src="<?php echo get_template_directory_uri() . '/images/compartilhar.png' ?>">
                            <div class="media-body">
                                <p class="mb-0">
                                    Donec sed odio dui. Nullam quis risus eget urna mollis ornare vel eu leo.
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-12 col-md-7">
                    <img src="<?php echo get_template_directory_uri() . '/images/bg1.png' ?>" style="max-width: 100%">
                </div>

            </div>

        </div>
    </section>

<?php get_footer() ?>