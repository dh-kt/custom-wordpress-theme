<?php get_header(); ?>

<?php
$equipment_archive_url = get_post_type_archive_link('equipment');

if (!$equipment_archive_url) {
    $equipment_archive_url = home_url('/');
}
?>

<!-- Slider / Carousel -->
<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">

    <!-- Indicators -->
    <div class="carousel-indicators">
        <button
            type="button"
            data-bs-target="#mainSlider"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1">
        </button>

        <button
            type="button"
            data-bs-target="#mainSlider"
            data-bs-slide-to="1"
            aria-label="Slide 2">
        </button>

        <button
            type="button"
            data-bs-target="#mainSlider"
            data-bs-slide-to="2"
            aria-label="Slide 3">
        </button>
    </div>

    <!-- Slides -->
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div
                style="
                    height: 500px;
                    background: linear-gradient(
                        135deg,
                        #667eea 0%,
                        #764ba2 100%
                    );
                "
            >
                <div class="carousel-caption">

                    <h1>Аренда спецтехники</h1>

                    <p>
                        Широкий выбор экскаваторов,
                        бульдозеров и кранов
                    </p>

                    <?php echo esc_url($equipment_archive_url); ?>                        class="btn btn-warning"
                    >
                        Подобрать технику
                    </a>

                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div
                style="
                    height: 500px;
                    background: linear-gradient(
                        135deg,
                        #f093fb 0%,
                        #f5576c 100%
                    );
                "
            >
                <div class="carousel-caption">

                    <h1>Продажа с гарантией</h1>

                    <p>
                        Новая и б/у техника
                        от проверенных поставщиков
                    </p>

                     ?>"
                        class="btn btn-warning"
                    >
                        Смотреть каталог
                    </a>

                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <div
                style="
                    height: 500px;
                    background: linear-gradient(
                        135deg,
                        #4facfe 0%,
                        #00f2fe 100%
                    );
                "
            >
                <div class="carousel-caption">

                    <h1>Сервис и ремонт</h1>

                    <p>
                        Профессиональное обслуживание
                        любой техники
                    </p>

                    #
                        Записаться
                    </a>

                </div>
            </div>
        </div>

    </div>

    <!-- Previous -->
    <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#mainSlider"
        data-bs-slide="prev"
    >
        <span
            class="carousel-control-prev-icon"
            aria-hidden="true"
        ></span>

        <span class="visually-hidden">
            Previous
        </span>
    </button>

    <!-- Next -->
    <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#mainSlider"
        data-bs-slide="next"
    >
        <span
            class="carousel-control-next-icon"
            aria-hidden="true"
        ></span>

        <span class="visually-hidden">
            Next
        </span>
    </button>

</div>


<!-- Popular Equipment Section -->
<section class="py-5">

    <div class="container">

        <h2 class="text-center mb-4">
            Популярная спецтехника
        </h2>

        <div class="row g-4">

            <?php

            $equipment_query = new WP_Query(
                array(
                    'post_type'      => 'equipment',
                    'post_status'    => 'publish',
                    'posts_per_page' => 4,
                )
            );

            if ($equipment_query->have_posts()) :

                while ($equipment_query->have_posts()) :

                    $equipment_query->the_post();

                    $price = get_post_meta(
                        get_the_ID(),
                        '_equipment_price',
                        true
                    );

                    $availability = get_post_meta(
                        get_the_ID(),
                        '_equipment_availability',
                        true
                    );

                    if ($availability === 'В наличии') {
                        $badge_class = 'bg-success';
                    } elseif ($availability === 'Под заказ') {
                        $badge_class = 'bg-warning text-dark';
                    } else {
                        $badge_class = 'bg-secondary';
                    }

            ?>

                    <div class="col-12 col-sm-6 col-lg-3">

                        <div class="card h-100 shadow-sm">

                            <?php if (has_post_thumbnail()) : ?>

                                <?php
                                the_post_thumbnail(
                                    'medium',
                                    array(
                                        'class' => 'card-img-top',
                                    )
                                );
                                ?>

                            <?php else : ?>

                                <div
                                    class="card-img-top text-center py-5 bg-light"
                                    style="font-size: 80px;"
                                >
                                    🚜
                                </div>

                            <?php endif; ?>

                            <div class="card-body">

                                <h5 class="card-title">
                                    <?php the_title(); ?>
                                </h5>

                                <p class="card-text text-muted">
                                    <?php
                                    echo esc_html(
                                        get_the_excerpt()
                                    );
                                    ?>
                                </p>

                                <?php if ($price !== '') : ?>

                                    <p class="fw-bold text-success">
                                        от
                                        <?php
                                        echo esc_html(
                                            number_format_i18n(
                                                (int) $price
                                            )
                                        );
                                        ?>
                                        ₽/час
                                    </p>

                                <?php endif; ?>

                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                        align-items-center
                                    "
                                >

                                    <?php if ($availability !== '') : ?>

                                        <span
                                            class="badge <?php
                                            echo esc_attr(
                                                $badge_class
                                            );
                                            ?>"
                                        >
                                            <?php
                                            echo esc_html(
                                                $availability
                                            );
                                            ?>
                                        </span>

                                    <?php endif; ?>

                                                                            );
                                        ?>"
                                        class="
                                            btn
                                            btn-sm
                                            btn-outline-warning
                                        "
                                    >
                                        Подробнее
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

            <?php

                endwhile;

                wp_reset_postdata();

            else :

            ?>

                <div class="col-12">
                    <p class="text-center">
                        Техника пока не добавлена.
                    </p>
                </div>

            <?php endif; ?>

        </div>

        <!-- View All Equipment -->
        <div class="text-center mt-5">

             ?>"
                class="btn btn-warning btn-lg"
            >
                Смотреть всю технику →
            </a>

        </div>

    </div>

</section>

<?php get_footer(); ?>
