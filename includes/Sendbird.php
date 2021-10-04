<?php 

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sendbird{
    const root  = 'https://api-1FEEF5D5-377E-4482-9D1A-3FF6A92DAA08.sendbird.com/v3';
    const api_token = '5d2006c8b95ba0f084e2671ab672b93c7efdbc1b';
    
    const delete = "DELETE";

    public function call($url,$params=array(),$options = array()) {
      //return true;
        $headers = array('Content-Type: application/json',
            'charset: utf8','Api-Token: '.self::api_token);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::root . $url );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        if(!empty($params)){
            curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($params));
        }
        if(isset($options['request_type'])){
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $options['request_type']);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result,true);
        
    }
    
    
    public function createUser($user_id) {
        $params = array(
            'user_id'=>$user_id,
            'nickname'=>'',
            'profile_url'=>'',
            'issue_access_token'=>false
        );
        return $this->call('/users',$params);
    }
    
    public function createPrivateChannel($user_ids) {
        $params = array(
            'is_distinct'=>'true',
            'user_ids'=>$user_ids
        );
        return $this->call('/group_channels',$params);
    }
    
    public function viewUser($user_id) {
        return $this->call("/users/{$user_id}");
    }
    
    public function deleteChannel($channel_url) {
        return $this->call("/group_channels/{$channel_url}",[],['request_type'=>self::delete]);
    }
    public function deleteUser($user_id) {
        return $this->call("/users/{$user_id}",[],['request_type'=>self::delete]);
    }
    public function getChannelsOfUser($user_id) {
        return $this->call("/users/{$user_id}/my_group_channels");
    }
    
     public function updateChannel($user_id) {
        $params = array(
            'user_id'=>$user_id,
        );
        return $this->call("/group_channels/sendbird_group_channel_3965_da92cf3013b272b3b30b8fe802f57d70044f45b4/join",
                $params,['request_type'=>'PUT']
                );
    }
    public function updateChannel2($user_id) {
        $params = array(
            'operator_ids'=>$user_id,
        );
        return $this->call("/open_channels/sendbird_open_channel_3965_d14622e1abd6b28ecc4c6f82653e1eb6f12033eb",
                $params,['request_type'=>'PUT']
                );
    }
    
    public function createPublicGroupChannel() {
        $params = array(
            'is_public'=>true,
        );
        return $this->call("/group_channels",
                $params,['request_type'=>'POST']
       );
    }
    
    
    
    }
