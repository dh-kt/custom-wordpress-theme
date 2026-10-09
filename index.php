<?php get_header(); ?>

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
            aria-label="Slide 1"
        ></button>

        <button
            type="button"
            data-bs-target="#mainSlider"
            data-bs-slide-to="1"
            aria-label="Slide 2"
        ></button>

        <button
            type="button"
            data-bs-target="#mainSlider"
            data-bs-slide-to="2"
            aria-label="Slide 3"
        ></button>
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

                    <?php echo esc_url(
                        get_post_type_archive_link('equipment')
                    ); ?>" class="btn btn-warning">
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
   
