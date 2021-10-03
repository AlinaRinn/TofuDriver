<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');
$CDataBase = new CDataBase;
$Name = htmlspecialchars($_POST["name"]);
$RequiredCar = htmlspecialchars($_POST["order"]);
$ContactNumber = htmlspecialchars($_POST["info"]);
$CDataBase->Insert('car_order', $Name, $RequiredCar, $ContactNumber);
$CDataBase->InsertTimeInCarsTime();
require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/header.php');
echo '<br>' . 'Заявка отправлена. Скоро с вами свяжется наш оператор ' . '<div style="font-size: xxx-large">&#10084;</div>' . '<br>';
require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/footer.php');