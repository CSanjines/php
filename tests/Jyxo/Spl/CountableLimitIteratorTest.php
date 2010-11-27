<?php

/**
 * Jyxo Library
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * https://github.com/jyxo/php/blob/master/license.txt
 */

namespace Jyxo\Spl;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * Test pro třídu \Jyxo\Spl\CountableLimitIterator.
 *
 * @see \Jyxo\Spl\Object
 * @copyright Copyright (c) 2005-2010 Jyxo, s.r.o.
 * @license https://github.com/jyxo/php/blob/master/license.txt
 * @author Jakub Tománek <libs@jyxo.com>
 */
class CountableLimitIteratorTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * Test fungování limitu
	 */
	public function testLimit()
	{
		$data = range(0, 10);
		$expected = range(2, 4);

		$iterator = new \Jyxo\Spl\CountableLimitIterator(new \ArrayIterator($data), 2, 3);
		$result = iterator_to_array($iterator);

		$this->assertEquals(array_values($expected), array_values($result));
	}

	/**
	 * Test vracení počtu - propagace
	 */
	public function testPassCount()
	{
		$data = range(0, 10);
		$expected = range(2, 4);

		$iterator = new \Jyxo\Spl\CountableLimitIterator(new \ArrayIterator($data), 2, 3);
		$this->assertEquals(count($data), count($iterator));
	} // testPassCount();

	/**
	 * Test vracení počtu - reálná hodnota
	 */
	public function testLimitCount()
	{
		$data = range(0, 10);
		$expected = range(2, 4);

		$iterator = new \Jyxo\Spl\CountableLimitIterator(new \ArrayIterator($data), 2, 3, \Jyxo\Spl\CountableLimitIterator::MODE_LIMIT);

		$this->assertEquals(3, count($iterator));
		$result = iterator_to_array($iterator);
		$this->assertEquals(3, count($result));
	} // testLimitCount();

	/**
	 * Test vytvoření instance s neplatným iterátorem
	 */
	public function testInvalidIterator()
	{
		$this->setExpectedException('InvalidArgumentException');
		$iterator = new \Jyxo\Spl\CountableLimitIterator(new \EmptyIterator());
	} // testInvalidIterator();
}
