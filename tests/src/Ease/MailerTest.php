<?php

namespace Test\Ease;

use Ease\Mailer;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-10-23 at 14:10:35.
 */
class MailerTest extends SandTest {

    /**
     * @var Mailer
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->object = new Mailer('info@vitexsoftware.cz', 'Unit Test');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void {
        
    }

    /**
     * @covers Ease\Mailer::__construct
     */
    public function testConstructor() {
        $classname = get_class($this->object);

        // Get mock, without the constructor being called
        $mock = $this->getMockBuilder($classname)
                ->disableOriginalConstructor()
                ->getMockForAbstractClass();
        $mock->__construct('info@vitexsoftware.cz', 'Unit Test');

        $mock->__construct('vitex@hippy.cz', 'Hallo', 'PHPUnit works well!');

        $this->assertEquals('PHPUnit works well!', $mock->textBody);
    }

    /**
     * @covers Ease\Mailer::setMailHeaders
     */
    public function testSetMailHeaders() {
        $this->object->mailHeaders['From'] = 'ease@framework.cz';
        $this->object->setMailHeaders(['x-mail' => 'test']);
        $this->assertEquals('test', $this->object->getMailHeader('x-mail'));
        $this->assertEquals('ease@framework.cz',
                $this->object->getMailHeader('From'));
    }

    /**
     * @covers Ease\Mailer::getMailHeader
     */
    public function testGetMailHeader() {
        $this->assertEquals('info@vitexsoftware.cz',
                $this->object->getMailHeader('To'));
    }

    /**
     * @covers Ease\Mailer::setMailBody
     */
    public function testSetMailBody() {
        $this->assertTrue($this->object->setMailBody('mail body'));
    }

    /**
     * @covers Ease\Mailer::addFile
     */
    public function testAddFile() {
        $this->assertTrue($this->object->addFile(__FILE__, 'text/x-php'));
    }

    /**
     * @covers Ease\Mailer::draw
     */
    public function testDraw($whatWant = NULL) {
        $this->assertEmpty($this->object->draw());
    }

    /**
     * @covers Ease\Mailer::send
     */
    public function testSend() {
        if (file_exists('/usr/sbin/sendmail')) {
            $this->assertTrue($this->object->send());
        } else {
            $this->markTestSkipped('Sendmail not found');
        }
    }

    /**
     * @covers Ease\Mailer::setUserNotification
     */
    public function testSetUserNotification() {
        $this->object->setUserNotification(true);
        $this->assertTrue($this->object->notify);
        $this->object->setUserNotification(false);
        $this->assertFalse($this->object->notify);
    }

}
