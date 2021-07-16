ALTER TABLE oc_product_attribute DROP INDEX IF EXISTS `PRIMARY`;
alter table oc_product_attribute modify attribute_id int(11) default null;
alter table oc_product_attribute modify product_id int(11) default null;
alter table oc_product_attribute modify language_id int(11) default null;
alter table oc_product_attribute modify text text default null;

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
    attribute_id int(11),
    itdaat_attribute_id int(11),
    primary key (attribute_id,itdaat_attribute_id)
);
-- create itdaat_dictionary for attribute and value
create table `oc_itdaat_dictionary`(
    language_id int(11),
    oc_attribute_id int(11),
    oc_attribute_value varchar(256),
    itdaat_attribute_id int(11),
    itdaat_attribute_value_id int(11),
    primary key (language_id,oc_attribute_id,oc_attribute_value)
);
-- create table copy of the oc_product_attribute
CREATE TABLE `oc_itdaat_product_attribute` (
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `oc_itdaat_product_attribute2` (
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `language_id` int(11) DEFAULT NULL,
  `text` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


delimiter //
create trigger itdaat_insert_product_attribute before insert on oc_product_attribute for each row
begin
    if(select !isnull(NEW.attribute_id) and !isnull(NEW.text)) then
        insert into oc_itdaat_dictionary (language_id, oc_attribute_id, oc_attribute_value) values (NEW.language_id, NEW.attribute_id, NEW.text) on duplicate key update language_id = language_id;
        insert into oc_itdaat_product_attribute (product_id, attribute_id, language_id, text) values (NEW.product_id, NEW.attribute_id, NEW.language_id, NEW.text);

        select oc_itdaat_attribute_name.name, oc_itdaat_attribute_value.value, oc_itdaat_dictionary.itdaat_attribute_id
            into  @name, @value, @itdaat_attribute_id
            from oc_itdaat_dictionary
        left join oc_itdaat_attribute_name
            on oc_itdaat_attribute_name.itdaat_attribute_id = oc_itdaat_dictionary.itdaat_attribute_id and oc_itdaat_attribute_name.language_id = oc_itdaat_dictionary.language_id
        left join oc_itdaat_attribute_value
            on oc_itdaat_attribute_value.id = oc_itdaat_dictionary.itdaat_attribute_value_id and oc_itdaat_attribute_value.itdaat_attribute_id = oc_itdaat_dictionary.itdaat_attribute_id and oc_itdaat_attribute_value.language_id = oc_itdaat_dictionary.language_id
        where
            oc_itdaat_dictionary.language_id = NEW.language_id and oc_itdaat_dictionary.oc_attribute_id = NEW.attribute_id and oc_itdaat_dictionary.oc_attribute_value = NEW.text;
        
        set @attribute_id = null;
        select oc_itdaat_attribute_dictionary.attribute_id into @attribute_id from oc_itdaat_attribute_dictionary
            where 
                oc_itdaat_attribute_dictionary.itdaat_attribute_id = @itdaat_attribute_id;

        if (select isnull(@attribute_id)  and !isnull(@value) and !isnull(@itdaat_attribute_id))then
            select max( oc_attribute.attribute_id ) + 1 into @attribute_id from oc_attribute;
            select oc_attribute.attribute_group_id, oc_attribute.sort_order into @group_id, @sort_order from oc_attribute where oc_attribute.attribute_id = NEW.attribute_id;
            insert into oc_attribute (attribute_id, attribute_group_id, sort_order) values (@attribute_id, @group_id, @sort_order);
            insert into oc_attribute_description (attribute_id, language_id, name) values (@attribute_id, NEW.language_id, @name);
            insert into oc_itdaat_attribute_dictionary (attribute_id,itdaat_attribute_id) values (@attribute_id, @itdaat_attribute_id);
        end if;

        set NEW.text = @value, NEW.attribute_id = @attribute_id;
    end if;

end; //


delimiter //
create trigger itdaat_update_product_attribute before update on oc_product_attribute for each row
begin
    if(select !isnull(NEW.attribute_id) and !isnull(NEW.text)) then
        insert into oc_itdaat_dictionary (language_id, oc_attribute_id, oc_attribute_value) values (NEW.language_id, NEW.attribute_id, NEW.text) on duplicate key update language_id = language_id;
        insert into oc_itdaat_product_attribute (product_id, attribute_id, language_id, text) values (NEW.product_id, NEW.attribute_id, NEW.language_id, NEW.text);

        select oc_itdaat_attribute_name.name, oc_itdaat_attribute_value.value, oc_itdaat_dictionary.itdaat_attribute_id
            into  @name, @value, @itdaat_attribute_id
            from oc_itdaat_dictionary
        left join oc_itdaat_attribute_name
            on oc_itdaat_attribute_name.itdaat_attribute_id = oc_itdaat_dictionary.itdaat_attribute_id and oc_itdaat_attribute_name.language_id = oc_itdaat_dictionary.language_id
        left join oc_itdaat_attribute_value
            on oc_itdaat_attribute_value.id = oc_itdaat_dictionary.itdaat_attribute_value_id and oc_itdaat_attribute_value.itdaat_attribute_id = oc_itdaat_dictionary.itdaat_attribute_id and oc_itdaat_attribute_value.language_id = oc_itdaat_dictionary.language_id
        where
            oc_itdaat_dictionary.language_id = NEW.language_id and oc_itdaat_dictionary.oc_attribute_id = NEW.attribute_id and oc_itdaat_dictionary.oc_attribute_value = NEW.text;
        
        set @attribute_id = null;
        select oc_itdaat_attribute_dictionary.attribute_id into @attribute_id from oc_itdaat_attribute_dictionary
            where 
                oc_itdaat_attribute_dictionary.itdaat_attribute_id = @itdaat_attribute_id;

        if (select isnull(@attribute_id)  and !isnull(@value) and !isnull(@itdaat_attribute_id))then
            select max( oc_attribute.attribute_id ) + 1 into @attribute_id from oc_attribute;
            select oc_attribute.attribute_group_id, oc_attribute.sort_order into @group_id, @sort_order from oc_attribute where oc_attribute.attribute_id = NEW.attribute_id;
            insert into oc_attribute (attribute_id, attribute_group_id, sort_order) values (@attribute_id, @group_id, @sort_order);
            insert into oc_attribute_description (attribute_id, language_id, name) values (@attribute_id, NEW.language_id, @name);
            insert into oc_itdaat_attribute_dictionary (attribute_id,itdaat_attribute_id) values (@attribute_id, @itdaat_attribute_id);
        end if;

        set NEW.text = @value, NEW.attribute_id = @attribute_id;
    end if;

end; //