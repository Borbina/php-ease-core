<?php
/**
 * Základní objekty systému.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2019 Vitex@hippy.cz (G)
 */
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart

declare(strict_types=1);

namespace Test\Ease;

use Ease\Atom;

/**
 * Test class for EaseAtom.
 * Generated by PHPUnit on 2012-03-17 at 23:53:07.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2009-2019 Vitex@hippy.cz (G)
 */
class AtomTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Atom
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->object = new Atom();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        
    }

    /**
     * @covers Ease\Atom::logBanner
     */
    public function testLogBanner()
    {
//          $this->object->cleanStatusMessages();
        $this->object->logBanner();
        $statuses = $this->object->getStatusMessages();
        $this->assertStringContainsString('EasePHP Framework',
            end($statuses['debug']));
    }

    /**
     * @covers Ease\Atom::getObjectName
     */
    public function testgetObjectName()
    {
        $this->assertNotEmpty($this->object->getObjectName());
    }

    /**
     * @covers Ease\Atom::addStatusMessage
     */
    public function testaddStatusMessage()
    {
        $this->object->cleanMessages();
        $this->object->addStatusMessage(_('Status message add test'), 'info');
        $this->assertNotEmpty($this->object->getStatusMessages());
    }

    /**
     * @covers Ease\Atom::addStatusMessages
     */
    public function testaddstatusMessages()
    {
        $this->object->addStatusMessage('Ok');
        $this->object->addstatusMessages(array('info' => array('test msg 1'), 'debug' => array(
                'test msg 2',)));
        $this->assertArrayHasKey('info', $this->object->getStatusMessages());
        $this->assertNull($this->object->addStatusMessages(false));
    }

    /**
     * @covers Ease\Atom::cleanMessages
     */
    public function testcleanMessages()
    {
        $this->object->addStatusMessage('Clean Test');
        $this->object->cleanMessages();
        $this->assertEmpty($this->object->getStatusMessages(),
            'Status messages cleaning');
    }

    /**
     * @covers Ease\Atom::getStatusMessages
     */
    public function testgetstatusMessages()
    {
        $this->object->cleanMessages();
        $this->object->addStatusMessage('Message');
        $this->object->addStatusMessage('Message', 'warning');
        $this->object->addStatusMessage('Message', 'debug');
        $this->object->addStatusMessage('Message', 'error');
        $messages = $this->object->getstatusMessages();
        $this->assertArrayHasKey('error', $messages);
        $this->assertArrayHasKey('debug', $messages);
        $this->assertArrayHasKey('info', $messages);
    }

    /**
     * @covers Ease\Atom::__toString
     */
    public function test__toString()
    {
        $this->assertEmpty($this->object->__toString());
    }

    /**
     * @covers Ease\Atom::draw
     */
    public function testDraw($whatWant = null)
    {
        $this->assertEquals('', $this->object->draw());
    }
}

// @codeCoverageIgnoreEnd
