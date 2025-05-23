<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Messaging\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Values;
use Twilio\Version;


class ExternalCampaignList extends ListResource
    {
    /**
     * Construct the ExternalCampaignList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(
        Version $version
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        ];

        $this->uri = '/Services/PreregisteredUsa2p';
    }

    /**
     * Create the ExternalCampaignInstance
     *
     * @param string $campaignId ID of the preregistered campaign.
     * @param string $messagingServiceSid The SID of the [Messaging Service](https://www.twilio.com/docs/messaging/api/service-resource) that the resource is associated with.
     * @return ExternalCampaignInstance Created ExternalCampaignInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $campaignId, string $messagingServiceSid): ExternalCampaignInstance
    {

        $data = Values::of([
            'CampaignId' =>
                $campaignId,
            'MessagingServiceSid' =>
                $messagingServiceSid,
        ]);

        $payload = $this->version->create('POST', $this->uri, [], $data);

        return new ExternalCampaignInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Messaging.V1.ExternalCampaignList]';
    }
}
