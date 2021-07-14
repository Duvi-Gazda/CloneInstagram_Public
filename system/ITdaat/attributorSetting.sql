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
-- create table that will continue all values that are already set in the product_attribute table
create table oc_itdaat_attribute_value_exists (
    id integer primary key auto_increment,
    product_id int(11),
    language_id int(3),
    attribute_id int(11)
);
-- create trigger on adding to the product_attribute table
delimiter //
create trigger itdaat_insert_product_attribute before update on oc_product_attribute for each row
begin
    select
        oc_itdaat_attribute_name.name, oc_itdaat_attribute_value.value, oc_itdaat_dictionary.itdaat_attribute_id, oc_itdaat_dictionary.oc_attribute_id
    into
        @attribute_itdaat_name, @attribute_itdaat_value, @attribute_itdaat_id, @dict_id
    from oc_itdaat_dictionary
             left join oc_itdaat_attribute_name on oc_itdaat_attribute_name.id = oc_itdaat_dictionary.itdaat_attribute_id
             left join oc_itdaat_attribute_value on oc_itdaat_attribute_value.id = oc_itdaat_dictionary.itdaat_attribute_value_id
    where oc_itdaat_dictionary.language_id = NEW.language_id and oc_itdaat_dictionary.oc_attribute_id = NEW.attribute_id and oc_itdaat_dictionary.oc_attribute_value = NEW.text
    limit 1;
    
    --  check if such attribute and value are in the table already
    if(select ISNULL(@dict_id)) then 
        -- if there is no such attribute and value yet
            -- set product status 0 to hide it
            -- set to the dictionary new row
            -- set attribute id and check if there is no such row yet
                    -- if there is set unreal attribute id to avoid PRIMARY Key error
                    -- if there is no such attribute id language_id and product id insert to the oc_itdaat_attribute_value_exists
        
        update oc_product set oc_product.status = 0 where oc_product.product_id = NEW.product_id;
        insert into oc_itdaat_dictionary (language_id,oc_attribute_id, oc_attribute_value) values (NEW.language_id, NEW.attribute_id, NEW.text);
        select attribute_id into @attribute_id from oc_itdaat_attribute_value_exists where
            oc_itdaat_attribute_value_exists.language_id = NEW.language_id and oc_itdaat_attribute_value_exists.attribute_id = NEW.attribute_id and oc_itdaat_attribute_value_exists.product_id = NEW.product_id;
        
        if(select !isnull(@attribute_id) and NEW.attribute_id != OLD.attribute_id)then
            if(@attribute_id > 0)then
                set @attribute_id = 0;
            end if;
            set NEW.attribute_id = @attribute_id - 1;
        end if;
        insert into oc_itdaat_attribute_value_exists (language_id,product_id, attribute_id) values (NEW.language_id, NEW.product_id, NEW.attribute_id) ;
    else
        -- if there is in the dictionary
            -- check if there is translation
                 -- if there is no translate
                    -- set unreal attribute id from oc_itdaat_attribute_value_exists
                    -- set to the product status 0
                  -- if there is translate
                    -- set attribute text from the translation
                    -- set attribute id and check if there is no such row yet
                        -- if there is set unreal attribute id to avoid PRIMARY Key error
                        -- if there is no such attribute id language_id and product id insert to the oc_itdaat_attribute_value_exists
        
        select
            `oc_itdaat_attribute_name`.`name`, `oc_itdaat_attribute_value`.`value`, `oc_itdaat_dictionary`.`itdaat_attribute_id`
        into
            @attribute_itdaat_name, @attribute_itdaat_value, @attribute_itdaat_id
        from `oc_itdaat_dictionary`
                left join `oc_itdaat_attribute_name` on `oc_itdaat_attribute_name`.`id` = `oc_itdaat_dictionary`.`itdaat_attribute_id` and oc_itdaat_dictionary.language_id = oc_itdaat_attribute_name.language_id
                left join `oc_itdaat_attribute_value` on `oc_itdaat_attribute_value`.`id` = `oc_itdaat_dictionary`.`itdaat_attribute_value_id` and oc_itdaat_dictionary.language_id = oc_itdaat_attribute_value.language_id
        where oc_itdaat_dictionary.id = @dict_id limit 1;

        -- check if there is translation 
        if(select ISNULL(@attribute_itdaat_name) and ISNULL(@attribute_itdaat_value)) then
            -- if there is no translate
                -- set to the product status 0
                -- set unreal attribute id from oc_itdaat_attribute_value_exists
            update oc_product set oc_product.status = 0 where oc_product.product_id = NEW.product_id;
            
            select attribute_id into @attribute_id from oc_itdaat_attribute_value_exists where
                oc_itdaat_attribute_value_exists.language_id = NEW.language_id and oc_itdaat_attribute_value_exists.attribute_id = NEW.attribute_id and oc_itdaat_attribute_value_exists.product_id = NEW.product_id;
            if(select !isnull(@attribute_id) and NEW.attribute_id != OLD.attribute_id) then
                if(@attribute_id > 0) then
                    set @attribute_id = 0;
                end if;
                set NEW.attribute_id = @attribute_id - 1;
            end if;
            insert into oc_itdaat_attribute_value_exists (language_id,product_id, attribute_id) values (NEW.language_id, NEW.product_id, NEW.attribute_id) ;
        else 
            -- if there is translate
                -- set attribute text from the translation
                -- set attribute id and check if there is no such row yet
                    -- if there is set unreal attribute id to avoid PRIMARY Key error
                    -- if there is no such attribute id language_id and product id insert to the oc_itdaat_attribute_value_exists
            set NEW.text = @attribute_itdaat_value;
            select attribute_id into @attribute_id from oc_itdaat_attribute_value_exists where
                oc_itdaat_attribute_value_exists.language_id = NEW.language_id and oc_itdaat_attribute_value_exists.attribute_id = NEW.attribute_id and oc_itdaat_attribute_value_exists.product_id = NEW.product_id;
            if(select !isnull(@attribute_id) and NEW.attribute_id != OLD.attribute_id)then
                if(@attribute_id > 0)then
                    set @attribute_id = 0;
                end if;
                set NEW.attribute_id = @attribute_id - 1;
            end if;
            insert into oc_itdaat_attribute_value_exists (language_id,product_id, attribute_id) values (NEW.language_id, NEW.product_id, NEW.attribute_id) ;
        end if;
    end if;
end; // 

-- create trigger on delete
delimiter //
create trigger itdaat_delete_product_attribute before delete on `oc_product_attribute` for each row
begin
	delete from `oc_itdaat_attribute_value_exists` where
    	`oc_itdaat_attribute_value_exists`.`product_id` = OLD.product_id AND
        `oc_itdaat_attribute_value_exists`.`language_id` = OLD.language_id and
        `oc_itdaat_attribute_value_exists`.`attribute_id` = OLD.attribute_id;
end //