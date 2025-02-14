
# PHP Interactive Quiz Platform

## Features
- Loads 5 random quiz questions from the database.
- Allows users to submit answers.
- Displays quiz score after submission.

## Setup
1. Create the `questions` table using `create_tables.sql`.
2. Insert quiz questions into the table manually.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to take the quiz.

## Customization
- Change the number of quiz questions in `get_questions.php`.
- Add more answer choices in the database schema.
    