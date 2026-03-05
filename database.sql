CREATE TABLE IF NOT EXISTS domains (
    id INT AUTO_INCREMENT PRIMARY KEY,
    domain_name VARCHAR(255) NOT NULL,
    expiry_date DATE NOT NULL,
    status VARCHAR(50) DEFAULT 'Active',
    auto_renew TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO domains (domain_name, expiry_date, status, auto_renew) VALUES 
('mycoolsite.com', DATE_ADD(CURRENT_DATE, INTERVAL 1 YEAR), 'Active', 1);
