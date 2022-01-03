CREATE USER 'W02_user'@'localhost' IDENTIFIED by 'password';

GRANT SELECT, UPDATE, INSERT, DELETE ON W02.* TO 'W02_user'@'localhost';

FLUSH PRIVILEGES;

SELECT user FROM mysql.user

	
