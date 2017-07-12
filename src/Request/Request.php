<?php
/**
 * Author: Hassletauf <hassletauf@gmail.com>
 * Date: 10/1/2016
 * Time: 10:16 PM
 */

namespace Konnektive\Request;

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\ValidationException;
use Konnektive\Config;
use Konnektive\Model;

abstract class Request extends Model
{
    protected $baseUrl = "https://api.konnektive.com";
    protected $endpointUri;
    protected $verb = "POST";
    /**
     * Examples for all rules and messages can be found here https://laravel.com/docs/5.3/validation. Other features of the Laravel
     * framework will not be available in this application.
     * @var array
     */
    protected $rules = [];
    protected $messages = [];

    protected $zonesList;

    public function getVerb()
    {
        return $this->verb;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getEndpoint()
    {
        return $this->endpointUri;
    }

    public function getUrl()
    {
        return $this->getBaseUrl() . $this->getEndpoint();
    }

    public function getQuery()
    {
        return http_build_query($this->attributes);
    }

    /**
     * Uses the rules definition to validate the data prior to sending to Konnektive.
     * @return void
     * @throws ValidationException
     */
    public function validate()
    {
        $loader = new FileLoader(new Filesystem, 'lang');
        $translator = new Translator($loader, 'en');
        $validation = new Factory($translator, new Container);

        $rules = $this->rules();

        $this->_applyCustomValidationRules($validation);

        $validation->validate($this->attributes, $rules, $this->messages);
    }

    /**
     * Get rules array. Can be overridden by children to customize dynamic fields.
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * Takes a set of messages in a format expected by illuminate/validation.
     * @param array $messages
     */
    public function setMessages(array $messages)
    {
        $this->messages = isset($messages) ? $messages : [];
    }

    public function getZonesList($country = null)
    {
        return Config::get('zones' . ($country ? '.' . $country . '.valid_states' : ''));
    }

    /**
     * @param Factory $validator
     */
    private function _applyCustomValidationRules(Factory &$validator)
    {
        $validator->extend('creditcard', function ($attribute, $value, $formats) {
            //Simple MOD10 for now.
            $card_number_checksum = '';
            foreach (str_split(strrev((string)$value)) as $i => $d) {
                $card_number_checksum .= $i % 2 !== 0 ? $d * 2 : $d;
            }

            return array_sum(str_split($card_number_checksum)) % 10 === 0;
        });

        $validator->extend('date_multi_format', function ($attribute, $value, $formats) {
            // iterate through all formats
            foreach ($formats as $format) {
                // parse date with current format
                $parsed = date_parse_from_format($format, $value);
                // if value matches given format return true=validation succeeded
                if ($parsed['error_count'] === 0 && $parsed['warning_count'] === 0) {
                    return true;
                }
            }

            // value did not match any of the provided formats, so return false=validation failed
            return false;
        });

        $validator->extend('valid_state_for_country', function ($attribute, $value, $parameters) {
            /**
             * @use valid_state_for_country:<country attribute>
             */
            if (isset($parameters[0]) && $country = strtoupper($this->getAttribute($parameters[0]))) {
                $zones = $this->getZonesList();
                return isset($zones[$country]) && isset($zones[$country]['valid_states'][$value]);
            }
            return false;
        });
    }
}