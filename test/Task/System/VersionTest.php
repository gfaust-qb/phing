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

namespace Phing\Test\Task\System;

use Phing\Test\Helper\AbstractBuildFileTest;


/**
 * @author Michiel Rook <mrook@php.net>
 * @package phing.tasks.ext
 */
class VersionTest extends AbstractBuildFileTest
{
    public function setUp()
    {
        $this->configureProject(PHING_TEST_BASE . "/etc/tasks/system/VersionTest.xml");
    }

    public function tearDown()
    {
        if (file_exists(PHING_TEST_BASE . "/etc/tasks/system/" . 'build.version')) {
            unlink(PHING_TEST_BASE . "/etc/tasks/system/" . 'build.version');
        }

        if (file_exists(PHING_TEST_BASE . "/etc/tasks/system/" . 'property.version')) {
            unlink(PHING_TEST_BASE . "/etc/tasks/system/" . 'property.version');
        }
    }

    public function testBugfix()
    {
        $this->expectLog("testBugfix", "1.0.1");
    }

    public function testMinor()
    {
        $this->expectLog("testMinor", "1.1.0");
    }

    public function testMajor()
    {
        $this->expectLog("testMajor", "2.0.0");
    }

    public function testDefault()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertPropertyEquals('build.version', '1.0.0');
        $this->assertFileExists(PHING_TEST_BASE . "/etc/tasks/system/" . 'build.version', 'File not found');
    }

    public function testPropFile()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertPropertyEquals('propfile.version', '4.5.5');
        $this->assertFileExists(PHING_TEST_BASE . "/etc/tasks/system/" . 'property.version', 'File not found');
    }

    public function testPropFileWithDefaultProperty()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertPropertyEquals('build.version', '4.5.5');
        $this->assertFileExists(PHING_TEST_BASE . "/etc/tasks/system/" . 'build.version', 'File not found');
    }

    public function testWithStartingVersion()
    {
        $this->executeTarget(__FUNCTION__);
        $this->assertPropertyEquals('build.version', '1.0.1');
        $this->assertFileExists(PHING_TEST_BASE . "/etc/tasks/system/" . 'build.version', 'File not found');
    }
}
