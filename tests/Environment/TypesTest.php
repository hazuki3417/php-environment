<?php declare(strict_types=1);
/**
 * @license MIT
 * @author hazuki3417<hazuki3417@gmail.com>
 * @copyright 2021 hazuki3417 all rights reserved.
 */

namespace Selen\Environment\Test;

use Mockery;
use PHPUnit\Framework\TestCase;
use Selen\Environment\TypeInterface;
use Selen\Environment\Types;

/**
 * @coversDefaultClass \Selen\Environment\Types
 *
 * @group Selen/Environment
 * @group Selen/Environment/Types
 *
 * @see \Selen\Environment\Types
 *
 * [command]
 * php ./vendor/bin/phpunit --group=Selen/Environment/Types
 *
 * @internal
 */
class TypesTest extends TestCase
{
    public function testGet()
    {
        /** @var \Selen\Environment\TypeInterface $mockProduction */
        $mockProduction = Mockery::mock(TypeInterface::class)->makePartial();
        $mockProduction->shouldReceive('name')->andReturn('production');
        $mockProduction->shouldReceive('values')->andReturn(['test1']);

        /** @var \Selen\Environment\TypeInterface $mockStaging */
        $mockStaging = Mockery::mock(TypeInterface::class)->makePartial();
        $mockStaging->shouldReceive('name')->andReturn('staging');
        $mockStaging->shouldReceive('values')->andReturn(['test2']);

        /** @var \Selen\Environment\TypeInterface $mockTesting */
        $mockTesting = Mockery::mock(TypeInterface::class)->makePartial();
        $mockTesting->shouldReceive('name')->andReturn('testing');
        $mockTesting->shouldReceive('values')->andReturn(['test3']);

        $types = new Types($mockProduction, $mockStaging, $mockTesting);

        $this->assertInstanceOf(TypeInterface::class, $types->get('production'));
        $this->assertInstanceOf(TypeInterface::class, $types->get('staging'));
        $this->assertInstanceOf(TypeInterface::class, $types->get('testing'));

        $this->assertEquals($types->get('production')->name(), 'production');
        $this->assertEquals($types->get('staging')->name(), 'staging');
        $this->assertEquals($types->get('testing')->name(), 'testing');

        $this->assertEquals($types->get('production')->values(), ['test1']);
        $this->assertEquals($types->get('staging')->values(), ['test2']);
        $this->assertEquals($types->get('testing')->values(), ['test3']);

        $this->expectException(\RuntimeException::class);

        $types->get('local');
    }
}
