<?php
// Setup emailer with phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer-master/src/Exception.php';
require 'vendor/PHPMailer-master/src/PHPMailer.php';
require 'vendor/PHPMailer-master/src/SMTP.php';

// Load required classes using initiator
require './includes/init.php';
// Customize page
$thisPage = 'Contact';

// initialize form values
$email = '';
$subject = '';
$message = '';
$sent = false;
$errors = [];




// submit the form to itself (don't specify action)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Store the submitted Values
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    // validate fields
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Please enter a valid email address';
    }

    if ($subject == '') {
        $errors[] = 'Please enter a subject';
    }

    if ($message == '') {
        $errors[] = 'Please enter a message';
    }

    // If no errors are found in the $errors array then send email
    if (empty($errors)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('no-reply@meliorateafrica.com');
            $mail->addAddress('recipient@emaple.com');
            $mail->addReplyTo($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();

            $sent = true;
        } catch (Exception $e) {
            $errors[] = 'Message not sent: '. $mail->ErrorInfo;
        }
    }
}

?>
<?php require 'includes/header.php'; ?>
<h2>Contact Us</h2>
<!-- Display errors if there are any -->
<?php if (!empty($errors)) : ?>
    <ul class="list-unstyled">
        <?php foreach ($errors as $error) : ?>
            <li class="callout-danger mb-1"><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<!-- Show it message was sent -->
<?php if ($sent) : ?>
    <p class="callout-info">Your email was sent.</p>
    <?php else : ?>
    
    <form method="post" id="contactForm">
        <div class="mb-3">
            <label for="email" class="form-label visually-hidden">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="<?= htmlspecialchars($email); ?>">
        </div>
        <div class="mb-3">
            <label for="subject" class="form-label visually-hidden">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="<?= htmlspecialchars($subject); ?>">
        </div>
        <div class="mb-3">
            <label for="message" class="form-labe visually-hidden">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message"><?= htmlspecialchars($message); ?></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Send Message</button>
        </div>
    </form>
    <?php endif; ?>


<?php require 'includes/footer.php'; ?>