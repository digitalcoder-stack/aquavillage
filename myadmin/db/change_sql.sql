CREATE TABLE ticket_discounts (
    discount_id INT PRIMARY KEY AUTO_INCREMENT,
    discount_code VARCHAR(50) NOT NULL,
    discount_name VARCHAR(200) NOT NULL,
    min_pack INT NOT NULL,
    max_pack INT,
    discount_percent DECIMAL(5,2) NOT NULL,
    start_date DATE,
    end_date DATE,
    discount_status INT,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE `tickets_wp_tbl` ADD `is_discount_applied` TINYINT(1) NOT NULL COMMENT '1- yes , 0-no' AFTER `m_ticket_gstAmt`, ADD `m_ticket_disprt` TINYINT(4) NOT NULL COMMENT ' in %' AFTER `is_discount_applied`;