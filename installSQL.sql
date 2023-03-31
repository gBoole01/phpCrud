DROP DATABASE phpcrud;
CREATE DATABASE phpcrud;
USE phpcrud;

CREATE TABLE students (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    school VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO students (name, age, school)
VALUES 
('John', 20, 'MIT'),
('Mary', 21, 'Harvard'),
('Peter', 22, 'Stanford'),
('Jane', 23, 'Yale'),
('Mark', 24, 'Princeton'),
('Sara', 25, 'Columbia'),
('Paul', 26, 'Cornell'),
('Laura', 27, 'Dartmouth'),
('Bob', 28, 'Brown'),
('Emily', 29, 'Duke');