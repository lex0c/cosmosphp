<?php
namespace Cosmos\Security\Encryption;

/**
 * Disguise
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package \Cosmos\Security\Encryption
 */
class Disguise
{
    /**
     * Logic from Encryption.
     * The key is encrypted in Base64 then, divided in half, inverted and encrypted again.
     *
     * @param string $data
     *
     * @return string
     */
    final public function obscure(string $data):string
    {
        if(empty($data)):
            throw new \InvalidArgumentException('Arguments not valid!');
        endif;

        $encryptedData = base64_encode(htmlentities($data));
        return base64_encode(strrev(substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData)
                ,strlen($encryptedData)).substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData))));
    }

    /**
     * Logic from Decryption
     * Reverse process of 'obscure()' to recover the original value.
     *
     * @param string $encryptedData
     *
     * @return string
     */
    final public function illumin(string $encryptedData):string
    {
        if(empty($encryptedData)):
            throw new \InvalidArgumentException('Arguments not valid!');
        endif;

        $encryptedData = base64_decode(htmlentities($encryptedData));
        $encryptedData = strrev(
            substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData),strlen($encryptedData))
            .substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData)));
        return base64_decode($encryptedData);
    }

}
