<?php
namespace Cosmos\Security\Encryption\Traits;

/**
 * Maskable
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package \Cosmos\Security\Traits
 */
trait Maskable
{
    /**
     * Hard hash encrypting.
     *
     * @param string $encryptedData
     *
     * @return string
     */
    protected function inverse(string $encryptedData):string
    {
        return base64_encode(strrev(
                substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData), strlen($encryptedData)).
                substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData)))
        );
    }

    /**
     * Decrypting.
     *
     * @param string $encryptedData
     *
     * @return string
     */
    protected function reverse(string $encryptedData):string
    {
        $encryptedData = base64_decode($encryptedData);
        return strrev(
            substr($encryptedData, (strlen($encryptedData)/2)-strlen($encryptedData),strlen($encryptedData)).
            substr($encryptedData, 0, (strlen($encryptedData)/2)-strlen($encryptedData))
        );
    }

}
