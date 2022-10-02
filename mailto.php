<?php

if (isset($_POST['Email']))

    //Sending
    $email_to = "craigsheehy123@gmail.com";
    $email_sub = "Person Website Form Submission";

    // This is for if there are issues found in the form.
    function issue($error)
    {
        echo "We are sorry, but there were error(s) found in the form you submitted.";
        echo "Here are the error(s). <br><br>";
        echo $error . "<br><br>";
        die();
    }

    //Checking the data
    if (
       !isset($_POST['Name']) ||
       !isset($_POST['Email']) ||
       !isset($_POST['Message'])
    ) {
        issue('We are sorry, but there is an issue with your form.');
    }

    //Requireds
    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_expected = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $name_expected = "/^[A-Za-z .'-]+$/";


    //Check if the email is valid
    if (!preg_match($email_exp, $email)) {
        $error_message .= 'The email address you entered does not appear to be valid.<br>';
    }

    //Checking if name is valid
    if(!preg_match($name_expected, $name)) {
        $error_message .= 'The name you entered does not appear to be valid.<br>';
    }


    //Checking if message is valid
    if (strlen($message) < 2) {
        $error_message .= 'The Message you entered do not appear to be valid.<br>';
    }

    if (strlen($error_message) > 0) {
        issue($error_message);
    }

    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Thank you for contacting us. We will be in touch with you very soon.

<?php
?>