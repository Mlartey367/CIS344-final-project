-- =========================================================
-- Real Estate Agency Portal Starter SQL
-- Spring 2026
-- =========================================================

CREATE DATABASE IF NOT EXISTS real_estate_portal_db;
USE real_estate_portal_db;

DROP TABLE IF EXISTS Users;

CREATE TABLE Users (
    userId INT NOT NULL AUTO_INCREMENT,
    userName VARCHAR(50) NOT NULL UNIQUE,
    contactInfo VARCHAR(200),
    passwordHash VARCHAR(255) NOT NULL,
    userType ENUM('agent', 'buyer', 'renter') NOT NULL,
    PRIMARY KEY (userId)
);


-- ---------------------------------------------------------
-- Sample Data
-- NOTE: Password hashes below are placeholders.
-- ---------------------------------------------------------
INSERT INTO Users (userName, contactInfo, passwordHash, userType) VALUES
('agent_maria', 'maria@agency.com', '$2y$10$examplehash0000000000000000000000000000000000000', 'agent'),
('buyer_james', 'james@email.com', '$2y$10$examplehash0000000000000000000000000000000000001', 'buyer'),
('renter_lisa', 'lisa@email.com', '$2y$10$examplehash0000000000000000000000000000000000002', 'renter');
