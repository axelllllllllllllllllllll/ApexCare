<?php

require_once("Db.php");

class Sales extends Db
{
    // ================================================================
    // FUNCTIONS TO FETCH DATA
    // ================================================================
    public function getAllSalesRecords()
    {
        $sql = "SELECT * FROM sales_table";

        return $this->getResult($sql);
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

            return $stmt;
        } catch (\Throwable $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
