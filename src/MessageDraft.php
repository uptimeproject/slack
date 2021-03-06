<?php declare(strict_types = 1);

namespace UptimeProject\Slack;

class MessageDraft
{
    /** @var Workspace */
    private $workspace;

    /** @var string */
    private $username;

    /** @var string|null */
    private $iconEmoji;

    /** @var string|null */
    private $iconUrl;

    public function __construct(Workspace $workspace, string $username, ?string $iconEmoji = null, ?string $iconUrl = null)
    {
        $this->workspace    = $workspace;
        $this->username     = $username;
        $this->iconEmoji    = $iconEmoji;
        $this->iconUrl      = $iconUrl;
    }

    public function send(string $message, ?string $to = null): void
    {
        $payload = [
            'text'     => $message,
            'username' => $this->username,
        ];

        if ($to !== null) {
            $payload['channel'] = $to;
        }

        if ($this->iconEmoji !== null) {
            $payload['icon_emoji'] = $this->iconEmoji;
        } elseif ($this->iconUrl !== null) {
            $payload['icon_url'] = $this->iconUrl;
        }

        $this->workspace->sendRaw($payload);
    }
}
