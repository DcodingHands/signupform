<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require_once 'database.php';
    class User extends Database{
        //insert user
        public function SaveUser($username,$email,$password){
            $sql = "INSERT INTO users(username,email,pword) VALUES(:username,:email,:pword)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'username'=>$username,
                'email'=>$email,
                'pword'=>$password
            ]);
            return true;
        }
        //check if email exists
        public function email_exists($email){
            $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(is_array($result) && count($result) >0){
                return $result;
            }else {
                return false;
            }
        }
        //update user info
        public function SaveToken($token,$token_expire,$email){
            $sql = "UPDATE users SET token =:token, expired = :token_expire WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'token'=>$token,
                'token_expire'=>$token_expire,
                'email'=>$email
            ]);
            return true;
        }
        //register user
        public function Register(){
            if(isset($_POST['Register'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];
                $validUsername = "/^[A-Za-z]{1}[A-Za-z0-9]{2,20}$/";
                $validPassword = "/^(?=.*[!£%^&#-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/"; 
               if(empty($username) ||empty($email) ||empty($password) ||empty($cpassword)){
                   echo 'All fields are required!';
               }elseif (!preg_match($validUsername,$username)) {
                   echo 'A valid username is required!';
               }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                echo 'A valid email is required!';
               }elseif($this->email_exists($email)){
                   echo 'Email already exists';
               }elseif(!preg_match($validPassword,$password)){
                   echo 'Password must contain numbers, letters, special chars and must be at least 8 chars long!';
               }elseif($cpassword != $password){
                   echo 'The two passwords do not match';
               }else{
                   $hashpassword = password_hash($password,PASSWORD_DEFAULT);
                   if($this->SaveUser($username,$email, $hashpassword)){
                       header('Location: login.php');
                   }else{
                       echo 'registration was not successful!';
                   }
               }
            }
        }
        //login user
        public function Login(){
            if(isset($_POST['Login'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                if(empty($email)||empty($password)){
                    echo 'All fields are required!';
                }elseif(!$this->email_exists($email)){
                    echo 'Wrong email or password!';
                }else{
                    $data = $this->email_exists($email);
                    if(password_verify($password,$data['pword'])){
                        $_SESSION['username'] = $data['username'];
                        header('Location: index.php');
                    }else{
                        echo 'Wrong Password';
                    }
                }
            }
        }
        //send token 
        public function SendEmail($to,$sub,$msg){
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'youremailaddress.com';                     //SMTP username
                $mail->Password   = 'yourpassword';//type your email password                               //SMTP password
                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('youremailaddress.com', 'DcodingHands');
                $mail->addAddress($to, 'Joe User');     //Add a recipient
               
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $sub;
                $mail->Body    = $msg;
               

                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        //forgot password
        public function forgotpassword(){
            if(isset($_POST['Forgotpassword'])){
                $email = $_POST['email'];
                if(empty($email)){
                    echo 'An email is required to reset password';
                }elseif(!$this->email_exists($email)){
                    echo $email.' is not registered!';
                }else{
                    $_SESSION['email'] = $email;//store the user email in a session
                    $token = rand(1000,9999);// generating random 4 digit number
                    $token_expire = time() + (60 * 5); //token expired after 5 minutes
                    $this->SaveToken($token,$token_expire,$email);
                    $this->SendEmail($email,'Password Reset','To reset your password enter'.' '.$token);
                    header('Location: token.php');
                }
            }
        }
        //get token from db
        public function getToken($token){
            $sql = "SELECT * FROM users WHERE token = :token LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['token'=>$token]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(is_array($result) && count($result) >0){
                return $result;
            }else {
                return false;
            } 
        }
        // token
        public function Token(){
            if(isset($_POST['Token'])){
                $token = $_POST['token'];
                if(empty($token)){
                    echo 'Token is required to reset passwod';
                }elseif(!$this->getToken($token)){
                    echo 'Wrong Token!';
                }else{
                    $token_expire = time();// the current time
                    $check =$this->getToken($token)['expired']; //here get the time token was send. remember that the token expire after 5minute once continue button is clicked
                    if($check < $token_expire){//comparing the two times to see if it has pass 5minutes  
                        echo 'Sorry the Token has expired!';
                    }else{
                        header('Location: newpassword.php');
                    }
                }
            }
        }
        // up date passwod
        public function Updatepassword($password,$email){
            $sql = "UPDATE users SET pword =:pass WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'pass'=>$password,
                'email'=>$email
            ]);
            return true;
        }
        // newpassword
        public function newpassword(){
            if(isset($_POST['Newpassword'])){
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];
                $email = $_SESSION['email'];//remember earier i store the user email in a session var
                if(empty($email)){//if a user did not provide an email
                    header('Location: forgotpassword.php');//send user to forgotpassword page
                }
                $validPassword = "/^(?=.*[!£%^&#-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/";
                if(empty($password) ||empty($cpassword)){
                    echo 'All fields are required!';
                }elseif(!preg_match($validPassword,$password)){
                    echo 'Password must contain numbers, letters, special chars and must be at least 8 chars long!';
                }elseif($cpassword != $password){
                    echo 'The two passwords do not match';
                }else{
                    $hashpassword = password_hash($password,PASSWORD_DEFAULT);
                    if($this->Updatepassword($hashpassword,$email)){
                        if(isset($_SESSION['email'])){//here 
                            unset($_SESSION['email']);//unseting the user email session after updating password 
                            header('Location: login.php');
                        }
                        
                    }else{
                        echo 'password change was not successful!';
                    }
                }
            }
        }
    }