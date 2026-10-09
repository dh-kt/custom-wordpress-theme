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
                        $
