<?php

namespace WsdlToPhp\PackageGenerator\Tests\File;

use WsdlToPhp\PackageGenerator\Generator\Generator;
use WsdlToPhp\PackageGenerator\Model\Struct as StructModel;
use WsdlToPhp\PackageGenerator\File\Struct as StructFile;

class StructTest extends AbstractFile
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionOnDestination()
    {
        $file = new StructFile(self::bingGeneratorInstance(), 'foo', __DIR__ . '/../rsources/');
    }
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionOnWrite()
    {
        $file = new StructFile(self::bingGeneratorInstance(), 'foo', __DIR__ . '/../rsources/');

        $file->write();
    }
    /**
     *
     */
    public function testDestination()
    {
        $file = new StructFile(self::bingGeneratorInstance(), 'foo', __DIR__ . '/../resources/');

        $this->assertSame(realpath(__DIR__ . '/../resources'), $file->getDestination());
    }
    /**
     *
     */
    public function testGetFileName()
    {
        $model = new StructModel('Foo');
        $file = new StructFile(self::bingGeneratorInstance(), 'foo', __DIR__ . '/../resources/');
        $file->setModel($model);

        $this->assertSame(realpath(__DIR__ . '/../resources') . '/ApiStructFoo.php', $file->getFileName());
    }
    /**
     *
     */
    public function testWriteBingSearchEnumAdultOption()
    {
        $file = $this->getTestDirectory();
        $generator = self::bingGeneratorInstance();
        if ($model = $generator->getStruct('AdultOption')) {
            $struct = new StructFile($generator, $model->getName(), $file);
            $struct
                ->setModel($model)
                ->write();
            $this->assertSameFileContent('ValidApiEnumAdultOption', $struct);
        } else {
            $this->assertFalse(true, 'Unable to find AdultOption enumeration for file generation');
        }
    }
    /**
     *
     */
    public function testWriteBingSearchStructQuery()
    {
        $file = $this->getTestDirectory();
        $generator = self::bingGeneratorInstance();
        if ($model = $generator->getStruct('Query')) {
            $struct = new StructFile($generator, $model->getName(), $file);
            $struct
                ->setModel($model)
                ->write();
            $this->assertSameFileContent('ValidApiStructQuery', $struct);
        } else {
            $this->assertFalse(true, 'Unable to find Query struct for file generation');
        }
    }
}
