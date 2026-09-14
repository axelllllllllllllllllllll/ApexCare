<?php
session_start();

require_once("../model/Medicine.php");

header('Content-Type: application/json');

$medicine = null;

if (empty($_POST["action"])) {
    echo json_encode(['error' => 'Invalid action']);
} else {
    $medicine = new Medicine();

    switch ($_POST["action"]) {
        // ================================================================
        // FUNCTIONS TO FETCH DATA
        // ================================================================
        case 'getMedicineByName':
            // Error Handling

            $result = $medicine->getFilteredMedicine(medicine_name_query: $_POST["medicine_name_to_search"]);

            echo json_encode([
                "status" => "success",
                "data" => $result
            ]);

            exit();
            break;
        case 'getMedicineById':
            // Error Handling

            $result = $medicine->getFilteredMedicine(medicine_id: $_POST["medicine_id_to_search"]);

            echo json_encode([
                "status" => "success",
                "data" => $result
            ]);

            exit();
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
