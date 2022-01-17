	--Password must be 8 characters or more
	CREATE USER 'user'@'localhost' IDENTIFIED by 'newUserTestPassword'; --user creation
	GRANT SELECT, UPDATE, INSERT, DELETE ON PHPSQLTEST.users TO 'user'@'localhost'; --grant rights
	FLUSH PRIVILEGES;