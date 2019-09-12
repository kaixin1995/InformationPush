<?php
/**
 * 获取失效的regId列表.
 * @author wangkuiwei
 * @name Feedback
 * @desc 获取失效的regId列表。
 *
 */
namespace xmpush;

class Feedback extends HttpBase {

    public function __construct() {
        parent::__construct();
    }

    public function getInvalidRegIds($retries = 1) {
        $result = $this->getResult(PushRequestPath::V1_FEEDBACK_INVALID_REGID(), array(), $retries);
        return $result;
    }

}

?>
