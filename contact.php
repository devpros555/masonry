<?php
header('Content-Type: application/json');

// Database connection details
$host = 'localhost';
$db   = 'contact_form_db';
$user = 'root';
$pass = ''; // empty password for XAMPP
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    if ($name === '' || $email === '' || $phone === '' || $message === '') {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        exit;
    }

    // 1. Save to database
    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (:name, :email, :phone, :message)");
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'message' => $message
    ]);

    // 2. Send email to yourself
    $to = "raul.garcia.1627@gmail.com"; // <<< Your email
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message";
    $headers = "From: no-reply@yourdomain.com"; // you can change this

    mail($to, $subject, $body, $headers);

    echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
