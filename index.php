<?php get_header(); ?>
 <!-- Slider/Carousel -->
<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">
    
    <!-- Indicators (dots) -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#mainSlider" data-bs-slide-to="2"></button>
    </div>
    
    <!-- Slides -->
    <div class="carousel-inner">
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div style="height: 500px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="carousel-caption">
                    <h1>Аренда спецтехники</h1>
                    <p>Широкий выбор экскаваторов, бульдозеров и кранов</p>
                    <a href="#" class="btn btn-warning">Подобрать технику</a>
                </div>
            </div>
        </div>
        
        <!-- Slide 2 -->
        <div class="carousel-item">
            <div style="height: 500px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <div class="carousel-caption">
                    <h1>Продажа с гарантией</h1>
                    <p>Новая и б/у техника от проверенных поставщиков</p>
                    <a href="#" class="btn btn-warning">Смотреть каталог</a>
                </div>
            </div>
        </div>
        
        <!-- Slide 3 -->
        <div class="carousel-item">
            <div style="height: 500px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <div class="carousel-caption">
                    <h1>Сервис и ремонт</h1>
                    <p>Профессиональное обслуживание любой техники</p>
                    <a href="#" class="btn btn-warning">Записаться</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Popular Equipment Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Популярная спецтехника</h2>
        
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-top text-center py-5 bg-light" style="font-size: 80px;">
                        🚜
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Экскаватор E-200</h5>
                        <p class="card-text text-muted">Грузоподъемность: 2т</p>
                        <p class="fw-bold text-success">от 2 500 ₽/час</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning text-dark">В наличии</span>
                            <a href="#" class="btn btn-sm btn-outline-warning">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-top text-center py-5 bg-light" style="font-size: 80px;">
                        🏗️
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Башенный кран КБ-403</h5>
                        <p class="card-text text-muted">Грузоподъемность: 8т</p>
                        <p class="fw-bold text-success">от 4 800 ₽/час</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning text-dark">В наличии</span>
                            <a href="#" class="btn btn-sm btn-outline-warning">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-top text-center py-5 bg-light" style="font-size: 80px;">
                        🚛
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Самосвал КамАЗ-6520</h5>
                        <p class="card-text text-muted">Грузоподъемность: 20т</p>
                        <p class="fw-bold text-success">от 3 200 ₽/час</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-warning text-dark">В наличии</span>
                            <a href="#" class="btn btn-sm btn-outline-warning">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-img-top text-center py-5 bg-light" style="font-size: 80px;">
                        🚧
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Бульдозер ДЗ-171</h5>
                        <p class="card-text text-muted">Мощность: 180 л.с.</p>
                        <p class="fw-bold text-success">от 5 000 ₽/час</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-success">Под заказ</span>
                            <a href="#" class="btn btn-sm btn-outline-warning">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- View All Button -->
        <div class="text-center mt-5">
            <a href="#" class="btn btn-warning btn-lg">Смотреть всю технику →</a>
        </div>
    </div>
</section>
<?php get_footer(); ?>