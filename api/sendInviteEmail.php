<?php 
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require_once('../repository/ConferenceDAO.php');
require_once('../repository/HotelDAO.php');
require_once('../repository/UserDAO.php');

use Repository\ConferenceDAO;
use Repository\HotelDAO;
use Repository\UserDAO;


// Instantiation and passing `true` enables exceptions

function sendInviteMail ($user, $hotel, $conference)
{
    $html = "
        <h3>Thư mời bạn tới tham dự hội thảo.</h3>
        <h4>Thống tin chi tiết:</h6>
        <span width='100px'>Tên hội thảo: </span> <span>".$conference['name']."</span><br>
        <span width='100px'>Thời gian: </span> <span>".$conference['thoigian']."</span><br>
        <span width='100px'>Địa điểm: </span> <span>".$conference['diadiem']."</span><br>
        <span width='100px'>Khách sạn: </span> <span>".$hotel['name']."</span><br>
        <span width='100px'>Số người tham gia: </span> <span>300</span><br>
        <span>Xem thêm chi tiết ở <a href='127.0.0.1/'>đây</a></span>
    ";
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output, Comment this line for disable configuration log
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'tienanhnguyen191999@gmail.com';                     // SMTP username
        $mail->Password   = 'oapgxetnybmscxkf';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('tienanhnguyen191999@gmail.com', 'Hoi Thao WEBSITE');
        $mail->addAddress($user['email'], $user['email']);     // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        $mail->CharSet = 'UTF-8';

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Thư mời tham gia hội thảo';
        $mail->Body    = $html;
        $mail->AltBody = 'Chọn vào <a href="127.0.0.1:8000/admin/user">link</a> này để biết rõ thông tin';
    
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }    
}

$myConferenceDAO = new ConferenceDAO();
$myHotelDAO = new HotelDAO();
$myUserDAO = new UserDAO();
foreach ($_POST['data'] as $key => $value) {
    // Save relationship to database
    $myConferenceDAO->saveRelationship($value['user_id'], $value['conference_id'], $value['hotel_id']);
    
    // Send email
    $user = $myUserDAO->getSelected($value['user_id'])->fetch_assoc();
    $conference = $myConferenceDAO->getSelected($value['conference_id'])->fetch_assoc();
    $hotel = $myHotelDAO->getSelected($value['hotel_id'])->fetch_assoc();

    sendInviteMail($user, $hotel, $conference);
}
?>