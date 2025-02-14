
import sys
import json
import random

def predict_stock(ticker):
    prediction = random.uniform(-5, 5)  # Simulate a random prediction change in %
    result = {
        "ticker": ticker,
        "predicted_change": f"{prediction:.2f}%",
        "recommendation": "BUY" if prediction > 0 else "SELL"
    }
    return json.dumps(result, indent=2)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        ticker = sys.argv[1]
        print(predict_stock(ticker))
    else:
        print(json.dumps({"error": "No ticker provided"}))
    