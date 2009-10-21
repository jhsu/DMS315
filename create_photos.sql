CREATE TABLE photos (
    id integer AUTO_INCREMENT PRIMARY KEY NOT NULL,
	user_id integer NOT NULL,
    filename varchar(255),
    created_at timestamp,
    updated_at timestamp
) ENGINE=InnoDB;
