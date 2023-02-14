<!DOCTYPE html>

<?php
require __DIR__ . '/process.php';
$login = getCurrentUser();

if ($login) {
    header('Location: /index.php');  
}
?>

<?php
if (!empty($_POST)) {

    $login = $_POST['login'] ?? '';
    $password = SHA1($_POST['password']) ?? '';

    if (checkPassword($login, $password)) {

        session_start();
        $_SESSION['timer'] = time();

        setcookie('login', $login, time() + 86400);
        setcookie('password', $password, time() + 86400);
        header('Location: /privateoffice.php');
    } elseif (existsUser($login)) {
        $error = 'Неправильный пароль';
    }
    else {
        $error = 'Не существует такого пользователя';
    }
}
?>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Страница авторизации</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header><div class="container">
            <div class="logo"><a href="/index.php">Главная страница</a></div>
            <h1 class="caption">Демо-версия сайта для SPA-салона</h1>
            <nav>
                <br><a href="/index.php">Выйти</a>
            </nav> 
        </header>
        

        <h3>Форма авторизация</h3>
        <?php if (isset($error)): ?>
        <span style="color: red;">
        <?= $error ?>
        </span>
        <?php endif; ?>

        <form action="/login.php" method="post">
            <input name="login" type="text" placeholder="Логин" <?php if (isset($error)): ?> value = "<?= $login ?>" <?php endif; ?>>
            <input name="password" type="password" placeholder="Пароль">
            <input name="submit" type="submit" value="Войти">
        </form>

        <div>
        <h3>Наши услуги</h3>
        <p>Наш SPA-салон предлагает более десятка традиционных и авторских процедур для женщин и мужчин. Программы разработаны специально для жителей больших городов и удовлетворяют все потребности в уходе при активном образе жизни:</p>
        
        <ul>
        <li>Аюрведические процедуры полезны при бессоннице, тревожности, депрессии, хронической усталости.</li>
        <li>Омолаживающие СПА-программы помогают коже вернуть упругость, естественный цвет, тонус здорового организма.</li>
        <li>Увлажняющие и восстанавливающие процедуры для лица продлевают молодость любой женщины.</li>
        <li>Расслабляющий массаж для ног воздействует на все активные точки на стопах.</li>
        <li>СПА-программы в хаммаме стимулируют обменные процессы, укрепляют организм и избавляют от лишних килограммов.</li>
        </ul>
        <p>Хотите посещать наши СПА-процедуры со скидками и по акциям? Регистрируйтесь, приобретайте наши продукты, следите за акциями и специальными предложениями лично для Вас.</p>
        </div>
        
        <section class="salon">
                    <h3>Фото нашего салона</h3>
                <p class="salonimg">
                <img src="\IMG\Душ.jpg" alt="Фото салона" width="450" height="350">
                <img src="\IMG\Массаж.jpg" alt="Фото салона" width="450" height="350">
                </p>
        </section>

        <section class="promoting">
                    <h3 style="color: red;">Наши текущие акции для всех покупателей:</h3>
                    <ul>
                        <li>Тем, кто приобретает 10 сеансов массажа, в подарок идет бесплатный сеанс скраба</li>
                        <li>Наша джакузи бесплатна по записи для новых клиентов, кто приобретет одну из месячных программ до 01.03.2023</li>
                    </ul>
                <p class="promo">
                <img src="\IMG\Скраб.jpg" alt="Фото салона" width="450" height="350">
                <img src="\IMG\Джакузи.jpg" alt="Фото салона" width="450" height="350">
                </p>
        </section>

        <footer>
            <div class="links">
                <a href="/index.php">Главная</a>
            </div>
            <div class="copyright">Copyright &#169; SPA-салон 2023</div>
        </footer>
    </body>
</html>