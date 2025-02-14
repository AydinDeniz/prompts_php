
import sys
from PIL import Image
import torch
from torchvision import transforms, models

# Load pre-trained model (ResNet18 for example)
model = models.resnet18(pretrained=True)
model.eval()

def classify_image(image_path):
    transform = transforms.Compose([
        transforms.Resize((224, 224)),
        transforms.ToTensor(),
    ])

    image = Image.open(image_path).convert("RGB")
    image = transform(image).unsqueeze(0)

    with torch.no_grad():
        outputs = model(image)
    
    predicted_class = outputs.argmax().item()
    return f"Predicted Class: {predicted_class}"

if __name__ == "__main__":
    if len(sys.argv) > 1:
        image_path = sys.argv[1]
        print(classify_image(image_path))
    else:
        print("No image provided")
    