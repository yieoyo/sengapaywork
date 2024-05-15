<?php

namespace Billplz;

use Laravie\Codex\Discovery;
use Laravie\Codex\Client as BaseClient;
use Http\Client\Common\HttpMethodsClient as HttpClient;

class Client extends BaseClient
{
    /**
     * Billplz API Key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Billplz X-Signature Key.
     *
     * @var string|null
     */
    protected $signatureKey;

    /**
     * Billplz API endpoint.
     *
     * @var string
     */
    protected $apiEndpoint = 'https://www.billplz.com/api';

    /**
     * Default API version.
     *
     * @var string
     */
    protected $defaultVersion = 'v4';

    /**
     * List of supported API versions.
     *
     * @var array
     */
    protected $supportedVersions = [
        'v3' => 'Three',
        'v4' => 'Four',
    ];

    /**
     * Construct a new Billplz Client.
     *
     * @param \Http\Client\Common\HttpMethodsClient  $http
     * @param string  $apiKey
     * @param string|null $signatureKey
     */
    public function __construct(HttpClient $http, string $apiKey, ?string $signatureKey = null)
    {
        $this->http = $http;

        $this->setApiKey($apiKey);
        $this->setSignatureKey($signatureKey);
    }

    /**
     * Make a client.
     *
     * @param string  $apiKey
     * @param string|null $signatureKey
     *
     * @return $this
     */
    public static function make(string $apiKey, ?string $signatureKey = null)
    {
        return new static(Discovery::client(), $apiKey, $signatureKey);
    }

    /**
     * Use sandbox environment.
     *
     * @return $this
     */
    final public function useSandbox(): self
    {
        return $this->useCustomApiEndpoint('https://billplz-staging.herokuapp.com/api');
    }

    /**
     * Get API Key.
     *
     * @return string
     */
    final public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Set API Key.
     *
     * @param  string  $apiKey
     *
     * @return $this
     */
    final public function setApiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get X-Signature Key.
     *
     * @return string|null
     */
    final public function getSignatureKey(): ?string
    {
        return $this->signatureKey;
    }

    /**
     * Set X-Signature Key.
     *
     * @param  string|null  $signatureKey
     *
     * @return $this
     */
    final public function setSignatureKey(?string $signatureKey = null): self
    {
        $this->signatureKey = $signatureKey;

        return $this;
    }

    /**
     * Get Collection resource.
     *
     * @param  string|null  $version
     *
     * @return \BIllplz\Contracts\Collection
     */
    final public function collection(?string $version = null): Contracts\Collection
    {
        return $this->uses('Collection', $version);
    }

    /**
     * Get Open Collection resource.
     *
     * @param  string|null  $version
     *
     * @return \BIllplz\Contracts\OpenCollection
     */
    final public function openCollection(?string $version = null): Contracts\OpenCollection
    {
        return $this->uses('OpenCollection', $version);
    }

    /**
     * Get bill resource.
     *
     * @param  string|null  $version
     *
     * @return \Billplz\Contracts\Bill
     */
    final public function bill(?string $version = null): Contracts\Bill
    {
        return $this->uses('Bill', $version);
    }

    /**
     * Get transaction resource.
     *
     * @param  string|null  $version
     *
     * @return \Billplz\Contracts\Bill\Transaction
     */
    final public function transaction(?string $version = null): Contracts\Bill\Transaction
    {
        return $this->uses('Bill.Transaction', $version);
    }

    /**
     * Get mass payment instruction collection resource.
     *
     * @return \BIllplz\Contracts\Collection\MassPayment
     */
    final public function massPaymentCollection(): Contracts\Collection\MassPayment
    {
        return $this->uses('Collection.MassPayment', 'v4');
    }

    /**
     * Get mass payment instruction resource.
     *
     * @return \Billplz\Contracts\MassPayment
     */
    final public function massPayment(): Contracts\MassPayment
    {
        return $this->uses('MassPayment', 'v4');
    }

    /**
     * Get bank resource.
     *
     * @param  string|null  $version
     *
     * @return \Billplz\Contracts\BankAccount
     */
    final public function bank(?string $version = null): Contracts\BankAccount
    {
        return $this->uses('BankAccount', $version);
    }

    /**
     * Get resource default namespace.
     *
     * @return string
     */
    final protected function getResourceNamespace(): string
    {
        return __NAMESPACE__;
    }
}
