DROP DATABASE IF EXISTS travel_agency; 
CREATE DATABASE travel_agency DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE travel_agency;

CREATE TABLE destinations (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(256) NOT NULL,
	image VARCHAR(256),
	description VARCHAR(1024) NOT NULL,
	published BIT NOT NULL DEFAULT 1,
	published_date DATETIME,
	created_date DATETIME,
	modified_date DATETIME
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE tours (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(256) NOT NULL,
	image VARCHAR(256),
	price float NOT NULL,
	short_description VARCHAR(512),
	description TEXT,
	destination_id INT REFERENCES destinations(id),
	published BIT NOT NULL DEFAULT 1,
	published_date DATETIME,
	created_date DATETIME,
	modified_date DATETIME
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	role VARCHAR(16) NOT NULL DEFAULT 'guest',
	created_date DATETIME,
	modified_date DATETIME
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE orders (
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT,
	status INT DEFAULT 1, -- 1: pending, 2: confirmed, 3: canceled
	created_date DATETIME,
	modified_date DATETIME
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE order_items (
	item_id INT NOT NULL REFERENCES users(id),
	order_id INT NOT NULL REFERENCES orders(id),
	quantity INT NOT NULL CHECK (quantity > 0),
	price float NOT NULL,
	PRIMARY KEY (item_id, order_id)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TRIGGER IF EXISTS tgg_insert_destinations;
delimiter //
CREATE TRIGGER tgg_insert_destinations 
BEFORE INSERT ON destinations
FOR EACH ROW 
BEGIN
	SET NEW.created_date = now();
	SET NEW.modified_date = now();
	IF NEW.published = 1 THEN
		SET NEW.published_date = now();
	END IF;
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_update_destinations;
delimiter //
CREATE TRIGGER tgg_update_destinations 
BEFORE UPDATE ON destinations
FOR EACH ROW 
BEGIN
	SET NEW.modified_date = now();
	IF NEW.published != OLD.published AND NEW.published = 1 THEN
		SET NEW.published_date = now();
	END IF;
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_insert_tours;
delimiter //
CREATE TRIGGER tgg_insert_tours
BEFORE INSERT ON tours
FOR EACH ROW 
BEGIN
	SET NEW.created_date = now();
	SET NEW.modified_date = now();
	IF NEW.published = 1 THEN
		SET NEW.published_date = now();
	END IF;
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_update_tours;
delimiter //
CREATE TRIGGER tgg_update_tours
BEFORE UPDATE ON tours
FOR EACH ROW 
BEGIN
	SET NEW.modified_date = now();
	IF NEW.published != OLD.published AND NEW.published = 1 THEN
		SET NEW.published_date = now();
	END IF;
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_insert_users;
delimiter //
CREATE TRIGGER tgg_insert_users
BEFORE INSERT ON users
FOR EACH ROW 
BEGIN
	SET NEW.created_date = now();
	SET NEW.modified_date = now();
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_update_users;
delimiter //
CREATE TRIGGER tgg_update_users
BEFORE UPDATE ON users
FOR EACH ROW 
BEGIN
	SET NEW.modified_date = now();
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_insert_orders;
delimiter //
CREATE TRIGGER tgg_insert_orders
BEFORE INSERT ON orders
FOR EACH ROW 
BEGIN
	SET NEW.created_date = now();
	SET NEW.modified_date = now();
END;//
delimiter ;

DROP TRIGGER IF EXISTS tgg_update_orders;
delimiter //
CREATE TRIGGER tgg_update_orders
BEFORE UPDATE ON orders
FOR EACH ROW 
BEGIN
	SET NEW.modified_date = now();
END;//
delimiter ;

INSERT INTO destinations(name, image, description) VALUES ('Europe', 'img/europe.jpg', 'Europe is an amazing place for a holiday. From the famous Eiffel Tower and Louvre Museum in Paris to the mountain railway of Jungfrau in Switzerland or Amsterdam’s exciting nightlife,  we can take you to all the best bits of Europe in our modern, comfortable coaches.');
INSERT INTO destinations(name, image, description) VALUES ('Asia', 'img/asia.jpg', 'Sum up Asia in a paragraph? Good luck. Positively massive by just about every measure, the sole thread that unites this diverse continent is the sheer diversity of experiences it presents to travellers.');
INSERT INTO destinations(name, image, description) VALUES ('Africa', 'img/africa.jpg', 'On this route you will experience \'The World in one Country\' with very spectacular scenery, big game on safari, African Cultures, Ocean, Mountains and semi-desert. The menu is very varied and spiced by your guide with background information and stories about present and past.');
INSERT INTO destinations(name, image, description) VALUES ('Australia', 'img/australia.jpg', 'Tourists visit places and see things. Travellers journey to places and experience things. At Aussie Farmstay and Bush Adventures we design our tours for travellers, not tourists. We travel in a small group (maximum of 11 passengers) to ensure the experience is a personalised one. As long as two passengers have booked an Aussie Farmstay and Bush Adventures tour, the tour will proceed.');
INSERT INTO destinations(name, image, description) VALUES ('South America', 'img/south_america.jpg', 'Colourful, candid and everything in between, South America beats to the rhythm of an infectious, eternal drum. Captured in the chaos of Rio\'s carnival, echoing on Columbia\'s Caribbean beaches and booming along the peaks of the Andes, an effervescent spirit bursts from every facet of life on this remarkable continent.');