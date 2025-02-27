CREATE DATABASE tienda_online;
SET NAMES UTF8;
CREATE DATABASE IF NOT EXISTS tienda_online;
USE tienda_online;

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios(
    id int(255) auto_increment not null,
    nombre varchar(100) not null,
    apellidos varchar(255),
    email varchar(255) not null,
    password varchar(255) not null,
    rol varchar(20),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias(
    id int(255) auto_increment not null,
    nombre varchar(100) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS productos;
CREATE TABLE IF NOT EXISTS productos(
    id int(255) auto_increment not null,
    categoria_id int(255) not null,
    nombre varchar(100) not null,
    descripcion text,
    precio float(100,2) not null,
    stock int(255) not null,
    oferta varchar(2),
    fecha date not null,
    imagen varchar(255),
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS pedidos;
CREATE TABLE IF NOT EXISTS pedidos(
    id int(255) auto_increment not null,
    usuario_id int(255) not null,
    provincia varchar(100) not null,
    localidad varchar(100) not null,
    direccion varchar(255) not null,
    coste float(200,2) not null,
    estado varchar(20) not null,
    fecha date,
    hora time,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS lineas_pedidos;
CREATE TABLE IF NOT EXISTS lineas_pedidos(
    id int(255) auto_increment not null,
    pedido_id int(255) not null,
    producto_id int(255) not null,
    unidades int(255) not null,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

ALTER TABLE lineas_pedidos
DROP FOREIGN KEY fk_linea_producto,
ADD FOREIGN KEY (producto_id) REFERENCES productos (id) ON DELETE CASCADE;

ALTER TABLE productos
DROP FOREIGN KEY fk_producto_categoria,
ADD FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE CASCADE;

-- Insertando nuevas categorías
INSERT INTO categorias (nombre) VALUES
('Monitores'),
('Portátiles'),
('Teclados'),
('Ratones');

-- Insertando productos de ejemplo
-- Monitores
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(1, 'Monitor LG 24MP59G', 'Monitor LG de 24 pulgadas con tecnología IPS para gaming', 200.00, 50, NULL, CURDATE(), 'lg_24mp59g.jpg'),
(1, 'Monitor Samsung Curvo', 'Monitor curvo de Samsung de 27 pulgadas', 300.00, 30, '10%', CURDATE(), 'samsung_curvo.jpg'),
(1, 'Monitor Dell Ultrasharp', 'Monitor Dell de 32 pulgadas Ultrasharp con resolución 4K', 450.00, 20, NULL, CURDATE(), 'dell_ultrasharp.jpg'),
(1, 'Monitor Asus ProArt', 'Monitor Asus ProArt para profesionales de la creatividad', 600.00, 15, '5%', CURDATE(), 'asus_proart.jpg');

-- Portátiles
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(2, 'Portátil HP Pavilion 15', 'Portátil HP Pavilion de 15.6 pulgadas ideal para trabajo y juego', 700.00, 40, NULL, CURDATE(), 'hp_pavilion15.jpg'),
(2, 'MacBook Pro 16', 'Apple MacBook Pro de 16 pulgadas con chip M1', 2400.00, 30, NULL, CURDATE(), 'macbook_pro16.jpg'),
(2, 'Dell XPS 13', 'Dell XPS 13 ultraligero y potente con pantalla 4K', 1000.00, 25, '5%', CURDATE(), 'dell_xps13.jpg'),
(2, 'Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad X1 Carbon, ultraligero y robusto', 1500.00, 20, NULL, CURDATE(), 'thinkpad_x1carbon.jpg');

-- Teclados
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(3, 'Teclado Mecánico Corsair K95', 'Teclado mecánico Corsair K95 RGB Platinum', 170.00, 50, '10%', CURDATE(), 'corsair_k95.jpg'),
(3, 'Teclado Logitech K380', 'Teclado Logitech K380 multi-dispositivo Bluetooth', 40.00, 60, NULL, CURDATE(), 'logitech_k380.jpg'),
(3, 'Teclado Razer BlackWidow', 'Teclado mecánico Razer BlackWidow Elite', 130.00, 40, NULL, CURDATE(), 'razer_blackwidow.jpg'),
(3, 'Teclado Apple Magic Keyboard', 'Apple Magic Keyboard con diseño minimalista', 90.00, 30, NULL, CURDATE(), 'apple_magic.jpg');

-- Ratones
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(4, 'Ratón Logitech MX Master 3', 'Ratón inalámbrico Logitech MX Master 3 para avanzada productividad', 100.00, 45, NULL, CURDATE(), 'logitech_mxmaster3.jpg'),
(4, 'Ratón Razer DeathAdder V2', 'Ratón Razer DeathAdder V2, óptimo para gaming', 50.00, 60, '15%', CURDATE(), 'razer_deathadderv2.jpg'),
(4, 'Ratón Corsair Harpoon', 'Ratón gaming Corsair Harpoon RGB Wireless', 60.00, 30, NULL, CURDATE(), 'corsair_harpoon.jpg'),
(4, 'Apple Magic Mouse 2', 'Apple Magic Mouse 2 con superficie táctil', 80.00, 40, NULL, CURDATE(), 'apple_magicmouse2.jpg');

-- Usuarios
INSERT INTO usuarios (nombre, apellidos, email, password, rol) 
VALUES ('admin', 'admin', 'admin@gmail.com', '$2y$04$XZoQNRD0kF1kJ1Re1W2NRODn6.I5.2Z0Wp/j94vimGJ/Klubz18de', 'admin');