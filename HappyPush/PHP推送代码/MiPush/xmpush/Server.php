<?php
/**
 * Created by PhpStorm.
 * User: zhangdali
 * Date: 2016/12/5
 * Time: 下午4:36
 */

namespace xmpush;


class Server {

    /**
     * @var string
     */
    private $host;
    /**
     * @var int
     */
    private $priority;
    private $minPriority;
    private $maxPriority;
    private $decrStep;
    private $incrStep;

    /**
     * Server constructor.
     * @param string $host
     * @param int $minPriority
     * @param int $maxPriority
     * @param int $decrStep
     * @param int $incrStep
     */
    public function __construct($host, $minPriority, $maxPriority, $decrStep, $incrStep) {
        $this->host = $host;
        $this->priority = $maxPriority;
        $this->minPriority = $minPriority;
        $this->maxPriority = $maxPriority;
        $this->decrStep = $decrStep;
        $this->incrStep = $incrStep;
    }

    function __destruct() {
    }


    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @param $host
     */
    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * @param int $priority
     */
    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function incrPriority() {
        $this->changePriority(true, $this->incrStep);
    }

    public function decrPriority() {
        $this->changePriority(false, $this->incrStep);
    }

    /**
     * @param bool $incr
     * @param int $step
     */
    private function changePriority($incr, $step) {
        $newPriority = $incr ? $this->priority + $step : $this->priority - $step;
        if ($newPriority < $this->minPriority) {
            $newPriority = $this->minPriority;
        }
        if ($newPriority > $this->maxPriority) {
            $newPriority = $this->maxPriority;
        }
        $this->priority = $newPriority;
    }
}