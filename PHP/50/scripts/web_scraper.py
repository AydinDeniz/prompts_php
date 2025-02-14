
import sys
import json
import requests
from bs4 import BeautifulSoup
import openai

openai.api_key = "your_openai_api_key_here"

def scrape_and_summarize(url):
    try:
        response = requests.get(url, headers={'User-Agent': 'Mozilla/5.0'})
        soup = BeautifulSoup(response.text, 'html.parser')
        text = " ".join([p.text for p in soup.find_all('p')][:5])

        ai_summary = openai.ChatCompletion.create(
            model="gpt-4",
            messages=[{"role": "system", "content": "Summarize the following text in a concise manner."},
                      {"role": "user", "content": text}],
            temperature=0.5
        )

        summary = ai_summary["choices"][0]["message"]["content"]
        return json.dumps({"url": url, "summary": summary}, indent=2)

    except Exception as e:
        return json.dumps({"error": str(e)})

if __name__ == "__main__":
    if len(sys.argv) > 1:
        url = sys.argv[1]
        print(scrape_and_summarize(url))
    else:
        print(json.dumps({"error": "No URL provided"}))
    