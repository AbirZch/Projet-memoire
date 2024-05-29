<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class MeetingReminder extends Mailable
{
    use Queueable, SerializesModels;

 public $remainingDays;
 private Carbon $meetingDateTime;
public $attendeeName;
public $meetingDate;
public $meetingOrganizer;
public $meetingTime;
    public function __construct( $meetingDateTime,$attendeeName,$meetingOrganizer)
    {
        $this->meetingDateTime=Carbon::parse( $meetingDateTime);
        $this->meetingDate=  $this->meetingDateTime->toDateString();
        $this->meetingTime=  $this->meetingDateTime->toTimeString();
        $this->attendeeName=$attendeeName;
        $this->meetingOrganizer=$meetingOrganizer;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Meeting Reminder',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.meeting-reminder',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
