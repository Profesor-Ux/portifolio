<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $message = trim($_POST['note']);

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        // Return error if required fields are empty
        echo "<script>alert('Please fill in all required fields (Name, Email, Message)'); window.history.back();</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Return error if email is invalid
        echo "<script>alert('Please enter a valid email address'); window.history.back();</script>";
        exit;
    }

    // Email settings
    $to = "brywilf36@gmail.com"; 
    $subject = "New Contact Form Submission from $name";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email body
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Phone: $phone\n";
    $email_body .= "Address: $address\n";
    $email_body .= "Message:\n$message\n";

    // Send email
    if (mail($to, $subject, $email_body, $headers)) {
        // Success message
        echo "<script>alert('Thank you! Your message has been sent successfully.'); window.location.href = 'index.html';</script>"; // Redirect to your homepage or thank you page
    } else {
        // Error message
        echo "<script>alert('Error occurred while sending email. Please try again later.'); window.history.back();</script>";
    }
} else {
    // If not a POST request, redirect back
    header("Location: index.html"); // Replace with your form page
    exit;
}
?>