<?php
namespace Cosmos\Collections\Interfaces;

/**
 * Sortable Interface
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Collections\Interfaces
 */
interface SortableInterface
{
	/**
	 * Method for integration with implementation.
	 * 
     * @param array $data
     *
     * @return array
	 */
	public function sort(array $data):array;

}
