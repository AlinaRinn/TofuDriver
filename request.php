<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/functions/FFunc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');
?>

    <form action="functions/request_sorted.php" method="post" style="margin-top: 30px; margin-bottom: 30px; margin-left: 10px; float: left">
        <label>Сортировка:
            <select name="sort">
                <option value="1">Имя А-Я</option>
                <option value="2">Имя Я-А</option>
                <option value="3">Машина</option>
                <option value="4">Время ранее</option>
                <option value="5">Время позднее</option>
            </select>
        </label>
        <label>
            <button type="submit" name="send" style="font-family: inherit; font-weight: inherit; font-size: inherit; padding: inherit; background-color: inherit; border: 2px gray solid; color: inherit; margin: inherit; width: 30px">   >   </button>
        </label>
    </form>

<?php
$CDataBase = new CDataBase;
$BD_string = array();
$Sort = 0;
$BD_string = $CDataBase->selectAll('car_order', $Sort);

$table = '<table><tr style="font-weight: bold"><td class="req">Идентификатор</td><td class="req">Имя</td><td class="req">Заказ</td><td class="req">Контактная информация</td><td class="req">Время подачи</td></tr>';
foreach ($BD_string as $mi) {
    $table .= '<tr>';
    foreach($mi as $my)
    {
        $table .= '<td class="req">' .$my .'</td>';
    }
    $table .= '</tr>';
}
$table .= '</table>';
echo $table;

?>

    <form action="functions/post.php" method="post" style="margin-top: 50px">
        <p style="font-weight: bold; margin-bottom: 30px">Подать заявку на приобретение</p>
        <ul>
            <li>
                <label>Ваше имя: <input type="text" name="name" value="" required/></label>
            </li>

            <li>
                <label>Автомобиль: <select name="order">
                        <option value="Toyota AE86 Trueno">Toyota AE86 Trueno</option>
                        <option value="Mitsubishi Lanser 10 Evo">Mitsubishi Lanser 10 Evo</option>
                        <option value="Toyota Supra A80 (Gen. 4)">Toyota Supra A80 (Gen. 4)</option>
                        <option value="Nissan Skyline R34">Nissan Skyline R34</option>
                        <option value="Dodge charger 1969">Dodge charger 1969</option>
                        <option value="DeLorean DMC-12">DeLorean DMC-12</option>
                        <option value="Dodge Charger Daytona 1969">Dodge Charger Daytona 1969</option>
                        <option value="ZAZ - 968">ZAZ - 968</option>
                        <option value="Другой">Другой</option></select>
                </label>
            </li>

            <li>
                <label> Контактная информация: <input type="text" name="info" value="" required/></label>
            </li>

            <li>
                <button type="submit" name="send" value="Отправить">Отправить</button>
            </li>
        </ul>
    </form>

    <form action="functions/del.php" method="post">
        <label>ID: <input type="text" name="delbox" value=""/></label>
        <label>Pass: <input type="text" name="pass" value=""/></label>
        <button type="submit" name="delete">Удалить</button>
    </form>

<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/layouts/footer.php');
