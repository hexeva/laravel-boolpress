<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostAdminNotification extends Mailable
{
    use Queueable, SerializesModels;

    // istanzio $new_post da mettere a disposizione nel contruct 
    public $new_post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // passo come argomento nel contruct new_post che metterò con di data a disposizione nella view
    public function __construct($_new_post)
    {
        $this->new_post = $_new_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // passo new post alla view 
        $data = [
            'new_post'=> $this->new_post
        ];
        return $this->view('mails.new-post-admin-notification',$data);
    }
}
