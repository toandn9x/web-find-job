<?php


namespace App\Http\Views;

use App\Models\Notification;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Auth;

class NotificationComposer
{
    public function compose(View $view)
    {
        if(Auth::check()) {
            $notifications = Notification::where('recipient_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

            $view->with([
                'notifications' => $notifications,
            ]);
        }
       
    }
}