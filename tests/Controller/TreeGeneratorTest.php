<?php
require_once 'src/constants.php';
require_once 'src/Controller/TreeGenerator.php';

/**
 * @author agnes
 */
class TreeGeneratorTest extends PHPUnit\Framework\TestCase {
    const SMALL_SIZE = 5;
    const MEDIUM_SIZE = 7;
    const LARGE_SIZE = 11;
    
    /**
     * @dataProvider provideCorrectShapesLength
     */
    public function testCorrectShapesLength(int $size, int $string_length): void {
        $expected_tree = (new TreeGenerator())->generateShape($size);
        $this->assertEquals(strlen($expected_tree), $string_length);
    }
    
    public function provideCorrectShapesLength(): iterable {
        yield 'small tree string length' => [ 
            self::SMALL_SIZE, 40
        ];
        yield 'medium tree string length' => [ 
            self::MEDIUM_SIZE, 84
        ];
        yield 'large tree string length' => [ 
            self::LARGE_SIZE, 220
        ];
    }
    
    /**
     * @dataProvider provideCorrectShapes
     */
    public function testGenerateCorrectShapes(string $shape, int $size): void {
        $expected_tree = (new TreeGenerator())->generateShape($size);
        $this->assertEquals($expected_tree, $shape);
    }
    
    public function provideCorrectShapes(): iterable {
        yield 'small tree shape' => [ 
            ""
            . "   +   \n"
            . "   X   \n"
            . "  XXX  \n"
            . " XXXXX \n"
            . "XXXXXXX\n",
            self::SMALL_SIZE
        ];
        yield 'medium tree shape' => [ 
            ""
            . "     +     \n"
            . "     X     \n"
            . "    XXX    \n"
            . "   XXXXX   \n"
            . "  XXXXXXX  \n"
            . " XXXXXXXXX \n"
            . "XXXXXXXXXXX\n",
            self::MEDIUM_SIZE
        ];
        yield 'large tree shape' => [ 
            ""
            . "         +         \n"
            . "         X         \n"
            . "        XXX        \n"
            . "       XXXXX       \n"
            . "      XXXXXXX      \n"
            . "     XXXXXXXXX     \n"
            . "    XXXXXXXXXXX    \n"
            . "   XXXXXXXXXXXXX   \n"
            . "  XXXXXXXXXXXXXXX  \n"
            . " XXXXXXXXXXXXXXXXX \n"
            . "XXXXXXXXXXXXXXXXXXX\n",
            self::LARGE_SIZE
        ];
    }
}
