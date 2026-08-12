<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name ="viewport" content="width = device-width, initial-scale=1.0">
        <title><?php wp_title(); ?></title>
        
        <!-- Bootstrap CSS  -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <?php wp_head(); ?>  
    </head>
    <body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <!-- Brand/Logo -->
            <a class="navbar-brand" href="#">СпецТехника</a>
            
            <!-- Toggler (hamburger) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Каталог</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Контакты</a>
                    </li>
                </ul>
                
                <!-- Phone and Button -->
                <div class="d-flex ms-auto">
                    <a href="#" class="btn btn-outline-warning me-2">+7 (999) 123-45-67</a>
                    <a href="#" class="btn btn-warning">Заказать</a>
                </div>
            </div>
        </div>
    </nav>