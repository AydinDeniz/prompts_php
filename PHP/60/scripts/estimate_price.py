
import sys
import json
import random

def estimate_price(location, size):
    base_price = 50000 + (size * 200)
    location_factor = random.uniform(0.8, 1.2)
    estimated_price = base_price * location_factor
    return json.dumps({"estimated_price": round(estimated_price, 2)})

if __name__ == "__main__":
    if len(sys.argv) == 3:
        print(estimate_price(sys.argv[1], float(sys.argv[2])))
    else:
        print(json.dumps({"error": "Invalid input"}))
    