<?php

namespace Benji07\BlogBundle\Tests\Entity;

use Benji07\BlogBundle\Entity\Post;

/**
 * Test for entity Post
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test __toString method
     */
    public function testToString()
    {
        $p = new Post();
        $p->setTitle('mon titre');

        $this->assertEquals('mon titre', (string) $p);
    }
}