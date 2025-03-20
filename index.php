<?php
    include_once('./db.php');

    class User {
        public $login;
        public $pass;
        public $email;


        public function __construct($login, $pass, $email){
            $this->login = $login;
            $this->pass = $pass;
            $this->email = $email;
        }
        
        function Show()
        {
            echo "
            <div>
                $this->login
            <br/>
                $this->pass
            <br/>
                $this->email
            </div>";
        }

        function ToDB()
        {
            $db = new DB();
            $query = $db->connect('localhost', 'root', 'root', 'works');

            $stmt = $quer->prepare("INSERT INTO User (Login, Email, Password) VALUES (:login, :email, :password)");

            $stmt->execute([
                ':login' => $this->login,
                ':email' => $this->email,
                ':password' => password_hash($this->pass, PASSWORD_DEFAULT) // Хешируем пароль
            ]);
        }
       
    }

    if(!isset($_POST["submit"])) {
        $arr = [$_POST['Login'], $_POST['Email'], $_POST['Pass']];
        $objUser = new User($arr[0], $arr[1], $arr[2]);
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <input type="text" name="Login" value="<? if(isset($objUser)) echo $objUser->login  ?>" placeholder="Login">
        <input type="email" name="Email" value="<? if(isset($objUser)) echo $objUser->email ?>" placeholder="Email">
        <input type="password" name="Pass" placeholder="Password">

        <input type="submit" value="отправить">
    </form>
    <br/>

    <?php
    if(isset($objUser)){
        $objUser->ToDB();
        $objUser->Show();
    }
    ?>
</body>
</html>
