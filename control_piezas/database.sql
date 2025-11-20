CREATE DATABASE control_piezas;

USE control_piezas;

CREATE TABLE piezas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  articulo VARCHAR(100),
  prenda VARCHAR(100),
  parte VARCHAR(100),
  talle VARCHAR(20),
  valor DECIMAL(5,2),
  curva VARCHAR(100),
  tipo_curva VARCHAR(20),   -- NUEVO
  fila INT,
  columna INT,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP

  ALTER TABLE piezas 
ADD UNIQUE KEY uniq_pieza (articulo, prenda, parte, talle, curva, tipo_curva, fila, columna);
);
