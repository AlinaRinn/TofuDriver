<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');
$CDataBase = new CDataBase;
$ID = htmlspecialchars($_POST["delbox"]);
$pass = htmlspecialchars($_POST["pass"]);
require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/header.php');
if ($pass == "322228"){
    $CDataBase->Delete('car_order', $ID);
    //$CDataBase->DeleteWithkey('car_order','car_order_times', $ID);
    echo '<br>' . 'Заявка удалена';
}
else{
    echo '<br>' . 'Пароль неверен';
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/footer.php');
