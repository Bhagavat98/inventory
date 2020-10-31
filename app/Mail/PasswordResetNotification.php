<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class PasswordResetNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $content = null;
    protected $brandName = null;
    protected $reset_email = null;
    protected $title = null;
    protected $fromEmail = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $reset_email, $fromEmail, $content, $name)
    {
        //
        $this->content = $content; 
        $this->title = $title; 
        $this->name = $name;
        $this->reset_email = $reset_email;
        $this->fromEmail = $fromEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        Log::info("Sending Mail/PasswordResetNotification.php email=".$this->reset_email.",  BrandName:".$this->name.", content=".$this->content);

        return $this->from($this->fromEmail, $this->name)
					 ->subject($this->title)
                ->markdown('emails.reset_password', [ 'title' => $this->title, 'name' => $this->name, 'content' => $this->content, ]);
                //->with('name', $this->fromEmailName);
        //return $this->view('daily_email')->with('test', 'Test Value');
        //return $this->toMail();
                
    }

    
}
