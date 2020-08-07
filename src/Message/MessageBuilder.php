<?php
namespace Slack\Message;

use Slack\ApiClient;
use Slack\ChannelInterface;
use Slack\User;

/**
 * A builder object for creating new message objects.
 */
class MessageBuilder
{
    /**
     * @var ApiClient An API client.
     */
    private $client;

    /**
     * @var array An array of data to pass to the built message.
     */
    protected $data = [];

    /**
     * Creates a new message builder.
     *
     * @param ApiClient $client The API client the builder is working for.
     */
    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * Creates and returns a new message object specified by the builder.
     *
     * @return Message A new message object.
     */
    public function create()
    {
        return new Message($this->client, $this->data);
    }

    /**
     * Sets the message text.
     *
     * @param string $text The message body text.
     * @param bool $markdown Enable or disable Markdown parsing of the text.
     * @param string|null $blocks Optional JSON encoded array containing blocks element
     * @return $this
     */
    public function setText($text, $markdown = true, $blocks=null)
    {
        $this->data['text'] = $text;
        $this->data['mrkdwn'] = $markdown;
        $this->data['blocks'] = $blocks;
        return $this;
    }

    /**
     * Sets the channel the message should be posted to.
     *
     * @param ChannelInterface $channel A channel to post to.
     * @return $this
     */
    public function setChannel(ChannelInterface $channel)
    {
        $this->data['channel'] = $channel->getId();
        return $this;
    }

    /**
     * Sets the user the message is sent from.
     *
     * @param User $user A user.
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->data['user'] = $user->getId();
        return $this;
    }

    /**
     * Adds an attachment to the message.
     *
     * @param Attachment $attachment The attachment to add.
     * @return $this
     */
    public function addAttachment(Attachment $attachment)
    {
        $this->data['attachments'][] = $attachment;
        return $this;
    }
}
