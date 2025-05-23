<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Preview
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Preview\DeployedDevices\Fleet;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $sid
 * @property string|null $url
 * @property string|null $friendlyName
 * @property string|null $fleetSid
 * @property string|null $accountSid
 * @property string|null $syncServiceSid
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 */
class DeploymentInstance extends InstanceResource
{
    /**
     * Initialize the DeploymentInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $fleetSid 
     * @param string $sid Provides a 34 character string that uniquely identifies the requested Deployment resource.
     */
    public function __construct(Version $version, array $payload, string $fleetSid, string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'url' => Values::array_get($payload, 'url'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'fleetSid' => Values::array_get($payload, 'fleet_sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'syncServiceSid' => Values::array_get($payload, 'sync_service_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
        ];

        $this->solution = ['fleetSid' => $fleetSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return DeploymentContext Context for this DeploymentInstance
     */
    protected function proxy(): DeploymentContext
    {
        if (!$this->context) {
            $this->context = new DeploymentContext(
                $this->version,
                $this->solution['fleetSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Delete the DeploymentInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the DeploymentInstance
     *
     * @return DeploymentInstance Fetched DeploymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DeploymentInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the DeploymentInstance
     *
     * @param array|Options $options Optional Arguments
     * @return DeploymentInstance Updated DeploymentInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): DeploymentInstance
    {

        return $this->proxy()->update($options);
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
        return '[Twilio.Preview.DeployedDevices.DeploymentInstance ' . \implode(' ', $context) . ']';
    }
}

