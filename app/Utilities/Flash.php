<?php

namespace App\Utilities;

/**
 * Class Flash
 * @package App\Utilities
 */
class Flash
{
    /**
     * Message key
     */
    const MESSAGE = 'flash_message';

    /**
     * Overlay key
     */
    const OVERLAY = 'flash_message_overlay';

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @param string $key
     */
    public function message(string $title, string $message, string $type = 'info', string $key = self::MESSAGE)
    {
        session()->flash($key, [
            'title'   => $title,
            'message' => $message,
            'type'    => $type
        ]);
    }

    /**
     * @param string $title
     * @param string $message
     */
    public function success(string $title, string $message)
    {
        $this->message($title, $message, 'success');
    }

    /**
     * @param string $title
     * @param string $message
     */
    public function error(string $title, string $message)
    {
        $this->message($title, $message, 'error');
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     */
    public function overlay(string $title, string $message, string $type = 'success')
    {
        $this->message($title, $message, $type, self::OVERLAY);
    }
}
