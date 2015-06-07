<?php

use StephenHill\ORM\RandomBase58IdGenerator;

class RandomBase58IdGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function testSomething()
    {
        $em = $this->getMockBuilder('\Doctrine\ORM\EntityManager')
                   ->disableOriginalConstructor()
                   ->getMock();

        $entity = new stdClass();

        $generator = new RandomBase58IdGenerator();

        $id = $generator->generate($em, $entity);

        $this->assertSame(16, strlen($id));
    }
}