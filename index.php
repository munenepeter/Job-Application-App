<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";
//variables
//constant variables
$from = trim("from@yourdomain.com");
$fromName = trim("Peter Munene");
//dynamic variables
$recipient = $recipientName = $attachmentOne = $attachmentTwo = $subject =  $body ="";

if (isset($_POST['submit'])) {
  $recipient = test_input($_POST["email"]);
  $recipientName = test_input($_POST["name"]);
  $attachmentOne = test_input($_POST["cv"]);
  $attachmentTwo = test_input($_POST["cover-letter"]);
  $subject = test_input($_POST["subject"]);
  $body = test_input($_POST["msg"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
 
    $mail = new PHPMailer;

    //start the mailing
    $mail->From = $from;
    $mail->FromName = $fromName;

    $mail->addAddress($recipient, $recipientName);

    //Provide file path and name of the attachments
    $mail->addAttachment($attachmentOne);
    $mail->addAttachment($attachmentTwo); //Filename is optional

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $body;

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }




?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Apply for a Job</title>
</head>

<body>
    <div class="container-fluid">
        <!-- Top part-->
        <div class="row py-3 ">
            <div class="col-lg-12 mx-auto">
                <div class="text-white p-5 shadow-sm rounded banner  bg-info">
                    <h1 class="display-4">Job Application App</h1>
                    <p class="lead">Apply for the lattest job opportunities with ease</p>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row mt-2">
                <div class="col-md-3">
                <p class="lead">Get all of the jobs to apply</p>
                </div>
                <div class="col-md-1">
                </div>

                <div class="col-md-8">
                    <form class="row g-3" method="POST" action="index.php">
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">To</label>
                            <input name="email" type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-4">
                            <label for="inputName" class="form-label">Addresse Name</label>
                            <input name="name" type="text" class="form-control" id="inputName">
                        </div>
                        <div class="col-md-4">
                            <label for="subject" class="form-label">Subject</label>
                            <input name="subject" type="text" class="form-control" id="subject">
                        </div>
                        <div class="col-12">
                            <label for="inputmsg" class="form-label">Message to Employer</label>
                            <textarea name="msg" class="form-control" id="msg"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="formFile" class="form-label">Choose CV</label>
                            <input class="form-control" name="cv" type="file" id="formFile">
                        </div>
                        <div class="col-md-6">
                            <label for="formFile" class="form-label">Cover Letter</label>
                            <input class="form-control" name="cover-letter" type="file" id="formFile">
                        </div>
                        <div class="col-12">
                            <button name="submit" type="submit" class="btn btn-primary">Send Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>