<?php
session_start();

require_once("../model/Delivery.php");
require_once("../model/Supplier.php");
require_once("../model/Medicine.php");

header('Content-Type: application/json');

$delivery = null;

if (empty($_POST["action"])) {
    echo json_encode(['error' => 'Invalid action']);
} else {
    $delivery = new Delivery();

    switch ($_POST["action"]) {
        // ================================================================
        // FUNCTIONS TO FETCH DATA
        // ================================================================
        // Modify to check for errors returned by getResults() inside the Delivery.php
        case 'getAllDeliveryRecords':

            $result = $delivery->getFilteredDeliveryRecord(receiver_id: $_POST["receiver_id"]);

            echo json_encode($result);
            exit();
            break;
        case 'getFilteredDeliveryRecord':
            $result = $delivery->getFilteredDeliveryRecord(
                $_POST["inventory_staff_id"],
                $_POST["supplier_name_filter"],
                $_POST["from_date"],
                $_POST["to_date"],
                $_POST["search_query"]
            );

            echo json_encode($result);
            exit();
            break;
        case 'getDeliveryRecordById':

            $result = [
                "status" => "success",
                "delivery_record_detail" => $delivery->getDeliveryRecordById($_POST["delivery_id"]),
                "delivery_items" => $delivery->getDeliveryDetail($_POST["delivery_id"]),
                "grand_total" => $delivery->getDeliveryGrandTotalAmount($_POST["delivery_id"])
            ];

            echo json_encode($result);
            exit();
            break;
        case 'getDeliveryCount':
            $result = $delivery->getDeliveryCount();

            echo json_encode($result);

            exit();
            break;

        // ================================================================
        // FUNCTIONS TO INSERT DATA
        // ================================================================
        case 'createDeliveryRecord':
            $supplier = new Supplier();
            $medicine = new Medicine();

            $result = [];

            // Get Delivery Record Details for delivery_table
            $deliveryDetails = $_POST["deliveryRecordDetails"];

            // Get Delivery Items List for for delivery_detail_table
            $deliveryItemsList = $_POST["deliveryItems"];

            // Get the supplier ID
            $supplier_id = $supplier->getFilteredSuppliers(supplier_name: $deliveryDetails["supplier_name"])[0]["supplier_id"];

            // Creates new Delivery Record on delivery_table and get its ID
            $delivery_id = $delivery->createDeliveryRecord(
                supplier_id: $supplier_id,
                receiver_id: $deliveryDetails["receiver_id"],
                total_amount: $deliveryDetails["total_amount"]
            )["last_id"];

            // Loop through the Delivery Items List to record every Delivery Items Detail
            for ($index = 0; $index < count($deliveryItemsList); $index++) {
                $item = $deliveryItemsList[$index];

                $medicine_id = $medicine->getFilteredMedicine(medicine_name_query: $deliveryItemsList[0]["medicineName"])[0]["medicine_id"];
                $delivery->createDeliveryDetailRecord($delivery_id, $medicine_id, $item["receivedQuantity"], $item["batchNumber"], $item["expiryDate"], $item["unitPrice"]);

                // Fetch all incomplete orders and check if the current medicine can be allocated

            }

            echo json_encode($result);
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
            exit();
            break;
    }
}
