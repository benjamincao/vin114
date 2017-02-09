<?php

namespace Carnetmotors\Vin114;

use \SoapClient;
use \SOAPFault;
use Carnetmotors\Vin114\Beans\Vin114Result;

/**
*
*/
class Client
{
    const WEB_SERVICE_URL = 'http://58.221.57.73:8088/webService/BaInfoService.asmx?WSDL';

    const VIN114_ERRS = array(
        'E6' => '力洋接口程序出现异常',
        'E7' => 'IP验证不通过',
        'E8' => '未查到对应数据',
    );

    const KEY_PARAMETER_PAIRS = array(
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
        'VINNF'    => 'year',
        'NLevelID' => 'newLevelId',
    );

    public function __construct($method)
    {
    }

    public function fetchBaseInfo($vin, &$errMsg)
    {
        $vin114Result = new Vin114Result();

        try {
            $soapClient = new SoapClient(self::WEB_SERVICE_URL);
            $response   = $soapClient->GetBaInfoByVIN(
                array('vin' => $vin)
            );

            if (!isset($response->GetBaInfoByVINResult)) {
                $errMsg = 'wrong response format. response = ' . serialize($response);
                return null;
            }

            $result = $response->GetBaInfoByVINResult;

            $errCodes = array_keys(self::VIN114_ERRS);
            if (in_array($result, self::VIN114_ERRS)) {
                $errMsg = self::VIN114_ERRS[$result];
                return null;
            }

            $json = json_decode($result);
            if ($json == null) {
                $errMsg = 'json decode error. response = ' . serialize($response);
                return null;
            }

            foreach (self::KEY_PARAMETER_PAIRS as $key => $value) {
                if (isset($json[0]->$key)) {
                    $vin114Result->$value = $json[0]->$key;
                }
            }
        } catch (SOAPFault $fault) {
            $errMsg = 'SOAPFault: ' . $fault->getMessage();
            return null;
        }

        return $vin114Result;
    }
}
