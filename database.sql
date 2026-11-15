CREATE DATABASE IF NOT EXISTS dbproject6
	DEFAULT CHARACTER SET utf8mb4
	DEFAULT COLLATE utf8mb4_unicode_ci;

USE dbproject6;

CREATE TABLE IF NOT EXISTS tb_kategori (
	kat_id TINYINT(3) NOT NULL AUTO_INCREMENT,
	kat_nama VARCHAR(50) NOT NULL,
	kat_keterangan TEXT DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(kat_id)
);

CREATE TABLE IF NOT EXISTS tb_users (
	user_id INT(11) NOT NULL AUTO_INCREMENT,
	user_email VARCHAR(50) NOT NULL,
	user_password VARCHAR(100) NOT NULL,
	user_nama VARCHAR(100) DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(user_id),
	UNIQUE KEY(user_email)
);

CREATE TABLE IF NOT EXISTS tb_produk (
	produk_id INT(11) NOT NULL AUTO_INCREMENT,
	produk_id_kat TINYINT(3) NOT NULL,
	produk_id_user INT(11) NOT NULL,
	produk_kode VARCHAR(50) NOT NULL,
	produk_nama VARCHAR(256) NOT NULL,
	produk_hrg BIGINT(20) DEFAULT '0',
	produk_keterangan TEXT DEFAULT NULL,
	produk_stock INT(11) DEFAULT '0',
	produk_photo VARCHAR(100) DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME DEFAULT NULL,
	PRIMARY KEY(produk_id),
	UNIQUE KEY(produk_kode),
	FOREIGN KEY(produk_id_kat) REFERENCES tb_kategori(kat_id) ON UPDATE CASCADE ON DELETE RESTRICT,
	FOREIGN KEY(produk_id_user) REFERENCES tb_users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT IGNORE INTO tb_users (user_id, user_email, user_password, user_nama) VALUES
(1, 'admin@mail.com', '$2y$10$NDgBjEE1XLld.AW/NkZSSehmialL0vrrqhoYkU2P23rlA.YoKoN56', 'Administrator');