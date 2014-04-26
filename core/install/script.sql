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
	details VARCHAR(256),
	thumbnail VARCHAR(256),
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
INSERT INTO destinations(name, image, description) VALUES ('North America', 'img/canada.jpg', 'Enjoy the cosmopolitan buzz of San Francisco and the Bay Area.');
-- SELECT * FROM destinations;

INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('London', '7 days, 3 countries, 15 experiences', 'img/place_london.jpg', 'img/slide2.jpg', 675, 'Leave London and cross the English Channel. Upon arrival in Paris late afternoon we will undertake a driving tour of this beautiful city taking in some of the most iconic sights. After dinner you have the rest of the night to explore Paris.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Paris', '7 nights, 4-star hotel, B&B', 'img/place_paris.jpg', 'img/slide4.jpg', 999, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('London', '10 days, 5 countries, 8 experiences', 'img/place_london.jpg', 'img/slide2.jpg', 1105, 'Leave London and cross the English Channel. Upon arrival in Paris late afternoon we will undertake a driving tour of this beautiful city taking in some of the most iconic sights. After dinner you have the rest of the night to explore Paris.', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Dublin', '7 days, 1 country, 15 experiences', 'img/place_dublin.jpg', 'img/slide_dublin.jpg', 680, 'Are you up for the craic? This 7 day coach tour of Ireland is filled with music, monuments and mystical locations! Explore the highlights of Northern Ireland and the Republic, including Celtic castles, city sightseeing, and natural wonders unique to the Emerald Isle.  The Giants Causeway, Cliffs of Moher, Ring of Kerry, Blarney Castle and the cities of Waterford, Dublin and Belfast are just some of the highlights. This Ireland holiday tour will give you a taste of the traditional and a load of Irish hospitality. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Switzerland', '10 nights, 5-star hotel, all inclusive', 'img/place_switzerland.jpg', 'img/slide4.jpg', 1799, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Thailand', '7 nights, 4-star hotel, B&B', 'img/place_thailand.jpg', 'img/slide4.jpg', 1699, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 2);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('New York', '3 nights in 4-star hotel, all inclusive', 'img/place_newyork.jpg', 'img/slide2.jpg', 999, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 6);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Italy', '1 night, 4-star hotel, B&B', 'img/place_italy.jpg', 'img/slide5.jpg', 356, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Canada', '5 nights, 4-star hotel, all inclusive', 'img/place_canada.jpg', 'img/slide1.jpg', 899, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 5);
INSERT INTO tours(name, details, thumbnail, image, price, short_description, description, destination_id) VALUES('Australia', '4 nights, 5-star hotel, B&B', 'img/place_australia.jpg', 'img/slide5.jpg', 1099, 'I\'m a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc elementum scelerisque malesuada. Morbi congue bibendum diam, at volutpat nisl pellentesque sit amet. In mattis diam ac justo venenatis auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse eget diam vitae felis fermentum rhoncus adipiscing nec magna. Phasellus sed massa nec dui tincidunt scelerisque eget quis leo. Cras bibendum ullamcorper mi, rutrum pretium odio tempus eu. </p><p>Proin non purus magna. Sed non fermentum sem. Nunc rutrum mauris pretium elit rutrum consequat. Vestibulum porttitor libero quis nibh lobortis interdum. Morbi tincidunt est quis semper pharetra. Pellentesque varius aliquam ornare. Sed accumsan arcu eget pellentesque semper. Nullam auctor orci at libero consectetur, ut pharetra velit euismod. Duis et mauris mollis, auctor quam vel, adipiscing metus. Curabitur vel imperdiet nulla, ut gravida leo. Donec dignissim massa at eros aliquet, at placerat orci viverra. Aliquam blandit molestie facilisis. Pellentesque tempus sollicitudin consequat. Duis volutpat, turpis eget feugiat pretium, ante lacus facilisis nisi, nec adipiscing velit risus ac purus. Phasellus nec luctus mauris. </p>', 1);
-- SELECT * FROM tours;
