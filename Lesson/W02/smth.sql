CREATE USER 'JonasH'@'localhost' IDENTIFIED by 'Password';

GRANT SELECT, UPDATE, INSERT, DELETE ON W02.* TO 'JonasH'@'localhost';

FLUSH PRIVILEGES;

SELECT user FROM mysql.user;