<?php

require_once("Db.php");

class Supplier extends Db
{
    // ================================================================
    // FUNCTIONS TO FETCH DATA
    // ================================================================
    public function getAllSuppliers()
    {
        $sql = "SELECT * FROM supplier_table;";

        return $this->getResult($sql, $executeParameters = []);
    }

    public function getFilteredSuppliers($supplier_number = "", $supplier_name = "", $supplier_email = "")
    {
        $sql = "SELECT * FROM supplier_table WHERE 1";
        $params = [];

        if (!empty($supplier_number)) {
            $sql .= " AND supplier_number = ?";
            $params[] = $supplier_number;
        }

        if (!empty($supplier_name)) {
            $sql .= " AND `name` = ?";
            $params[] = $supplier_name;
        }

        if (!empty($supplier_email)) {
            $sql .= " AND email = ?";
            $params[] = $supplier_email;
        }

        $sql .= " LIMIT 1;";

        return $this->getResult($sql, $params);
    }

    // ================================================================
    // FUNCTIONS TO INSERT DATA
    // ================================================================

    // ================================================================
    // FUNCTIONS TO UPDATE DATA
    // ================================================================

    // ================================================================
    // HELPER FUNCTIONS
    // ================================================================

    // Function to catch the error if there are any error when
    // connecting to database (Fetching, Inserting, Deleting, or 
    // Updating Records)
    // 
    // $query - SQL Query to be performed
    // $executeParameters (Optional Parameter) - The parameters needed to execute the prepared statements
    //                    - This is the values needed to match the number of placeholders ('?' symbol)
    // 
    // Can be called as:
    //  - getResult($sql);
    //  - getResult($sql, $executeParameters);
    public function getResult($query, $executeParameters = [])
    {
        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($executeParameters);

            return $stmt->fetchAll();
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    // Used for Inserting, Updating, or Deleting data
    // 
    // $query - SQL Query to be performed
    // $executeParameters (Optional Parameter) - The parameters needed to execute the prepared statements
    //                                         - This is the values needed to match the number of placeholders ('?' symbol)
    // 
    // Can be called as:
    //  - getCreateDataResult($sql);
    //  - getCreateDataResult($sql, $executeParameters);
    public function getCreateDataResult($query, $executeParameters = [])
    {
        try {
            $stmt = $this->connect()->prepare($query);
            $stmt->execute($executeParameters);

            return [
                'status' => 'success',
                'affected_rows' => $stmt->rowCount(),
                'last_id' => $this->connect()->lastInsertId()
            ];
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
