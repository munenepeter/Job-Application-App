<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";
//variables
//constant variables
$from = trim("from@yourdomain.com");
$fromName = trim("Peter Munene");
//dynamic variables
$recipient = $recipientName = $attachmentOne = $attachmentTwo = $subject =  $body = "";
//send the mail
function sendMail($from, $fromName, $recipient, $recipientName, $attachmentOne, $attachmentTwo, $subject, $body)
{
    $mail = new PHPMailer;

    //start the mailing
    $mail->From = $from;
    $mail->FromName = $fromName;

    $mail->addAddress($recipient, $recipientName);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $body;

    //Provide file path and name of the attachments
    $mail->addAttachment($attachmentOne);
    //Attachment Two is optional
    //$mail->addAttachment($attachmentTwo); 

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

if (isset($_POST['submit'])) {
    // Count total files
    $path = "uploads/";

    $countfiles = count($_FILES['file']['name']);

    // Looping all files
    for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['file']['name'][$i];
        $attachmentOne = $path . basename($filename);
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'][$i], 'uploads/' . $filename);
    }

    $recipient = form_input($_POST["email"]);
    $recipientName = form_input($_POST["name"]);
    //$attachments = form_input($_POST["uploaded_file"]);
    //$attachmentTwo = form_input($_POST["uploaded_file"]);
    $subject = form_input($_POST["subject"]);
    $body = form_input($_POST["msg"]);
    sendMail($from, $fromName, $recipient, $recipientName, $attachmentOne, $attachmentTwo, $subject, $body);
}

function form_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                <div class=" text-center text-white p-5 shadow-sm rounded banner  bg-info">
                    <h1 class="display-4">Job Application App</h1>
                    <p class="lead">Apply for the latest job opportunities with ease</p>
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
                    <form enctype="multipart/form-data" class="row g-3" method="POST" action="index.php">
                        <div class="col-md-4">
                            <label for="inputEmail4" class="form-label">To</label>
                            <input name="email" type="email" class="form-control" id="inputEmail4" required>
                        </div>
                        <div class="col-md-4">
                            <label for="inputName" class="form-label">Addresse Name</label>
                            <input name="name" type="text" class="form-control" id="inputName" required>
                        </div>
                        <div class="col-md-4">
                            <label for="subject" class="form-label">Subject</label>
                            <input name="subject" type="text" class="form-control" id="subject" required>
                        </div>
                        <div class="col-12">
                            <label for="inputmsg" class="form-label">Message to Employer</label>
                            <textarea name="msg" class="form-control" id="msg" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="formFile" class="form-label">Choose CV and Cover Letter </label>
                            <input type="file" name="file[]" class="form-control" id="formFile" multiple>
                        </div>
                        <div class="col-md-12">
                            <button name="submit" type="submit" class="btn btn-primary">Send Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</body>

</html>
