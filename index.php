<!DOCTYPE html>

<?php
session_start();
require __DIR__ . '/process.php';
$login = getCurrentUser();
?>

<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>SPA-салон</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <header><div class="container">
            <div class="logo"><a href="/index.php">Главная страница</a></div>

            <h1 class="caption">Демо-версия сайта для SPA-салона</h1>

            <?php if ($login === null): ?>

            <nav>
                <br><a href="/login.php">Авторизация</a>
            </nav>   

            <?php else: ?>

            <nav>
                <br><a href="/login.php">Авторизация</a>
                <br><a href="/privateoffice.php">Личный кабинет</a>
                <br><a href="/logout.php">Выйти</a>
            </nav> 

            </div>
        </header>

            <div>

            <?php 
            
            if ($login) {

                $birthday = dateFromFile(); 
                $arr = explode('-', $birthday);
                $timeTillBirthday = mktime(23, 59, 59, $arr[1], $arr[2], date('Y'));
                $nowDate = time();
                $secondsRemaining = $timeTillBirthday - $nowDate;

                if (floor($timeTillBirthday / 86400) > floor($nowDate / 86400)) {

                    $daysRemaining = floor($secondsRemaining / 86400); 
                    echo "<div class=\"birthday\"><b>$login</b>, до Вашего Дня рождения осталось <b>$daysRemaining</b> дней</div>"; 

                } elseif (floor($timeTillBirthday / 86400) < floor($nowDate / 86400)) {

                    $timeTillBirthday = mktime(0, 0, 0, $arr[1], $arr[2], date('Y') + 1);
                    $nowDate = time();
                    $secondsRemaining = $timeTillBirthday - $nowDate;
                    $daysRemaining = round($secondsRemaining / 86400); 
                    echo "<div class=\"birthday\"><br><b>$login</b>, до Вашего Дня рождения осталось <b>$daysRemaining</b> дней</div>"; 

                } elseif (floor($timeTillBirthday / 86400) == floor($nowDate / 86400)) {
                    echo "<div class=\"birthday\"<br>Поздравляем, у Вас сегодня День рождения!<br>Сегодня действует для Вас индивидуальня скидка <b>5%</b> на все услуги салона.</div>"; 
                }

            }
        ?>

            <div class="login"><p><b>Добро пожаловать на сайт, <?= $login ?>!</b></p></div>

                Спасибо, что Вы с нами! Вам предоставляется персональная скидка <b>10%</b>, успейте приобрести услуги с Вашей скидкой до конца ее действия.
            <?php 
                    $endOfDiscount = $_SESSION['timer'] + 86400; 
                    $nowTime = time();
                    $secondsRemaining = $endOfDiscount - $nowTime; 
                    define('SECONDS_PER_MINUTE', 60); 
                    define('SECONDS_PER_HOUR', 3600); 
                
                    $hoursRemaining = floor($secondsRemaining / SECONDS_PER_HOUR); 
                    $secondsRemaining -= ($hoursRemaining * SECONDS_PER_HOUR);     
                
                    $minutesRemaining = floor($secondsRemaining / SECONDS_PER_MINUTE); 
                    $secondsRemaining -= ($minutesRemaining * SECONDS_PER_MINUTE);    

                    echo("<br>Ваша персональная скидка действует еще <b>$hoursRemaining</b> часов, <b>$minutesRemaining</b> минут, <b>$secondsRemaining</b> секунды");

                ?>
         
         <?php endif; ?>
           
         </div>
           
         <section class="salon">
                    <h3>Фото нашего салона</h3>
                <p class="salonimg">
                <img src="\IMG\Душ.jpg" alt="Фото салона" width="450" height="350">
                <img src="\IMG\Массаж.jpg" alt="Фото салона" width="450" height="350">
                </p>
        </section>

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
        </div>
        
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