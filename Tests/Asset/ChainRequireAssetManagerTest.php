<?php

/*
 * This file is part of the Fxp Require Asset package.
 *
 * (c) François Pluchino <francois.pluchino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fxp\Component\RequireAsset\Tests\Asset;

use Fxp\Component\RequireAsset\Asset\ChainRequireAssetManager;
use Fxp\Component\RequireAsset\Asset\RequireAssetManagerInterface;

/**
 * Require Locale Manager Tests.
 *
 * @author François Pluchino <francois.pluchino@gmail.com>
 */
class ChainRequireAssetManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RequireAssetManagerInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $ram;

    /**
     * @var ChainRequireAssetManager
     */
    protected $cram;

    protected function setUp()
    {
        $this->ram = $this->getMockBuilder(RequireAssetManagerInterface::class)->getMock();
        $this->cram = new ChainRequireAssetManager(array($this->ram));
    }

    public function getHasValues()
    {
        return array(
            array(true),
            array(false),
        );
    }

    /**
     * @dataProvider getHasValues
     *
     * @param bool $expectedResult
     */
    public function testHas($expectedResult)
    {
        $asset = '@package/asset.ext';

        $this->ram->expects($this->once())
            ->method('has')
            ->with($asset)
            ->willReturn($expectedResult);

        $res = $this->cram->has($asset);

        $this->assertSame($expectedResult, $res);
    }

    public function testGetPath()
    {
        $asset = '@package/asset.ext';
        $expectedResult = '/assets/asset.ext';

        $this->ram->expects($this->once())
            ->method('has')
            ->with($asset)
            ->willReturn(true);

        $this->ram->expects($this->once())
            ->method('getPath')
            ->with($asset)
            ->willReturn($expectedResult);

        $res = $this->cram->getPath($asset);

        $this->assertSame($expectedResult, $res);
    }

    /**
     * @expectedException \Fxp\Component\RequireAsset\Exception\AssetNotFoundException
     * @expectedExceptionMessage The asset "@package/asset.ext" is not found
     */
    public function testGetPathWithoutAsset()
    {
        $asset = '@package/asset.ext';

        $this->ram->expects($this->once())
            ->method('has')
            ->with($asset)
            ->willReturn(false);

        $this->ram->expects($this->never())
            ->method('getPath');

        $this->cram->getPath($asset);
    }

    /**
     * @expectedException \Fxp\Component\RequireAsset\Exception\AssetNotFoundException
     * @expectedExceptionMessage The asset "@package/asset.ext" is not found
     */
    public function testGetPathWithException()
    {
        $asset = '@package/asset.ext';

        $this->ram->expects($this->once())
            ->method('has')
            ->with($asset)
            ->willReturn(true);

        $this->ram->expects($this->once())
            ->method('getPath')
            ->with($asset)
            ->willThrowException(new \Exception('TEST'));

        $this->cram->getPath($asset);
    }
}
