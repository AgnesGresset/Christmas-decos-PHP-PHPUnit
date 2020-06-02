<?php
require_once 'src/constants.php';
require_once 'src/Model/UserData.php';

/**
 * @author agnes
 */
class UserDataTest  extends PHPUnit\Framework\TestCase {
    public function testFetchCorrectData(): void {
        $correct_fake_user_data = [
            "fake_user1" => [
                0 => [ "tree" => "s" ],
                1 => [ "tree" => "m" ],
                2 => [ "tree" => "l" ],
                3 => [ "tinsel" => "l" ]
            ],
            "fake_user2" => [
                0 => [ "star" => "s" ],
                1 => [ "star" => "m" ],
                2 => [ "star" => "l" ],
                3 => [ "tree" => "xs"]
            ]
        ];
        
        $this->assertEquals(
            (new UserData())->getUserData(file_get_contents('tests/Model/TestFakeUserData.json')),
            $correct_fake_user_data
        );
    }
    
    public function testFetchEmptyData(): void {
        $this->expectException("Exception");
        $this->expectExceptionMessage("You haven't given any input yet!");
        (new UserData())->getUserData("");
    }
}
