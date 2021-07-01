-- create table for the itdaat attribute
create table `oc_itdaat_attribute`(
	id integer primary key AUTO_INCREMENT
);
-- create table for the itdaat attribute name
create table `oc_itdaat_attribute_name`(
	id integer primary key AUTO_INCREMENT,
    `itdaat_attribute_id` int(11),
    language_id int(11),
    `name` varchar(64)
);
-- create table for the itdaat attribute value
create table `oc_itdaat_attribute_value`(
	id integer primary key auto_increment,
    language_id int(11),
    itdaat_attribute_id int(11),
    value text
);
-- create dictionary table for attributes only
Create table `oc_itdaat_attribute_dictionary`(
    id integer primary key auto_increment,
    attribute_id int(11),
    itdaat_attribute_id int(11)
);
-- create itdaat_dictionary for attribute and value
create table `oc_itdaat_dictionary`(
	id integer primary key AUTO_INCREMENT,
    language_id int(11),
    oc_attribute_id int(11),
    oc_attribute_value varchar(64),
    itdaat_attribute_id int(11),
    itdaat_attribute_value_id int(11)
)ENGINE=MyISAM DEFAULT CHARSET=utf8;
-- create trigger on adding to the product_attribute table
DELIMITER //
create trigger itdaat_insert_product_attribute before insert on `oc_product_attribute` for each row 
begin
    select
        	`oc_itdaat_attribute_name`.`name`, `oc_itdaat_attribute_value`.`value`, `oc_itdaat_dictionary`.`itdaat_attribute_id`
             into 
             @attribute_itdaat_name, @attribute_itdaat_value, @attribute_itdaat_id
        	from `oc_itdaat_dictionary` 
            left join `oc_itdaat_attribute_name` on `oc_itdaat_attribute_name`.`id` = `oc_itdaat_dictionary`.`itdaat_attribute_id`
            left join `oc_itdaat_attribute_value` on `oc_itdaat_attribute_value`.`id` = `oc_itdaat_dictionary`.`itdaat_attribute_value_id`
        	where `oc_itdaat_dictionary`.`language_id` = NEW.language_id and `oc_itdaat_dictionary`.`oc_attribute_id` = NEW.attribute_id and `oc_itdaat_dictionary`.`oc_attribute_value` = NEW.text
            limit 1;
    -- check if attribute value and attribute id exists   
    if(select ISNULL(@attribute_itdaat_name) or ISNULL(@attribute_itdaat_value)) then 
        -- insert into the dictionary without itdaat_attribute_id and itdaat_attribute_value_id
        insert into `oc_itdaat_dictionary` (`language_id`,`oc_attribute_id`,`oc_attribute_value`,`itdaat_attribute_id`, `itdaat_attribute_value_id`) VALUES(NEW.language_id,NEW.attribute_id, NEW.text,null,null);
    else
        -- if attribute itdaat name and value exists in the dictionary we have to check if such itdaat_attribute_id does not exists in the attribute dictionary
        select `oc_itdaat_attribute_dictionary`.`attribute_id` into @attr_id from `oc_itdaat_attribute_dictionary` where `oc_itdaat_attribute_dictionary`.`itdaat_attribute_id` = @attribute_itdaat_id limit 1;
        if(select ISNULL(@attr_id)) then
            -- text change to the itdaat attribute value
            set NEW.text = @attribute_itdaat_value;
            --  create attribute (and descrioption) tables
                -- select from `oc_attribute` last id
                select MAX(`oc_attribute`.`attribute_id`) + 1 into @last_attr_id from `oc_attribute`;
                -- select group id of the current attribute
                select `oc_attribute`.`attribute_group_id`, `oc_attribute`.`sort_order` + 1 into @attr_group_id, @sort_order from `oc_attribute` where `oc_attribute`.`attribute_id` = NEW.attribute_id;
                -- set new attribute id in the data to be inserted
                set NEW.attribute_id = @last_attr_id;
            -- insert new attribute
            insert into `oc_attribute` (`attribute_id`,`sort_order`, `attribute_group_id`) values (@last_attr_id, @sort_order, @attr_group_id);
            -- insert new attribute descrioption
            insert into `oc_attribute_description` (`attribute_id`,`language_id`, `name`) values (@last_attr_id, NEW.language_id, @attribute_itdaat_name);
            -- add to the attribute dictionary attribute itdaat id from dictionary and last attribute id from opencart
            insert into `oc_itdaat_attribute_dictionary` (`attribute_id`, `itdaat_attribute_id`) values (@last_attr_id, @attribute_itdaat_id);
        else
            set NEW.text = @attribute_itdaat_value;
            set NEW.attribute_id = @attr_id;
        end if;

    end if;
end//
-- create trigger on editing to the product_attribute table
DELIMITER //
create trigger itdaat_insert_product_attribute before update on `oc_product_attribute` for each row 
begin
    select
        	`oc_itdaat_attribute_name`.`name`, `oc_itdaat_attribute_value`.`value`, `oc_itdaat_dictionary`.`itdaat_attribute_id`
             into 
             @attribute_itdaat_name, @attribute_itdaat_value, @attribute_itdaat_id
        	from `oc_itdaat_dictionary` 
            left join `oc_itdaat_attribute_name` on `oc_itdaat_attribute_name`.`id` = `oc_itdaat_dictionary`.`itdaat_attribute_id`
            left join `oc_itdaat_attribute_value` on `oc_itdaat_attribute_value`.`id` = `oc_itdaat_dictionary`.`itdaat_attribute_value_id`
        	where `oc_itdaat_dictionary`.`language_id` = NEW.language_id and `oc_itdaat_dictionary`.`oc_attribute_id` = NEW.attribute_id and `oc_itdaat_dictionary`.`oc_attribute_value` = NEW.text
            limit 1;
    -- check if attribute value and attribute id exists   
    if(select ISNULL(@attribute_itdaat_name) or ISNULL(@attribute_itdaat_value)) then 
        -- insert into the dictionary without itdaat_attribute_id and itdaat_attribute_value_id
        insert into `oc_itdaat_dictionary` (`language_id`,`oc_attribute_id`,`oc_attribute_value`,`itdaat_attribute_id`, `itdaat_attribute_value_id`) VALUES(NEW.language_id,NEW.attribute_id, NEW.text,null,null);
    else
        -- if attribute itdaat name and value exists in the dictionary we have to check if such itdaat_attribute_id does not exists in the attribute dictionary
        select `oc_itdaat_attribute_dictionary`.`attribute_id` into @attr_id from `oc_itdaat_attribute_dictionary` where `oc_itdaat_attribute_dictionary`.`itdaat_attribute_id` = @attribute_itdaat_id limit 1;
        if(select ISNULL(@attr_id)) then
            -- text change to the itdaat attribute value
            set NEW.text = @attribute_itdaat_value;
            --  create attribute (and descrioption) tables
                -- select from `oc_attribute` last id
                select MAX(`oc_attribute`.`attribute_id`) + 1 into @last_attr_id from `oc_attribute`;
                -- select group id of the current attribute
                select `oc_attribute`.`attribute_group_id`, `oc_attribute`.`sort_order` + 1 into @attr_group_id, @sort_order from `oc_attribute` where `oc_attribute`.`attribute_id` = NEW.attribute_id;
                -- set new attribute id in the data to be inserted
                set NEW.attribute_id = @last_attr_id;
            -- insert new attribute
            insert into `oc_attribute` (`attribute_id`,`sort_order`, `attribute_group_id`) values (@last_attr_id, @sort_order, @attr_group_id);
            -- insert new attribute descrioption
            insert into `oc_attribute_description` (`attribute_id`,`language_id`, `name`) values (@last_attr_id, NEW.language_id, @attribute_itdaat_name);
            -- add to the attribute dictionary attribute itdaat id from dictionary and last attribute id from opencart
            insert into `oc_itdaat_attribute_dictionary` (`attribute_id`, `itdaat_attribute_id`) values (@last_attr_id, @attribute_itdaat_id);
        else
            set NEW.text = @attribute_itdaat_value;
            set NEW.attribute_id = @attr_id;
        end if;

    end if;
end//