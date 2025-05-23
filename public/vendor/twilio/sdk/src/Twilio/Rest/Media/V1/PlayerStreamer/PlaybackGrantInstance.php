<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Media
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Media\V1\PlayerStreamer;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $sid
 * @property string|null $url
 * @property string|null $accountSid
 * @property \DateTime|null $dateCreated
 * @property array|null $grant
 */
class PlaybackGrantInstance extends InstanceResource
{
    /**
     * Initialize the PlaybackGrantInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The unique string generated to identify the PlayerStreamer resource associated with this PlaybackGrant
     */
    public function __construct(Version $version, array $payload, string $sid)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'url' => Values::array_get($payload, 'url'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'grant' => Values::array_get($payload, 'grant'),
        ];

        $this->solution = ['sid' => $sid, ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return PlaybackGrantContext Context for this PlaybackGrantInstance
     */
    protected function proxy(): PlaybackGrantContext
    {
        if (!$this->context) {
            $this->context = new PlaybackGrantContext(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Create the PlaybackGrantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return PlaybackGrantInstance Created PlaybackGrantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): PlaybackGrantInstance
    {

        return $this->proxy()->create($options);
    }

    /**
     * Fetch the PlaybackGrantInstance
     *
     * @return PlaybackGrantInstance Fetched PlaybackGrantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): PlaybackGrantInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Media.V1.PlaybackGrantInstance ' . \implode(' ', $context) . ']';
    }
}

