CREATE DATABASE IF NOT EXISTS garden;

CREATE TABLE veggies ( 
    `id` SMALLINT NOT NULL AUTO_INCREMENT, 
    `amount` SMALLINT NOT NULL DEFAULT 0, 
    `type` VARCHAR(255) NOT NULL, 
    PRIMARY KEY (id) 
);

CREATE TABLE prices (
    `type` VARCHAR(255) NOT NULL,
    `value` DECIMAL(4,2) NOT NULL DEFAULT 0
);

INSERT INTO prices (type, value)
values ('agurkas', 1.25),
('pomidoras', 1.75);