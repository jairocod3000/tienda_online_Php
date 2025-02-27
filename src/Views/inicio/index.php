<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tienda Online</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/inicio.css">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/footer.css">
</head>
<body>
<section><br><br><br><br><br>
    <h1>Inicio</h1>
    <div class="product-carousel">
        <div class="carousel-tracks">
            <?php foreach ($productos as $producto): ?>
                <div class="carousel-item" id="item-<?= $producto['id'] ?>">
                    <a href="<?=BASE_URL?>producto/verDetalles/?id=<?=$producto['id']?>">
                        <img src="<?=BASE_URL?>img/<?=$producto['imagen']?>" class="product-image">
                    </a>
                    <h3 class="product-name"><?=$producto['nombre']?></h3>
                    <h2 class="product-price"><?=$producto['precio']?>€</h2>
                </div>
            <?php endforeach;?>
        </div>
        <button class="carousel-prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="carousel-next" onclick="changeSlide(1)">&#10095;</button>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentIndex = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;

        function changeSlide(direction) {
            slides[currentIndex].style.display = 'none';
            currentIndex += direction;
            if (currentIndex >= totalSlides) {
                currentIndex = 0;
            } else if (currentIndex < 0) {
                currentIndex = totalSlides - 1;
            }
            slides[currentIndex].style.display = 'block';
        }

        slides.forEach(slide => slide.style.display = 'none');
        slides[0].style.display = 'block';

        document.querySelector('.carousel-prev').addEventListener('click', function() {
            changeSlide(-1);
        });
        document.querySelector('.carousel-next').addEventListener('click', function() {
            changeSlide(1);
        });
    });
</script>

</body>