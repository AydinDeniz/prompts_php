
import sys
import pyotp

def validate_otp(secret, user_otp):
    totp = pyotp.TOTP(secret)
    return "VALID" if totp.verify(user_otp) else "INVALID"

if __name__ == "__main__":
    if len(sys.argv) == 3:
        secret = sys.argv[1]
        user_otp = sys.argv[2]
        print(validate_otp(secret, user_otp))
    else:
        print("INVALID")
    