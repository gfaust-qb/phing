<?php
namespace Phing\Test\Task\Ext\Hg;

use Phing\Test\Helper\AbstractBuildFileTest;

class TagTest extends AbstractBuildFileTest
{
    public function setUp()
    {
        mkdir(PHING_TEST_BASE . '/tmp/hgtest');
        $this->configureProject(
            PHING_TEST_BASE
            . '/etc/tasks/ext/hg/HgTagTaskTest.xml'
        );
    }

    public function tearDown()
    {
        HgTestsHelper::rmdir(PHING_TEST_BASE . "/tmp/hgtest");
    }

    public function testRepoDoesntExist()
    {
        $this->expectBuildExceptionContaining(
            'wrongRepositoryDirDoesntExist',
            'wrongRepositoryDirDoesntExist',
            "Repository directory 'inconcievable-buttercup' does not exist."
        );
    }

    /*
    public function testTag()
    {
        $this->expectBuildExceptionContaining(
            "tag",
            "tag",
            "abort: cannot tag null revision"
        );
        $this->assertInLogs('Executing: tag --user \'test\' new-tag');
    }
    */

    public function testRevision()
    {
        $this->expectBuildExceptionContaining(
            "testRevision",
            "testRevision",
            "abort: unknown revision 'deadbeef'"
        );
        $this->assertInLogs(
            'Executing: tag --rev \'deadbeef\' --user \'test\' new-tag'
        );
    }
}
