
import sys
import json
import random

products = [
    {"id": 1, "name": "Laptop", "category": "Electronics"},
    {"id": 2, "name": "Headphones", "category": "Electronics"},
    {"id": 3, "name": "Smartphone", "category": "Electronics"},
    {"id": 4, "name": "T-shirt", "category": "Clothing"},
    {"id": 5, "name": "Sneakers", "category": "Footwear"},
    {"id": 6, "name": "Smartwatch", "category": "Wearables"}
]

def recommend_products(user_id):
    recommended = random.sample(products, 3)
    return json.dumps(recommended, indent=2)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        user_id = sys.argv[1]
        print(recommend_products(user_id))
    else:
        print(json.dumps({"error": "No user ID provided"}))
    