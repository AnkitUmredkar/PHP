<?php


class MyConfig
{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "student_management_system";
    private $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
    }

    public function uploadImage($name, $path)
    {
        $query = "INSERT INTO gallery (name, path) VALUES ('$name', '$path')";
        $response = mysqli_query($this->connection, $query);
        return $response;
    }

    public function getAllImages(){
        $query = "SELECT * FROM gallery";
        $response = mysqli_query($this->connection, $query);
        return $response;
    }
	
	public function fetchImage($id){
        $query = "SELECT * FROM gallery WHERE id = $id";
        $response = mysqli_query($this->connection, $query);
        return $response;
    }

    public function deleteImage($id){
		$image = $this->fetchImage($id);
		$fileName = mysqli_fetch_assoc($image);//$image["path"];
		$status = unlink($fileName["path"]);
		if($status)
		{
			$query = "DELETE FROM gallery WHERE id = $id";
			mysqli_query($this->connection, $query);
		}
    }
}
