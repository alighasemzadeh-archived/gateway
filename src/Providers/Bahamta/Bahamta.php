<?php


namespace Alighasemzadeh\Gateway\Providers\Bahamta;


use Exception;
use Illuminate\Http\Request;
use Alighasemzadeh\Gateway\Exceptions\InvalidRequestException;
use Alighasemzadeh\Gateway\Exceptions\TransactionException;
use Alighasemzadeh\Gateway\GatewayManager;
use Alighasemzadeh\Gateway\Transactions\AuthorizedTransaction;
use Alighasemzadeh\Gateway\Transactions\SettledTransaction;
use Alighasemzadeh\Gateway\Transactions\UnAuthorizedTransaction;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Bahamta extends \Alighasemzadeh\Gateway\AbstractProvider
{

    /**
     * Address REQUEST SERVER
     *
     * @var string
     */
    const REQUEST_SERVER_URL = 'https://webpay.bahamta.com/api/create_request';

    /**
     * Address CONFIRM SERVER
     *
     * @var string
     */
    const CONFIRM_SERVER_URL = 'https://webpay.bahamta.com/api/confirm_payment';

    /**
     * @inheritDoc
     */
    protected function getProviderName()
    {
        return GatewayManager::BAHAMTA;
    }

    /**
     * @inheritDoc
     */
    protected function authorizeTransaction(UnAuthorizedTransaction $transaction)
    {
        $fields = [
            'api_key'             => $this->config['api'],
            'reference'           => $transaction->getId(),
            'amount_irr'          => $transaction->getAmount()->getRiyal(),
            'callback_url'        => $this->getCallback($transaction, true),
            'payer_mobile'          => $transaction->getExtraField('mobile'),
            'trusted_pan' => $transaction->getExtraField('trusted_pan'),
        ];


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL =>  Self::REQUEST_SERVER_URL . "?". http_build_query($fields),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $data = json_decode($response, true);

        if ($data["ok"]) {
            return AuthorizedTransaction::make($transaction, $data["result"]["payment_url"]);
        }

        throw new BahamtaException($data["error"]);
    }

    /**
     * @inheritDoc
     */
    protected function redirectToGateway(AuthorizedTransaction $transaction)
    {
        return new RedirectResponse($transaction->getReferenceId());
    }

    /**
     * @inheritDoc
     */
    protected function validateSettlementRequest(Request $request)
    {
        // TODO: Implement validateSettlementRequest() method.
    }

    /**
     * @inheritDoc
     */
    protected function settleTransaction(Request $request, AuthorizedTransaction $transaction)
    {
        // TODO: Implement settleTransaction() method.
    }
}