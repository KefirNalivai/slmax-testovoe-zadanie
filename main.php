

<?php

include 'class1.php';
include 'class2.php';
echo "Класс 1<br>";
echo "<b>Испытание 1: ищем в базе подав только id в класс <br></b>";
$b = new myclass1(4);
echo "<br>";
echo ("id: " . $b->id);
echo "<br>";
echo ("Имя: " . $b->name);
echo "<br>";
echo ("Фамилия: " . $b->lastname);
echo "<br>";
echo ("Полных лет: " . $b::DateToYears($b->datebirth));
echo "<br>";
echo ("Пол: " . $b->sex . " (".$b::numberToStr($b->sex).")");
echo "<br>";
echo ("Город: " . $b->city);
echo "<br><br>";

echo "<b>Испытание 2: создаём новую запись подав в класс все параметры <br></b>";
$b = new myclass1(11,"Тестовое", "Тестовая", "2001-12-07",1,'Minsk');
echo "<br>";
echo ("id: " . $b->id);
echo "<br>";
echo ("Имя: " . $b->name);
echo "<br>";
echo ("Фамилия: " . $b->lastname);
echo "<br>";
echo ("Полных лет: " . $b::DateToYears($b->datebirth));
echo "<br>";
echo ("Пол: " . $b->sex . " (".$b::numberToStr($b->sex).")");
echo "<br>";
echo ("Город: " . $b->city);
echo "<br><br>";

echo "<b>Испытание 3: создаём класс со всеми параметрами но в имени есть цифры (что впринципе недопустимо, значение в базу не вносится) <br></b>";
$b = new myclass1(12,"Тестовое1", "Тестовая2", "2001-12-07",1,'Minsk');
echo "<br><br>";

echo "<b>Испытание 4: пытаемся повторно создать значение класса из испытания 2. В базу не оно не вносится из - за уже наличия id <br></b>";
$b = new myclass1(11,"Тестовое", "Тестовая", "2001-12-07",1,'Minsk');
echo "<br>";
echo ("id: " . $b->id);
echo "<br>";
echo ("Имя: " . $b->name);
echo "<br>";
echo ("Фамилия: " . $b->lastname);
echo "<br>";
echo ("Полных лет: " . $b::DateToYears($b->datebirth));
echo "<br>";
echo ("Пол: " . $b->sex . " (".$b::numberToStr($b->sex).")");
echo "<br>";
echo ("Город: " . $b->city);
echo "<br><br>";

echo "<b>Испытание 5: удаление записи из испытания 2 через метод класса <br></b>";
$b->del();
echo "<br><br>";

echo "<b>Испытание 6: создаём класс из испытания 2 опять, меняем его значения через методж change, и новый класс присваивается другой переменной. Далее новая переменная сохраняется через конструктор в бд. На всякий случай пробуем сохранить новый класс через метод save, о он уже сохранен конструктором. <br></b>";
$b = new myclass1(11,"Тестовое", "Тестовая", "2001-12-07",1,'Minsk');
$b2 = $b->change(12,"Измен","Измен","",0,"");
$b2->save();
echo "<br><br>";

echo "Класс 2<br>";
echo "<b>Испытание 7:  создаём второй класс путем добавления в параметр любого текста, числа. Код находит в БД все совпадения внутри каждого столбца и выводит id найденных записей в массив <br></b>";
echo "id найденных значений: ";
$b2 = new myclass2('Min');
for($i=0;$i < count($b2->peoplуid); $i++)
      {
        echo $b2->peoplуid[$i] . " ";
        
      }
echo "<br><br>";

echo "<b>Испытание 8:  получение массива экземляров класса 1 по id полученных в конструкторе в испытании 7 <br></b>";
echo "Найденые люди: <br>";
$b2->toInfoMassive();
for($i=0;$i < count($b2->peoplуid); $i++)
      {
        echo $i+1 . ". " . $b2->peoplуinfo[$i]->id . " | " . $b2->peoplуinfo[$i]->name . " | " . $b2->peoplуinfo[$i]->lastname . " | " . $b2->peoplуinfo[$i]->datebirth . " | " . $b2->peoplуinfo[$i]::numberToStr($b2->peoplуinfo[$i]->sex) . " | " . $b2->peoplуinfo[$i]->city . "<br>";
        
      }
echo "<br><br>";

echo "<b>Испытание 9:  удаления всех экземпляров класса 1 найденных в массиве класса 2 <br></b>";
$b2->delMassive();


?>

