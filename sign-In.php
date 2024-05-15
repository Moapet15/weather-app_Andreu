<?php
    session_start();

    if (isset($_POST['login']))
    {
        signIn();
    }

    if (isset($_POST['signedOut'])) 
    {
        dropSigned();
    }

    function signIn()
    {
        try
        {
            $user = $_POST['user'];
            $password = $_POST['password'];
    
            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = "MoapetS15";
            $dbname = "weatherapp";
            $dbport = "3306";

            if (checkSigned() != TRUE)
            {
                echo "L'usuari ja existeix";
            }
            else
            {
                echo "Podem crear l'usuari";
                $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, $dbport);
            
                $sql = "INSERT INTO `user` (`name`, `password`) VALUES ('$user', '$password')";
                $result = $conn->query($sql);
                
                if ($conn->affected_rows > 0) 
                {
                    echo "Sign-In Ok!";
                }
                else 
                {
                    echo "Sign-In K.O!";
                }
                $conn->close();
            }

        }
        catch (Exception $e) 
        {
            $errores = "Hay que revisar esos puntos : <br> " . $e->getMessage();
        }
    }

    function checkSigned()
    {
        try
        {
            $user = $_POST['user'];
            $password = $_POST['password'];

            $dbservername = "localhost";
            $dbusername = "root";
            $dbpassword = "MoapetS15";
            $dbname = "weatherapp";
            $dbport = "3306";

            $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, $dbport);
            
            $sql = "SELECT name, password FROM user WHERE name= '" . $user . "';";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
                while ($row = $result->fetch_assoc()) 
                {
                    if ($row["password"] == $password)
                    {
                        $_SESSION['signed'] = TRUE;
                        $_SESSION['user'] = $user;
                    } 
                    else 
                    {
                        echo "User not authenticated";
                    }
                }
                return FALSE;
            }
            $conn->close();
        }
        catch (Exception $e) 
        {
            $errores = "Hay que revisar esos puntos : <br> " . $e->getMessage();
        }
    }

    function dropSigned()
    {
        echo "Sign-out in...";
        $user = $_POST['user'];
        $password = $_POST['password'];

        $dbservername = "localhost";
        $dbusername = "root";
        $dbpassword = "MoapetS15";
        $dbname = "weatherapp";
        $dbport = "3306";

        $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname, $dbport);
        
        $sql = "DELETE FROM user WHERE name = '$user' AND password = '$password'";
        $result = $conn->query($sql);
    }

    function logout()
    {
        session_unset();
        session_destroy();
    }
?>
