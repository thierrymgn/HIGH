CREATE TABLE
    IF NOT EXISTS `users` (
        user_id INT NOT NULL AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        admin BOOLEAN NOT NULL DEFAULT FALSE,
        PRIMARY KEY (user_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    IF NOT EXISTS `posts` (
        post_id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        title VARCHAR(50) NOT NULL,
        content TEXT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (post_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

CREATE TABLE
    IF NOT EXISTS `comments` (
        comment_id INT NOT NULL AUTO_INCREMENT,
        user_id INT NOT NULL,
        post_id INT NOT NULL,
        content TEXT NOT NULL,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (comment_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (post_id) REFERENCES posts(post_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;