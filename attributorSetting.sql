Create table `oc_itdaat_attribute_copy` (
   attribute_id INTEGER PRIMARY KEY AUTO_INCREMENT,
   attribute_group_id int(11),
   sort_order int(3)
);

Create table `oc_itdaat_attribute_description_copy`(
    attribute_id int(11),
    language_id int(11),
    name varchar(64) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oc_itdaat_product_attribute_copy` (
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

Create table `oc_itdaat_attribute` (
   attribute_id INTEGER PRIMARY KEY AUTO_INCREMENT
);

Create table `oc_itdaat_attribute_description`(
    attribute_id int(11),
    language_id int(11),
    name varchar(64) 
)ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oc_itdaat_product_attribute` (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

Create table `oc_itdaat_dictionary` (
    id integer(11) PRIMARY key AUTO_INCREMENT,
    language_id int(11),
    attribute_name varchar(64) not null,
    attribute_value varchar(64) not null,
    itdaat_attribute_id int(11),
    itdaat_attribute_value int(11)
);
CREATE FUNCTION itdaat_check_in_dictionary (attr_name varchar(64), attr_value varchar(64), lang_id int(11)) RETURNS int
RETURN EXISTS(SELECT 1 FROM `oc_itdaat_dictionary` WHERE 
              `oc_itdaat_dictionary`.`attribute_name` = attr_name
              	AND
              `oc_itdaat_dictionary`.`attribute_value` = attr_value
              	AND 
              `oc_itdaat_dictionary`.`language_id` = lang_id);


DELIMITER //
CREATE TRIGGER itdaat_attribute_value_insert BEFORE INSERT ON `oc_product_attribute` FOR EACH ROW
BEGIN
	SELECT `oc_attribute_description`.`name` INTO @attr_name FROM `oc_attribute_description` WHERE 
	`oc_attribute_description`.`attribute_id` = NEW.attribute_id
		AND
	`oc_attribute_description`.`language_id` = NEW.language_id;
     IF(SELECT itdaat_check_in_dictionary(@attr_name, NEW.text, NEW.language_id)) THEN 
  	SELECT `oc_itdaat_dictionary`.`itdaat_attribute_id` INTO @attr_itdaat_name_id FROM `oc_itdaat_dictionary` WHERE
       	`oc_itdaat_dictionary`.`language_id` = NEW.language_id
       		AND
       `oc_itdaat_dictionary`.`attribute_name` = @attr_name
       		AND 
       `oc_itdaat_dictionary`.`attribute_value` = NEW.text;
    SELECT `oc_itdaat_attribute_description`.`name` INTO @attr_itdaat_name FROM `oc_itdaat_attribute_description` WHERE
      	`oc_itdaat_attribute_description`.`attribute_id` = @attr_itdaat_name_id
      		AND
      	`oc_itdaat_attribute_description`.`language_id` = NEW.language_id;
     INSERT INTO `oc_attribute_description` (attribute_id,language_id,name) 
      	VALUES (NEW.attribute_id, NEW.language_id, @attr_itdaat_name);
      
      
    SELECT `oc_itdaat_dictionary`.`itdaat_attribute_value` INTO @attr_itdaat_value_id FROM `oc_itdaat_dictionary` WHERE
      	`oc_itdaat_dictionary`.`language_id` = NEW.language_id
      		AND 
      	`oc_itdaat_dictionary`.`attribute_value` = NEW.text
      		AND 
      	`oc_itdaat_dictionary`.`attribute_name` = @attr_name;
    SELECT `oc_itdaat_product_attribute`.`text` INTO @attr_itdaat_value FROM `oc_itdaat_attribute_description` WHERE
      	`oc_itdaat_product_attribute`.`id` = @attr_itdaat_value_id
      		AND 
      	`oc_itdaat_product_attribute`.`language_id` = NEW.language_id;
    SET NEW.text = @attr_itdaat_value;
    ELSE
       		INSERT INTO `oc_itdaat_dictionary` 
      (`language_id`, `attribute_name`, `attribute_value`, `itdaat_attribute_id`,`itdaat_attribute_value`)
       		VALUES
       (NEW.language_id, @attr_name,  NEW.text, null, null);
    END IF;
    
END //
