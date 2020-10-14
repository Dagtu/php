<?php
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
    $age = filter_var(trim($_POST['age']), FILTER_SANITIZE_STRING);
    

    $filter_age = array('options' => array('min_range' => 1 , 'max_range' => 100 ) );
  
    if (!isset($name) or mb_strlen($name) > 30 or !preg_match( "/^[a-zа-яё\s]+$/iu",$name) ) {
    	echo "Имя не может быть пустым или содержать больше 30 символов, может содержать буквы английского и русского алфавита";
    } elseif (!isset($phone) or !preg_match("/^(\s*)?(\+)?([- ()+]?\d[- ()+]?){10,14}(\s*)?$/", $phone)) {
    	echo "Некорректное значение 'номер телефона' ";
    } elseif (!isset($age) or !filter_var($age, FILTER_VALIDATE_INT , $filter_age)) {
    	echo "Некорректное значение 'Возраст' ";
    } else {
    	echo "Проверка данных прошла успешно";
    }
?>