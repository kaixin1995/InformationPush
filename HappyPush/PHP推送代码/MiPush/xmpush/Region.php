<?php
/**
 * Created by PhpStorm.
 * User: zhangdali
 * Date: 2018/3/12
 * Time: 下午5:44
 */

namespace xmpush;


class Region {
    const China = 0;          // 国内
    const Other = 1;          // 国外其他地方，比如新加坡

    public static function getFeedbackHostList() {
        return array(
            Region::China => Constants::HOST_PRODUCTION_FEEDBACK,
            Region::Other => Constants::HOST_GLOBAL_PRODUCTION_FEEDBACK
        );
    }

    public static function getApiHostList() {
        return array(
            Region::China => Constants::HOST_PRODUCTION,
            Region::Other => Constants::HOST_GLOBAL_PRODUCTION
        );
    }
}