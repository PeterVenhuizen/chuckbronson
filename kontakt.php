<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Kontakt / Impressum</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <?php include('favicon.html'); ?>

        <link rel="stylesheet" href="assets/css/style.css">
        
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </head>
    <body>

        <?php include('navbar.html'); ?>

        <div class="container">

            <h1>Kontakt</h1>

            <?php
                $errName = $errEmail = $errSubject = $errMessage = $errCaptcha = $result = '';

                if (isset($_POST['contactSubmit'])) {

                    $name = $_POST['contactName'];
                    $email = $_POST['contactEmail'];
                    $subject = $_POST['contactSubject'];
                    $message = $_POST['contactMessage'];
                    $captcha = $_POST['g-recaptcha-response'];

                    $to = 'pavenhuizen@gmail.com';
                    $htmlContent = '
                        <html>
                            <head>
                                <title>Chuck Bronson Kontakt</title>
                            </head>
                            <body>
                                <h2>Nachtricht von ' . $name . ' (' . $email . ')</h2>
                                <p>' . $message . '</p>
                            </body>
                        </html>';

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "From: Chuck Bronson Kontakt" . "\r\n";

                    // Check if name has been entered
                    if (!$name) {
                        $errName = "Bitte geben Sie Ihren Namen ein.";
                    }

                    // Check if email has been entered and is valid
                    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errEmail = "Bitte geben Sie eine gültige E-Mail-Adresse ein.";
                    }

                    // Check if a subject has been entered
                    if (!$subject) {
                        $errSubject = "Bitte geben Sie den Betreff an.";
                    }

                    // Check if message has been entered
                    if (!$message) {
                        $errMessage = "Bitte geben Sie Ihre Nachricht ein.";
                    }

                    // Check if reCAPTCHA was checked
                    if (!$captcha) {
                        $errCaptcha = "Bitte bestätigen Sie, dass Sie kein Roboter sind.";
                    }

                    // Check reCAPTCHA
                    // https://codeforgeek.com/2014/12/google-recaptcha-tutorial/
                    $secretKey = "6LeT8-wSAAAAAMbnCiRoMLWNEzuFQrlzTxFe7c8J";
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                    $responseKeys = json_decode($response, true);
                    if (intval($responseKeys["success"]) == 1) {
                        
                        // Check errors
                        if (!strlen($errName) && !strlen($errEmail) && !strlen($errMessage)) {
                            if (mail($to, $subject, $htmlContent, $headers)) {
                                $result='<div class="alert alert-success">Vielen Dank für Ihre Nachricht.</div>';
                                $_POST = array();
                            } else {
                                $result='<div class="alert alert-danger">Beim Senden der Nachricht ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.</div>';
                            }
                        }
                    }
                }

            ?>

            <form class="form-horizontal" role="form" method="post" action="kontakt.php">
                <div class="form-group">
                    <label class="col-sm-2" for="contactName">Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="contactName" id="contactName" value="<?php echo (isset($_POST["contactName"])) ? $_POST["contactName"] : ''; ?>">
                        <?php echo "<p class='text-danger'>$errName</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="contactEmail">E-mail:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="contactEmail" id="contactEmail" value="<?php echo (isset($_POST["contactEmail"])) ? $_POST["contactEmail"] : ''; ?>">
                        <?php echo "<p class='text-danger'>$errEmail</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="contactSubject">Betreff:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="contactSubject" id="contactSubject" value="<?php echo (isset($_POST["contactSubject"])) ? $_POST["contactSubject"] : ''; ?>">
                        <?php echo "<p class='text-danger'>$errSubject</p>"; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2" for="contactMessage">Nachricht:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="5" name="contactMessage" id="contactMessage"><?php echo (isset($_POST["contactMessage"])) ? $_POST["contactMessage"] : ''; ?></textarea>
                        <?php echo "<p class='text-danger'>$errMessage</p>"; ?>
                    </div>
                </div>
                
                <!-- https://developers.google.com/recaptcha/intro -->
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">    
                        <div class="g-recaptcha" data-sitekey="6LeT8-wSAAAAADVhKL4lmq1ngo2F9f5rwJerwW2I"></div>
                        <?php echo "<p class='text-danger'>$errCaptcha</p>"; ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" name="contactSubmit" class="btn btn-default">Abschicken</button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <?php echo $result; ?>
                    </div>
                </div>

            </form>

            <h1>Impressum</h1>

            <div class="row">

                <div class="col-xs-12 col-xs-offset-0 col-sm-offset-0 col-sm-6">
                    <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Vereinsregisterauszug</th>                    
                    </tr>
                </thead>
                <tr>
                    <td>Name:</td>
                    <td>Sportunion Ultimate-Frisbee-Club - Wien</td>
                </tr>
                <tr>
                    <td>Sitz:</td>
                    <td>Wien</td>
                </tr>
                <tr>
                    <td>Enstehungsdatum:</td>
                    <td>22.09.2003</td>
                </tr>
                <tr>
                    <td>ZVR-Zahl:</td>
                    <td>256051545</td>
                </tr>
                <tr>
                    <td>Obmann:</td>
                    <td>Philipp Lukavsky</td>
                </tr>
                <tr>
                    <td>Obmann-Stv:</td>
                    <td>Yvonne Engstler</td>
                </tr>
            </table>
                </div>

                <div class="col-xs-12 col-xs-offset-0 col-sm-offset-0 col-sm-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="2">Bankverbindung</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>Inhaber:</td>
                            <td>Sportunion Ultimate-Frisbee-Club - Wien</td>
                        </tr>
                        <tr>
                            <td>IBAN:</td>
                            <td>AT983200000012173274 </td>
                        </tr>
                        <tr>
                            <td>BIC:</td>
                            <td>RLNWATWWXXX</td>
                        </tr>
                    </table>
                </div>

            </div>

        </div>

        <?php include('footer.html'); ?>

    </body>
</html>