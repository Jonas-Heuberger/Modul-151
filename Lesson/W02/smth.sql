CREATE USER 'JonasHeuberger'@'localhost' IDENTIFIED by 'Password';

GRANT SELECT, UPDATE, INSERT, DELETE ON W02.* TO 'JonasHeuberger'@'localhost';

FLUSH PRIVILEGES;

SELECT user FROM mysql.user

	
