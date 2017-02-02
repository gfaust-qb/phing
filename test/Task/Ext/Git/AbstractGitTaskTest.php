<?php
/*
 *  $Id$
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information please see
 * <http://phing.info>.
 */

namespace Phing\Test\Task\Ext\Git;

use Phing\Task\Ext\Git\AbstractGitTask;
use Phing\Test\Helper\AbstractBuildFileTest;

/**
 * @author Victor Farazdagi <simple.square@gmail.com>
 * @version $Id$
 * @package phing.tasks.ext
 */
class AbstractGitTaskTest extends AbstractBuildFileTest
{
    protected $mock;

    public function setUp()
    {
        // the pear git package hardcodes the path to git to /usr/bin/git and will therefore
        // not work on Windows.
        if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
            $this->markTestSkipped('Testing not on a windows os.');
        }

        $this->configureProject(
            PHING_TEST_BASE
            . "/etc/tasks/ext/git/GitBaseTest.xml"
        );
        $this->mock = $this->getMockForAbstractClass(AbstractGitTask::class);
    }

    public function testInitialization()
    {
        $this->assertInstanceOf(AbstractGitTask::class, $this->mock);
    }

    /**
     * @todo - make sure that required arguments are checked
     */
    public function testArguments()
    {
    }

    public function testMutators()
    {
        // gitPath
        $gitPath = $this->mock->getGitPath();
        $this->mock->setGitPath('my-new-path');
        $this->assertEquals('my-new-path', $this->mock->getGitPath());
        $this->mock->setGitPath($gitPath);

        // repository
        $repository = $this->mock->getRepository();
        $this->mock->setRepository('/tmp');
        $this->assertEquals('/tmp', $this->mock->getRepository());
        $this->mock->setRepository($repository);
    }
}
