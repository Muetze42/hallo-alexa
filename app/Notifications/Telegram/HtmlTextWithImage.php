<?php

namespace App\Notifications\Telegram;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile as TelegramMessage;

class HtmlTextWithImage extends Notification implements ShouldQueue
{
    use Queueable;

    public string $content;
    public string $imageUrl;

    /**
     * Create a new notification instance.
     *
     * @param string $content
     * @param string $imageUrl
     */
    public function __construct(string $content, string $imageUrl)
    {
        $this->content = $content;
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return TelegramMessage
     */
    public function toTelegram(mixed $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->to($notifiable)
            ->content($this->content)
            ->file($this->imageUrl, 'photo')
            ->options(['parse_mode' => 'html']);
    }
}
