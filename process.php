<?php

// функция возвращает массив пользовательских данных из текстового файла и записывает его другой текстовый файл для работы с датами, если он еще не существует
function getUsersList() {

    $fileUsersDB = file("usersDB.txt");

    foreach ($fileUsersDB as $value) {

        $valueArr = explode(" ", $value);
        $item = array();
        $item['login'] = $valueArr[0];
        $item['password'] = $valueArr[1];
        $usersDB[] = $item;
    }

        if (!file_exists("arrayDate.txt")) {
        
            foreach ($usersDB as $value) {

                $value['date'] = '';
                $usersDBdate[] = $value;

            }

            $strValue = serialize($usersDBdate);
            $filename = "arrayDate.txt";
            $fileOpen = fopen($filename, 'w');
            fwrite($fileOpen, $strValue);
            fclose($fileOpen);
        }

    return $usersDB;

}

// Функция возвращает массив пользовательских данных из php файла, в котором указаны хеши паролей и сами пароли в виде комментания 

/* function getUsersList1() {

    require __DIR__ . '/usersDB.php';

    //print_r($usersDB);

    return $usersDB;
    
} */


// функция проверяет существование введенного логина
function existsUser($login) {

    return in_array($login, array_column(getUsersList(),'login'));

}

// функция проверяет существование пользователя и правильность введенного пароля
function checkPassword($login, $password) { 
    
    $users = getUsersList();
    $userPass = "";

    foreach ($users as $user) {    

        if ($login == $user['login']) {
            $userPass = $user['password'];
        }
    }
   
    if (true === existsUser($login)) {
        
        if ($password == $userPass) {
            return true;
        }
    }

        return false;

}

// функция возвращает либо логин вошедшего на сайт, либо null
function getCurrentUser() {

    $loginFromCookie = $_COOKIE['login'] ?? '';
    $passwordFromCookie = $_COOKIE['password'] ?? '';

    if (checkPassword($loginFromCookie, $passwordFromCookie)) {
        return $loginFromCookie;
    } else {
        return null;
    }
}

// функция записи даты в массив и затем в отдельный текстовый файл
function dateToFile($date) {

    $filename = "arrayDate.txt";
    $file = file_get_contents($filename);
    $users = unserialize($file);
    
    $login = getCurrentUser();

    $key = array_search($login, array_column($users, 'login'));
    $users[$key]['date'] = $date;
	$str_users = serialize($users);
	
	$fileOpen = fopen($filename, 'w');
	fwrite($fileOpen, $str_users);
	fclose($fileOpen);

}

// функция возвращает либо дату рождения входящего на сайт, либо null
function dateFromFile() {

        $file = file_get_contents("arrayDate.txt");
	    $users = unserialize($file);

        $key = array_search($_COOKIE['login'], array_column($users, 'login'));

        if ($date=$users[$key]['date']) {

        return $date;

        } 

       return null;

}