<?php

class Config
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "student_management_system";
    private $connection;

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->dbname);
        // if ($response) {  
        //     echo "Databse connect successfully !";
        // } else {
        //     echo "Failed to connect to database !";
        // }
    }

    public function __construct()
    {
        $this->connect();
    }

    public function insertData($name, $grade, $course, $phone)
    {
        $query = "INSERT INTO student(name,grade,course,phone) VALUES('$name','$grade','$course',$phone)";

        $response = mysqli_query($this->connection, $query);

         return $response;
        //below condition for database. 
        // if ($response) {
        //     echo "Data inserted successfully!";
        // } else {
        //     echo "Failed to insert in database !";
        // }
    }

    public function getData()
    {
        $query = "SELECT * FROM student";
        $response = mysqli_query($this->connection, $query);
        // $data = mysqli_fetch_assoc($response);// convert ---------> object to map
        return $response;
    }

    public function deleteData($id)
    {
        $query = "DELETE FROM student WHERE id = $id";
        $response = mysqli_query($this->connection, $query);
        return $response;
    }

    public function updateData($id, $name, $grade, $course, $phone)
    {
        $query = "UPDATE student SET name = '$name', grade = '$grade', course = '$course', phone = $phone WHERE id = $id";
        $response = mysqli_query($this->connection,$query);
        return $response;
    }
}
