<?php
/**
 * Created by PhpStorm.
 * User: zhangdali
 * Date: 2016/12/7
 * Time: 下午6:30
 */

namespace xmpush;

class PushRequestPath {
    // regid message
    static function V2_SEND() {
        return new static("/v2/send", PushRequestType::MESSAGE);
    }

    static function V2_REGID_MESSAGE() {
        return new static("/v2/message/regid", PushRequestType::MESSAGE);
    }

    static function V3_REGID_MESSAGE() {
        return new static("/v3/message/regid", PushRequestType::MESSAGE);
    }

    // subscribe topic
    static function V2_SUBSCRIBE_TOPIC() {
        return new static("/v2/topic/subscribe", PushRequestType::MESSAGE);
    }

    static function V2_UNSUBSCRIBE_TOPIC() {
        return new static("/v2/topic/unsubscribe", PushRequestType::MESSAGE);
    }

    static function V2_SUBSCRIBE_TOPIC_BY_ALIAS() {
        return new static("/v2/topic/subscribe/alias", PushRequestType::MESSAGE);
    }

    static function V2_UNSUBSCRIBE_TOPIC_BY_ALIAS() {
        return new static("/v2/topic/unsubscribe/alias", PushRequestType::MESSAGE);
    }

    // alias message
    static function V2_ALIAS_MESSAGE() {
        return new static("/v2/message/alias", PushRequestType::MESSAGE);
    }

    static function V3_ALIAS_MESSAGE() {
        return new static("/v3/message/alias", PushRequestType::MESSAGE);
    }

    // broadcast message
    static function V2_BROADCAST_TO_ALL() {
        return new static("/v2/message/all", PushRequestType::MESSAGE);
    }

    static function V3_BROADCAST_TO_ALL() {
        return new static("/v3/message/all", PushRequestType::MESSAGE);
    }

    static function V2_BROADCAST() {
        return new static("/v2/message/topic", PushRequestType::MESSAGE);
    }

    static function V3_BROADCAST() {
        return new static("/v3/message/topic", PushRequestType::MESSAGE);
    }

    static function V2_MULTI_TOPIC_BROADCAST() {
        return new static("/v2/message/multi_topic", PushRequestType::MESSAGE);
    }

    static function V3_MILTI_TOPIC_BROADCAST() {
        return new static("/v3/message/multi_topic", PushRequestType::MESSAGE);
    }

    static function V2_DELETE_BROADCAST_MESSAGE() {
        return new static("/v2/message/delete", PushRequestType::MESSAGE);
    }

    // user account message
    static function V2_USER_ACCOUNT_MESSAGE() {
        return new static("/v2/message/user_account", PushRequestType::MESSAGE);
    }

    // miid message
    static function V2_MIID_MESSAGE() {
        return new static("/v2/message/miid", PushRequestType::MESSAGE);
    }

    // multi message
    static function V2_SEND_MULTI_MESSAGE_WITH_REGID() {
        return new self("/v2/multi_messages/regids", PushRequestType::MESSAGE);
    }

    static function V2_SEND_MULTI_MESSAGE_WITH_ALIAS() {
        return new self("/v2/multi_messages/aliases", PushRequestType::MESSAGE);
    }

    static function V2_SEND_MULTI_MESSAGE_WITH_ACCOUNT() {
        return new self("/v2/multi_messages/user_accounts", PushRequestType::MESSAGE);
    }

    // validate
    static function V1_VALIDATE_REGID() {
        return new static("/v1/validation/regids", PushRequestType::MESSAGE);
    }

    static function V1_GET_ALL_ACCOUNT() {
        return new static("/v1/account/all", PushRequestType::MESSAGE);
    }

    static function V1_GET_ALL_TOPIC() {
        return new static("/v1/topic/all", PushRequestType::MESSAGE);
    }

    static function V1_GET_ALL_ALIAS() {
        return new static("/v1/alias/all", PushRequestType::MESSAGE);
    }

    static function V1_GET_ALL_MIID() {
        return new static("/v1/miid/all", PushRequestType::MESSAGE);
    }

    // trace
    static function V1_MESSAGES_STATUS() {
        return new static("/v1/trace/messages/status", PushRequestType::MESSAGE);
    }

    static function V1_MESSAGE_STATUS() {
        return new static("/v1/trace/message/status", PushRequestType::MESSAGE);
    }

    static function V1_GET_MESSAGE_COUNTERS() {
        return new static("/v1/stats/message/counters", PushRequestType::MESSAGE);
    }

    // presence
    static function V1_REGID_PRESENCE() {
        return new static("/v1/regid/presence", PushRequestType::MESSAGE);
    }

    static function V2_REGID_PRESENCE() {
        return new static("/v1/regid/presence", PushRequestType::MESSAGE);
    }

    // schedule job
    static function V2_DELETE_SCHEDULE_JOB() {
        return new static("/v2/schedule_job/delete", PushRequestType::MESSAGE);
    }

    static function V3_DELETE_SCHEDULE_JOB() {
        return new static("/v3/schedule_job/delete", PushRequestType::MESSAGE);
    }

    static function V2_CHECK_SCHEDULE_JOB_EXIST() {
        return new static("/v2/schedule_job/exist", PushRequestType::MESSAGE);
    }

    static function V2_QUERY_SCHEDULE_JOB() {
        return new static("/v2/schedule_job/query", PushRequestType::MESSAGE);
    }

    // feedback
    static function V1_FEEDBACK_INVALID_ALIAS() {
        return new static("/v1/feedback/fetch_invalid_aliases", PushRequestType::FEEDBACK);
    }

    static function V1_FEEDBACK_INVALID_REGID() {
        return new static("/v1/feedback/fetch_invalid_regids", PushRequestType::FEEDBACK);
    }

    static function V1_FEEDBACK_INVALID_MIID() {
        return new static("/v1/feedback/fetch_invalid_miid", PushRequestType::FEEDBACK);
    }

    // emq job
    static function V1_EMQ_ACK_INFO() {
        return new static("/msg/ack/info", PushRequestType::EMQ);
    }

    static function V1_EMQ_CLICK_INFO() {
        return new static("/msg/click/info", PushRequestType::EMQ);
    }

    static function V1_EMQ_INVALID_REGID() {
        return new static("/app/invalid/regid", PushRequestType::EMQ);
    }

    /**
     * PushRequestPath constructor.
     * @param string $path
     * @param int $requestType
     */
    public function __construct($path, $requestType) {
        $this->path = $path;
        $this->requestType = $requestType;
    }

    /**
     * @return int
     */
    public function getRequestType() {
        return $this->requestType;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }


    /**
     * @var string
     */
    private $path;
    /**
     * @var int
     */
    private $requestType;
}