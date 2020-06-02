<?php
require_once 'src/constants.php';
require_once 'src/Controller/StarGenerator.php';

/**
 * @author agnes
 */
class StarGeneratorTest extends PHPUnit\Framework\TestCase {
    const SMALL_SIZE = 5;
    const MEDIUM_SIZE = 7;
    const LARGE_SIZE = 11;
    
    /**
     * @dataProvider provideCorrectShapesLength
     */
    public function testCorrectShapesLength(int $size, int $string_length): void {
        $expected_star = (new StarGenerator())->generateShape($size);
        $this->assertEquals(strlen($expected_star), $string_length);
    }
    
    public function provideCorrectShapesLength(): iterable {
        yield 'small star string length' => [ 
            self::SMALL_SIZE, 40
        ];
        yield 'medium star string length' => [ 
            self::MEDIUM_SIZE, 84
        ];
        yield 'large star string length' => [ 
            self::LARGE_SIZE, 198
        ];
    }
    
    /**
     * @dataProvider provideCorrectShapes
     */
    public function testGenerateCorrectShapes(string $shape, int $size): void {
        $expected_star = (new StarGenerator())->generateShape($size);
        $this->assertEquals($expected_star, $shape);
    }
    
    public function provideCorrectShapes(): iterable {
        yield 'small star shape' => [ 
            ""
            . "   +   \n"
            . "   X   \n"
            . "+XXXXX+\n"
            . "   X   \n"
            . "   +   \n",
            self::SMALL_SIZE
        ];
        yield 'medium star shape' => [ 
            ""
            . "     +     \n"
            . "     X     \n"
            . "   XXXXX   \n"
            . "+XXXXXXXXX+\n"
            . "   XXXXX   \n"
            . "     X     \n"
            . "     +     \n",
            self::MEDIUM_SIZE
        ];
        yield 'large star shape' => [ 
            ""
            . "        +        \n"
            . "        X        \n"
            . "       XXX       \n"
            . "     XXXXXXX     \n"
            . "   XXXXXXXXXXX   \n"
            . "+XXXXXXXXXXXXXXX+\n"
            . "   XXXXXXXXXXX   \n"
            . "     XXXXXXX     \n"
            . "       XXX       \n"
            . "        X        \n"
            . "        +        \n",
            self::LARGE_SIZE
        ];
    }
}
