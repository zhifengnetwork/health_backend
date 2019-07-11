<?php
/**
 * tpshop
 * ============================================================================
 * * 版权所有 2015-2027 深圳搜豹网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.tp-shop.cn
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用 .
 * 不允许对程序代码以任何形式任何目的的再发布。
 * 采用最新Thinkphp5助手函数特性实现单字母函数M D U等简写方式
 * ============================================================================
 * $Author: 当燃 2016-01-09
 */
namespace app\mobile\controller;

use Think\Db;
use app\common\logic\wechat\WechatUtil;

class Bonus extends MobileBase {

    public function bonus_action()
    {
        $data = [
            'order_id'=>1,
            'goods_id'=>1,
            'user_id' =>8852,
            'shop_price'=>29800,
            'gold_card_price'=>23280,
            'brick_card_price'=>13980,
            'fine_brick_card_price'=>9180,
            'nums'=>1
        ];
        //设置参数
        if(!$this->setParams($data)) return true;
        $this->bonus($data);      	 		
    }

    //设置参数
    private function setParams($data)
    {
        $this->order_id                  = $data['order_id']; //订单id
        $this->goods_id                  = $data['goods_id']; //商品id
        $this->user_id                   = $data['user_id'];//用户id
        $this->shop_price                = $data['shop_price']; //原价
        $this->gold_card_price           = $data['gold_card_price'];//金卡会员价格
        $this->brick_card_price          = $data['brick_card_price'];//钻石会员价格
        $this->fine_brick_card_price     = $data['fine_brick_card_price'];//精钻会员价格
        $this->nums                      = $data['nums'];//商品数量
        return true;
    } 

    private function bonus()
    {
        //获取返佣人信息
        $users = $this->reward_leve( $this->user_id);
        $level = 0;
        foreach($users as $key => $vale)
        {
            if($vale['level']>=$level){
                //二级返佣
                dump('二级返佣');
            }else{
                //极差价
                //二级返佣
                dump('极差价,二级返佣');
            }
            $level = $vale['level'];
        }
        
    }
    public function reward_leve($user_id,$num = 0,&$userList = array()){

		$num += 1;
        $field = "user_id, first_leader, level,parents_cache_vip,gift_pack_1,gift_pack_2,gift_pack_3,set_up_shop";
        $UpInfo = M('users')->field($field)->where(['user_id' => $user_id])->find();
        
		$first_leader = $UpInfo['first_leader'];
		
		if($first_leader <= 0 || $num > 2){
			return true;
        }
        if ($UpInfo)  //有上级
        {
            $userList[] = $UpInfo;
            $this->reward_leve($first_leader,$num,$userList);
        }   
        return $userList;
		
	}
	
}