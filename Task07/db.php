<?php
$databaseFile = __DIR__ . '/university.db';
$pdo = new PDO('sqlite:' . $databaseFile, null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
$pdo->exec('PRAGMA foreign_keys = ON;');
$exists = $pdo->query("SELECT 1 FROM sqlite_master WHERE type='table' AND name='groups'")->fetch();
if (!$exists) {
    $sql = "
        PRAGMA foreign_keys = ON;

        DROP TABLE IF EXISTS students;
        DROP TABLE IF EXISTS groups;

        CREATE TABLE groups (
            id INTEGER PRIMARY KEY,
            number TEXT NOT NULL,
            program TEXT NOT NULL,
            graduation_year INTEGER NOT NULL
        );

        CREATE TABLE students (
            id INTEGER PRIMARY KEY,
            name TEXT NOT NULL,
            gender TEXT NOT NULL CHECK (gender IN ('М', 'Ж')),
            birth_date TEXT NOT NULL,
            student_card_number TEXT NOT NULL,
            group_id INTEGER NOT NULL,
            FOREIGN KEY (group_id) REFERENCES groups(id)
        );

        INSERT INTO groups (number, program, graduation_year) VALUES
        ('1', 'Программная инженерия', 2025),
        ('2', 'Программная инженерия', 2026);

        INSERT INTO students (name, gender, birth_date, student_card_number, group_id) VALUES
        ('Зубков Роман Сергеевич', 'М', '2005-06-14', '31', 1),
        ('Иванов Максим Александрович', 'М', '2005-11-22', '12', 1),
        ('Ивенин Артём Андреевич', 'М', '2005-03-08', '67', 1),
        ('Казейкин Иван Иванович', 'М', '2006-07-30', '90', 2),
        ('Колыганов Александр Павлович', 'М', '2005-09-17', '34', 2),
        ('Кочнев Артем Алексеевич', 'М', '2005-12-05', '89', 1),
        ('Логунов Илья Сергеевич', 'М', '2005-11-14', '56', 1),
        ('Макарова Юлия Сергеевна', 'Ж', '2005-01-25', '23', 1),
        ('Маклаков Сергей Александрович', 'М', '2005-10-03', '11', 2),
        ('Маскинскова Наталья Сергеевна', 'Ж', '2005-12-14', '61', 1),
        ('Мукасеев Дмитрий Александрович', 'М', '2005-05-12', '55', 1),
        ('Наумкин Владислав Валерьевич', 'М', '2005-02-28', '67', 1),
        ('Паркаев Василий Александрович', 'М', '2005-07-07', '19', 2),
        ('Полковников Дмитрий Александрович', 'М', '2006-11-14', '27', 2),
        ('Пузаков Дмитрий Александрович', 'М', '2005-03-25', '20', 2),
        ('Пшеницына Полина Алексеевна', 'Ж', '2005-06-09', '63', 2),
        ('Пяткин Игорь Алексеевич', 'М', '2005-10-27', '33', 2),
        ('Рыбаков Евгений Геннадьевич', 'М', '2004-12-18', '37', 1),
        ('Рыжкин Владислав Дмитриевич', 'М', '2005-05-03', '83', 2),
        ('Рябченко Александра Станиславовна', 'Ж', '2005-09-02', '15', 1),
        ('Снегирев Данил Александрович', 'М', '2005-01-07', '99', 2),
        ('Тульсков Илья Андреевич', 'М', '2005-04-22', '48', 2),
        ('Фирстов Артём Александрович', 'М', '2005-08-11', '49', 2),
        ('Четайкин Владислав Александрович', 'М', '2005-11-30', '51', 2),
        ('Шарунов Максим Игоревич', 'М', '2005-07-15', '21', 2),
        ('Шушев Денис Сергеевич', 'М', '2005-02-14', '78', 1);
    ";
    $queries = explode(';', $sql);
    foreach ($queries as $query) {
        $query = trim($query);
        $query = preg_replace('/--.*$/', '', $query);
        $query = trim($query);
        if ($query !== '') {
            $pdo->exec($query);
        }
    }
}

return $pdo;