CREATE DATABASE IF NOT EXISTS camagru_db;

USE camagru_db;

CREATE TABLE IF NOT EXISTS users(
    id_user INT PRIMARY KEY  NOT NULL AUTO_INCREMENT,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    pseudonym VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    passworduser VARCHAR(100) NOT NULL,
    confirm_key VARCHAR(100) NOT NULL,
    confirm_account_key INT NOT NULL,
    confirm_key_password VARCHAR(100) NOT NULL,
    confirm_account_key_password INT NOT NULL,
    key_infup INT NOT NULL,
    receive_notif INT NOT NULL
);

CREATE TABLE IF NOT EXISTS pictures(
    id_picture INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    picture LONGBLOB NOT NULL,
    datepicture TIMESTAMP NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS likes(  
    id_like INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_picture INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_picture) REFERENCES pictures (id_picture) ON DELETE CASCADE ON UPDATE CASCADE
);
 
CREATE TABLE IF NOT EXISTS comments(
    id_comment INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_picture INT NOT NULL,
    comment VARCHAR(200),
    datecomment TIMESTAMP NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_picture) REFERENCES pictures (id_picture) ON DELETE CASCADE ON UPDATE CASCADE
);