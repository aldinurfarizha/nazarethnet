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

namespace Twilio\Rest\Preview\Understand\Assistant\FieldType;

use Twilio\Options;
use Twilio\Values;

abstract class FieldValueOptions
{
    /**
     * @param string $synonymOf A value that indicates this field value is a synonym of. Empty if the value is not a synonym.
     * @return CreateFieldValueOptions Options builder
     */
    public static function create(
        
        string $synonymOf = Values::NONE

    ): CreateFieldValueOptions
    {
        return new CreateFieldValueOptions(
            $synonymOf
        );
    }



    /**
     * @param string $language An ISO language-country string of the value. For example: *en-US*
     * @return ReadFieldValueOptions Options builder
     */
    public static function read(
        
        string $language = Values::NONE

    ): ReadFieldValueOptions
    {
        return new ReadFieldValueOptions(
            $language
        );
    }

}

class CreateFieldValueOptions extends Options
    {
    /**
     * @param string $synonymOf A value that indicates this field value is a synonym of. Empty if the value is not a synonym.
     */
    public function __construct(
        
        string $synonymOf = Values::NONE

    ) {
        $this->options['synonymOf'] = $synonymOf;
    }

    /**
     * A value that indicates this field value is a synonym of. Empty if the value is not a synonym.
     *
     * @param string $synonymOf A value that indicates this field value is a synonym of. Empty if the value is not a synonym.
     * @return $this Fluent Builder
     */
    public function setSynonymOf(string $synonymOf): self
    {
        $this->options['synonymOf'] = $synonymOf;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Preview.Understand.CreateFieldValueOptions ' . $options . ']';
    }
}



class ReadFieldValueOptions extends Options
    {
    /**
     * @param string $language An ISO language-country string of the value. For example: *en-US*
     */
    public function __construct(
        
        string $language = Values::NONE

    ) {
        $this->options['language'] = $language;
    }

    /**
     * An ISO language-country string of the value. For example: *en-US*
     *
     * @param string $language An ISO language-country string of the value. For example: *en-US*
     * @return $this Fluent Builder
     */
    public function setLanguage(string $language): self
    {
        $this->options['language'] = $language;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Preview.Understand.ReadFieldValueOptions ' . $options . ']';
    }
}

