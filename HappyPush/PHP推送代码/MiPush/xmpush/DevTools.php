<?php
/**
 * 设备查询工具集.
 * @author wangkuiwei
 * @name DevTools
 *
 */
namespace xmpush;

class DevTools extends HttpBase {

    public function __construct() {
        parent::__construct();
    }

    public function getAliasesOf($packageName, $regId, $retries = 1) {
        $fields = array('registration_id' => $regId, 'restricted_package_name' => $packageName);
        $result = $this->getResult(PushRequestPath::V1_GET_ALL_ALIAS(), $fields, $retries);
        return $result;
    }

    public function getTopicsOf($packageName, $regId, $retries = 1) {
        $fields = array('registration_id' => $regId, 'restricted_package_name' => $packageName);
        $result = $this->getResult(PushRequestPath::V1_GET_ALL_TOPIC(), $fields, $retries);
        return $result;
    }

}

?>
