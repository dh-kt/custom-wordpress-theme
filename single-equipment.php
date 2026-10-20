<?php get_header(); ?>

<div class="container py-5">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <?php if (has_post_thumbnail()) : ?>
        <div style="margin:20px 0;">
            <?php the_post_thumbnail('large', array(
                'class' => 'img-fluid'
            )); ?>
        </div>
    <?php endif; ?>

    <p>
        <strong>Цена:</strong>
        <?php echo get_post_meta(
            get_the_ID(),
            '_equipment_price',
            true
        ); ?>
        ₽/час
    </p>

    <p>
        <strong>Наличие:</strong>
        <?php echo get_post_meta(
            get_the_ID(),
            '_equipment_availability',
            true
        ); ?>
    </p>

    <div>
        <?php the_content(); ?>
    </div>

    <p style="margin-top:30px;">
         <a href="<?php echo get_post_type_archive_link('equipment'); ?>">
            ← Назад к каталогу
        </a>
    </p>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>