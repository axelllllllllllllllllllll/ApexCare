<?php
session_start();

require_once("../model/Supplier.php");

header('Content-Type: application/json');

$supplier = null;

if (empty($_POST["action"])) {
    echo json_encode(['error' => 'Invalid action']);
} else {
    $supplier = new Supplier();

    switch ($_POST["action"]) {
        // ================================================================
        // FUNCTIONS TO FETCH DATA
        // ================================================================
        case 'getAllSuppliers':
            // Error Handling or Validations

            $result = $supplier->getAllSuppliers();

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
            echo json_encode([
                "status" => "error",
                'message' => 'Invalid action'
            ]);
            break;
    }
    exit();
}
