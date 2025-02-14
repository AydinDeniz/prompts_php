
CREATE TABLE IF NOT EXISTS chat_memory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_message TEXT,
    ai_response TEXT,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
    