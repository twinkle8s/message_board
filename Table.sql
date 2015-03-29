USE Secret;

CREATE TABLE IF NOT EXISTS member
	( username VARCHAR(16), password VARCHAR(40), INDEX(username(6)) );

CREATE TABLE IF NOT EXISTS profile
	( username VARCHAR(16), gender CHAR(6), birthdate DATE,
	phone CHAR(10), email VARCHAR(40), address VARCHAR(80),
	createTime TIMESTAMP DEFAULT 0, updateTime TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	INDEX(username(6)) );

CREATE TABLE IF NOT EXISTS message
	( id INT NOT NULL AUTO_INCREMENT, name VARCHAR(16), title VARCHAR(30), content VARCHAR(300),
	type VARCHAR(5), time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, INDEX(title, type) );