CREATE DATABASE IF NOT EXISTS form_builder_db;
USE form_builder_db;

-- Forms table
CREATE TABLE IF NOT EXISTS forms (
    form_id INT AUTO_INCREMENT PRIMARY KEY,
    form_name VARCHAR(255) NOT NULL,
    form_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Form fields table
CREATE TABLE IF NOT EXISTS form_fields (
    field_id INT AUTO_INCREMENT PRIMARY KEY,
    form_id INT NOT NULL,
    field_label VARCHAR(255) NOT NULL,
    field_type ENUM('text','textarea','radio','checkbox','select') NOT NULL,
    field_options TEXT NULL,
    is_required BOOLEAN DEFAULT 0,
    field_order INT DEFAULT 0,
    FOREIGN KEY (form_id) REFERENCES forms(form_id) ON DELETE CASCADE
);

-- Table to store responses
CREATE TABLE IF NOT EXISTS form_responses (
    response_id INT AUTO_INCREMENT PRIMARY KEY,
    form_id INT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (form_id) REFERENCES forms(form_id) ON DELETE CASCADE
);

-- Table to store response values
CREATE TABLE IF NOT EXISTS form_response_values (
    value_id INT AUTO_INCREMENT PRIMARY KEY,
    response_id INT NOT NULL,
    field_id INT NOT NULL,
    value TEXT,
    FOREIGN KEY (response_id) REFERENCES form_responses(response_id) ON DELETE CASCADE,
    FOREIGN KEY (field_id) REFERENCES form_fields(field_id) ON DELETE CASCADE
);
