<?php

class myclass2 {
    public $peoplуid = array();
    public $peoplуinfo = array();
    public $database = 'testzadanie123';
    public $tablename = 'people';
    

    public function __construct($zn = null)
    {
      if (!class_exists('myclass1')) {
        echo "Класс не существует";
      }
      else
      if (null === $zn ) {
            echo("Вы не ввели значение для поиска. Были выбраны все записи из бд");
            $conn = mysqli_connect("localhost", "root", "", $this->database);
            $query = "SELECT * FROM `$this->tablename`";
            $result = mysqli_query($conn,$query);
             while ($row = mysqli_fetch_array($result))
            {
                  $this->peoplуid[] = $row['id'];

            }
        } 
        else 
        {
           echo("Вы ввели значение для поиска.");
            $conn = mysqli_connect("localhost", "root", "", $this->database);
            $query = "SELECT * FROM `$this->tablename` WHERE id LIKE '%{$zn}%' or name LIKE '%{$zn}%' or lastname LIKE '%{$zn}%' or bithday LIKE '%{$zn}%' or sex LIKE '%{$zn}%' or city LIKE '%{$zn}%'";
            $result = mysqli_query($conn,$query);
             while ($row = mysqli_fetch_array($result))
            {
                  $this->peoplуid[] = $row['id'];
            }
        }
    }

    function toInfoMassive()
    {
      if(count($this->peoplуid) == 0)
      {
        echo("Вы ничего не искали, нечего инициализировать из массива id");
        return;
      }
      for($i=0;$i < count($this->peoplуid); $i++)
      {
        $this->peoplуinfo[] = new myclass1($this->peoplуid[$i]);
        
      }
      //echo($this->peoplуinfo[0]->datebirth);
    }
    
    function delMassive()
    {
      if(count($this->peoplуinfo) == 0)
      {
        echo("Массив данных пуст, удалять нечего");
        return;
      }
      for($i=0;$i < count($this->peoplуinfo); $i++)
      {
        $this->peoplуinfo[$i]->del();
        
      }
      echo("Все данные успешно удалены");
      //echo($this->peoplуinfo[0]->datebirth);
    }

  

}


?>