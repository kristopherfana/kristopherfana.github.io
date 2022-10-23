<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    //include 'C:\xampp\htdocs\CONTACT FORM\connection.php';
    $result="";
    $error="";
     if(isset($_POST['submit'])){
        
       if (!$_POST['fullname'] ){
            $error="</br>Please enter your name";

       }
       if (!$_POST['email']){
            $error.="</br>Please enter your email address";
       }
       if (!$_POST['comment']){
            $error.="</br>Please enter a comment";
        }

    if ($error!=""){
        $result='<div class= "alert alert-danger"><strong>There were error(s) in your form:</strong>'.$error.'</div>';
        }
        elseif($error==""){
            //variable declaration
            $fullname = $_POST['fullname'];
            $uemail = $_POST['email'];
            $comment = $_POST['comment'];

            // creating a connection
            $conn = mysqli_connect("localhost", "kris", "Azertyu1*", "contact__form");

            // to ensure that the connection is made
            if ($conn->connect_error)
            {   
                echo "Hi";
                die("Connection failed!" . mysqli_connect_error());
            }

            $duplicate_check = mysqli_query($conn ,"SELECT * FROM comments WHERE `email`='$uemail'");
            $num_rows = mysqli_num_rows($duplicate_check);

            if ($num_rows) {

                $result='<div class= "alert alert-danger"><strong>Ooops! Email already used</strong></div>';
            }

            // using sql to create a data entry query
    
            $sql="INSERT INTO `comments`(`fullname`, `email`, `comment`) VALUES ('$fullname','$uemail', '$comment') ";

            if(!($num_rows)){
                $rs = mysqli_query($conn, $sql);
                   //send query to the database to add values and confirm if successful
                if($rs)
                {
                        
                        require_once 'C:\xampp\phpMyAdmin\vendor\composer\vendor\autoload.php';

                        $mail = new PHPMailer(true);



                            $mail->isSMTP();                                            // Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                            $mail->Username   = 'devkriss.0@gmail.com';                     // SMTP username
                            $mail->Password   = 'zwjuktdznyxcdxbb';                               // SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                            $mail->Port       = 587;      



                        $mail->From = 'devkriss.0@gmail.com';
                        $mail->FromName = "Kristopher Fana";

                        $mail->addAddress($uemail, $fullname);


                        $mail->isHTML(false);

                        $mail->Subject = 'This is an email sent with PHP';
                        $mail->Body = '<strong>Thank you for submitting the form</strong> '.$fullname;
                        $mail->AltBody = 'This is the plain text version of the email content';

                        try {
                            $mail->send();
                            $result='<div class="alert alert-success"><strong>Form submitted.</strong> Thank you</div>';
                        } catch (Exception $e) {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                    //$result='<div class="alert alert-success"><strong>Form submitted.</strong> Thank you</div>';
                }
            }
        }
         
            

            
            // close connection
            // mysqli_close($conn);

            
        }
    
?>



<!DOCTYPE HTML>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>
            My Contact Form
        </title>
        <!--CSS Bootstrap to be placed in the head of the document-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>

    <style>
        .container{
            border:0.5px solid grey;
            border-radius:10px;
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>

    <body>
        
            <div class="container col-4 ">
                <h1>My Contact Form</h1>

                <?php echo $result;?>
        

                <form method="POST" action="">
           
                    
                    <div class="form-group ">
                        <label for="fullname">Your name:</label>
                        <input type="text" class="form-control input" name="fullname"  placeholder="Enter name">
                    </div>

                    <div class="form-group">
                        <label for="Email">Mail address:</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" name="comment"  placeholder="Enter a comment"></textarea>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        

        <!--jQUery, Javascipt and popperjs to be pasted before the the end of the body-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>