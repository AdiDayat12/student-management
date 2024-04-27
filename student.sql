USE university;
CREATE TABLE student (
	id serial primary key,
    student_id char(6) unique key null,
    name varchar(100) not null,
    email varchar(100) not null,
    faculty varchar(100) not null,
    image varchar(100)
)