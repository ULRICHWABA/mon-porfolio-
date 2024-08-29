<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data by ulrich
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Check if data is valid
    if (empty($name) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // If data is not valid, show an error message
        echo 'Il semble qu\'il y ait un problème avec les informations que vous avez fournies. Veuillez vérifier tous les champs et réessayer.';
        exit;
    }

    // Recipient email address
    $recipient = "wabaulrich1234@gmail.com"; // my actually adresse 

    // Email content
    $email_subject = "Nouveau message de $name: $subject";
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send email
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // If email sent successfully, show a success message
        echo 'Votre message a été envoyé. Merci!';
    } else {
        // If email not sent, show an error message
        echo 'Oups! Quelque chose s\'est mal passé et votre message n\'a pas été envoyé. Veuillez réessayer plus tard.';
    }
} else {
    // If form is not submitted, show an error message
    echo 'Il y a eu un problème avec votre soumission. Veuillez réessayer.';
}
?>
