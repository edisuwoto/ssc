<?php


use Modules\Chat\Entities\Status;

if (!function_exists('userStatusChange')) {
    function userStatusChange($userId, $status)
    {
        $current = Status::firstOrNew(
            ['user_id' => $userId],
            ['user_id' => $userId,]
        );

        $current->status = $status;
        $current->save();
    }
}
