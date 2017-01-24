<?php
namespace Cosmos\Security\Encryption;

/**
 * Hash Mask
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package \Cosmos\Security\Encryption
 */
class HashMask
{
    /**
     * Logic from Encryption.
     * The key is encrypted in Base64 then, divided in half, inverted and encrypted again.
     *
     * @param string $data
     *
     * @return string
     */
    public function disguise(string $data):string
    {
        $encryptedData = base64_encode($data);
        return base64_encode(strrev(substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData)
                ,strlen($encryptedData)).substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData))));
    }

    /**
     * Logic from Decryption
     * Reverse process of 'disguise()' to recover the original value.
     *
     * @param string $encryptedData
     *
     * @return string
     */
    public function retrieve(string $encryptedData):string
    {
        $encryptedData = base64_decode($encryptedData);
        $encryptedData = strrev(
            substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData),strlen($encryptedData))
            .substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData)));
        return base64_decode($encryptedData);
    }

}
