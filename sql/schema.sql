CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  is_admin TINYINT(1) DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  text_de TEXT NOT NULL,
  text_en TEXT NOT NULL,
  image_path VARCHAR(255),
  choice1_de VARCHAR(255) NOT NULL,
  choice1_en VARCHAR(255) NOT NULL,
  choice2_de VARCHAR(255) NOT NULL,
  choice2_en VARCHAR(255) NOT NULL,
  choice3_de VARCHAR(255) NOT NULL,
  choice3_en VARCHAR(255) NOT NULL,
  choice4_de VARCHAR(255) NOT NULL,
  choice4_en VARCHAR(255) NOT NULL,
  correct_choice_index TINYINT(1) NOT NULL
);

CREATE TABLE user_progress (
  user_id INT,
  question_id INT,
  attempt_count INT DEFAULT 0,
  correct_count INT DEFAULT 0,
  incorrect_count INT DEFAULT 0,
  PRIMARY KEY(user_id, question_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE exam_history (
  exam_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
  score TINYINT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE user_answers (
  exam_id INT,
  question_id INT,
  selected_choice_index TINYINT(1),
  PRIMARY KEY (exam_id, question_id),
  FOREIGN KEY (exam_id) REFERENCES exam_history(exam_id) ON DELETE CASCADE,
  FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE password_resets (
  email VARCHAR(100) NOT NULL,
  token VARCHAR(255) NOT NULL,
  expires_at DATETIME NOT NULL,
  PRIMARY KEY (email)
);