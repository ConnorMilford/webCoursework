<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class postNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $comment;

    /**
     * Create a new notification instance.
     */
    public function __construct(Post $post, Comment $comment)
    {
        $this->post=$post;
        $this->comment=$comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'post_id' => $this->post->id,
            'post_text' => $this->post->postText,
            'comment_id' => $this->comment->id,
            'comment_text' => $this->comment->text,
        ];
    }
}
