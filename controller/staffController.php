
<?php
session_start();

require_once("../model/staff.php");

header('Content-Type: application/json');

$staff = null;

if (empty($_POST["action"])) {
    echo json_encode(['error' => 'Invalid action']);
} else {
    $staff = new Staff();

    switch ($_POST["action"]) {
        // ================================================================
        // FUNCTIONS TO FETCH DATA
        // ================================================================
        case '':
            // Code
            break;

        // ================================================================
        // FUNCTIONS TO UPDATE DATA
        // ================================================================

        // ================================================================
        // FUNCTIONS TO DELETE DATA
        // ================================================================

        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
    exit();
}
