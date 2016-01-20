<?php /*include_once 'SessionController.php';*/?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/common/common_tools.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/LotteryDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/RewardDao.php';?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/casarover/application/models/PriceDao.php';?>
<?php 
/**
 * 2016新年签活动的大部分业务逻辑.
 * @author Ye_WD
 * @2015-12-28
 */
class WechatLotteryService {
    /** 每天抽奖次数上限 */
    const DAY_LIMIT = 5;
    const OVER_LIMIT = "Over daily limit!";
    /** 中奖概率百分比数 */
    const WIN_RATE = 100;
    private $lotteryDao;
    private $rewardDao;
    private $priceDao;
    public function __construct() {
        $this->lotteryDao = new LotteryDao();
        $this->rewardDao = new RewardDao();
        $this->priceDao = new PriceDao();
    }
    /**
     * Save the lottery action.
     * 将一次抽签的行为记录在database里.
     * @param String $openid
     * @return number 今天的抽签次数, String 超过一天的抽签次数了.
     */
    public function save_onelot($openid) {
        $lot_row = $this->lotteryDao->getByOpenid($openid);
        if (!$lot_row) {
            // 1.The very first time of lottery.
            $this->lotteryDao->add($openid);
            return 1;
        } else {
            // 比对时间，若是另一天，要重置count_today
            $last_date = substr($lot_row['update_time'], 0, 10);
            $current_date = date("Y-m-d");
            if ($last_date == $current_date) {
                // 同一天
                $count_today = $lot_row['count_today'] + 1;
                $count_total = $lot_row['count_total'] + 1;
                if ($count_today > self::DAY_LIMIT) {
                    // 2.Too much times within one day.
                    return self::OVER_LIMIT;
                } else {
                    // 3.The second or third time today.
                    $this->lotteryDao->update($lot_row['id'], $count_today, $count_total);
                    return $count_today;
                }
            } else {
                // 另一天
                // 4.The first time today, but drew at least once ago.
                $count_today = 1;
                $count_total = $lot_row['count_total'] + 1;
                $this->lotteryDao->update($lot_row['id'], $count_today, $count_total);
                return 1;
            }
        }
    }
    /**
     * Draw the lottery according to the RATE.
     * 按照中奖概率给出抽奖结果。
     * @return boolean 中奖与否
     */
    public function draw() {
        // 查看奖品情况
        $price_count = $this->priceDao->getTotalCount();
        // 奖品已经抽光
        if ($price_count == 0) return false;
        // 奖品还没抽光
        $rate = self::WIN_RATE * 10;
        $rand = rand(1, 1000);
        if ($rand <= $rate) {
            // 中奖了
            return true;
        } else {
            return false;
        }
    }
    /**
     * Draw the price level while the user already win the price.
     * 抽几等奖。
     * @return number 几等奖
     */
    public function draw_price() {
        $price_array = $this->priceDao->get();
        $count = $price_array[0] + $price_array[1] + $price_array[2];
        // 奖品已经抽光
        if ($count == 0) return 0;
        $rand = rand(1, $count);
        if ($rand <= $price_array[0]) {
            $price_array[0]--;
            $this->priceDao->put($price_array);
            return 1;
        } else if ($rand <= ($price_array[0] + $price_array[1])) {
            $price_array[1]--;
            $this->priceDao->put($price_array);
            return 2;
        } else {
            $price_array[2]--;
            $this->priceDao->put($price_array);
            return 3;
        }
    }
    /**
     * Save the infomation of the lottery winner.
     * 保存用户中奖信息
     * @param  $openid
     * @param  $cellphone
     * @param  $reward_level
     */
    public function save_winner($openid, $reward_level, $cellphone=null) {
        $this->rewardDao->add($openid, $cellphone, $reward_level);
    }
    public function save_winner_cellphone($openid, $cellphone) {
        $this->rewardDao->updateCellphone($openid, $cellphone);
    }
    public function receive_price($id) {
        $this->rewardDao->updateToReceived($id);
    }
}
?>