-- Create table for attribute entities
CREATE TABLE `oc_itdaat_attribute` (
    id INTEGER PRIMARY KEY AUTO_INCREMENT
);
-- Create table for attribute names
CREATE TABLE `oc_itdaat_attribute_name` (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    language_id INT,
    name VARCHAR(255),
    attr_itdaat_id INT,
    FOREIGN KEY (attr_itdaat_id) REFERENCES `oc_itdaat_attribute`(`id`)
);
-- Create table for atribute values
CREATE TABLE `oc_itdaat_attribute_val` (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    language_id INT,
    name VARCHAR(255),
    attr_itdaat_id INT,
    FOREIGN KEY (attr_itdaat_id) REFERENCES `oc_itdaat_attribute`(`id`)
);
--  Create table for attribute copy
CREATE TABLE `oc_itdaat_attributte_OCcopy` (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    attribute_group_id INT(11),
    sort_order INT(3)
);
-- Create table for description copy
CREATE TABLE `oc_itdaat_attribute_description_OCcopy` (
    attribute_id INT(11),
    language_id INT,
    name VARCHAR(64)
);
-- Create table for product_attribute copy
CREATE TABLE `oc_itdaat_product_attribute_OCcopy` (
    product_id INT(11),
    attribute_id INT(11),
    language_id INT(11),
    `text` text
);
-- Create table for product-dictionary
CREATE TABLE `oc_itdaat_product_dictionary` (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    product_id INT(11),
    dictionary_id INT(11),
    FOREIGN KEY (product_id) REFERENCES `oc_product`(`product_id`),
    FOREIGN KEY (dictionary_id) REFERENCES `oc_itdaat_dictionary`(`id`)
);

-- Create dictionary
CREATE TABLE `oc_itdaat_dictionary`(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    language_id int,
    attribute_name varchar(255),
    attribute_description varchar(255),
    itdaat_attr_id int,
    itdaat_attr_val_id int,
    FOREIGN KEY (itdaat_attr_id) REFERENCES `oc_itdaat_attribute`(`id`),
    FOREIGN KEY (itdaat_attr_val_id) REFERENCES `oc_itdaat_attribute_val`(`id`)
);

-- Create function to check if such attribute exists
CREATE FUNCTION attribute_exists_in_itdaat (name VARCHAR(255), language_id INT) RETURNS INT
RETURN (SELECT 1 FROM `oc_itdaat_attribute_name` WHERE `oc_itdaat_attribute_name`.`name`  = name AND `oc_itdaat_attribute_name`.`language_id` = language_id);

-- Create function to check if such attribute value exists
CREATE FUNCTION attribute_value_exists_in_itdaat (name VARCHAR(255), language_id INT) RETURNS INT
RETURN (SELECT 1 FROM `oc_itdaat_attribute_val` WHERE `oc_itdaat_attribute_val`.`name`  = name AND `oc_itdaat_attribute_val`.`language_id` = language_id);

-- Create function to check if such attribute name exists in the dictionary
CREATE FUNCTION attr_name_exists_in_dictionary_itdaat (name VARCHAR(255),language_id INT(11)) RETURNS INT
RETURN (SELECT 1 FROM `oc_itdaat_dictionary` WHERE `oc_itdaat_dictionary`.`attribute_name` = name AND `oc_itdaat_dictionary`.`language_id` = language_id AND `oc_itdaat_dictionary`.`itdaat_attr_id` IS NOT NULL and `oc_itdaat_dictionary`.`itdaat_attr_val_id` IS NOT NULL);

-- Create trigger in insert to the attribute name to wirte to our copy all data and to the original null
DELIMITER //
CREATE TRIGGER attribute_description_insert_to_copy BEFORE INSERT ON `oc_attribute_description` FOR EACH ROW
BEGIN
	INSERT INTO `oc_itdaat_attribute_description_OCcopy` (attribute_id,language_id,name) VALUES (NEW.attribute_id, NEW.language_id, NEW.name);
    DELETE FROM `oc_attribute_description` WHERE NEW.attribute_id = attribute_id AND NEW.language_id = language_id;
END //
-- Create trigger to the attribute value to wirte to our copy all data and to the original null
DELIMITER //
CREATE TRIGGER attribute_value_insert_to_copy BEFORE INSERT ON `oc_product_attribute` FOR EACH ROW
BEGIN
	INSERT INTO `oc_itdaat_product_attribute_OCcopy` (product_id,attribute_id,language_id,text) VALUES (NEW.product_id, NEW.attribute_id, NEW.language_id, NEW.text);
    SIGNAL SQLSTATE '45000';
END //




--  Create trigger in insert to the attribute(opencart) real data wirte to our copy name to wirte in opencarts null
-- DELIMITER //
-- CREATE TRIGGER attribute_insert_to_copy AFTER INSERT ON `oc_attribute` FOR EACH ROW
-- BEGIN
-- 	INSERT INTO `oc_itdaat_attributte_OCcopy` (attribute_group_id,sort_order) VALUES (NEW.attribute_group_id, NEW.sort_order);
--     DELETE FROM `oc_attribute` WHERE NEW;
-- END //
