<?php
//class to connect to the database
class Dbh
{
    /// store database info into variables
    private $serverName = "localhost";
    private $dbName = "zuri";
    private $userName = "root";
    private $password = "";

    //method to connect to database
    protected function connect()
    {
        //Data Source Name
        $dsn = "mysql:host={$this->serverName};dbname={$this->dbName}";
        $conn = new PDO($dsn, $this->userName, $this->password);
        $conn->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC,
        );
        //echo "Connected Successfully";
        return $conn;
    }
}

////////////////--------------------User Class ------------------/////////////////
class User extends Dbh
{
    public $errorMessage;
    public function register($request)
    {
        $username = $request['username'];
        $password = $request['password'];
        $password = md5($password);
        try {

            $conn = $this->connect();
            $sql = "INSERT INTO user (username, password)
            VALUES ('$username', '$password')";
            // use exec() because no results are returned
            $conn->exec($sql);
        } catch (PDOException $e) {
            $this->errorMessage =  $e->getMessage();
        }

        $conn = null;
    }


    public function login($request)
    {

        $username = test_input($request['username']);
        $password = test_input($request['password']);
        $password = md5($password);
        try {

            $conn = $this->connect();
            $sql = "SELECT * FROM user WHERE username = ? AND password = ? ";
            //send the request to the db 
            $stmt = $conn->prepare($sql);
            //execute the prepared statement;
            $stmt->execute([$username, $password]);
            //and fetch the result in a form of assoc array
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $this->errorMessage =  $e->getMessage();
        }

        $conn = null;
    }


    public function index($id)
    {

        $id = test_input($id);
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT id, username, password FROM user WHERE  id= $id");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll();
            //print_r($result);
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    public function resetPassword($newPassword, $id)
    {
        $id = test_input($id);
        $newPassword = test_input($newPassword);
        $newPassword = md5($newPassword);

        try {
            $conn = $this->connect();
            $sql = "UPDATE user SET password='$newPassword' WHERE id='$id'";
            // Prepare statement
            $stmt = $conn->prepare($sql);

            // execute the query
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }


    public function validate($request)
    {
        $username = test_input($request['username']);
        $password = test_input($request['username']);

        if ($username == "" || $password == "") {
            $this->errorMessage = "All Fields are required";
            return $this->errorMessage;
        }
    }
}

//////----------------------- Courses Class ----------------------/////////////////////
class Courses extends Dbh
{
    public function show()
    {
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT course_id, course_name FROM courses");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    public function create($request)
    {
        $newCourse = test_input($request);
        try {
            $conn = $this->connect();
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO courses (course_name)
                    VALUES (:course_name)");
            $stmt->bindParam(':course_name', $newCourse);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    public function index($id)
    {

        $id = test_input($id);
        try {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT course_id, course_name  FROM courses WHERE  course_id='$id'");
            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->fetchAll();
            //print_r($result);
            return $result[0];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }


    public function delete($id)
    {

        $id = test_input($id);
        try {
            $conn = $this->connect();
            // sql to delete a record
            $sql = "DELETE FROM courses WHERE course_id='$id'";

            // use exec() because no results are returned
            $conn->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }

    public function update($name, $id)
    {

        $name = test_input($name);
        $id = test_input($id);
        try {
            $conn = $this->connect();
            // sql to update a record
            $sql = "UPDATE courses SET course_name='$name' WHERE course_id='$id'";

            // use exec() because no results are returned
            $conn->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
}




//clean the user's input
function test_input($val)
{
    //remove all spaces before and after the string;
    $val = trim($val);
    //remove backslashes
    $val = stripslashes(($val));
    //converts some predefined characters to html entities 
    $val = htmlspecialchars($val);

    // retrun the clean input
    return $val;
}
