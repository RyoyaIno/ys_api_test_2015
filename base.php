<?php

/** 
 * ys_api_test_2015用ベースクラス
 * @author RyoyaIno
 */
class base {
    
    /**
     * yahooAPI利用アプリケーションID
     * @final String
     */
    const APPID = "dj0zaiZpPW42SURsWjdOVGRtYiZzPWNvbnN1bWVyc2VjcmV0Jng9Mjc-";

    /**
     * カテゴリーselect文
     * @var String
     */
    private $menu = "";
    
    /**
     * xml分解後ランキングデータ
     * @var array
     */
    private $rankData = array();
    
    /**
     * xml分解後ホットデータ
     * @var array
     */
    private $hotData = array();
    
    /**
     * 任意のメッセージ
     * @var String
     */
    private $msg = "";
    
    /**
     * コンストラクタ
     */
    public function __construct() {
        //カテゴリー
        $categories = array(
            "1" => "すべてのカテゴリから",
            "13457" => "ファッション",
            "2498" => "食品",
            "2500" => "ダイエット、健康",
            "2501" => "コスメ、香水",
            "2502" => "パソコン、周辺機器",
            "2504" => "AV機器、カメラ",
            "2505" => "家電",
            "2506" => "家具、インテリア",
            "2507" => "花、ガーデニング",
            "2508" => "キッチン、生活雑貨、日用品",
            "2503" => "DIY、工具、文具",
            "2509" => "ペット用品、生き物",
            "2510" => "楽器、趣味、学習",
            "2511" => "ゲーム、おもちゃ",
            "2497" => "ベビー、キッズ、マタニティ",
            "2512" => "スポーツ",
            "2513" => "レジャー、アウトドア",
            "2514" => "自転車、車、バイク用品",
            "2516" => "CD、音楽ソフト",
            "2517" => "DVD、映像ソフト",
            "10002" => "本、雑誌、コミック"
        );
        $catNum = (isset($_GET["cat"])) ? $_GET["cat"] : "1";
        $this->createMenu($categories);
        $this->createHotData();
        $this->createRankData($categories,$catNum);
    }
    
    /**
     * formのselect文optionの生成
     * @access private
     * @param array $cat カテゴリー
     * @return void
     */
    private function createMenu($cat){
        foreach ($cat as $key => $val){
            $this->menu .= '<li><a href="./index.php?cat='.$key.'">'.$val.'</a></li>';
        }
        return;
    }
    
    /**
     * ホットデータ情報取得
     * @return void
     */
    private function createHotData(){
        //yahooAPIを利用してホットデータ生成
        $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/getModule?appid=".self::APPID."&position=hotitem";
        $xml = simplexml_load_file($url);
        if ($xml["totalResultsReturned"] != 0) {
            $this->hotData = $xml->Result->Hit;
        } else {
            $this->msg .= "ホットデータを取得できませんでした。";
        }
        return;
    }
    
    /**
     * ランキングデータの生成
     * @access private
     * @param array $cat カテゴリー
     * @return array xml分解後ランキングデータ
     */
    private function createRankData($cat,$catNum){
        //POSTされた値が正しいかチェック
        $chk = FALSE;//不正フラグ
        foreach ($cat as $key => $val){
            if($catNum == $key){
                $chk = TRUE;
                break;
            }
        }
        if($chk){
            $this->msg .= "「{$val}」の売り上げランキング ";
        } else {
            $this->msg .= "カテゴリーが不正です。メニューバーからカテゴリーを選択してください。";
            $key = "1";//不正の場合はとりあえず全てのカテゴリーを表示しておく
        }
        //yahooAPIを利用してランキングデータ生成
        $url = "http://shopping.yahooapis.jp/ShoppingWebService/V1/categoryRanking?appid=".self::APPID."&category_id={$key}";
        $xml = simplexml_load_file($url);
        if ($xml["totalResultsReturned"] != 0) {
            $this->rankData = $xml->Result->RankingData;
        } else {
            $this->msg .= "「{$val}」のランキングデータを取得できませんでした。";
        }
        return;
    }
    
    /**
     * select文を取得
     * @access public
     * @return String
     */
    public function getMenu(){
        return $this->menu;
    }
    
    /**
     * ランキングデータのxmlを分解した配列を取得
     * @access public
     * @return array
     */
    public function getRankData(){
        return $this->rankData;
    }
    
    /**
     * ホットデータのxmlを分解した配列を取得
     * @access public
     * @return array
     */
    public function getHotData(){
        return $this->hotData;
    }
    
    /**
     * メッセージの取得
     * @access public
     * @return String
     */
    public function getMsg(){
        return $this->msg;
    }
}
