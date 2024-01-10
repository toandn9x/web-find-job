<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Events\SendNotification;
use Log;

class NotificationController extends Controller
{
    public static function store($request) {
        $notification = new Notification;
        $notification->recipient_id = $request['recipient_id'];
        $notification->sender_id = $request['sender_id'];
        $notification->content = $request['content'];
        $notification->path = $request['path_route'];

        $notification->save();
    }
}
