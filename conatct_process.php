<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        // Error response
        http_response_code(400);
        echo "Tafadhali jaza fomu vyema.";
        exit;
    }

    $to = "saidomary@gmail.com";  // Badilisha na email yako halisi
    $subject = "Message from Portfolio Contact Form";
    $email_content = "Jina: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Ujumbe:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Ujumbe umefanikiwa kutumwa, nitakujibu hivi karibuni.";
    } else {
        http_response_code(500);
        echo "Tatizo limetokea, tafadhali jaribu tena baadaye.";
    }

} else {
    http_response_code(403);
    echo "Tafadhali tumia fomu kwa njia sahihi.";
}
?>
