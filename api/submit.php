<?php

header("Content-Type: application/json");

require_once "../config/database.php";

$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$phone = trim($_POST["phone"] ?? "");
$message = trim($_POST["message"] ?? "");

if ($name === "" || $email === "" || $message === "") {

    echo json_encode([
        "success" => false,
        "message" => "Please fill all required fields."
    ]);

    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo json_encode([
        "success" => false,
        "message" => "Invalid email address."
    ]);

    exit;
}

$sql = "
    INSERT INTO submissions
    (name, email, phone, message)
    VALUES
    (:name, :email, :phone, :message)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ":name" => $name,
    ":email" => $email,
    ":phone" => $phone,
    ":message" => $message
]);

echo json_encode([
    "success" => true,
    "message" => "Form submitted successfully!"
]);
