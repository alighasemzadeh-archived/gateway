<?php


namespace Alighasemzadeh\Gateway\Providers\Bahamta;


class BahamtaException extends \Alighasemzadeh\Gateway\Exceptions\TransactionException
{

    /**
     * @inheritDoc
     */
    protected function getErrors()
    {
        return [
            'INVALID_API_CALL' => 'قالب فراخوانی سرویس رعایت نشده است.',
            'INVALID_API_KEY' =>  'API KEY وارد شده اشتباه است.',
            'LESS_THAN_WAGE_AMOUNT' =>  'مبلغ کمتر از کارمزد پرداختی است.',
            'TOO_LESS_AMOUNT' =>  'مبلغ کمتر از حد مجاز (هزار تومان) است.',
            'TOO_MUCH_AMOUNT' =>  'مبلغ بیشتر از حد مجاز (پنجاه میلیون تومان) است.',
            'INVALID_TRUSTED_PAN' =>  'لیست شماره کارتها نادرست است.',
            'INVALID_CALLBACK' =>  ' آدرس فراخوانی نادرست است.',
            'ALREADY_PAID' =>  'درخواست پرداختی با شناسه داده شده قبلاً ثبت و پرداخت شده است.',
            'NO_REG_TERMINAL' =>  'ترمینالی برای این فروشنده ثبت نشده است.',
            'NO_AVAILABLE_GATEWAY' =>  'درگاههای پرداختی که این فروشنده در آنها ترمینال ثبت شده دارد، قادر به ارائه خدمات نیستند.',
            'NOT_AUTHORIZED' => 'API KEY وارد شده اشتباه است.',
            'INVALID_AMOUNT' => 'مبلغ وارد شده اشتباه است.',
            'INVALID_REFERENCE' => 'شماره شناسه پرداخت ناردست است.',
            'INVALID_PARAM' => 'خطایی در مقادیر دریافتی رخ داده است.',
            'UNKNOWN_BILL' => 'پرداختی با شماره شناسه فرستاده شده ثبت نشده است.',
            'MISMATCHED_DATA' => 'اطلاعات مطابقت ندارد.',
            'NOT_CONFIRMED' => 'این پرداخت تأیید نشد.',
            'SERVICE_ERROR' => 'خطای داخلی سرویس رخ داده است.',
        ];
    }
}