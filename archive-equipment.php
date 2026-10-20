<?php get_header(); ?>

<div class="container py-5">

    <h1 class="mb-4">Каталог техники</h1>

    <div class="row g-4">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="col-md-6 col-lg-4">
            <div class="card h-100">

                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                <?php endif; ?>

                <div class="card-body">
                    <h5><?php the_title(); ?></h5>

                    <p><?php the_excerpt(); ?></p>
					<p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-warning">
                            Подробнее
                        </a>
                    </p>
                </div>

            </div>
        </div>

    <?php endwhile; else : ?>

        <p>Техника не найдена.</p>

    <?php endif; ?>

    </div>

</div>

<?php get_footer(); ?>