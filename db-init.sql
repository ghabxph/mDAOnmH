GRANT SELECT, UPDATE, DELETE, INSERT ON exam.* to 'exam'@'%' IDENTIFIED BY 'eIggr3T18BNkLZ17';
CREATE DATABASE exam;
USE exam;
CREATE TABLE blog (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    title TEXT NULL,
    content TEXT NULL,
    filename TEXT NULL,
    type VARCHAR(50),
    created_at TIMESTAMP NOT NULL
);


GRANT SELECT, UPDATE, DELETE, INSERT ON exam_test.* to 'exam_test'@'%' IDENTIFIED BY 'TwK0kdEUy7xff3Jv';
CREATE DATABASE exam_test;
USE exam_test;
CREATE TABLE blog (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    title TEXT NULL,
    content TEXT NULL,
    filename TEXT NULL,
    type VARCHAR(50),
    created_at TIMESTAMP NOT NULL
);
