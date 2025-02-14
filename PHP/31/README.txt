
# AI Chatbot with Memory and NLP

## Features
- Stores conversation history in a database.
- Uses OpenAI API to generate responses.
- Provides a chat UI for interaction.

## Setup
1. Create the `chat_memory` table using `create_tables.sql`.
2. Replace `your_openai_api_key_here` in `chatbot.php` with a valid OpenAI API key.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to chat with the AI.

## Customization
- Increase conversation history in `chatbot.php`.
- Modify AI parameters in the OpenAI API request.
    