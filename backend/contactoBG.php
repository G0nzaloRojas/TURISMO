<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../includes/PHPMailer-6.10.0/src/PHPMailer.php';
require_once __DIR__ . '/../includes/PHPMailer-6.10.0/src/SMTP.php';
require_once __DIR__ . '/../includes/PHPMailer-6.10.0/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitizar datos del formulario
    $firstName = htmlspecialchars($_POST["first-name"]);
    $lastName = htmlspecialchars($_POST["last-name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $destination = htmlspecialchars($_POST["destination"]);
    $travelDate = htmlspecialchars($_POST["travel-date"]);
    $travelers = htmlspecialchars($_POST["travelers"]);
    $message = htmlspecialchars($_POST["message"]);
    $newsletter = isset($_POST["newsletter"]) ? "Sí" : "No";
    
    $fullName = $firstName . " " . $lastName;

    $mail = new PHPMailer();

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'paskito00@gmail.com'; 
        $mail->Password = 'sewgyyhpofdlunyk'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente y destinatario
        $mail->setFrom('paskito00@gmail.com', 'BA Tour - Formulario de Contacto');
        $mail->addAddress('paskito00@gmail.com', 'Equipo BA Tour');
        $mail->addReplyTo($email, $fullName);

        // Contenido del email
        $mail->isHTML(true);
        $mail->Subject = "Nueva consulta de $fullName - BA Tour";
        
        $emailBody = "
        <h2>Nueva consulta desde el formulario de contacto</h2>
        <hr>
        <p><strong>Nombre completo:</strong> $fullName</p>
        <p><strong>Email:</strong> $email</p>
        " . (!empty($phone) ? "<p><strong>Teléfono:</strong> $phone</p>" : "") . "
        " . (!empty($destination) ? "<p><strong>Destino de interés:</strong> $destination</p>" : "") . "
        " . (!empty($travelDate) ? "<p><strong>Fecha estimada de viaje:</strong> $travelDate</p>" : "") . "
        " . (!empty($travelers) ? "<p><strong>Número de viajeros:</strong> $travelers</p>" : "") . "
        <p><strong>Quiere recibir newsletter:</strong> $newsletter</p>
        <hr>
        <p><strong>Mensaje:</strong></p>
        <p>$message</p>
        <hr>
        <p><em>Enviado desde el formulario de contacto de BA Tour</em></p>
        ";
        
        $mail->Body = $emailBody;

        $mail->send();
        
        // Redirige con mensaje de éxito
        header("Location: ../contact.php?exito=1#contact-form");
        exit;
        
    } catch (Exception $e) {
        // Redirige con mensaje de error
        header("Location: ../contact.php?error=1#contact-form");
        exit;
    }
} else {
    // Si no es POST, redirige al formulario
    header("Location: ../contact.php");
    exit;
}
?>