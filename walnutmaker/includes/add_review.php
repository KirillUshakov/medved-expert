<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Проверка того, что есть данные из капчи
if (!$_POST["g-recaptcha-response"]) {
    // Если данных нет, то программа останавливается и выводит ошибку
    exit("Ошибка. Капча не заполнена");
} else { // Иначе создаём запрос для проверки капчи
    // URL куда отправлять запрос для проверки
    $url = "https://www.google.com/recaptcha/api/siteverify";
    // Ключ для сервера
    $key = "6LdFM9weAAAAAChaqJY7oKhPAozTYsewIRl5b2lj";
    // Данные для запроса
    $query = array(
        "secret" => $key, // Ключ для сервера
        "response" => $_POST["g-recaptcha-response"], // Данные от капчи
        "remoteip" => $_SERVER['REMOTE_ADDR'] // Адрес сервера
    );
 
    // Создаём запрос для отправки
    $ch = curl_init();
    // Настраиваем запрос 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query); 
    // отправляет и возвращает данные
    $data = json_decode(curl_exec($ch), $assoc=true); 
    // Закрытие соединения
    curl_close($ch);
 
    // Если нет success то
    if (!$data['success']) {
        // Останавливает программу и выводит "ВЫ РОБОТ"
        exit("Ошибка. Вы робот");
    } else {
        // Подключаем необходимые файлы 
        require_once( $_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );

        // Получение отправленных данных 
        $user_name    = trim($_POST['name']);
        $user_message = trim($_POST['message']);
        $user_rating  = trim($_POST['rating']);
        // $review_type = trim($_POST['review_type']); # можно передать термин таксономии 

        $post_data = array(
            'post_author'   => 1,
            'post_status'   => 'pending',               # статус - «На утверждении» 
            'post_type'     => 'reviews',               # тип записи - «Отзывы» 
            'post_title'    => 'Отзыв - ' . $user_name, # заголовок отзыва 
            'post_content'  => $user_message,           # текст отзыва 
            // 'tax_input' => ['{Название таксономии}' => array($review_type)], 
        );

        // Вставляем запись в базу данных 
        $post_id = wp_insert_post( $post_data );

        // Добавляем остальные поля 
        update_field( 'rejting', $user_rating, $post_id ); # рейтинг 
        update_field( 'name', $user_name, $post_id );      # имя 

        // Необходимо для записи таксономии «tax_input» 
        // wp_set_object_terms( $post_id, $review_type, '{Название таксономии}' );
    }
}
echo 'Отзыв отправлен на проверку';

