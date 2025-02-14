
import sys
import json
import re

def analyze_code(file_path):
    with open(file_path, 'r', encoding='utf-8') as file:
        code = file.read()

    issues = []
    
    if "eval(" in code:
        issues.append("Security Warning: Use of 'eval()' detected.")

    if "exec(" in code:
        issues.append("Security Warning: Use of 'exec()' detected.")

    if re.search(r"password", code, re.IGNORECASE):
        issues.append("Potential Issue: Hardcoded passwords found.")

    result = {
        "file": file_path,
        "issues": issues if issues else ["No major issues found"]
    }

    return json.dumps(result, indent=2)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        file_path = sys.argv[1]
        print(analyze_code(file_path))
    else:
        print(json.dumps({"error": "No file provided"}))
    