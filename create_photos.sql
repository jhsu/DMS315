DROP TABLE IF EXISTS photos;

CREATE TABLE photos (
    id integer AUTO_INCREMENT PRIMARY KEY NOT NULL,
	user_id integer NOT NULL,
	score integer default 100, 
    filename varchar(255),
    thumbnail varchar(255),
    created_at timestamp,
    updated_at timestamp,
	index(user_id)
) ENGINE=InnoDB;
