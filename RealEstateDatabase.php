<?php
require_once __DIR__ . '/Database.php';

class RealEstateDatabase {
    private PDO $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function addUser(string $userName, string $contactInfo, string $passwordHash, string $userType): bool {
        // TODO:
        // 1. Insert a new user into the Users table using a prepared statement.
        // 2. Return true if successful, false otherwise.
        $sql = "INSERT INTO Users (userName, contactInfo, passwordHash, userType)
                VALUES (:userName, :contactInfo, :passwordHash, :userType)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':userName' => $userName,
            ':contactInfo' => $contactInfo,
            ':passwordHash' => $passwordHash,
            ':userType' => $userType
        ]);
    }

    public function getUserByUsername(string $userName) {
        // Retrieve one user by username.
        $sql = "SELECT * FROM Users WHERE userName = :userName LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':userName' => $userName]);
        return $stmt->fetch();
    }

    public function addProperty(string $title, string $propertyType, string $address, string $city, float $price, string $status, int $agentId): bool {
        // TODO: Insert a new property into the Properties table.
        $sql = "INSERT INTO Properties (title, propertyType, address, city, price, status, agentId)
            VALUES (:title, :propertyType, :address, :city, :price, :status, :agentId)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':title' => $title,
        ':propertyType' => $propertyType,
        ':address' => $address,
        ':city' => $city,
        ':price' => $price,
        ':status' => $status,
        ':agentId' => $agentId
    ]);
}

    public function getAllProperties(): array {
        // TODO: Optionally replace this with the PropertyListingView.
        $sql = "SELECT p.*, u.userName AS agentName
                FROM Properties p
                JOIN Users u ON p.agentId = u.userId
                ORDER BY p.propertyId DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getPropertyById(int $propertyId) {
        $sql = "SELECT p.*, u.userName AS agentName
                FROM Properties p
                JOIN Users u ON p.agentId = u.userId
                WHERE p.propertyId = :propertyId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':propertyId' => $propertyId]);
        return $stmt->fetch();
    }

    public function addInquiry(int $userId, int $propertyId, string $message): bool {
        // TODO: Insert a new inquiry with the current date and time.
         $sql = "INSERT INTO Inquiries (userId, propertyId, message, inquiryDate)
            VALUES (:userId, :propertyId, :message, NOW())";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        ':userId' => $userId,
        ':propertyId' => $propertyId,
        ':message' => $message
    ]);
}


      public function getUserDetails(int $userId) {
    // TODO:
    // Expand this function so it returns the user plus their related
    // inquiries, favorites, or transactions.
    $sql = "SELECT u.*,
                i.inquiryId, i.propertyId AS inquiryPropertyId, i.message, i.inquiryDate,
                f.favoriteId, f.propertyId AS favoritePropertyId, f.savedDate,
                t.transactionId, t.transactionType, t.transactionDate, t.amount
            FROM Users u
            LEFT JOIN Inquiries i ON u.userId = i.userId
            LEFT JOIN Favorites f ON u.userId = f.userId
            LEFT JOIN Transactions t ON u.userId = t.userId
            WHERE u.userId = :userId";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':userId' => $userId]);
    return $stmt->fetchAll();
}
    public function getPropertiesByCity(string $city): array {
        // TODO: Finish this function
         return [];
    }
}
?>
