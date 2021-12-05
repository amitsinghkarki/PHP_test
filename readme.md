CREATE TABLE dummy.category (
id int NOT NULL PRIMARY KEY,
category_name varchar(50) NOT NULL


)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS dummy.category;


CREATE TABLE dummy.skill (
skill_id int NOT NULL PRIMARY KEY,
skill_name varchar(50) NOT NULL,
category_id int,
 CONSTRAINT fk_category_id FOREIGN KEY (category_id)
    REFERENCES category(id)
    )
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_0900_ai_ci;
DROP TABLE IF EXISTS dummy.skill;

