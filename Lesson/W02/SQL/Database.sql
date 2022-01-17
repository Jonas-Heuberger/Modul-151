CREATE USER 'JonasH'@'localhost' IDENTIFIED by 'Password';

GRANT SELECT, UPDATE, INSERT, DELETE ON W02.* TO 'JonasH'@'localhost';

FLUSH PRIVILEGES;

SELECT user FROM mysql.user;

INSERT INTO users (id, firstname, lastname, username, password, email) values ('1', 'Test', 'Test', 'Test', 'Test', 'Test');

DELETE FROM users where id = 1;