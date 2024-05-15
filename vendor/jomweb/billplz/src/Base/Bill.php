<?php

namespace Billplz\Base;

use Billplz\Request;
use InvalidArgumentException;
use Laravie\Codex\Contracts\Response;
use Billplz\Contracts\Bill as Contract;
use Laravie\Codex\Concerns\Request\Multipart;

abstract class Bill extends Request implements Contract
{
    use Multipart,
        PaymentCompletion;

    /**
     * Create a new bill.
     *
     * @param  string  $collectionId
     * @param  string|null  $email
     * @param  string|null  $mobile
     * @param  string  $name
     * @param  \Money\Money|\Duit\MYR|int  $amount
     * @param  array|string  $callbackUrl
     * @param  string  $description
     * @param  array  $optional
     *
     * @throws \InvalidArgumentException
     *
     * @return \Billplz\Response
     */
    public function create(
        string $collectionId,
        ?string $email,
        ?string $mobile,
        string $name,
        $amount,
        $callbackUrl,
        string $description,
        array $optional = []
    ): Response {
        if (empty($email) && empty($mobile)) {
            throw new InvalidArgumentException('Either $email or $mobile should be present');
        }

        $body = \array_merge(
            \compact('email', 'mobile', 'name', 'amount', 'description'), $optional
        );

        $body['collection_id'] = $collectionId;

        $body = $this->parseRedirectAndCallbackUrlFromRequest($body, $callbackUrl);

        list($headers, $stream) = $this->prepareMultipartRequestPayloads([], $body);

        return $this->stream('POST', 'bills', $headers, $stream);
    }

    /**
     * Show an existing bill.
     *
     * @param  string  $id
     *
     * @return \Billplz\Response
     */
    public function get(string $id): Response
    {
        return $this->send('GET', "bills/{$id}");
    }

    /**
     * Show an existing bill transactions.
     *
     * @param  string  $id
     * @param  array   $optional
     *
     * @return \Billplz\Response
     */
    public function transaction(string $id, array $optional = []): Response
    {
        return $this->client->uses('Bill.Transaction', $this->getVersion())
                    ->show($id, $optional);
    }

    /**
     * Destroy an existing bill.
     *
     * @param  string  $id
     *
     * @return \Billplz\Response
     */
    public function destroy(string $id): Response
    {
        return $this->send('DELETE', "bills/{$id}");
    }
}
