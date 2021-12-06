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

CREATE TABLE `user_data` (
`user_id` int NOT null AUTO_INCREMENT,
`first_name` varchar(50) NOT NULL,
`last_name` varchar(50) NOT NULL,
`street` varchar(100) NOT NULL,
`city` varchar(50) NOT NULL,
`zip` varchar(6) NOT NULL,
`state` varchar(50) NOT NULL,
`phone` varchar(12) NOT NULL,
`email` varchar(50) NOT null,
PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `user_skills` (
`id` int NOT null AUTO_INCREMENT,
`user_id` int NOT NULL,
`skill_id` int NOT NULL,
`rating` tinyint NOT NULL,
PRIMARY KEY (`id`),
CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_data` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `admin` (
`id` int NOT null AUTO_INCREMENT,
`username` varchar(50) NOT NULL,
`password` varchar(64) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
