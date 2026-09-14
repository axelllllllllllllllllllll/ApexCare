<?php
session_start();

require_once("../model/Order.php");

header('Content-Type: application/json');

$order = null;

if (empty($_POST["action"])) {
    echo json_encode(['error' => 'Invalid action']);
} else {
    $order = new Order();

    switch ($_POST["action"]) {
        // ================================================================
        // FUNCTIONS TO FETCH DATA
        // ================================================================
        case 'getCompletedOrderByDeliveryDetailId':
            // Error Handling or Validations

            $result = $order->getOrdersWithCompletedStatusByDeliveryDetailId($_POST["delivery_detail_id"]);

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
