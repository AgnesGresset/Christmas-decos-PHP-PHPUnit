<?php
/**
 * @author agnes
 */
class UserData {
    public function getUserData(string $fake_user_data): ?array {
        $decoded_user_data = json_decode($fake_user_data, true);
        if (!$decoded_user_data) {
            throw new \Exception("You haven't given any input yet!");
        }
        return $decoded_user_data;
    }
}