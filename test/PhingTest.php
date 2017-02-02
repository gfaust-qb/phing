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

namespace Phing\Test;

use Phing\Phing;
use PHPUnit_Framework_TestCase;

/**
 * Core Phing class test
 *
 * @author Kirill chEbba Chebunin <iam@chebba.org>
 * @version $Revision: $
 * @package phing
 */
class PhingTest extends PHPUnit_Framework_TestCase
{
    const NAMESPACED_CLASS = 'Vendor\\Package\\Sub_Package\\Separated\\FullSeparatedClass';
    const SEPARATED_CLASS = 'Vendor_Package_SeparatedClass';
    const DOTTED_CLASS = 'Vendor.Package.DottedClass';
    const DOTTED_CLASS_SHORTNAME = 'DottedClass';

    protected $classpath;

    /**
     * Test a PSR-0 support of class loading
     * @link http://groups.google.com/group/php-standards/web/psr-0-final-proposal
     */
    public function testImportNamespacedClass()
    {
        $className = Phing::import(self::NAMESPACED_CLASS, self::getClassPath());
        self::assertEquals(self::NAMESPACED_CLASS, $className);
        self::assertTrue(class_exists(self::NAMESPACED_CLASS));
    }

    /**
     * Tests the PEAR standard
     */
    public function testImportPear()
    {
        $className = Phing::import(self::SEPARATED_CLASS, self::getClassPath());
        self::assertEquals(self::SEPARATED_CLASS, $className);
        self::assertTrue(class_exists(self::SEPARATED_CLASS));
    }

    /**
     * Test the default dot separated class loading
     */
    public function testImportDotPath()
    {
        $className = Phing::import(self::DOTTED_CLASS, self::getClassPath());
        self::assertEquals(self::DOTTED_CLASS_SHORTNAME, $className);
        self::assertTrue(class_exists(self::DOTTED_CLASS_SHORTNAME));
    }

    /**
     * Get fixtures classpath
     *
     * @return string Classpath
     */
    protected static function getClassPath()
    {
        return __DIR__ . '/etc/importclasses';
    }
}
