<?php
/*
 * This file is part of the Eko\FeedBundle Symfony bundle.
 *
 * (c) Vincent Composieux <vincent.composieux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eko\FeedBundle\Tests;

use Eko\FeedBundle\Feed\FeedManager;

/**
 * FeedManagerTest
 *
 * This is the feed manager test class
 *
 * @author Vincent Composieux <vincent.composieux@gmail.com>
 */
class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array $config  Configuration settings
     */
    protected $config = array(
        'feeds' => array(
            'article' => array(
                'title'       => 'My articles/posts',
                'description' => 'Latests articles',
                'link'        => 'http://github.com/eko/FeedBundle',
                'encoding'    => 'utf-8',
                'author'      => 'Vincent Composieux'
            )
        )
    );

    /**
     * Check if feed is correctly inserted
     */
    public function testHasFeed()
    {
        $manager = new FeedManager($this->config);

        $this->assertTrue($manager->has('article'));
    }

    /**
     * Check if a fake feed name is not marked as existing
     */
    public function testFeedDoNotExists()
    {
        $manager = new FeedManager($this->config);

        $this->assertFalse($manager->has('fake_feed_name'));
    }

    /**
     * Check if the feed data are properly loaded from configuration settings
     */
    public function testGetFeedData()
    {
        $manager = new FeedManager($this->config);
        $feed = $manager->get('article');

        $this->assertEquals('My articles/posts', $feed->get('title'));
        $this->assertEquals('Latests articles', $feed->get('description'));
        $this->assertEquals('http://github.com/eko/FeedBundle', $feed->get('link'));
        $this->assertEquals('utf-8', $feed->get('encoding'));
        $this->assertEquals('Vincent Composieux', $feed->get('author'));
    }
}