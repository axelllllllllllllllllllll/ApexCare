<?php
session_start();

require_once("../model/Auth.php");

header('Content-Type: application/json');

$auth = null;

if (empty($_POST["action"])) {
    echo json_encode(["status" => "error", "message" => "Invalid Action"]);
} else {
    $auth = new Auth();

    switch ($_POST["action"]) {
        case 'handleUserLogin':
            $result = $auth->handleLoginAttempt($_POST["email"], $_POST["password"]);

            // echo json_encode(["data" => "laksd"]);

            if ($result["status"] == "failed") {
                echo json_encode($result);
                return;
            }

            if ($result["status"] == "success") {
                $_SESSION["user"] = [
                    "id" => $result["data"][0]["user_id"],
                    "role" => $result["data"][0]["role_id"]
                ];

                echo json_encode([
                    "user" => $_SESSION["user"]
                ]);
            }

            exit();
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            exit();
            break;
    }
}
