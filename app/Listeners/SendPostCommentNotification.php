<?php

namespace App\Listeners;

use App\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\postNotification;
class SendPostCommentNotification
{
    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $comment = $event->comment;
        
        if ($comment && $comment->post) {
            $post = $comment->post;
            
            if ($post->user) {
                $user = $post->user;
                
                $user->notify(new PostNotification($post, $comment));
            } else {
                \Log::error('Post does not have a user associated with it.');
            }
        } else {
            \Log::error('Comment does not have a related post.');
        }
    }
}
