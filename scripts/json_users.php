<?php

/*
$conn = mysqli_connect("localhost", "root", "", 'belem.ru_drupal');
if ($conn === false) {
    die("Ошибка: " . mysqli_connect_error());
}
echo "Подключение успешно установлено";


$sql = "SELECT * FROM users WHERE `pass` != '' LIMIT 5";

$result = mysqli_query($conn, $sql);

$arrau = [];
while ($row = mysqli_fetch_array($result)) {
    $arrau[] = [
        'id' => $row['uid'],
        'name' => $row['name'],
    ];
}

file_put_contents('scripts/users.json', json_encode($arrau));

mysqli_close($conn);*/

//222

$conn = mysqli_connect("localhost", "root", "", 'belem.ru_site');
if ($conn === false) {
    die("Ошибка: " . mysqli_connect_error());
}
echo "Подключение успешно установлено";

$users = file_get_contents('scripts/users.json');

$i = 1;
foreach (json_decode($users, true) as $item){
    echo $item['name'];
    echo '<br>';

    $id = $item['id'];
    $name = $item['name'];
    $email = 'asdasqwe'. $i .'@yandex.ru';
    $sql = "INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES ( '". $id ."', '".  $name ."' , '". $email ."' , '12345667890')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $i++;
}





