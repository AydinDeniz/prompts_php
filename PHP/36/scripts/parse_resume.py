
import sys
import json
from pdfminer.high_level import extract_text

def parse_resume(file_path):
    text = extract_text(file_path)
    keywords = ["Python", "PHP", "JavaScript", "Machine Learning", "Data Science"]
    matched_keywords = [word for word in keywords if word.lower() in text.lower()]
    
    result = {
        "parsed_text": text[:500] + "...",
        "matched_skills": matched_keywords
    }

    return json.dumps(result)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        file_path = sys.argv[1]
        print(parse_resume(file_path))
    else:
        print(json.dumps({"error": "No file provided"}))
    