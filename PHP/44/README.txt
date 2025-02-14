
# Custom LLM-Based PHP Chatbot with Knowledge Base Integration

## Features
- Queries a knowledge base before sending requests to LLM.
- Uses OpenAI's GPT-4 model for intelligent responses.
- Simple web-based chat UI for interactions.

## Setup
1. Create the `knowledge_base` table using `create_tables.sql`.
2. Replace `your_openai_api_key_here` in `llm_handler.py` with a valid API key.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html` to chat with the AI.

## Customization
- Extend knowledge base storage to reduce API calls.
- Implement vector search for better knowledge retrieval.
    