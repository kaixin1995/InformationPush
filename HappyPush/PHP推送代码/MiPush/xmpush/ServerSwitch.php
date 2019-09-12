<?php
/**
 * 用于多个域名之间的切换逻辑
 * Created by PhpStorm.
 * User: zhangdali
 * Date: 2016/12/5
 * Time: 下午4:29
 */

namespace xmpush;


class ServerSwitch {
    /**
     * 存储message的server
     * @var array Server
     */
    private $servers;
    private $apiRegionList;
    private $feedbackRegionList;
    private $sandbox;
    private $specified;
    private $emq;
    private $messageVip;
    private $defaultServer;
    private $inited = false;
    private $lastRefreshTime;
    static $REFRESH_SERVER_HOST_INTERVAL = 300000; // 5 * 60 * 1000


    /**
     * @var ServerSwitch reference to singleton instance
     */
    private static $instance;

    /**
     * 通过延迟加载（用到时才加载）获取实例
     *
     * @return self
     */
    public static function getInstance() {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }

        return self::$instance;
    }

    /**
     * 是否需要刷新host列表
     * @return bool
     */
    public function needRefreshHostList() {
        return !$this->inited ||
            $this->currentTimeMillis() - $this->lastRefreshTime >= self::$REFRESH_SERVER_HOST_INTERVAL;
    }

    /**
     * @param String $serverListStr : host:min:max:step,host:min:max:step,...
     */
    public function initialize($serverListStr) {
        if (!$this->needRefreshHostList()) {
            return;
        }
        $serverStrArr = explode(',', $serverListStr);
        $servers = array();
        $i = 0;
        foreach ($serverStrArr as $serverStr) {
            $sp = explode(":", $serverStr);
            if (count($sp) < 5) {
                $servers[$i] = $this->defaultServer;
                continue;
            }
            $servers[$i] = new Server($sp[0], intval($sp[1]), intval($sp[2]), intval($sp[3]), intval($sp[4]));
            if (!empty($this->servers)) {
                foreach ($this->servers as $server) {
                    if (strcmp($server->getHost(), $servers[$i]->getHost())) {
                        $servers[$i]->setPriority($server->getPriority());
                    }
                }
            }
            $i++;
        }
        $this->inited = true;
        $this->lastRefreshTime = $this->currentTimeMillis();
        $this->servers = $servers;
    }

    /**
     * @param PushRequestPath $requestPath
     */
    /**
     * @param PushRequestPath $requestPath
     * @return Server
     */
    public function &selectServer($requestPath, $region, $isVip) {
        if (isset(Constants::$host)) {
            $this->specified->setHost(Constants::$host);
            return $this->specified;
        }
        if (Constants::$sandbox) {
            return $this->sandbox;
        }
        switch ($requestPath->getRequestType()) {
            case PushRequestType::FEEDBACK:
                switch ($region) {
                    case Region::Other:
                        return $this->feedbackRegionList[$region];
                    default:
                        return $this->feedbackRegionList[Region::China];

                }
            case PushRequestType::EMQ:
                return $this->emq;
            default:
                switch ($region) {
                    case Region::Other:
                        return $this->apiRegionList[$region];
                    default:
                        if ($isVip) {
                            return $this->messageVip;
                        }
                        return $this->selectMsgServer();
                }
        }

    }

    /**
     * @return mixed|Server
     */
    private function &selectMsgServer() {
        if (!Constants::$autoSwitchHost || !$this->inited) {
            return $this->defaultServer;
        }
        $allPriority = 0;
        $priorities = array();
        foreach ($this->servers as $server) {
            $priorities[] = $server->getPriority();
            $allPriority += $server->getPriority();
        }
        $randomPoint = mt_rand(0, $allPriority);
        $sum = 0;
        for ($i = 0; $i < count($priorities); $i++) {
            $sum += $priorities[$i];
            if ($randomPoint <= $sum) {
                return $this->servers[$i];
            }
        }
        return $this->defaultServer;
    }

    /**
     * 构造函数私有，不允许在外部实例化
     */
    private function __construct() {
        $this->sandbox = new Server(Constants::HOST_SANDBOX, 100, 100, 0, 0);
        $this->specified = new Server(Constants::$host, 100, 100, 0, 0);
        $this->emq = new Server(Constants::HOST_EMQ, 100, 100, 0, 0);
        $this->defaultServer = new Server(Constants::HOST_PRODUCTION, 1, 90, 10, 5);
        $this->lastRefreshTime = $this->currentTimeMillis();
        $hostList = Region::getFeedbackHostList();
        $this->feedbackRegionList = array();
        foreach ($hostList as $region => $host) {
            $this->feedbackRegionList[$region] = new Server($host, 100, 100, 0, 0);
        }
        $hostList = Region::getApiHostList();
        $this->apiRegionList = array();
        foreach ($hostList as $region => $host) {
            $this->apiRegionList[$region] = new Server($host, 100, 100, 0, 0);
        }
        $this->messageVip = new Server(Constants::HOST_VIP, 100, 100, 0, 0);
    }

    /**
     * 防止对象实例被克隆
     *
     * @return void
     */
    private function __clone() {
    }

    /**
     * 防止被反序列化
     *
     * @return void
     */
    private function __wakeup() {
    }

    /**
     * 获取当前时间(毫秒)
     * @return int
     */
    private function currentTimeMillis() {
        return ceil(microtime(true) * 1000);
    }
}