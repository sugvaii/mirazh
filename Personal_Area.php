<?php
session_start();

// Проверяем, что пользователь авторизован
if (!isset($_SESSION['loggedin'])) {
    header('Location: authorization.html');
    exit();
}

// Далее идет содержимое вашей личной страницы или административной области

// Пример вывода данных из сессии
$surname = $_SESSION['surname'];
$name = $_SESSION['name'];
$patronymic = $_SESSION['patronymic'];
$phone = $_SESSION['phone'];
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mirazh</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="header__logo">
          <a href="index.html">
            <img src="log.png" alt="Новый логотип" class="header__logo-image">
          </a>
          <p class="header__subtitle">территория красивых людей</p>
        </div>
        <nav class="header__nav">
          <ul class="header__nav-list">
            <li class="header__nav-item"><a href="#" class="header__nav-link" style="text-decoration: none;;color: #000; background-color: #667FFF; padding: 5px; border-radius: 5px;">Личный кабинет</a></li>
          </ul>
        </nav>
        <div class="header__buttons">
          <button id="callSalonButton" class="header__buttons__button">Позвонить в салон</button>
          <button id="personalAccountButton" class="header__buttons__button" onclick="openNewPage()">Личный кабинет</button>
          <img src="zvon.png" alt="Позвонить в салон" class="header__buttons__image" id="callSalonImage" onclick="callSalon()">
          <img src="User.png" alt="Личный кабинет" class="header__buttons__image" onclick="openNewPage()">
        </div>
      </header>
          <script>
            
            function openNewPage() {
              // Замените "new-page.html" на путь к вашей HTML странице
              window.location.href = "authorization.html";
            }
          
      document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("custom-modal");
        const openModalBtn = document.getElementById("callSalonButton");
        const openModalImg = document.getElementById("callSalonImage"); // Добавили изображение
        const closeModalBtn = document.getElementById("custom-close-modal");
      
        function openModal() {
          modal.style.display = "block";
        }
      
        openModalBtn.addEventListener("click", openModal);
        openModalImg.addEventListener("click", openModal); // Добавили слушатель события для изображения
      
        closeModalBtn.addEventListener("click", function() {
          modal.style.display = "none";
        });
      
        window.addEventListener("click", function(event) {
          if (event.target === modal) {
            modal.style.display = "none";
          }
        });
      });
            </script>
    
  
     
    <div class="personal-data">
        <h2 class="personal-data__title">Личные данные</h2>
        <form class="personal-data__form">
            <div class="personal-data__fields">
                <div class="personal-data__field">
                    <div class="personal-data__input-container">

                        <input type="text" id="surname" class="personal-data__input" placeholder="Фамилия" value="<?php echo htmlspecialchars($_SESSION['surname']); ?>" readonly />
                        <div class="personal-data__input-line"></div>
                    </div>
                </div>
                <div class="personal-data__field">
                    <div class="personal-data__input-container">

                        <input type="text" id="name" class="personal-data__input" placeholder="Имя" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly />
                        <div class="personal-data__input-line"></div>
                    </div>
                </div>
                <div class="personal-data__field">
                    <div class="personal-data__input-container">

                        <input type="text" id="patronymic" class="personal-data__input" placeholder="Очетсво" value="<?php echo htmlspecialchars($_SESSION['patronymic']); ?>" readonly />
                        <div class="personal-data__input-line"></div>
                    </div>
                </div>
                <div class="personal-data__field">
                    <div class="personal-data__input-container">

                        <input type="tel" id="phone" class="personal-data__input" placeholder="Номер телефона" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" readonly />
                        <div class="personal-data__input-line"></div>
                    </div>
                </div>
                <div class="personal-data__field">
                    <div class="personal-data__input-container">

                        <input type="email" id="email" class="personal-data__input" placeholder="Электронная почта" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" readonly />
                        <div class="personal-data__input-line"></div>

                    </div>
                </div>
            </div>
            <div class="personal-data__photo">
                <div class="personal-data__photo-placeholder">+</div>
                <label for="photo" class="personal-data__photo-label">Фото профиля</label>
                <input type="file" id="photo" class="personal-data__photo-input" />
            </div>
        </form>
    </div> 

      

    <footer class="footer">
        <div class="footer__column footer__column--about">
            <h3 class="footer__title">О нас</h3>
            <ul class="footer__list">
                <li class="footer__item"><a href="index.html" class="footer__link">История развития</a></li>
                <li class="footer__item"><a href="index.html" class="footer__link">Сфера деятельности</a></li>
                <li class="footer__item"><a href="index.html" class="footer__link">Достижения</a></li>
                <li class="footer__item"><a href="index.html" class="footer__link">Преимущества компании</a></li>
                <li class="footer__item"><a href="index.html" class="footer__link">Контакты</a></li>
            </ul>
        </div>
        <div class="footer__column footer__column--services">
            <h3 class="footer__title">Услуги</h3>
            <ul class="footer__list">
                <li class="footer__item"><a href="Yslygi.html" class="footer__link">Парикмахер</a></li>
                <li class="footer__item"><a href="Yslygi.html" class="footer__link">Ногтевой сервис</a></li>
                <li class="footer__item"><a href="Yslygi.html" class="footer__link">Макияж</a></li>
                <li class="footer__item"><a href="Yslygi.html" class="footer__link">Косметология</a></li>
                <li class="footer__item"><a href="Yslygi.html" class="footer__link">Уход за телом</a></li>
            </ul>
        </div>
        <div class="footer__column footer__column--blog">
            <h3 class="footer__title">Блог</h3>
            <ul class="footer__list">
                <li class="footer__item"><a href="blog.html" class="footer__link">Статьи</a></li>
                <li class="footer__item"><a href="blog.html" class="footer__link">Отзывы</a></li>
                <li class="footer__item"><a href="blog.html" class="footer__link">Новости</a></li>
                <li class="footer__item"><a href="blog.html" class="footer__link">Акции</a></li>
                <li class="footer__item"><a href="blog.html" class="footer__link">Обучение</a></li>
            </ul>
        </div>
        <div class="footer__column footer__column--social">
          <h3 class="footer__title">Мы в соц.сетях</h3>
            <div class="footer__social-icons">
                <a href="#" class="footer__social-link"><img src="Screenshot 2024-06-18 131306.png" alt="Instagram"></a>
                <a href="#" class="footer__social-link"><img src="vk.png" alt="VK"></a>
                <a href="#" class="footer__social-link"><img src="Screenshot 2024-06-18 131415.png" alt="Telegram"></a>
            </div>
        </div>
        <div class="footer__bottom">
            <p class="footer__copyright" >©2024 Mirazh. Все права защищены.</p>
        </div>
      </footer>

</body>
</html>
      