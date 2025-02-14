
<?php
use Firebase\JWT\JWT;

class JWTUtils {
    private static $secret_key = "YOUR_SECRET_KEY";
    private static $encrypt = ['HS256'];

    public static function encode($data) {
        $issuedAt = time();
        $expire = $issuedAt + (60*60);

        $token = array(
            'iat' => $issuedAt,
            'exp' => $expire,
            'data' => $data
        );

        return JWT::encode($token, self::$secret_key);
    }

    public static function decode($token) {
        try {
            return JWT::decode($token, self::$secret_key, self::$encrypt)->data;
        } catch(Exception $e) {
            return null;
        }
    }
}
?>
    