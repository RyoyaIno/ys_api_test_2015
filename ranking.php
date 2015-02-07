<?php
//baseのインクルードとオブジェクト生成
include_once './base.php';
$base = new base();
$menu = $base->getMenu();
$msg = $base->getMsg();
$rankData = $base->getRankData();
$hotData = $base->getHotData();
?>
<!doctype html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
        <title>Yahoo!ショッピングAPIテスト</title>
        <meta name="viewport" content="width=device-width">
        <meta name="copyright" content="Template Party">
        <link rel="stylesheet" href="css/style.css">
        <link href="css/style-s.css" rel="stylesheet" type="text/css" media="only screen and (max-width:480px)">
        <link href="css/style-m.css" rel="stylesheet" type="text/css" media="only screen and (min-width:481px) and (max-width:800px)">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script type="text/javascript" src="js/openclose.js"></script>
    </head>

    <body>
        <h1>ys_api_test_2015</h1>
        <div id="container">
            <header>
                <p id="logo"><a href="#"><img src="images/logo.png" width="200" height="200" alt="SAMPLE WEBSITE"></a></p>
                <aside id="mainimg">
                    <img class="slide_file" src="images/1.jpg">
                    <img class="slide_file" src="images/2.jpg">
                    <img class="slide_file" src="images/3.jpg">
                    <input type="hidden" id="slide_loop" value="0">
                    <a href="#" id="slide_link">
                        <img id="slide_image" src="images/1.jpg" alt="" width="950" height="300" />
                        <img id="slide_image2" src="images/1.jpg" alt="" width="950" height="300" /></a>
                </aside>
            </header>

            <nav id="menubar">
                <ul>
                    <?php echo $menu; ?>
                </ul>
            </nav>

            <div id="contents">

                <div id="main">

                    <section class="list">

                        <h2 class="mb15"><?php echo $msg; ?></h2>

                        <?php
                        $i = 0;
                        foreach ($rankData as $rank) {
                            $i++;
                            ?>
                            <article>
                                <a href="<?php echo $rank->Url; ?>"><figure><img src="<?php echo $rank->Image->Medium; ?>" width="280" height="280" alt="第<?php echo $i; ?>位" /></figure></a>
                                <h4>第<?php echo $i; ?>位　　<a href="<?php echo $rank->Review->Url; ?>"><?php echo $rank->Review->Count; ?>件のレビュー平均<?php echo $rank->Review->Rate; ?></a></h4>
                                <p><a href="<?php echo $rank->Url; ?>"><?php echo $rank->Name; ?></a></p>
                            </article>
                        <?php } ?>
                    </section>
                    <!--/list-->

                </div>
                <!--/main-->

                <div id="sub">

                    <section id="submenu">
                        <h2>ランキング表示カテゴリー</h2>
                        <nav>
                            <ul>
                                <?php echo $menu; ?>
                            </ul>
                        </nav>
                    </section>
                    <br>
                    <section>
                        <h2>話題の情報</h2>
                        <br>
                        <?php foreach ($hotData as $hot) { ?>
                            <a href ="<?php echo $hot->Url; ?>"><img src="<?php echo $hot->Image->Original; ?>" width="220" height="220"/></a>
                            <br>
                            <a href ="<?php echo $hot->Url; ?>"><?php echo $hot->Title; ?></a>
                            <br>
                        <?php } ?>
                    </section>

                </div>
                <!--/sub-->

                <p id="pagetop"><a href="#">↑ PAGE TOP</a></p>

            </div>
            <!--/contents-->

        </div>
        <!--/container-->

        <footer>
            <small>Copyright&copy; 2015 Ryoya Ino All Rights Reserved.</small>
            <span class="pr"><a href="http://template-party.com/" target="_blank">Web Design:Template-Party</a></span>
        </footer>

        <!--スマホ用メニューバー-->
        <img src="images/icon_bar.png" width="20" height="16" alt="" id="menubar_hdr" class="close">
        <script type="text/javascript">
            if (OCwindowWidth() < 480) {
                open_close("menubar_hdr", "menubar");
            }
        </script>

        <!--スライドショースクリプト-->
        <script type="text/javascript" src="js/slide_simple_pack.js"></script>

    </body>
</html>