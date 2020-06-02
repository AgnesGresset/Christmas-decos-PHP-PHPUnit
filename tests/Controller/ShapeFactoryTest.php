<?php
require_once 'src/constants.php';
require_once 'src/Controller/ShapeFactory.php';
require_once 'src/Model/UserData.php';

/**
 * @author agnes
 */
class ShapeFactoryTest extends PHPUnit\Framework\TestCase {
    /**
     * @dataProvider provideUserData
     */
    public function testCreateShapeWithCorrectUserData(array $fake_user_data, array $result): void {
        $shape_factory = (new ShapeFactory($fake_user_data));
        $this->assertEquals($shape_factory->createShapes(), $result);
    }
    
    public function provideUserData(): iterable {
        $correct_fake_user_data = [
            "user1" => [
                0 => [
                    "tree" => "s"
                ]
            ],
            "user2" => [
                0 => [
                    "star" => "m"
                ],
            ]
        ];
        
        yield 'correct user data' => [
            $correct_fake_user_data, [
                0 => ""
                . "   +   \n"
                . "   X   \n"
                . "  XXX  \n"
                . " XXXXX \n"
                . "XXXXXXX\n",
                1 => ""
                . "     +     \n"
                . "     X     \n"
                . "   XXXXX   \n"
                . "+XXXXXXXXX+\n"
                . "   XXXXX   \n"
                . "     X     \n"
                . "     +     \n",
            ]
        ];
        
        yield 'empty user data' => [ [], [] ];
    }
}
