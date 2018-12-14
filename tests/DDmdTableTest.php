<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class DDmdTableTest extends TestCase
{
    public function setUp()
    {
        $this->parser = new Denshoch\DenDenMarkdown( array("ddmdTable" => true) );
        $this->fixtureDir = __DIR__ . DIRECTORY_SEPARATOR . 'fixtures' . DIRECTORY_SEPARATOR . 'DDmdTable';
    }

    public function test01()
    {
        $this->assertTransformation('01');
    }

    public function testTableAlignClassTmpl()
    {
    	$this->parser->tableAlignClassTmpl = "text-%%";
        $this->assertTransformation('testTableAlignClassTmpl');
    }

    protected function assertTransformation($fixtureName)
    {
        $sourceFile = $fixtureName . '.md';
        $transformedFile = $fixtureName . '.html';
        $this->assertTransformedFile($transformedFile, $sourceFile);
    }

    protected function assertTransformedFile($transformedFile, $sourceFile)
    {
        $expected = $this->fixture($transformedFile);
        $actual = $this->parser->transform($this->fixture($sourceFile));
        $this->assertSame($expected, $actual);
    }

    protected function fixture($fileName)
    {
        $filePath = $this->fixtureDir . DIRECTORY_SEPARATOR . $fileName;
        return file_get_contents($filePath);
    }
}