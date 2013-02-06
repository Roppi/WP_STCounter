<?php
/*
Plugin Name: Simple Title Counter
Description: タイトルの文字数を投稿画面に表示するだけのプラグインです。
Author: Roppi
Version: 0.1
Author URI: http://www.roppi.net
*/

// アクションを追加
add_action( 'admin_head-post.php', 'simple_title_counter_main' );
add_action( 'admin_head-post-new.php', 'simple_title_counter_main' );

// 処理内容
function simple_title_counter_main() {
?>
<script type="text/javascript">
  TITLE_COUNTER_MAX_LENGTH = 32; //スタイルを変更する文字数（必要ない場合は0）

  jQuery(
      function($) {
        // カウンタ更新関数
        function updateTitleCounter() {
          //タイトルの文字数を取得
          var titleLength = $('#title').val().length;

          // 既定の文字数を超える場合はスタイルを変更
          var stCounter = $('#title-counter').text(titleLength);
          if (TITLE_COUNTER_MAX_LENGTH != 0 && titleLength > TITLE_COUNTER_MAX_LENGTH ) {
            stCounter.addClass( 'title-counter-length-over' );
          } else {
            stCounter.removeClass( 'title-counter-length-over' );
          }
        }

        // カウンタ表示部をタイトルの上に追加
        $('#titlewrap')
            .before('<div id="title-counter"></div>')
            .bind('keyup', updateTitleCounter);

        // 初期表示
        updateTitleCounter();
      });
</script>
<style type='text/css'>
  #title-counter {
    text-align: right;
    width: 100%
  }
  .title-counter-length-over {
    color: #f00;
    font-weight: bold;
  }
</style>
<?php
}
