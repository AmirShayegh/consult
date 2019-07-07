<?php

    if(isset($_POST['name'])
        && isset($_POST['email'])
        && isset($_POST['subject'])
        && isset($_POST['message']))
    {
        $to = "our_email@domain.com";
        $subject = $_POST['subject'];

        $headers = "From: " . strip_tags($_POST['email']) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($_POST['email']) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($_POST['name']) . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($_POST['email']) . "</td></tr>";
        $message .= "<tr><td><strong>Subject:</strong> </td><td>" . strip_tags($_POST['subject']) . "</td></tr>";
        $message .= "<tr><td><strong>Message:</strong> </td><td>" . strip_tags($_POST['message']) . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        if(mail($to, $subject, $message, $headers))
        {
            echo json_encode(array(
                    'error' => 'false',
                    'message' =>'Mail successfully sent.'
                )
            );
        }
        else
        {
            echo json_encode(array(
                'error' => 'true',
                'message' =>'Mail failed to send please try again later.'
                )
            );
        }
    }
    else
    {
        echo json_encode(array(
                'error' => 'true',
                'message' =>'Missing information.'
            )
        );
    }
