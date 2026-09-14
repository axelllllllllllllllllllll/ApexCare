<?php
require_once("Db.php");

class Auth extends Db
{

    public function handleLoginAttempt($email, $password)
    {
        $sql = "SELECT * FROM user_table WHERE email = ? LIMIT 1";
        $params = [
            $email
        ];

        $user = $this->getResult($sql, $params);

        if (!$user) {
            return [
                "status" => "failed",
                "message" => "Invalid Email"
            ];
        }

        if (!password_verify($password, $user[0]["hash_password"])) {
            return [
                "status" => "failed",
                "message" => "Incorrect Password"
            ];
        } else {
            return [
                "status" => "success",
                "message" => "Login Successfull",
                "data" => $user
            ];
        }
    }

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
