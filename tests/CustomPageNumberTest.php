<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CustomPageNumberTest extends TestCase
{
    public function testCustomPageNumberClass()
    {
        $parser = new Denshoch\DenDenMarkdown( array("pageNumberClass" => "page" ) );

        $source = <<< EOT
[%%36]

## 大見出し ##
EOT;

        $expected = <<< EOT
<div id="pagenum_36" class="page" title="36" epub:type="pagebreak" role="doc-pagebreak">36</div>

<h2>大見出し</h2>
EOT;

        $actual = $parser->transform($source);
        $this->assertEquals(rtrim($expected), $actual);
        
    }

    public function testCustomPageNumberContent()
    {
        $parser = new Denshoch\DenDenMarkdown( array("pageNumberContent" => "第%%ページ" ) );

        $source = <<< EOT
[%%36]

## 大見出し ##
EOT;

        $expected = <<< EOT
<div id="pagenum_36" class="pagenum" title="36" epub:type="pagebreak" role="doc-pagebreak">第36ページ</div>

<h2>大見出し</h2>
EOT;

        $actual = $parser->transform($source);
        $this->assertEquals(rtrim($expected), $actual);
        
    }
}