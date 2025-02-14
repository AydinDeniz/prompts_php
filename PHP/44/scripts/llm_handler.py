
import sys
import json
import openai

openai.api_key = "your_openai_api_key_here"

def query_llm(user_input):
    response = openai.ChatCompletion.create(
        model="gpt-4",
        messages=[{"role": "system", "content": "You are an AI assistant."},
                  {"role": "user", "content": user_input}],
        temperature=0.7
    )
    return response["choices"][0]["message"]["content"]

if __name__ == "__main__":
    if len(sys.argv) > 1:
        user_input = sys.argv[1]
        print(query_llm(user_input))
    else:
        print(json.dumps({"error": "No input provided"}))
    