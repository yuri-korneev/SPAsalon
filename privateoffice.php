<!DOCTYPE html>

<?php
require __DIR__ . '/process.php';
$login = getCurrentUser();
?>

<?php
if (!empty($_POST)) {
    $date = $_POST['date'];
    dateToFile($date);
}

?>

<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Личный кабинет</title>
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

            <?php if ($login === null) {
                header('Location: /login.php');
            }
            else ?> 
            <h2>Ваш личный кабинет, <span style="color: blue;"> <?= $login ?></span>!</h2>
        

        <?php if (dateFromFile() == null): ?>

        <form action="/privateoffice.php" method="post">
            <label for="date">Дата рождения: </label>
            <input name="date" type="date">
            <input name="submit" type="submit" value="Отправить">
        </form>

        <?php else: ?>
            <h3>Ваша дата рождения: <?= dateFromFile() ?></h3>
        <?php endif; ?>

        <footer>
            <div class="links">
                <a href="/index.php">Главная</a>
            </div>
            <div class="copyright">Copyright &#169; SPA-салон 2023</div>
        </footer>
    </body>
</html>