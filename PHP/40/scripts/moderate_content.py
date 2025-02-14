
import sys
import json
from PIL import Image
import torch
from torchvision import transforms, models

# Load pre-trained model (e.g., ResNet18 for content analysis)
model = models.resnet18(pretrained=True)
model.eval()

def analyze_content(file_path):
    transform = transforms.Compose([
        transforms.Resize((224, 224)),
        transforms.ToTensor(),
    ])

    image = Image.open(file_path).convert("RGB")
    image = transform(image).unsqueeze(0)

    with torch.no_grad():
        outputs = model(image)
    
    predicted_class = outputs.argmax().item()

    result = {
        "file": file_path,
        "classification": f"Predicted Class: {predicted_class}",
        "safe": predicted_class not in [5, 6]  # Assume classes 5 & 6 are unsafe content
    }

    return json.dumps(result)

if __name__ == "__main__":
    if len(sys.argv) > 1:
        file_path = sys.argv[1]
        print(analyze_content(file_path))
    else:
        print(json.dumps({"error": "No file provided"}))
    