<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Autopilot
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\Exceptions\TwilioException;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\InstanceContext;
use Twilio\Serialize;


class DefaultsContext extends InstanceContext
    {
    /**
     * Initialize the DefaultsContext
     *
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the [Assistant](https://www.twilio.com/docs/autopilot/api/assistant) that is the parent of the resource to fetch.
     */
    public function __construct(
        Version $version,
        $assistantSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'assistantSid' =>
            $assistantSid,
        ];

        $this->uri = '/Assistants/' . \rawurlencode($assistantSid)
        .'/Defaults';
    }

    /**
     * Fetch the DefaultsInstance
     *
     * @return DefaultsInstance Fetched DefaultsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DefaultsInstance
    {

        $payload = $this->version->fetch('GET', $this->uri);

        return new DefaultsInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid']
        );
    }


    /**
     * Update the DefaultsInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DefaultsInstance Updated DefaultsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): DefaultsInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'Defaults' =>
                Serialize::jsonObject($options['defaults']),
        ]);

        $payload = $this->version->update('POST', $this->uri, [], $data);

        return new DefaultsInstance(
            $this->version,
            $payload,
            $this->solution['assistantSid']
        );
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
        return '[Twilio.Autopilot.V1.DefaultsContext ' . \implode(' ', $context) . ']';
    }
}
