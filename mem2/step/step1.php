    <div style="padding-left:30px; float:clear;">

    <!--

        <p style="margin:20px 20px 16px 0; padding: 5px 0 5px 10px; font-size:11pt; font-weight:bold; background-color:aqua; color:navy;">
            メンバー登録とは
        </p>
        <p style="margin:10px 0 8px 0; font-size:10pt; float:clear;">
            メンバー登録とは、日本ワーキング・ホリデー協会によるワーホリ成功の為のメンバーサポート制度です。<br/>
            メンバーになると個別カウンセリングや特別セミナーへの参加、ビザ取得サポート、出発前の準備、到着後のサポートまで個別にフルサポート致します。<br/>
            <span style="color:red;">●</span>　メンバー登録料は５，０００円（３年間有効）となります。<br/>
        </p>
    -->
        <p class="title_bar">
            メンバー登録の前に必ずご確認ください
        </p>

        <div style="font-size:11pt;margin:0 20px 0 10px;">
【　ご注意　】<br />
皆様のビザ取得にあたり、当協会が実施するお手伝い（サポート）は、申請方法のご説明、書き方等の指導を行うものであり、申請を代行するものではありません。<br />
各種ビザの発給は各国大使館・領事館等の判断によるものであり、当協会はビザ取得の確約、保障などは一切行えません。<br />
ご自身でビザ申請した後のトラブル等の対応は、当協会では出来かねます。ご自身で直接申請先（大使館等）にお問い合わせ下さい。<br />
お客様の状況によりサポートを御断りする場合も御座います。予めご了承ください。<br />
        </div>

        <p class="title_bar">
            お客様情報をご入力下さい　　　　　　　<span style="font-size:8pt; font-weight:normal; color:black;"><img src="images/hissu.gif">　は必須項目です</span>
        </p>

    <form class="cmxform" id="signupForm" method="post" action="./check.php?k=<?php echo $k; ?>" onsubmit="fncClearFields();">
        <input type="hidden" name="act" value="<?php echo $act; ?>">
        <input type="hidden" name="kyoten" value="<?php echo $k; ?>">
        <table class="entrytable">
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    メールアドレス
                </td>
                <td class="td_method">[半角英数字]</td>
                <td class="td_input">
                    <input id="email" name="email" size="36" maxlength="80" value="" class="focus" pre="0" />
                    &nbsp;
                    <span class="tooltip">
                        <img style="cursor:pointer;" src="images/hatena.gif" />
                        <div class="tooltipmsg">
                            ※ログイン用のメールアドレスとなります<br/>
                            ※携帯電話でのメールアドレスをご使用の場合、<br/>　jawhm.or.jpドメインからのメールを受信できるように設定を確認してください<br/>
                            ※次のようなメールアドレスはご利用いただけません。<br/>
                            　１．メールアドレスの @ の直前にピリオド (.) がある<br/>
                            　２． @ より前でピリオドが連続する<br/>
                            　恐れ入りますが、他のメールアドレスでご登録ください。<br/>
                        </div><br/>
                    </span>
                    <span class="sample">例） mail@jawhm.or.jp</span>
                    <div class="postcode">
                        ※ご確認のメールをお送りしますので、連絡可能なメールアドレスを入力してください。
						<div style="background-color:#FF9966; color:black; margin: 5px 5px 5px 5px;padding: 5px 8px 5px 8px; font-weight:none;">
						【重要：HOTMAIL等のメールをご利用の方へ】<br/>
						hotmail、live.jp等のメアドをご利用の場合、確認メールが正しく届かない場合があります。<br/>
						メンバー登録前に<a target="_blank" href="https://www.jawhm.or.jp/blog/tokyoblog/%E4%BB%8A%E6%97%A5%E3%81%AE%E5%8D%94%E4%BC%9A%E3%82%AA%E3%83%95%E3%82%A3%E3%82%B9/2610/">こちらをご確認頂く</a>
						か、<u>他のメアドをご利用ください</u>。
						</div>

                    </div>
                </td>
            </tr>
    <?php	if ($k == '')	{	?>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    パスワード
                </td>
                <td class="td_method">[半角英数字]</td>
                <td class="td_input">
                    <div class="postcode">
                        ※登録後、メンバー専用ページへのログインの際に必要となります。<br/>
                    </div>
                    <input id="password" name="password" type="password" maxlength="20" />
                    &nbsp;
                    <span class="tooltip">
                        <img style="cursor:pointer;" src="images/hatena.gif" />
                        <div class="tooltipmsg">
                            ※メンバー専用ページにログインする際のパスワードとなります。<br/>
                        </div>
                    </span>
                    <div class="postcode">
                        ※半角英数字５～２０文字で入力してください。
                    </div>
                    <input id="confirm_password" name="confirm_password" type="password" maxlength="20" />
                    <div class="postcode">
                        ※確認の為、同じパスワードを入力してください。
                    </div>
                </td>
            </tr>
    <?php	}else{			?>
            <input id="password" name="password" type="hidden" maxlength="20" value="<?php echo $newpwd; ?>" />
            <input id="confirm_password" name="confirm_password" type="hidden" maxlength="20" value="<?php echo $newpwd; ?>" />
    <?php	}			?>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    お名前
                </td>
                <td class="td_method">[全角]</td>
                <td class="td_input">
                    <table class="dummy">
                        <tr>
                            <td style="vertical-align:top;">
                                　姓 <input id="namae1" name="namae1" maxlength="20" size="10" value="" class="focus" pre="0" />
                            </td>
                            <td style="vertical-align:top;">
                                　　名 <input id="namae2" name="namae2" maxlength="20" size="10" value="" class="focus" pre="0" />
                            </td>
                            <td style="vertical-align:top;">　様</td>
                        </tr>
                            <td>
                                <span class="sample">　　例） 山田</span>
                            </td>
                            <td>
                                <span class="sample">　　例） 太郎</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    フリガナ
                </td>
                <td class="td_method">[全角カナ]</td>
                <td class="td_input">
                    <table class="dummy">
                        <tr>
                            <td style="vertical-align:top;">
                                セイ <input id="furigana1" name="furigana1" maxlength="20" size="10" value="" class="focus" pre="0" />
                            </td>
                            <td style="vertical-align:top;">
                                　メイ <input id="furigana2" name="furigana2" maxlength="20" size="10" value="" class="focus" pre="0" />
                            </td>
                            <td style="vertical-align:top;">　サマ</td>
                        </tr>
                            <td>
                                <span class="sample">　　例） ヤマダ</span>
                            </td>
                            <td>
                                <span class="sample">　　例） タロウ</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    性別
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <input type="radio" id="gender_male" value="m" name="gender" validate="required:true" />男性 &nbsp;&nbsp;
                    <input type="radio" id="gender_female" value="f" name="gender" checked/>女性
                    <label for="gender" class="error">性別を選択してください</label>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    生年月日
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <select id="y" name="year">
                        <?php
                            for ($i=1970; $i<=date('Y');$i++)
                            {
                                echo '<option value="'.$i.'"';
                                if($i == (date('Y')-22))
                                    echo'selected';

                                echo  '>'.$i.'</option>';
                            }
                        ?>
                    </select>年
                    <select id="m" name="month">
                        <option value="">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>
                    </select>月
                    <select id="d" name="day">
                        <option value="">--</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
                    </select>日
                    <img src="./images/icon_calendar.gif" id="select_date_calendar_icon"/>
                    &nbsp;
                    <span class="tooltip">
                        <img style="cursor:pointer;" src="images/hatena.gif" />
                        <div class="tooltipmsg">
                            ※カレンダーアイコンをクリックして簡単に選択して頂くこともできます。
                        </div>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    郵便番号
                </td>
                <td class="td_method">[半角数字]</td>
                <td class="td_input">
                    <input id="pcode" name="pcode" size=10 maxlength="10" value="" class="focus" pre="0" onKeyUp="AjaxZip2.zip2addr(this,'add1','add2',null,'add2');" />
                    <span class="sample">例） 160-0023</span>
                    <div class="postcode">
                        郵便番号をご入力頂くと、ご住所が自動で入力されます。　<span style="color:red;">[ <a target="_new" href="https://www.post.japanpost.jp/zipcode/" tabindex="-1">〒郵便番号検索ページへ</a> ]</span>
                    </div>
                </td>
            </tr>
            <tr style="border-top:none;">
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    都道府県
                </td>
                <td class="td_method">[全角]</td>
                <td class="td_input">
                    <input id="add1" name="add1" size=20 maxlength="80" value="" class="focus" pre="0" /><br/><span class="sample">例） 東京都</span>
                </td>
            </tr>
            <tr style="border-top:none;">
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    市区町村
                </td>
                <td class="td_method">[全角]</td>
                <td class="td_input">
                    <input id="add2" name="add2" size=50 maxlength="80" value="" class="focus" pre="0" /><br/><span class="sample">例） 新宿区西新宿</span>
                </td>
            </tr>
            <tr style="border-top:none;">
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    番地・建物名<br/>部屋番号
                </td>
                <td class="td_method">[全角]</td>
                <td class="td_input">
                    <input id="add3" name="add3" size=50 maxlength="80" value="" class="focus" pre="0" />
                    &nbsp;
                    <span class="tooltip">
                        <img style="cursor:pointer;" src="images/hatena.gif" />
                        <div class="tooltipmsg">
                            ※海外からの場合、国名を「都道府県」の欄に入力し<br/>
                            　残りの住所を「市区町村」「番地・建物名」に入力してください<br/>
                        </div>
                    </span>
                    <br/><span class="sample">例） １－３－３　ステーションビル５０７</span>
                    <div class="postcode">
                        ※メンバーズカードをお送りします。<br/>
                        （ご注意）宛先不明でカードがお送り出来ない事が多くあります。<br/>
						　　　　　必ず<b>アパート・マンション名、部屋番号</b>なども入力してください。<br/>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    電話番号
                </td>
                <td class="td_method">[半角数字]</td>
                <td class="td_input">
                    <input id="tel" name="tel" maxlength="30" value="" class="focus" pre="0" />
                    <br/><span class="sample">例） 0363045858</span>
                    <div class="postcode">
                        ※ハイフンは<b>入力不要</b>です。
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                </td>
                <td class="td_tag">
                    職業
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <input type="radio" class="radio" name="job" value="会社員">&nbsp;会社員
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="job" value="派遣">&nbsp;派遣
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="job" value="アルバイト">&nbsp;アルバイト
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="job" value="学生">&nbsp;学生
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="job" value="無職">&nbsp;無職
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="job" value="その他">&nbsp;その他
                    <br/>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                </td>
                <td class="td_tag">
                    渡航予定国
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <input type="checkbox" class="checkbox" name="c1" value="オーストラリア">&nbsp;オーストラリア
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c2" value="ニュージーランド">&nbsp;ニュージーランド
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c3" value="カナダ">&nbsp;カナダ
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c4" value="韓国">&nbsp;韓国
                    <br/>
                    <input type="checkbox" class="checkbox" name="c5" value="フランス">&nbsp;フランス
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c6" value="ドイツ">&nbsp;ドイツ
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c7" value="イギリス">&nbsp;イギリス
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c8" value="アイルランド">&nbsp;アイルランド
                    <br/>
                    <input type="checkbox" class="checkbox" name="c9" value="デンマーク">&nbsp;デンマーク
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c14" value="ノルウェー">&nbsp;ノルウェー
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c10" value="台湾">&nbsp;台湾
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c11" value="香港">&nbsp;香港
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c13" value="アメリカ">&nbsp;アメリカ
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="c12" value="未定">&nbsp;未定
                    <br/>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                </td>
                <td class="td_tag">
                    渡航予定国の語学力
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <input type="radio" class="radio" name="gogaku" value="堪能">&nbsp;堪能
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="gogaku" value="日常会話">&nbsp;日常会話
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="gogaku" value="挨拶程度">&nbsp;挨拶程度
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="gogaku" value="全然できない">&nbsp;全然できない
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="gogaku" value="その他">&nbsp;その他
                    <br/>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                </td>
                <td class="td_tag">
                    渡航目的
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <input type="checkbox" class="checkbox" name="p1" value="観光">&nbsp;観光
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="p2" value="語学上達のため">&nbsp;語学上達のため
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="p3" value="将来のキャリアアップ">&nbsp;将来のキャリアアップ
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="p4" value="海外生活体験">&nbsp;海外生活体験
                    <br/>
                    <input type="checkbox" class="checkbox" name="p5" value="現地調査">&nbsp;現地調査
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="p6" value="研究">&nbsp;研究
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="p7" value="その他">&nbsp;その他
                    <br/>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                </td>
                <td class="td_tag">
                    どこで当協会を<br/>　　　知りましたか
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    <input type="checkbox" class="checkbox" name="k1" value="協会ホームページ">&nbsp;協会ホームページ
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="k2" value="留学エージェントの紹介">&nbsp;留学エージェントの紹介
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="k3" value="書籍・雑誌">&nbsp;書籍・雑誌
                    <br/>
                    <input type="checkbox" class="checkbox" name="k4" value="友人の紹介">&nbsp;友人の紹介
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="k5" value="大使館の紹介">&nbsp;大使館の紹介
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="k6" value="学校の紹介">&nbsp;学校の紹介
                    &nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="checkbox" name="k7" value="その他">&nbsp;その他
                    <br/>
                </td>
            </tr>
            <tr>
                <td class="td_flag">
                </td>
                <td class="td_tag">
                    今後のご案内
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    今後、セミナーやイベントのご案内等をお送りしてもよろしいですか？<br/>
                    <input type="radio" class="radio" name="mailsend" value="1" checked>&nbsp;受け取る
                    &nbsp;&nbsp;
                    <input type="radio" class="radio" name="mailsend" value="0">&nbsp;受け取らない
                </td>
            </tr>

            <tr>
                <td class="td_flag">
                    <img src="images/hissu.gif">
                </td>
                <td class="td_tag">
                    メンバー登録に際して<br/>確認事項
                </td>
                <td class="td_method"></td>
                <td class="td_input">
                    【　メンバー規約　】
                    <iframe src="kiyaku1.html" style="height:160px; width:100%; border:1px solid gray;"></iframe>

                    【　プライバシーポリシー　】
                    <iframe src="kiyaku2.html" style="height:160px; width:100%; border:1px solid gray;"></iframe>

                    【　ビザ申請に関する重要事項　】
                    <iframe src="kiyaku3.html" style="height:160px; width:100%; border:1px solid gray;"></iframe>

                    &nbsp;<br/>
                    上記内容を確認の上、以下にチェックをしてください。<br/>
                    なお、各内容にご同意又は確認されない場合、メンバー登録は行えません。<br/>
                    &nbsp;<br/>
                    <input type="checkbox" class="checkbox" id="agree" name="agree" value="同意" />&nbsp;&nbsp;「メンバー規約」に同意します。<br/>
                    <input type="checkbox" class="checkbox" id="agree2" name="agree2" value="同意" />&nbsp;&nbsp;「プライバシーポリシー」を確認しました。<br/>
                    <input type="checkbox" class="checkbox" id="agree3" name="agree3" value="同意" />&nbsp;&nbsp;「ビザ申請に関する重要事項」を確認しました。<br/>
                    &nbsp;<br/>
                </td>
            </tr>

        </table>

        <input type="submit" value="次へ >>" style="width:150px; height:30px; margin:18px 0 30px 600px; font-size:11pt; font-weight:bold;" />

    </form>


    </div>

    <script type="text/javascript">
    SelectCalendar.createOnLoaded({yearSelect: 'y',
        monthSelect: 'm',
        daySelect: 'd'
    },
    {
        startYear: 1970,
        endYear: <?php echo date('Y'); ?>,
        lang: 'ja',
        triggers: ['select_date_calendar_icon']
    });
    </script>
