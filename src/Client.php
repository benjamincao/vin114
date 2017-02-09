<?php

namespace Carnetmotors\Vin114;

use SoapClient;
use SOAPFault;

/**
*
*/
class Client
{
    const WEB_SERVICE_URL = 'http://58.221.57.73:8088/webService/BaInfoService.asmx?WSDL';

    protected $errs = array(
        'E6' => '力洋接口程序出现异常',
        'E7' => 'IP验证不通过',
        'E8' => '未查到对应数据',
    );

    private $keyParameterPair = array(
        'LevelId'  => 'levelId',
        'PP'       => 'brand',
        'CX  '     => 'vehicleModel',
        'CX'       => 'vehicleLine',
        'CJMC'     => 'manufacture',
        'XSMC'     => 'saleName',
        'ZDJG'     => 'guidePrice',
        'FDJXH'    => 'engineModel',
        'FDJGS'    => 'cylinderNumber',
        'PL'       => 'displacement',
        'GL'       => 'enginePower',
        'RYLX'     => 'fuelType',
        'RYBH'     => 'fuelLevel',
        'PFBZ'     => 'dischargeStandard',
        'BSQLX'    => 'transmissionType',
        'BSQMS'    => 'gearboxDesc',
        'QDFS'     => 'driveMode',
        'DWS'      => 'gearNumber',
        'CMS'      => 'doorNumber',
        'ZWS'      => 'seatNumber',
        'NK'       => 'modelYear',
        'CSXS'     => 'vehicleBodyType',
        'JB'       => 'vehicleLevel',
        'CLLX'     => 'vehicleType',
        'SCNF'     => 'productYear',
        'SSNF'     => 'releaseYear',
        'SSYF'     => 'releaseMont',
        'TCNF'     => 'retirementYear',
        'VINNFVIN' => 'year',
        'NLevelID' => 'newLevelId',
    );

    public function __construct($method)
    {
    }

    public function fetchBaseInfo($vin, &$errMsg)
    {
        $vin114Result = null;

        try {
            $soapClient = new SoapClient(self::WEB_SERVICE_URL);
            $response   = $soapClient->GetBaInfoByVIN(
                array('vin' => $vin)
            );

            $errCodes = array_keys($errs);
            if (in_array($errs, $response)) {
                $errMsg = $errs[$response];
                return null;
            }

            $json = json_decode($response);
            if ($json == null) {
                $errMsg = 'json decode error. response = ' . $response;
                return null;
            }

            foreach ($keyParameterPair as $key => $value) {
                $vin114Result->$value = $json->$key;
            }
        } catch (SOAPFault $fault) {
            $errMsg = 'SOAPFault: ' . $fault->getMessage();
            return null;
        }

        return $vin114Result;
    }
}
