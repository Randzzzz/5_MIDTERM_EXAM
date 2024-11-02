CREATE TABLE user_accounts (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR (50),
    user_fname VARCHAR (50),
    user_lname VARCHAR (50),
    user_age INT,
    user_address VARCHAR (50),
    password VARCHAR (50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE artist_records (
    artist_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    stage_name VARCHAR (50),
    gender VARCHAR (50),
    email VARCHAR (50),
    added_by VARCHAR (50),
    last_updated_by VARCHAR (50),
    last_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE music_records (
    music_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR (50),
    genre VARCHAR (50),
    date_release VARCHAR (50),
    country_area VARCHAR (50),
    artist_id INT,
    added_by VARCHAR (50),
    last_updated_by VARCHAR (50),
    last_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    user_id INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE audit_log (
    audit_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    action VARCHAR(50),
    table_name VARCHAR(50),
    record_id INT,
    action_details VARCHAR(50),
    action_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);