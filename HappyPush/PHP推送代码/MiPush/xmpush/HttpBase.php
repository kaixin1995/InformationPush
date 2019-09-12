<?php
/**
 * @author wangkuiwei
 * @name HttpBase
 *
 */
namespace xmpush;

class HttpBase {
    private $appSecret;
    private $region;
    private $isVip;

    /**
     * @param string $appSecret
     */
    public function setAppSecret($appSecret) {
        $this->appSecret = $appSecret;
    }

    /**
     * @param int $region
     */
    public function setRegion($region) {
        $this->region = $region;
    }

    /**
     * @param bool $isVip
     */
    public function setIsVip($isVip) {
        $this->isVip = $isVip;
    }


    public function __construct() {
        $this->appSecret = Constants::$secret;
        $this->region = Region::China;
        $this->isVip = false;
    }

    //发送请求，获取result，带重试
    public function getResult($requestPath, $fields, $retries) {
        $result = new Result($this->getReq($requestPath, $fields));
        if ($result->getErrorCode() == ErrorCode::Success) {
            return $result;
        }
        //重试
        for ($i = 0; $i < $retries; $i++) {
            $result = new Result($this->getReq($requestPath, $fields));
            if ($result->getErrorCode() == ErrorCode::Success) {
                break;
            }
        }
        return $result;
    }

    //get方式发送请求
    public function getReq($requestPath, $fields, $timeout = 3) {
        return $this->httpRequest($requestPath, $fields, "Get", $timeout);
    }

    //发送请求，获取result，带重试
    public function postResult($requestPath, $fields, $retries) {
        $result = new Result($this->postReq($requestPath, $fields));
        if ($result->getErrorCode() == ErrorCode::Success) {
            return $result;
        }
        //重试
        for ($i = 0; $i < $retries; $i++) {
            $result = new Result($this->postReq($requestPath, $fields));
            if ($result->getErrorCode() == ErrorCode::Success) {
                break;
            }
        }
        return $result;
    }

    //post方式发送请求
    public function postReq($requestPath, $fields, $timeout = 10) {
        return $this->httpRequest($requestPath, $fields, "Post", $timeout);
    }

    private function buildFullRequestURL(Server $server, PushRequestPath $requestPath) {
        return Constants::$HTTP_PROTOCOL . "://" . $server->getHost() . $requestPath->getPath();
    }

    private function httpRequest($requestPath, $fields, $method, $timeout = 10) {
        $server = ServerSwitch::getInstance()->selectServer($requestPath, $this->region, $this->isVip);
        $url = $this->buildFullRequestURL($server, $requestPath);

        $headers = array('Authorization: key=' . $this->appSecret,
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            Constants::X_PUSH_SDK_VERSION . ': ' . Constants::SDK_VERSION);
        if (Constants::$autoSwitchHost && ServerSwitch::getInstance()->needRefreshHostList()) {
            array_push($headers, Constants::X_PUSH_HOST_LIST . ': true');
        }
        array_push($headers, "Expect:");

        // Open connection
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        if ($method == "Post") {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
        } else {
            curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($fields));
            curl_setopt($ch, CURLOPT_POST, false);
        }
        $content = curl_exec($ch);
        $result = "";
        if ($content !== false) {
            $info = curl_getinfo($ch);
            $total_time = $info['total_time'];
            if ($total_time > Constants::HOST_RESPONSE_EXPECT_TIME) {
                $server->decrPriority();
            } else {
                $server->incrPriority();
            }
            list($responseHeaderStr, $result) = explode("\r\n\r\n", $content, 2);
            $responseHeaders = $this->convertHeaders($responseHeaderStr);
            if (array_key_exists(Constants::X_PUSH_HOST_LIST, $responseHeaders)) {
                $serverListStr = $responseHeaders[Constants::X_PUSH_HOST_LIST];
                ServerSwitch::getInstance()->initialize($serverListStr);
            }
        } else {
            $server->decrPriority();
            $result = json_encode(array(
                "code" => ErrorCode::NETWORK_ERROR_TIMEOUT,
                "reason" => "network error or timeout"
            ));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }

    /**
     * @param $responseHeaderStr
     * @return array
     */
    private function convertHeaders($responseHeaderStr) {
        $responseHeaderArr = explode("\r\n", $responseHeaderStr);
        $responseHeaders = array();
        foreach ($responseHeaderArr as $responseHeader) {
            $items = explode(":", $responseHeader, 2);
            if ($items !== false) {
                if (count($items) == 2) {
                    $responseHeaders[trim($items[0])] = trim($items[1]);
                } else {
                    $responseHeaders["Header_" . count($responseHeaders)] = trim($responseHeader);
                }
            }
        }
        return $responseHeaders;
    }
}

?>
