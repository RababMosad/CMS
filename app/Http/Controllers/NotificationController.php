<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Post;
use App\Models\Alert;




class NotificationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
  
        $someNotifications = Notification::where([
                                ['user_id' , '!=', auth()->user()->id],
                                ['post_userId', '=', auth()->user()->id]
                            ])
                            ->orderBy('created_at', 'desc')
                            ->limit(4)
                            ->get();

        $data = [];
        foreach ($someNotifications as $item) {
            $data[] = [
                'user_name' => User::find($item->user_id)->name,
                'user_image' => User::find($item->user_id)->profile_photo_url,
                'post_title' => Post::find($item->post_id)->title,
                'post_slug' => Post::find($item->post_id)->slug,
                'date' => $item->created_at->diffForHumans()
            ];
        }

        $alert = Alert::where('user_id' , auth()->user()->id)->first();
        $alert->alert = 0 ;
        $alert->save();
        return response()->json(['someNotifications' => $data]);
    }

    public function allNotification(){
        $notifications = Notification::where([
            ['user_id' , '!=', auth()->user()->id],
            ['post_userId', '=', auth()->user()->id]
        ])
         ->orderBy('created_at', 'desc')
         ->paginate(10);
         

         $title='جميع الاشعارات';
         return view('notifications.show' , compact('notifications' , 'title'));
     }
}

