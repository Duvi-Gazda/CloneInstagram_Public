<?php
/**
 * itdaat_license
 * trait that includes all functionality that is connected with the license
 * ! Is required !
 */
trait itdaat_license{
    /**
     * ENCRYPT_METHOD
     * The encrypt method that is used to encrypting and decrypting functions
     * **/
    private function ENCRYPT_METHOD() : string{
        return 'AES-256-CBC';
    }
    /**
     * STATIC_HASH_KEY
     * Static key to add to the encrypted license
     */
    public function STATIC_HASH_KEY() : string{
        return "JLdfdfIJO(*()Efs";
    }

    /**
     * generateKey
     * Generate key according to the domain name
     * @param  string $domainName
     * @param  string $domainName
     * @return void
     */
    private function generateKey(string $domainName, string $moduleKey): string{
        // add to domain name static hashed data
        $domainName = $domainName . hash('crc32', $this->STATIC_HASH_KEY());
        // encode STATIC_HASH_KEY with domain
        $secret_key = hash('haval160,4', $domainName . $this->STATIC_HASH_KEY() . $moduleKey);
        $secret_key = hash('crc32', $secret_key . $this->STATIC_HASH_KEY());
        return $secret_key;
    }
    /**
     * generateLicense
     *
     * @param  string $domainName
     * @param  int $moduleCode
     * @param  mixed $endLicenseDateTime
     * @param  mixed $moduleKey unique module key
     * @return void
     */
    protected function generateLicense(string $domainName,string $moduleCode, $endLicenseDateTime,string $moduleKey): string{
        $array = [
            'date' => $endLicenseDateTime,
            'code' => $moduleCode
        ];
        // convert array to the json string
        $license = json_encode($array);
        // generate secret key according to the domain name and module unique key
        $secret_key = $this->generateKey($domainName, $moduleKey);
        // set the encrypt method
        $encryptMethod = $this->ENCRYPT_METHOD();
        // encode all data with using secret key and encrypting method
        return openssl_encrypt($license, $encryptMethod, $secret_key, 0, $this->STATIC_HASH_KEY());
    }
    /**
     * decodeLicenseTo_JSON_String
     * decodes license to JSON string using secret key and domain name
     * @param  mixed $license
     * @param  mixed $moduleKey unique module key
     * @param  mixed $domainName
     * @return string
     */
    protected function decodeLicenseTo_JSON_String(string $license, string $moduleKey, string $domainName = null): string
    {
        $num = 0;
        do {
            $domainName = $this->getDomainName($num) != null ? $this->getDomainName($num): $domainName;
            // generate secret key according to the domain name and module unique key
            $secret_key = $this->generateKey($domainName, $moduleKey);
            // encode all data with using secret key and encrypting method
            $encryptMethod = $this->ENCRYPT_METHOD();
            $decodedLicense =  openssl_decrypt($license, $encryptMethod, $secret_key, 0, $this->STATIC_HASH_KEY());
        } while (($decodedLicense == null)&& ($this->getDomainName($num++) != ''));
        return $decodedLicense? $decodedLicense : 'wrong license';
    }    
    /**
     * checkLicenseDate
     *
     * @return void
     */
    protected function checkLicenseDate(array $license): bool{
        $license_date = new DateTime($license['date']);
        $new = new DateTime(date('Y-m-d'));
        return $license_date->format('Y-m-d') <= $new->format('Y-m-d');
    }
    /**
     * decodeLicenseToArray
     * decode license to array
     * @param  mixed $license
     * @param  mixed $moduleKey unique module key
     * @param  mixed $domainName
     * @return array
     */
    protected  function decodeLicenseToArray(string $license, string $moduleKey, string $domainName = null): ?array
    {
        // convert json string to array and return
        $data = $this->decodeLicenseTo_JSON_String($license,$moduleKey, $domainName);
        return $data == 'wrong license' ? null : json_decode($data, true);
    }
    protected function getDomainName(int $numberToDelete): string
    {
         $array = (array)explode('.', $_SERVER['SERVER_NAME']);
        for ($i = 0; $i < $numberToDelete; $i++) {
            unset($array[$i]);
        }
        return implode('.', $array);
    }
}