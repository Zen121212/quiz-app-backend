# Quiz API

This API manages CRUD operations for **users**, **quizzes**, **questions**, and **options** in a quiz system.

### Authentication Endpoints

- **POST /register**: Register a new user with `name`, `last_name`, `email`, `password` and `is_admin`.
- **POST /login**: Login a user with `email` and `passsword`.

### Quiz Endpoints

- **POST /quizzes**: Create a new quiz with `title` and `description`.
- **GET /quizzes**: Retrieve a list of all quizzes.
- **PUT /quizzes/{id}**: Update a quiz by ID.
- **DELETE /quizzes/{id}**: Delete a quiz by ID.

### Question Endpoints

- **POST /questions**: Create a new question for a quiz with `quiz_id` and `question_text`.
- **GET /questions**: Retrieve a list of all questions specific to quiz ID.
- **PUT /questions/{id}**: Update a question by ID.
- **DELETE /questions/{id}**: Delete a question by ID.

### Option Endpoints

- **POST /options**: Create a new option for a question with `question_id`, `option_text` and `is_correct`.
- **GET /options**: Retrieve a list of all options.
