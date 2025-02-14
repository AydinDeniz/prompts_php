
import sys
import qrcode

def generate_qr(doc_id, file_path, qr_code_path):
    qr = qrcode.QRCode(version=1, box_size=10, border=5)
    qr.add_data(f"http://localhost:8000/scripts/verify_document.php?doc_id={doc_id}")
    qr.make(fit=True)
    img = qr.make_image(fill="black", back_color="white")
    img.save(qr_code_path)

if __name__ == "__main__":
    if len(sys.argv) == 4:
        generate_qr(sys.argv[1], sys.argv[2], sys.argv[3])
    