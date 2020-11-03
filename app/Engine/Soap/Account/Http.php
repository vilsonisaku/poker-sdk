<?php

namespace ExHelp\Engine\Soap\Account;

use ExHelp\Engine\Soap\MainHttp;

/**
 *
 * @author Http
 */
class Http extends MainHttp
{

    /**
     * http login request
     */
    public function login($data)
    {

        $user             = new \stdClass();
        $user->attributes = [
            "username"         => $data->username,
            "password"         => $data->password,
            "encodingPassword" => "PLAIN_TEXT",
        ];

        $xmlRequest = $this->requestXml->fill([
            'command' => 'login',
        ], [
            'xsi'       => ['xsi:type' => 'loginRequest'],
            'device'    => '0',
            'userAgent' => $data->userAgent,
            'ip'        => $data->ip,
            'user'      => $user,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     * http register request
     */
    public function register($data)
    {

        $inputArray = [
            "validationLevel" => $data->validation_level, // string
            // "type"=>$data->type, // value: register, prenote, REGISTER_OR_PRENOTE
            "auth"            => [
                '_attributes' => [
                    'username'         => $data->username, // string
                    'password'         => $data->password, // string
                    'encodingPassword' => 'PLAIN_TEXT',
                ],
            ],
            "nickname"        => $data->nickname, // string
            "email"           => $data->email, // string
            "firstname"       => $data->first_name, // string
            "lastname"        => $data->last_name, // string
            "taxcode"         => $data->taxcode, // string
            "sex"             => $data->sex, // string M or F
            "birth"           => [
                "_attributes" => [
                    'date'     => $data->birthday, // date
                    'country'  => $data->country_of_birth, // string
                    'province' => $data->province_of_birth, // string
                    'city'     => $data->city_of_birth, // string
                ],
            ],
            "residence"       => [
                "_attributes" => [
                    'country'  => $data->residence_country, // string
                    'province' => $data->residence_province, // string
                    'city'     => $data->residence_city, // string
                    'address'  => $data->address, // string
                    'postcode' => $data->postcode, // string
                ],
            ],
            "identity"        => [
                "_attributes" => [
                    'id'        => $data->identity_id, // string
                    'type'      => $data->identity_type, // string
                    'issueBy'   => $data->identity_issue_by, // string
                    'issueDate' => $data->identity_issue_date, // date
                    'expiry'    => $data->identity_expiry, // date
                    'city'      => $data->identity_city, // string
                ],
            ],
            "mobile"          => [
                "_attributes" => [
                    "prefix" => $data->number_prefix, // string
                    "number" => $data->number, // string
                ],
            ],
            "securityQA"      => [
                "_attributes" => [
                    "question" => $data->question, // string
                    "answer"   => $data->answer, // string
                ],
            ],
            "selfLimit"       => [
                "_attributes" => [
                    "period" => $data->self_limit_period, // int
                ],
                '_value'      => $data->self_limit_period_sum,
            ],
            "tracking"        => $data->tracking, // string
            "promo"           => $data->promo, // string
            "parent"          => $data->parent, // int
            "ip"              => $data->ip(), // string
            "allowance"       => [
                "_attributes" => [
                    "newsletter" => $data->newsletter, // boolean
                    "terms"      => $data->terms, // boolean
                    "contract"   => $data->contract, // boolean
                    "privacy"    => $data->privacy, // boolean
                ],
            ],
        ];

        $xmlRequest = $this->arrayToXml->convert(['command' => 'register'], $inputArray);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     * http register request
     */
    public function registerFast($data)
    {

        $array = [
            "auth"      => [
                '_attributes' => [
                    'username'         => $data->username,
                    'password'         => $data->password,
                    'encodingPassword' => 'PLAIN_TEXT',
                ],
            ],
            "nickname"  => $data->username,
            "email"     => $data->email,
            "firstname" => $data->first_name,
            "lastname"  => $data->last_name,
            "sex"       => $data->sex,
            "parent"    => $data->parent,
            "ip"        => $data->ip(),
        ];

        $xmlRequest = $this->arrayToXml->convert(['command' => 'registerFast'], $array);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     * http logout request
     */
    public function logout($ssoToken)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'logout',
        ], [
            'xsi'      => ['xsi:type' => 'logoutRequest'],
            'ssoToken' => $ssoToken,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     * http profile request
     */
    public function getProfile($token)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'authInfo',
        ], [
            'xsi'      => ['xsi:type' => 'authInfoRequest'],
            'ssoToken' => $token,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, false);

        $account = isset($data->account)
            ? json_decode(json_encode($data->account[0]->attributes()))->{'@attributes'}
            : $data;

        $customer = isset($data->customer)
            ? json_decode(json_encode($data->customer[0]->attributes()))->{'@attributes'}
            : new \stdClass;

        $type = isset($data->type) ? json_decode(json_encode($data->type))->{0} : null;

        return [
            "account"  => $account,
            "customer" => $customer,
            "type"     => $type,
        ];
    }

    /*
     *   Check users relation ids
     */
    public function getNetworkRelations($idMaster = 0, $idSlave = 0, $onlyDirect = 0)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getNetworkRelations',
        ], [
            'xsi'        => ['xsi:type' => 'getNetworkRelationsRequest'],
            'idMaster'   => $idMaster,
            'idSlave'    => $idSlave,
            'onlyDirect' => $onlyDirect,
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, true);

        if( isset($data['relation']) ){
            return isset($data['relation']['idMaster']) ? [$data['relation']] : $data['relation'];
        }
        return $data;
    }

    public function getNicknames()
    {
        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'getNicknames',
            ],
            [
                'ssoToken' => session('token'),
            ]
        );

        $xmlstr = $this->post($xmlRequest);

        $simpleXml = simplexml_load_string($xmlstr);

        if(!$simpleXml->output) return [];

        return $this->parse($simpleXml->output)['output'];
        // return $this->parseXml($xmlstr);
    }

    public function registerNickname($nickname,$idNetwork=null)
    {
        $idNetwork = $idNetwork?:config('skins.idNetwork');

        $body = [ 
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'registerNicknameByTokenRequest',
            ],
            'ssoToken' => session('token'),
            'idNetwork' => $idNetwork,
            'nickname' => $nickname,
        ];

        if($idNetwork==53) $body['transferValue'] = 0;

        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'registerNickname',
            ],
            $body
        );

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }


    public function transferNetentMoney($transferValue)
    {
        $body = [ 
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'registerNicknameByTokenRequest',
            ],
            'ssoToken' => session('token'),
            'idNetwork' => 53,
            'nickname' => "",
            'transferValue' => $transferValue,
        ];

        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'registerNickname',
            ],
            $body
        );

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     * http get skin config request
     */
    public function getSkinConfig($key, $nullable = null)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getSkinConfig',
        ], [
            'xsi'      => ['xsi:type' => 'getConfigSkinRequest'],
            'key'      => $key,
            'nullable' => $nullable,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  Search Withdrowal Request
     *'from'=>'2019-05-17T00:00:00.000+02:00',
     *'to'=>'2019-05-24T00:00:00.000+02:00',
     *'limit'=>60,
     */
    public function searchWithdrowal($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'searchWithdrawal',
        ], [
            'xsi'      => ['xsi:type' => 'searchWithdrawalRequest'],
            'ssoToken' => $data->token,
            'from'     => $data->from,
            'to'       => $data->to,
            'limit'    => $data->limit,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function transferMoney($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'transferMoney',
        ], [
            'xsi'          => ['xsi:type' => 'transferMoneyRequest'],
            'identita_src' => $data['agencyId'], // agency id
            'identita_dst' => $data['playerId'], // player id
            'value'        => $data['value'], // amount
            'type'         => $data['type'], //
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr, false, true);
    }

    /**
     *  Get Self Limit Request
     *'ssoToken'=>'token example',
     *'type'=>1,
     *'period'=>30,
     */
    public function getSelfLimit($token, $type, $period)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getSelfLimit',
        ], [
            'xsi'      => ['xsi:type' => 'getSelfLimitRequest'],
            'ssoToken' => $token,
            'type'     => $type, // 1
            'period'   => $period, // 30
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  Update Self Limit Request
     *'ssoToken'=>'token example',
     *'type'=>boolean,
     *'period'=>short,
     *'value'=>integer,
     */
    public function updateSelfLimit($type, $period, $value)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'updateSelfLimit',
        ], [
            'xsi'      => ['xsi:type' => 'updateSelfLimitRequest'],
            'ssoToken' => session('token'),
            'type'     => $type, // 1
            'period'   => $period, // 30
            'value'   => $value, // integer
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  Get Category Faq Request
     */
    public function getCategoryFaq()
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getCategoryFaq',
        ], [
            'xsi' => ['xsi:type' => 'downloadFaqsCategoryRequest'],
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  Get my document Request
     *'ssoToken'=>'token example'
     */
    public function getMyDocument($token)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getMyDocument',
        ], [
            'xsi'      => ['xsi:type' => 'getDocumentRequest'],
            'ssoToken' => $token,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  Is Self Excluded Request
     *'ssoToken'=>'token example'
     */
    public function isSelfExcluded($token)
    {

        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'isSelfExcluded',
            ],
            [
                'account' => [
                    '_attributes' => ['type' => 'SSOTOKEN'],
                    '_value'      => $token,
                ],
            ]
        );

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getAllowance()
    {

        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'getAllowance',
            ],
            [
                'ssoToken' => session('token'),
            ]
        );

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function changeAllowance($newsletter, $privacy)
    {

        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'changeAllowance',
            ],
            [
                'ssoToken' => session('token'),
                // 'allowance'=>[
                // '_attributes'=>[
                'newsletter' => $newsletter,
                'privacy' => $privacy,
                // ]
                // ]
            ]
        );

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *   Update Self Excluded Request
     */
    public function updateSelfExclusion($token, $days, $idGame = null)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'updateSelfExcluded',
        ], [
            'xsi'      => ['xsi:type' => 'updateSelfExclusionRequest'],
            'ssoToken' => $token,
            'idGame'   => $idGame,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *  Search Deposit Request
     *'from'=>'2019-05-17T00:00:00.000+02:00',
     *'to'=>'2019-05-24T00:00:00.000+02:00',
     *'limit'=>60,
     */
    public function searchDeposit($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'searchDeposit',
        ], [
            'xsi'      => ['xsi:type' => 'searchDepositRequest'],
            'ssoToken' => $data->token,
            'from'     => $data->from,
            'to'       => $data->to,
            'limit'    => $data->limit,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr, true);
    }

    /**
     *   Cash Transaction history Request
     * 'from'=>'2019-05-17T00:00:00.000+02:00',
     *'to'=>'2019-05-24T00:00:00.000+02:00',
     *'limit'=>60,
     */
    public function cashTransactionHistory($data)
    {

        // $xmlRequest = $this->requestXml->fill([
        //     'command' => 'cashTransactionHistory',
        // ], [
        //     'xsi'      => ['xsi:type' => 'cashTransactionHistoryRequest'],
        //     'ssoToken' => $data->token,
        //     'from'     => $data->from,
        //     'to'       => $data->to,
        //     'filter'   => $data->filter,
        // ]);

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'cashTransactionHistory',
        ], [
            'ssoToken' => $data->token,
            'from'     => $data->from,
            'to'       => $data->to,
            // 'filter'   => [
                // '_attributes'=> [
                    'idReason'=> $data->filter,
                // ]
            // ]
        ]);

        // 

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function cashTransactionHistoryAgency($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'cashTransactionHistoryPVR',
        ], [
            'xsi'    => ['xsi:type' => 'cashTransactionHistoryPVRRequest'],
            // 'ssoToken'=>$data->token,
            'idPVR'  => $data->idAccount,
            'from'   => $data->from,
            'to'     => $data->to,
            'filter' => $data->filter,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getResellerInfo($idLevel)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getResellerInfo',
        ], [
            'xsi' => ['xsi:type' => 'getResellerInfoRequest'],
            'id'  => $idLevel,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *   last access Request
     */
    public function lastAccess($token)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'lastAccess',
        ], [
            'xsi'      => ['xsi:type' => 'lastAccessRequest'],
            'ssoToken' => $token,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *   coupons history Request
     *   from: 2019-05-17+02:00
     */
    public function couponsHistory($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'couponsHistory',
        ], [
            'xsi'       => ['xsi:type' => 'couponsHistoryRequest'],
            'ssoToken'  => $data->token,
            'idGame'    => $data->idGame,
            'from'      => $data->from,
            'to'        => $data->to,
            'status'    => $data->status,
            'idExt'     => $data->idExt,
            'betType'   => $data->betType,
            'credit'    => $data->credit,
            'debit'     => $data->debit,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *   coupons history Request
     *   from: 2019-05-17+02:00
     */
    public function couponsHistoryAgency($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'couponsHistoryPvr',
        ], [
            'xsi'       => ['xsi:type' => 'couponsHistoryPVRRequest'],
            'ssoToken'  => $data->token,
            'idGame'    => $data->idGame,
            'from'      => $data->from,
            'to'        => $data->to,
            'status'    => $data->status,
            'idExt'     => $data->idExt,
            'betType'   => $data->betType,
            'credit'    => $data->credit,
            'debit'     => $data->debit,
            'idAccount' => $data->idAccount,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *   get wallet Request
     *   from: 2019-05-17+02:00
     */
    public function getWallet($data)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getWallet',
        ], [
            'xsi'      => ['xsi:type' => 'getWalletRequest'],
            'ssoToken' => $data->token,
            // 'idGame'=>$data->idGame
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /**
     *   get bonuses Request
     *   from: 2019-05-17+02:00
     */
    public function getBonuses($token)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getBonuses',
        ], [
            'xsi'      => ['xsi:type' => 'getBonusesRequest'],
            'ssoToken' => $token,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }


    public function buyAnduseRicaricard($idSeller, $idAccount)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'buyAnduseRicaricard',
        ], [
            'xsi'       => ['xsi:type' => 'buyAndUseRicaricardRequest'],
            'idSeller'  => $idSeller,
            'idAccount' => $idAccount,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getCmsVar()
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getCmsVar',
        ], [
            'xsi' => ['xsi:type' => 'getCmsVarRequest'],

        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function downloadCashReason()
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'downloadCashReason',
        ], [
            'xsi' => ['xsi:type' => 'downloadCashReasonRequest'],

        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function lostPassword($email, $birthday)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'lostPassword',
        ], [
            'xsi'      => ['xsi:type' => 'lostPasswordRequest'],
            'email'    => $email,
            'birthDay' => $birthday,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function lostPasswordAnswer($idAccount, $answer)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'lostPasswordAnswer',
        ], [
            'xsi'       => ['xsi:type' => 'lostPasswordAnswerRequest'],
            'idAccount' => $idAccount,
            'answer'    => $answer,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }


    public function reportSoggettiRete($entity, $entityType, $name)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'reportSoggettiRete',
        ], [
            'entity' => $entity,
            'entityType'     => $entityType,
            'name'     => $name,
        ]);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function reportProvvigioni($entity, $entityType, $dateType, $from, $to, $name = null, $gameId = null)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'reportProvvigioni',
        ], [
            'entity' => $entity,
            'entityType'     => $entityType,
            'name'     => $name,
            'dateType'     => $dateType,
            'from'     => $from,
            'to'     => $to,
            'gameId'     => $gameId,
        ]);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function searchWithdrawal($params)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'searchWithdrawal',
        ], [
            'xsi'      => ['xsi:type' => 'searchWithdrawalRequest'],
            'ssoToken' => $params->token,
            'from'     => $params->from,
            'to'       => $params->to,
            'limit'    => $params->limit,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }


    public function searchWithdrawalAccount($idEntityStaff, $idAccount, $params)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'searchWithdrawalAccount',
        ], [
            'xsi'      => ['xsi:type' => 'searchWithdrawalAccountRequest'],
            'idPVR'     => $idEntityStaff,
            'idAccount' => $idAccount,
            'from'     => $params->from,
            'to'       => $params->to,
            'limit'    => $params->limit,
            'status'    => $params->status,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function closeWithdrawal($idWithDrawal)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'closeWithdrawal',
        ], [
            'idWithDrawal' => $idWithDrawal,
            'idPVR'     => session('idEntityStaff'),
        ]);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getWithdrawalConfig($token, $type)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getWithdrawalConfig',
        ], [
            'xsi'      => ['xsi:type' => 'getWithdrawalConfigRequest'],
            'ssoToken' => $token,
            'type'     => $type,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getDepositConfig($token, $type = 1)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getDepositConfig',
        ], [
            'xsi'      => ['xsi:type' => 'getDepositConfigRequest'],
            'ssoToken' => $token,
            'type'     => $type,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function withdrawal($ssoToken, $amount, $type, $extra)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'withdrawal',
        ], [
            'xsi'      => ['xsi:type' => 'withdrawalRequest'],
            'ssoToken' => $ssoToken,
            'amount'   => $amount,
            'type'     => $type,
            'extra'    => $extra,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function depot($amount, $type, $promocode, $params)
    {

        $extra = [];
        foreach ($params as $key => $value) {
            $extra[] = ['_attributes' => ['key' => $key, 'value' => $value]];
        }

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'depot',
        ], [
            'ssoToken' => session('token'), // string
            'amount' => $amount, // int
            'type' => $type, // byte
            'extra' => $extra,
            'promocode' => $promocode,
        ]);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr, true);
    }

    public function reportAggi($params)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'reportAggi',
        ], [
            'idEntiy' => session('idEntityStaff'), // int
            'period' => $params->period, // byte
            'from' => $params->from,
            'to' => $params->to,
            'status' => $params->status,
            'idPlane' => $params->idPlane,
        ]);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr, true);
    }

    public function recalcAggio($idAggio)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'recalcAggio',
        ], [
            'idEntiy' => session('idEntityStaff'), // int
            'idAggio' => $idAggio, // byte
        ]);

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr, true);
    }


    public function modifyPersonalData($ssoToken, $customer)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'modifyPersonalData',
        ], [
            'xsi'      => ['xsi:type' => 'modifyPersonalDataRequest'],
            'ssoToken' => $ssoToken,
            'customer' => $customer,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function editPersonalInfo($ssoToken, $data)
    {

        $xmlRequest = $this->arrayToXml->convert(
            [
                'command' => 'editPersonalInfo',
            ],
            [
                'ssoToken' => $ssoToken,
                'customer' => [
                    '_attributes' => [
                        'email'             => $data->email,
                        'provinceResidence' => $data->provinceResidence,
                        'nationResidence'   => $data->nationResidence,
                        'city'              => $data->city,
                        'address'           => $data->address,
                        'number'            => $data->number,
                        'postcode'          => $data->postcode,
                        'mobile'            => $data->mobile,
                    ],
                ],
            ]
        );

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr, true, true);
    }

    public function changePassword($token, $oldPassword, $newPassword)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'changePassword',
        ], [
            'xsi'         => ['xsi:type' => 'changePasswordRequest'],
            'ssoToken'    => $token,
            'oldPassword' => $oldPassword,
            'newPassword' => $newPassword,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }


    public function forceChangePassword($idAccount, $newPassword)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'forceChangePassword',
        ], [
            'xsi'         => ['xsi:type' => 'forcedChangePasswordRequest'],
            'idAccount'    => $idAccount,
            'newPassword' => $newPassword,
        ]);

        

        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function sendMyDocument($ssoToken, $data)
    {

        $xmlRequest = $this->arrayToXml->convert(['command' => 'sendMyDocs'], [
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'sendDocumentRequest',
            ],
            'ssoToken'    => $ssoToken,
            'document'    => [
                'id'            => $data->type,
                'file'          => $data->file, // base64
                'dateCreazione' => $data->dateCreazione, // dateTime
                'desc'          => $data->desc, // string
                'docType'       => $data->docType, // int: pdf, png, gif, jpg, doc, tiff
                'docContent'    => $data->docContent, // int
                'docView'       => $data->docView, // int
                'status'        => $data->status, // int
                'docAuthorType' => $data->docAuthorType, // int
            ],
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr);

        if (isset($data['documents'])) {
            $data = $data['documents'];
            $data = (isset($data['file'])) ? [$data] : $data;
        }
        return $data;
    }

    public function sendDocumentToPlayer($idAccount, $data)
    {

        $xmlRequest = $this->arrayToXml->convert(['command' => 'sendMyAccountDocs'], [
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'sendDocumentAccountRequest',
            ],
            'idAccount'    => $idAccount,
            'document'    => [
                'id'            => $data->type,
                'file'          => $data->file, // base64
                'dateCreazione' => $data->dateCreazione, // dateTime
                'desc'          => $data->desc, // string
                'docType'       => $data->docType, // int: pdf, png, gif, jpg, doc, tiff
                'docContent'    => $data->docContent, // int
                'docView'       => $data->docView, // int
                'status'        => $data->status, // int
                'docAuthorType' => $data->docAuthorType, // int
            ],
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr);

        if (isset($data['documents'])) {
            $data = $data['documents'];
            $data = (isset($data['file'])) ? [$data] : $data;
        }
        return $data;
    }

    public function getNetworkTree($endId)
    {
        $xmlRequest = $this->arrayToXml->convert(['command' => 'getNetworkTree'], [
            'idEntita' => $endId,
        ]);
        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getPlayedReport($endId, $idGame, $from = null, $to = null)
    {
        // agency
        $xmlRequest = $this->arrayToXml->convert(['command' => 'getPlayedReport'], [
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'getPlayedPVRRequest',
            ],
            'idPVR'       => $endId, // required
            'idGame'      => $idGame, // required , 10 for prematch and 12 for live
            'from'        => $from,
            'to'          => $to,
        ]);
        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getCommissionsReport($endId, $idGame, $dateType, $from = null, $to = null)
    {
        // agency
        $xmlRequest = $this->arrayToXml->convert(['command' => 'getCommisionsReport'], [
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'getCommissionsPVRRequest',
            ],
            'idPVR'       => $endId, // required
            'idGame'      => $idGame, // required , 10 for prematch and 12 for live
            'from'        => $from,
            'to'          => $to,
            'dateType'    => $dateType, // 0 , 1, 2
        ]);
        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function downloadLanguage($locale)
    {
        $xmlRequest = $this->arrayToXml->convert(['command' => 'downloadLanguage'], [
            'locale' => $locale, // required
        ]);
        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    public function getBonusAdv($endId, $idGame)
    {
        // agency
        $xmlRequest = $this->arrayToXml->convert(['command' => 'getBonusAdv'], [
            '_attributes' => [
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xsi:type'  => 'getBonusAmountAdvRequest',
            ],
            'idPVR'       => $endId, // required
            'idGame'      => $idGame, // required , 10 for prematch and 12 for live
            // 'from'=>$from,
            // 'to'=>$to,
        ]);
        $xmlstr = $this->post($xmlRequest);

        return $this->parseXml($xmlstr);
    }

    /*
     *   get ticket status request
     */
    public function getCoupon($idTicket,$idGame,$idExt=false)
    {
        $data = [
            'xsi'    => ['xsi:type' => 'getCouponRequest'],
        ];

        if($idExt) {
            $data['idExt'] = $idTicket;
            $data['idGame'] = $idGame;
        } else {
            $data['id'] = $idTicket;
        }

        $xmlRequest = $this->requestXml->fill([
            'command' => 'getCoupon',
        ], $data );


        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, true,true);

        return $data;
    }

    /*
     *   get pdf of withdrawal by id
     */
    public function getPdfWithdrawal($idWithdrawal)
    {

        $xmlRequest = $this->requestXml->fill([
            'command' => 'generaVoucherPrelievo',
        ], [
            'xsi'          => ['xsi:type' => 'getWithdrawalVoucherDataRequest'],
            'idWithdrawal' => $idWithdrawal, // int
        ]);


        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, true);

        return $data;
    }


    /*
     *   do withdrawal by id
     */
    public function doWithdrawal($amount, $type, $params = [])
    {
        $extra = [];
        foreach ($params as $key => $value) {
            $extra[] = ['_attributes' => ['key' => $key, 'value' => $value]];
        }

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'withdrawal',
        ], [
            'ssoToken' => session('token'), // string
            'amount' => $amount, // int
            'type' => $type, // byte
            'extra' => $extra,
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, true);

        return $data;
    }

    /*
     *   cancel withdrawal by id
     */
    public function cancelWithdrawal($id)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'withdrawalCancel',
        ], [
            'ssoToken' => session('token'), // string
            'idWithdrawal' => $id, // int
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, true);

        return $data;
    }



    /*
     *   get getInvoices 
     */
    public function getInvoices($id)
    {

        $xmlRequest = $this->arrayToXml->convert([
            'command' => 'getInvoices',
        ], [
            '_attributes' => ['xsi:type' => 'getInvoiceRequest'],
            'idMaster' => $id, // string
        ]);

        $xmlstr = $this->post($xmlRequest);

        $data = $this->parseXml($xmlstr, true);

        return $data;
    }
}
