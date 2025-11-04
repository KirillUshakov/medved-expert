/**
 * Добавление отзыва
**/
$('#add_review').submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/wp-content/themes/walnutmaker/includes/add_review.php',
        data: $(this).serialize(),
        success: () => {
            console.log('Спасибо. Ваш отзыв отправлен.');
            $(this).trigger('reset'); // очищаем поля формы 
        },
        error: () => console.log('Ошибка отправки.');
    });
});