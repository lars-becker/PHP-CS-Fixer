<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace PhpCsFixer\Tests\Fixer\StringNotation;

use PhpCsFixer\Tests\Test\AbstractFixerTestCase;

/**
 * @author Gregor Harlan <gharlan@web.de>
 *
 * @internal
 *
 * @covers \PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer
 */
final class SingleQuoteFixerTest extends AbstractFixerTestCase
{
    /**
     * @param string      $expected
     * @param null|string $input
     *
     * @dataProvider provideTestFixCases
     */
    public function testFix($expected, $input = null)
    {
        $this->doTest($expected, $input);
    }

    public function provideTestFixCases()
    {
        return array(
            array(
                '<?php $a = \'\';',
                '<?php $a = "";',
            ),
            array(
                '<?php $a = b\'\';',
                '<?php $a = b"";',
            ),
            array(
                '<?php $a = B\'\';',
                '<?php $a = B"";',
            ),
            array(
                '<?php $a = \'foo bar\';',
                '<?php $a = "foo bar";',
            ),
            array(
                '<?php $a = b\'foo bar\';',
                '<?php $a = b"foo bar";',
            ),
            array(
                '<?php $a = B\'foo bar\';',
                '<?php $a = B"foo bar";',
            ),
            array(
                '<?php $a = \'foo
                    bar\';',
                '<?php $a = "foo
                    bar";',
            ),
            array(
                '<?php $a = \'foo\'.\'bar\'."$baz";',
                '<?php $a = \'foo\'."bar"."$baz";',
            ),
            array(
                '<?php $a = \'foo "bar"\';',
                '<?php $a = "foo \"bar\"";',
            ),
            array(<<<'EOF'
<?php $a = '\\foo\\bar\\\\';
EOF
                , <<<'EOF'
<?php $a = "\\foo\\bar\\\\";
EOF
            ),
            array(
                '<?php $a = \'foo $bar7\';',
                '<?php $a = "foo \$bar7";',
            ),
            array(
                '<?php $a = \'foo $(bar7)\';',
                '<?php $a = "foo \$(bar7)";',
            ),
            array(
                '<?php $a = \'foo \\\\($bar8)\';',
                '<?php $a = "foo \\\\(\$bar8)";',
            ),
            array('<?php $a = "foo \\" \\$$bar";'),
            array('<?php $a = b"foo \\" \\$$bar";'),
            array('<?php $a = B"foo \\" \\$$bar";'),
            array('<?php $a = "foo \'bar\'";'),
            array('<?php $a = b"foo \'bar\'";'),
            array('<?php $a = B"foo \'bar\'";'),
            array('<?php $a = "foo $bar";'),
            array('<?php $a = b"foo $bar";'),
            array('<?php $a = B"foo $bar";'),
            array('<?php $a = "foo ${bar}";'),
            array('<?php $a = b"foo ${bar}";'),
            array('<?php $a = B"foo ${bar}";'),
            array('<?php $a = "foo\n bar";'),
            array('<?php $a = b"foo\n bar";'),
            array('<?php $a = B"foo\n bar";'),
            array(<<<'EOF'
<?php $a = "\\\n";
EOF
            ),
        );
    }
}
