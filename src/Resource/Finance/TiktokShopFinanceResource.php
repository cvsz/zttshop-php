<?php

namespace Aftwork\TiktokShop\Resource\Finance;

use Aftwork\TiktokShop\Common\TiktokShopConfig;
use Aftwork\TiktokShop\Request\Finance\FinanceWithBody;
use Aftwork\TiktokShop\Request\Finance\FinanceWithOutBody;

class TiktokShopFinanceResource
{
    /**
     * Get Settlement List
     * @throws \Exception
     */
    public function getSettlements($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/settlements", $params, $apiConfig);
    }

    /**
     * Get Settlement Detail
     * @throws \Exception
     */
    public function getSettlement($baseUrl, $settlementId, TiktokShopConfig $apiConfig)
    {
        $params = ["settlement_id" => $settlementId];
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/settlements/detail", $params, $apiConfig);
    }

    /**
     * Get Income Statement
     * @throws \Exception
     */
    public function getIncomeStatement($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/income_statement", $params, $apiConfig);
    }

    /**
     * Get Transaction List
     * @throws \Exception
     */
    public function getTransactions($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/transactions", $params, $apiConfig);
    }

    /**
     * Get Payment Info
     * @throws \Exception
     */
    public function getPaymentInfo($baseUrl, $orderId, TiktokShopConfig $apiConfig)
    {
        $params = ["order_id" => $orderId];
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/payments", $params, $apiConfig);
    }

    /**
     * Get Commission Details
     * @throws \Exception
     */
    public function getCommissionDetails($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/commissions", $params, $apiConfig);
    }

    /**
     * Get Tax Information
     * @throws \Exception
     */
    public function getTaxInfo($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/tax", $params, $apiConfig);
    }

    /**
     * Download Financial Report
     * @throws \Exception
     */
    public function downloadFinancialReport($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return FinanceWithBody::makeMethod("POST", $baseUrl, "/api/finance/reports/download", [], $body, $apiConfig);
    }

    /**
     * Get Account Balance
     * @throws \Exception
     */
    public function getAccountBalance($baseUrl, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/balance", [], $apiConfig);
    }

    /**
     * Get Payout Status
     * @throws \Exception
     */
    public function getPayoutStatus($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/payouts", $params, $apiConfig);
    }

    /**
     * Request Payout
     * @throws \Exception
     */
    public function requestPayout($baseUrl, $body, TiktokShopConfig $apiConfig)
    {
        return FinanceWithBody::makeMethod("POST", $baseUrl, "/api/finance/payouts/request", [], $body, $apiConfig);
    }

    /**
     * Get VAT Information
     * @throws \Exception
     */
    public function getVATInfo($baseUrl, $params, TiktokShopConfig $apiConfig)
    {
        return FinanceWithOutBody::makeGetMethod("GET", $baseUrl, "/api/finance/vat", $params, $apiConfig);
    }
}
