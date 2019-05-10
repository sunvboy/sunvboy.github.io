CREATE DATABASE IF NOT EXISTS exportphpdb;

USE exportphpdb;

DROP TABLE IF EXISTS customers;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS customers (
	  customer_id INT(4) NOT NULL AUTO_INCREMENT,
	  first VARCHAR(20) NOT NULL,
	  last VARCHAR(30) NOT NULL,
	  state ENUM('CT','MA','ME','NJ','NY','RI','VT') NOT NULL,
	  dob DATE NOT NULL,
	  created DATE NOT NULL,
	  PRIMARY KEY (customer_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO customers (first, last, state, dob, created) values ('James', 'Smith', 'NY', '1955-12-04',DATE_SUB(NOW(), INTERVAL 62 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Sally', 'Jones', 'MA', '1947-01-06',DATE_SUB(NOW(), INTERVAL 55 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Debra', 'Green', 'CT', '1939-10-09',DATE_SUB(NOW(), INTERVAL 51 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Daniel', 'Brown', 'NY', '1940-02-26',DATE_SUB(NOW(), INTERVAL 36 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Doris', 'Black', 'ME', '1951-01-24',DATE_SUB(NOW(), INTERVAL 34 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Teri', 'Davis', 'VT', '1960-08-14',DATE_SUB(NOW(), INTERVAL 33 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Alfred', 'White', 'NJ', '1946-04-13',DATE_SUB(NOW(), INTERVAL 31 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Arn', 'Anderson', 'CT', '1944-03-24',DATE_SUB(NOW(), INTERVAL 24 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Brett', 'Albers', 'NY', '1967-11-10',DATE_SUB(NOW(), INTERVAL 22 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Jeffrey', 'McBride', 'ME', '1924-09-09',DATE_SUB(NOW(), INTERVAL 21 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Minnie', 'Bailey', 'RI', '1971-06-27',DATE_SUB(NOW(), INTERVAL 16 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Jack', 'Pratt', 'RI', '1958-11-29',DATE_SUB(NOW(), INTERVAL 16 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Joanne', 'Windsor', 'CT', '1949-03-04',DATE_SUB(NOW(), INTERVAL 15 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Kelly', 'Wells', 'MA', '1952-08-19',DATE_SUB(NOW(), INTERVAL 12 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Marcus', 'Jones', 'NJ', '1938-05-28',DATE_SUB(NOW(), INTERVAL 11 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Fred', 'Schwartz', 'NY', '1940-07-06',DATE_SUB(NOW(), INTERVAL 5 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Rachel', 'Clark', 'NY', '1956-08-16',DATE_SUB(NOW(), INTERVAL 5 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Henry', 'Adams', 'MA', '1931-12-19',DATE_SUB(NOW(), INTERVAL 4 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Rebecca', 'Stewart', 'ME', '1926-01-14',DATE_SUB(NOW(), INTERVAL 2 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Jean', 'Evans', 'ME', '1948-06-16',DATE_SUB(NOW(), INTERVAL 1 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Tim', 'Morgan', 'ME', '1953-05-16',DATE_SUB(NOW(), INTERVAL 1 DAY));
INSERT INTO customers (first, last, state, dob, created) values ('Kathy', 'Long', 'ME', '1970-03-26',NOW());
INSERT INTO customers (first, last, state, dob, created) values ('Phillip', 'King', 'CT', '1965-12-17',NOW());
INSERT INTO customers (first, last, state, dob, created) values ('Gary', 'Ross', 'VT', '1943-10-24',NOW());

commit;