<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Tests\Assetic\Util;

use Fxp\Component\RequireAsset\Assetic\Config\PackageManagerInterface;
use Fxp\Component\RequireAsset\Assetic\Util\PackageUtils;
use PHPUnit\Framework\TestCase;

/**
 * Package Utils Tests.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class PackageUtilsTest extends TestCase
{
    public function testGetPackagePaths()
    {
        $validPackages = [
            '@asset/package1' => 'path_to_package1',
            '@asset/package2' => 'path_to_package2',
            '@asset/vendor_asset_bundle' => 'path_to_bundle',
        ];

        $manager = $this->getMockBuilder('Fxp\Component\RequireAsset\Assetic\Config\PackageManagerInterface')->getMock();
        $manager->expects($this->any())
            ->method('getPackages')
            ->will($this->returnValue($this->createMockPackages($validPackages)));

        /* @var PackageManagerInterface $manager */
        $this->assertEquals($validPackages, PackageUtils::getPackagePaths($manager));
    }

    protected function createMockPackages(array $packages)
    {
        $mocks = [];

        foreach ($packages as $name => $path) {
            $mock = $this->getMockBuilder('Fxp\Component\RequireAsset\Assetic\Config\PackageInterface')->getMock();
            $mock->expects($this->any())
                ->method('getName')
                ->will($this->returnValue($name));
            $mock->expects($this->any())
                ->method('getSourcePath')
                ->will($this->returnValue($path));

            $mocks[] = $mock;
        }

        return $mocks;
    }
}
