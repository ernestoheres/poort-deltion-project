<?php

namespace App\Traits;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable) && !empty($value)) {
            $value = $this->decryptValue($value);
        }
        return $value;
    }

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable) && !empty($value)) {
            $value = $this->encryptValue($value);
        }
        return parent::setAttribute($key, $value);
    }

    protected function getEncryptionKey()
    {
        return env('ENCRYPTION_KEY');
    }

    private function encryptValue($value)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
        $encryptedData = openssl_encrypt($value, 'aes-128-cbc', $this->getEncryptionKey(), 0, $iv);
        return base64_encode($iv . $encryptedData);
    }

    private function decryptValue($value)
    {
        $data = base64_decode($value);
    
        // Ensure the IV is the correct length
        $ivLength = openssl_cipher_iv_length('aes-128-cbc');
        if (strlen($data) < $ivLength) {
            // Handle error - data is too short for valid IV
            throw new \Exception("Invalid data for decryption");
        }
    
        $iv = substr($data, 0, $ivLength);
        $encryptedData = substr($data, $ivLength);
    
        return openssl_decrypt($encryptedData, 'aes-128-cbc', $this->getEncryptionKey(), 0, $iv);
    }
    

    public function decryptAllAttributes()
    {
        foreach ($this->encryptable as $attribute) {
            if (!empty($this->attributes[$attribute])) {
                $this->attributes[$attribute] = $this->decryptValue($this->attributes[$attribute]);
            }
        }
    }
}
