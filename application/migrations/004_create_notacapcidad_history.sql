CREATE TABLE nota_capacidad_history (
    nota_capacidad_history_id INT AUTO_INCREMENT PRIMARY KEY,
    nota_capacidad_id INT NOT NULL,
    value INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
