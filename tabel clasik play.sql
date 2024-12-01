CREATE TABLE user_account (
	id SERIAL PRIMARY KEY,
	username VARCHAR(50) UNIQUE NOT NULL,
	email VARCHAR(100) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL
);

CREATE TABLE arkanoid_score (
	id_score SERIAL PRIMARY KEY,
	id_user INT REFERENCES user_account(id),
	score INT NOT NULL
);

CREATE TABLE tetris_score (
	id_score SERIAL PRIMARY KEY,
	id_user INT REFERENCES user_account(id),
	score INT NOT NULL
);

CREATE TABLE snake_score (
	id_score SERIAL PRIMARY KEY,
	id_user INT REFERENCES user_account(id),
	score INT NOT NULL
);

SELECT * FROM user_account;