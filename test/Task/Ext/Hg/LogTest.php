<?php

namespace Phing\Test\Task\Ext\Hg;

use Phing\Test\Helper\AbstractBuildFileTest;

class LogTest extends AbstractBuildFileTest
{
    public function setUp()
    {
        mkdir(PHING_TEST_BASE . '/tmp/hgtest');
        $this->configureProject(
            PHING_TEST_BASE
            . '/etc/tasks/ext/hg/HgLogTaskTest.xml'
        );
    }

    public function tearDown()
    {
        HgTestsHelper::rmdir(PHING_TEST_BASE . "/tmp/hgtest");
    }

    public function testMaxCountShouldBeAnInteger()
    {
        $this->expectBuildExceptionContaining(
            'maxCountShouldBeAnInteger',
            'maxCountShouldBeAnInteger',
            "maxcount should be a positive integer."
        );
    }

    public function testMaxCountShouldBeAnInteger2()
    {
        $this->expectBuildExceptionContaining(
            'maxCountShouldBeAnInteger2',
            'maxCountShouldBeAnInteger',
            "maxcount should be a positive integer."
        );
    }
}
