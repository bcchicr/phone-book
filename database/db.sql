DROP TABLE IF EXISTS student_data CASCADE;

CREATE TABLE student_data (
    student_id integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY NOT NULL,
    student_first_name character varying(100) NOT NULL,
    student_last_name character varying(100) NOT NULL,
    student_sex character(1) NOT NULL CHECK (student_sex IN('m', 'f')),
    student_birth_date date NOT NULL,
    student_group character varying(5) NOT NULL CHECK (length(student_group) >= 2),
    student_exam_points smallint NOT NULL CHECK (
        student_exam_points BETWEEN 0
        AND 300
    )
);

DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users (
    user_id integer PRIMARY KEY GENERATED ALWAYS AS IDENTITY NOT NULL,
    user_login character varying(100) UNIQUE NOT NULL,
    user_email character varying(255) UNIQUE NOT NULL,
    user_password character varying(255) UNIQUE NOT NULL,
    user_created_at timestamp with time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);

-- ALTER TABLE
--     student_data
-- ADD
--     FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE;

-- ALTER TABLE
--     users
-- ADD
--     FOREIGN KEY (user_id) REFERENCES student_data(student_id) ON DELETE RESTRICT;