<?php 
// Class that is used to connect to database
class Connection 
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'skandiweb_task_db';
    public $conn;

    // Connect to database
    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        }
        catch(Exception $e)
        {
            error_log($e->getMessage());
            exit('Connecting to database failed. Please contact site administrator.');
        }
        return $this->conn;
    }

    // Get data from database
    protected function getDataFromDB($stmt)
    {
        $result= $this->conn->query($stmt);
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_object())
            {
                $rows[] = $row;
            }
            return $rows;
        }
    }

    // Input data to database
    protected function addProducts($stmt)
    {
        // if ($stmt->execute() === TRUE)
        // {
        //     $stmt->close();
        //     $this->success = header('Location: index.php');
        //     return $this->success;
        // }
        // else
        // {
        //     $this->error = $this->conn->error;
        // }
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try {
            $stmt->execute();
            $stmt->close();
            $this->success = header('Location: index.php');
        }
        catch(Exception $e)
        {
            error_log($e->getMessage());
            $this->error = $this->conn->error;
        }
    }

    // Delete data from database
    protected function deleteProducts($stmt)
    {
        if ($this->conn->query($stmt) === TRUE)
        {
            return $this->success;
            $this->success = header('Location: index.php');
        }
        else
        {
            $this->error = $this->conn->error;
        }
    }
}