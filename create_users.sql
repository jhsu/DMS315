CREATE TABLE users (
    id integer AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username varchar(255),
    created_at timestamp,
    updated_at timestamp,
    email varchar(255) NOT NULL,
    crypted_password varchar(255) NOT NULL,
    password_salt varchar(255) NOT NULL
) ENGINE=InnoDB;


