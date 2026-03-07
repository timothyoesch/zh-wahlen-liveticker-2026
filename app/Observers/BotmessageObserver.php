<?php

namespace App\Observers;

use App\Models\Botmessage;

class BotmessageObserver
{
    /**
     * Handle the Botmessage "created" event.
     */
    public function created(Botmessage $botmessage): void
    {
        // Create POST request to Telegram API to send the message
        $telegramApiUrl = "https://api.telegram.org/bot" . config('services.telegram.bot_token') . "/sendMessage";
        $response = \Http::post($telegramApiUrl, [
            'chat_id' => config('services.telegram.chat_id'),
            'text' => toMarkdownV2($botmessage->content),
            'parse_mode' => 'MarkdownV2',
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['result']['message_id'])) {
                $botmessage->message_id = $responseData['result']['message_id'];
                $botmessage->sent_at = now();
                $botmessage->save();
            }
        } else {
            // Handle error, e.g. log it
            \Log::error('Failed to send message to Telegram', [
                'response' => $response->body(),
                'botmessage_content' => toMarkdownV2($botmessage->content),
            ]);
        }
    }

    /**
     * Handle the Botmessage "updated" event.
     */
    public function updated(Botmessage $botmessage): void
    {
        // If the message has already been sent, we can optionally update it on Telegram
        if ($botmessage->message_id) {
            $telegramApiUrl = "https://api.telegram.org/bot" . config('services.telegram.bot_token') . "/editMessageText";
            $response = \Http::post($telegramApiUrl, [
                'chat_id' => config('services.telegram.chat_id'),
                'message_id' => $botmessage->message_id,
                'text' => toMarkdownV2($botmessage->content),
                'parse_mode' => 'MarkdownV2',
            ]);

            if (!$response->successful()) {
                // Handle error, e.g. log it
                \Log::error('Failed to update message on Telegram', [
                    'response' => $response->body(),
                ]);
            }
        }
    }

    /**
     * Handle the Botmessage "deleted" event.
     */
    public function deleted(Botmessage $botmessage): void
    {
        // Optionally delete the message from Telegram
        if ($botmessage->message_id) {
            $telegramApiUrl = "https://api.telegram.org/bot" . config('services.telegram.bot_token') . "/deleteMessage";
            $response = \Http::post($telegramApiUrl, [
                'chat_id' => config('services.telegram.chat_id'),
                'message_id' => $botmessage->message_id,
            ]);

            if (!$response->successful()) {
                // Handle error, e.g. log it
                \Log::error('Failed to delete message from Telegram', [
                    'response' => $response->body(),
                ]);
            }
        }
    }
}
