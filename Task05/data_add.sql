INSERT INTO users (name, email, gender, register_date, occupation)
VALUES ('Наталья Маскинскова', 'natalia.maskinskova@mail.ru', 'female', date('now'), 'student');

INSERT INTO users (name, email, gender, register_date, occupation)
VALUES ('Илья Логунов', 'ilya.logunov@mail.ru', 'male', date('now'), 'student');

INSERT INTO users (name, email, gender, register_date, occupation)
VALUES ('Мукасеев Дмитрий', 'dmitriy.mukaseev@mail.ru', 'male', date('now'), 'student');

INSERT INTO users (name, email, gender, register_date, occupation)
VALUES ('Маклаков Сергей', 'sergey.maklakov@mail.ru', 'male', date('now'), 'student');

INSERT INTO users (name, email, gender, register_date, occupation)
VALUES ('Макарова Юлия', 'julia.makarova@mail.ru', 'female', date('now'), 'student');

INSERT INTO movies (title, year)
VALUES ('Иллюзия обмана 3', 2025);

INSERT INTO movie_genres (movie_id, genre_id)
SELECT m.id, g.id 
FROM movies m, genres g 
WHERE m.title = 'Иллюзия обмана 3' AND g.name = 'Criminal';

INSERT INTO movies (title, year)
VALUES ('Папины дочки. Мама вернулась', 2025);

INSERT INTO movie_genres (movie_id, genre_id)
SELECT m.id, g.id 
FROM movies m, genres g 
WHERE m.title = 'Папины дочки. Мама вернулась' AND g.name = 'Comedy';

INSERT INTO movies (title, year)
VALUES ('Алиса в стране чудес', 2025);

INSERT INTO movie_genres (movie_id, genre_id)
SELECT m.id, g.id 
FROM movies m, genres g 
WHERE m.title = 'Алиса в стране чудес' AND g.name = 'Musical';

INSERT INTO ratings (user_id, movie_id, rating, timestamp)
SELECT 
    (SELECT id FROM users WHERE email = 'natalia.maskinskova@mail.ru'),
    (SELECT id FROM movies WHERE title = 'Иллюзия обмана 3'),
    4.5,
    strftime('%s', 'now');

INSERT INTO ratings (user_id, movie_id, rating, timestamp)
SELECT 
    (SELECT id FROM users WHERE email = 'natalia.maskinskova@mail.ru'),
    (SELECT id FROM movies WHERE title = 'Папины дочки. Мама вернулась'),
    5.0,
    strftime('%s', 'now');

INSERT INTO ratings (user_id, movie_id, rating, timestamp)
SELECT 
    (SELECT id FROM users WHERE email = 'natalia.maskinskova@mail.ru'),
    (SELECT id FROM movies WHERE title = 'Алиса в стране чудес'),
    4.0,
    strftime('%s', 'now');