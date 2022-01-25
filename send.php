<?php
session_start();
    // Checking for a POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["name"]);
        $email = test_input($_POST["email"]);
        $message = test_input($_POST["message"]);
        $subject = test_input($_POST["subject"]);

        // Sanitize E-mail Address
        $emails = filter_var($email, FILTER_SANITIZE_EMAIL);
        // Validate E-mail Address
        $emails = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$emails){
        $_SESSION['flash_msg'] = '<div class="alert alert-danger" role="alert">
                Invalid Email
            </div>';
        }
        else{
        $sms = '<p><b>Name: </b>'.$name.'</p>
        <p><b>Email: </b>'.$email.'</p>
        <br />
        <p>'.$message.'</p>
        ';
        $headers = "From: hello@naztech.cyou\r\n"; // Sender's Email
        mail("wall.mate@gmail.com", $subject , $sms, $headers);
        $_SESSION['flash_msg'] = '<div class="alert alert-success" role="alert">
                Your mail has been sent successfully!
              </div>';
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;

    }else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    // Removing the redundant HTML characters if any exist.
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
                      
