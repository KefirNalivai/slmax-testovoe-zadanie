<?php

class myclass1 {
	public $id;
    public $name;
    public $lastname;
   	public $datebirth;
    public $sex;
    public $city;
    public $database = 'testzadanie123';
    public $tablename = 'people';
    

    public function __construct($id, $name = null, $lastname= null, $datebirth= null, $sex= null, $city= null)
    {
    	
      if (null === $name && null === $lastname && null === $datebirth && null === $sex && null === $city) {
            $this->construct_add($id);
        } else {
            $this->construct_find($id, $name, $lastname, $datebirth, $sex, $city);
        }
    }

    


	private function construct_find($id, $name, $lastname, $datebirth, $sex, $city)
	{
			  $this->id = (int)$id;
		      $this->name = $name;
		      $this->lastname = $lastname;
		      $this->datebirth = $datebirth;
		      $this->sex = $sex;
		      $this->city = $city;
		$conn = mysqli_connect("localhost", "root", "", $this->database);

    	$query = "SELECT * FROM `$this->tablename` WHERE id = {$id}";
    	 $result = mysqli_query($conn,$query);
    	 if(mysqli_num_rows($result) != 0) 
    	 {
    	 	echo "Данный id уже есть в базе<br>";
    	 	 
    	 }
    	 else
    	 {
				
		      $this->save();
  		 }
    }

    private function construct_add($id)
    {
    	
    	$conn = mysqli_connect("localhost", "root", "", $this->database);

    	$query = "SELECT * FROM `$this->tablename` WHERE id = {$id}";
    	 $result = mysqli_query($conn,$query);
    	 if(mysqli_num_rows($result) == 0) 
    	 {
    	 	echo "Не найден человек<br>";
    	 }
    	 else
    	 {
    	  while ($row = mysqli_fetch_array($result))
			{
			    $this->id = (int)$row['id'];
      			$this->name = $row['name'];
      			$this->lastname = $row['lastname'];
      			$this->datebirth = $row['bithday'];
      			$this->sex = $row['sex'];
      			$this->city = $row['City'];
			}
			echo "Запись в базе найдена.<br>";
		}
    }    

    function save() 
    {     
    	$conn = mysqli_connect("localhost", "root", "", $this->database);
		if (preg_match("/[^А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z\-_]+/", $this->name) || preg_match("/[^А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z\-_]+/", $this->lastname)) 
				{
				 	echo "Имя и фамилия должны содержать только буквы!<br>";
				}
				else
				{
					$conn = mysqli_connect("localhost", "root", "", $this->database);

		    	$query = "SELECT * FROM `$this->tablename` WHERE id = {$this->id}";
		    	 $result = mysqli_query($conn,$query);
		    	 if(mysqli_num_rows($result) == 0) 
		    	 {
		    	 	$query = "INSERT INTO `$this->tablename` VALUES('{$this->id}', '{$this->name}', '{$this->lastname}', '{$this->datebirth}', '{$this->sex}', '{$this->city}')";
			    	 $result = mysqli_query($conn,$query);
				      if ($result){
				        echo("Запись добавлена<br>");
				      } 
				      else 
				      {
				        echo("Произошла ошибка при добавлении человека<br>");
				        print_r(mysqli_error_list($conn));
				      }
		    	 }
		    	 else
		    	 {
		    	 	echo "Человек с id ". $this->id . " уже есть в базе!<br>"; 
		    	 }
			    	 
				}
		    	 
    }

    function del() 
    {
     
      
    	$conn = mysqli_connect("localhost", "root", "", $this->database);

    	$query = "DELETE FROM `$this->tablename` WHERE id = {$this->id}";
    	 $result = mysqli_query($conn,$query);
	      if ($result){
	        echo("Запись удалена<br>");
	      } 
	      else {
	        print_r(mysqli_error_list($conn));
	      }
    }

    static public function DateToYears($daybirdth)
    {

    	$date1 = new DateTime($daybirdth);
		$date2 = new DateTime();
		return $date1->diff($date2)->format("%y");
  	}

  	static public function numberToStr($numb)
    {
		return $numb == 0 ? 'муж' : 'жен';
  	}

  	function change($id = null, $name = null, $lastname= null, $datebirth= null, $sex= null, $city= null)
	{
		if(empty($id))
		{
			
			$id = $this->id;
		}
		
		if(!empty($name))
		{
			if (preg_match("/[^А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z\-_]+/", $name)) 
				{
				 	echo("Имя должно содержать только буквы!");
				 	return;
				}
			
		}
		else
		{
			$name = $this->name;
		}
		if(!empty($lastname))
		{
			if (preg_match("/[^А-ЯабвгдежзиклмнопрстуфхцчщъыьэюяёЁйЙa-zA-Z\-_]+/", $lastname)) 
				{
				 	echo("Фамилия должна содержать только буквы!");

				 	return;
				}
				
		}
		else
		{
			$lastname = $this->lastname;
		}
		if(!empty($sex))
		{
			if($sex == 'муж' || $sex == 'жен')
			{
				
				$sex = $sex == 'муж' ? 0 : 1;
			}
		}
		else
		{
			$sex = $this->sex;
		}
		if(empty($datebirth))
		{
			
			$datebirth = $this->datebirth;
		}
		if(empty($city))
		{
			
			$city = $this->city;
		}
		
		return new myclass1($id, $name, $lastname, $datebirth, $sex, $city);
		
		
		
	       
	      
	}

}


?>