<?php
/**
 * 常量定义.
 * @author wangkuiwei
 * @name Constants
 * @desc 常量定义
 *
 */
namespace xmpush;


class Constants {
    public static $comma = ',';
    public static $multi_topic_split = ';$;';
    public static $packageName = '';
    public static $bundle_id = '';
    public static $secret = '';

    /**
     * 是否在网络访问问题时,自动切换访问的域名
     */
    public static $autoSwitchHost = true;

    /**
     * 网络访问的超时时间,当超过该时间时,则认为可用性较低,会优先选择其他域名
     */
    public static $accessTimeOut = 5000;

    public static $HTTP_PROTOCOL = "https";

    public static $USE_HTTPS = true;
    /**
     * 是否测试环境
     */
    public static $sandbox = false;
    /**
     * 如果设置了IP、域名,则使用手动设置的值,只用于内部测试,不对外开放
     */
    /**
     * @return string
     */
    public static $host = null;

    const reg_url = '/v3/message/regid';
    const alias_url = '/v3/message/alias';
    const user_account_url = '/v2/message/user_account';
    const topic_url = '/v3/message/topic';
    const multi_topic_url = '/v3/message/multi_topic';
    const all_url = '/v3/message/all';
    const multi_messages_regids_url = '/v2/multi_messages/regids';
    const multi_messages_aliases_url = '/v2/multi_messages/aliases';
    const multi_messages_user_accounts_url = '/v2/multi_messages/user_accounts';
    const stats_url = '/v1/stats/message/counters';
    const message_trace_url = '/v1/trace/message/status';
    const messages_trace_url = '/v1/trace/messages/status';
    const validation_regids_url = '/v1/validation/regids';
    const subscribe_url = '/v2/topic/subscribe';
    const unsubscribe_url = '/v2/topic/unsubscribe';
    const subscribe_alias_url = '/v2/topic/subscribe/alias';
    const unsubscribe_alias_url = '/v2/topic/unsubscribe/alias';
    const fetch_invalid_regids_url = 'https://feedback.xmpush.xiaomi.com/v1/feedback/fetch_invalid_regids';
    const delete_schedule_job = '/v2/schedule_job/delete';
    const check_schedule_job_exist = '/v2/schedule_job/exist';
    const get_all_aliases = '/v1/alias/all';
    const get_all_topics = '/v1/topic/all';

    const UNION = 'UNION';
    const INTERSECTION = 'INTERSECTION';
    const EXCEPT = 'EXCEPT';

    /**
     * 相关域名定义
     */
    const HOST_EMQ = "emq.xmpush.xiaomi.com";
    const HOST_SANDBOX = "sandbox.xmpush.xiaomi.com";

    /**
     * 国内机房相关域名
     */
    const HOST_PRODUCTION = "api.xmpush.xiaomi.com";
    const HOST_PRODUCTION_FEEDBACK = "feedback.xmpush.xiaomi.com";

    /**
     * 海外机房相关域名
     */
    const HOST_GLOBAL_PRODUCTION = "api.xmpush.global.xiaomi.com";
    const HOST_GLOBAL_PRODUCTION_FEEDBACK = "feedback.xmpush.global.xiaomi.com";

    /**
     *  VIP域名
     */
    const HOST_VIP = "vip.api.xmpush.xiaomi.com";

    const X_PUSH_HOST_LIST = "X-PUSH-HOST-LIST";
    const HOST_RESPONSE_EXPECT_TIME = 5; // 响应时间低于这个值，host降权
    const X_PUSH_SDK_VERSION = "X-PUSH-SDK-VERSION";
    const SDK_VERSION = "PHP_SDK_V2.2.21";

    const EXTRA_PARAM_NOTIFY_EFFECT = "notify_effect";
    const NOTIFY_LAUNCHER_ACTIVITY = "1";
    const NOTIFY_ACTIVITY = "2";
    const NOTIFY_WEB = "3";
    const EXTRA_PARAM_INTENT_URI = "intent_uri";
    const EXTRA_PARAM_WEB_URI = "web_uri";

    public static function setPackage($package) {
        self::$packageName = $package;
    }

    public static function setSecret($secret) {
        self::$secret = $secret;
    }

    public static function setBundleId($bundleId) {
        self::$bundle_id = $bundleId;
    }

    public static function useOfficial() {
        self::$sandbox = false;
        self::$host = null;
    }

    public static function useSandbox() {
        self::$sandbox = true;
        self::$host = null;
    }

    /**
     * 仅限内部使用,用户测试专门的IP
     */
    public static function useInternalHost($hostOrIP) {
        self::$host = $hostOrIP;
    }

    public static function useHttp() {
        self::$HTTP_PROTOCOL = "http";
    }
}

?>
