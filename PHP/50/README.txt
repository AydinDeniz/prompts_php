
# Autonomous PHP-Powered Web Scraper with AI Data Summarization

## Features
- Extracts textual data from websites using web scraping.
- Summarizes content using AI-powered NLP models.
- Provides a simple frontend for user input and summarization.

## Setup
1. Install dependencies: `pip install requests beautifulsoup4 openai`.
2. Replace `your_openai_api_key_here` in `web_scraper.py` with a valid API key.
3. Run a local PHP server (`php -S localhost:8000 -t client/`).
4. Open `http://localhost:8000/index.html`, enter a website URL, and click "Scrape & Summarize".

## Customization
- Expand to fetch structured data such as product prices and reviews.
- Implement advanced AI models for in-depth content analysis.
    