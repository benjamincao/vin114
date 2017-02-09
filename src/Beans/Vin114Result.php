<?php

namespace Carnetmotors\Vin114\Beans;

/**
*
*/
class Vin114Result
{
    const SEPERATOR = ' | ';

    private $levelId;           // LevelId  VIN对应的标识ID值
    private $brand;             // PP  品牌
    private $vehicleModel;      // CX  车型
    private $vehicleLine;       // CXI  车系
    private $manufacture;       // CJMC  厂家名称
    private $saleName;          // XSMC  销售名称
    private $guidePrice;        // ZDJG  指导价格
    private $engineModel;       // FDJXH  发动机型号
    private $cylinderNumber;    // FDJGS  缸数
    private $displacement;      // PL  排量
    private $enginePower;       // GL  发动机最大功率(kW)
    private $fuelType;          // RYLX  燃油类型
    private $fuelLevel;         // RYBH  燃油标号
    private $dischargeStandard; // PFBZ  排放标准
    private $transmissionType;  // BSQLX  变速器类型
    private $gearboxDesc;       // BSQMS  变速器描述
    private $driveMode;         // QDFS  驱动方式
    private $gearNumber;        // DWS  档位数
    private $doorNumber;        // CMS  车门数
    private $seatNumber;        // ZWS  座位数
    private $modelYear;         // NK  年款
    private $vehicleBodyType;   // CSXS  车身形式
    private $vehicleLevel;      // JB  车辆级别
    private $vehicleType;       // CLLX  车辆类型
    private $productYear;       // SCNF  生产年份
    private $releaseYear;       // SSNF  上市年份
    private $releaseMont;       // SSYF  上市月份
    private $retirementYear;    // TCNF  停产年份
    private $year;              // VINNF  VIN对应的年份，可为具体的年份和“未查到年代”两种
    private $newLevelId;        // NLevelID  力洋标识ID（新编制ID）如：GBZ0142A0013

    /**
     * Magic method of __set.
     *
     * @param string $name
     * @param any $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * Magic method of __get.
     *
     * @param  string $name
     *
     * @return any or null
     */
    public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }

        return null;
    }

    public function __toString()
    {
        return '品牌: ' . $this->brand
            . self::SEPERATOR . 'VIN对应的标识ID值：' . $this->levelId
            . self::SEPERATOR . '品牌：' . $this->brand
            . self::SEPERATOR . '车型：' . $this->vehicleModel
            . self::SEPERATOR . '车系：' . $this->vehicleLine
            . self::SEPERATOR . '厂家名称：' . $this->manufacture
            . self::SEPERATOR . '销售名称：' . $this->saleName
            . self::SEPERATOR . '指导价格：' . $this->guidePrice
            . self::SEPERATOR . '发动机型号：' . $this->engineModel
            . self::SEPERATOR . '缸数：' . $this->cylinderNumber
            . self::SEPERATOR . '排量：' . $this->displacement
            . self::SEPERATOR . '发动机最大功率(kW)：' . $this->enginePower
            . self::SEPERATOR . '燃油类型：' . $this->fuelType
            . self::SEPERATOR . '燃油标号：' . $this->fuelLevel
            . self::SEPERATOR . '排放标准：' . $this->dischargeStandard
            . self::SEPERATOR . '变速器类型：' . $this->transmissionType
            . self::SEPERATOR . '变速器描述：' . $this->gearboxDesc
            . self::SEPERATOR . '驱动方式：' . $this->driveMode
            . self::SEPERATOR . '档位数：' . $this->gearNumber
            . self::SEPERATOR . '车门数：' . $this->doorNumber
            . self::SEPERATOR . '座位数：' . $this->seatNumber
            . self::SEPERATOR . '年款：' . $this->modelYear
            . self::SEPERATOR . '车身形式：' . $this->vehicleBodyType
            . self::SEPERATOR . '车辆级别：' . $this->vehicleLevel
            . self::SEPERATOR . '车辆类型：' . $this->vehicleType
            . self::SEPERATOR . '生产年份：' . $this->productYear
            . self::SEPERATOR . '上市年份：' . $this->releaseYear
            . self::SEPERATOR . '上市月份：' . $this->releaseMont
            . self::SEPERATOR . '停产年份：' . $this->retirementYear
            . self::SEPERATOR . 'VIN对应的年份(可为具体的年份和“未查到年代”两种)：' . $this->year
            . self::SEPERATOR . '力洋标识ID(新编制ID)：' . $this->newLevelId;
    }
}
