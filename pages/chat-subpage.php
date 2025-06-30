<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../static/css/ty.css">
    <link rel="stylesheet" href="../static/css/load.css">
    <title>留言板 - Moey</title>
    <style>
      body {
        font-family:Arial, sans-serif;
        margin:0;
        padding:0;
      }
      .container {
        max-width:900px;
        margin:0 auto;
        padding:10px;
      }
      h1 {
        text-align:center;
        font-size:2rem;
        margin-bottom:20px;
		font-family:sq;
      }
      form {
        display:flex;
        flex-direction:column;
        margin-bottom:20px;
      }
      label {
        font-family:dk;
        display: block;
        margin-bottom:10px;
        cursor:url('../images/default.cur'),default;
      }
      input[type="text"],
      textarea {
        padding:10px;
        border:1px solid #ccc;
        border-radius:4px;
        margin-bottom:20px;
        font-size:1rem;
        cursor:url('../images/text.cur'),text;
      }
      textarea {
        resize:vertical;
        min-height:100px;
        cursor:url('../images/text.cur'),text;
      }
      input[type="submit"] {
        background-color:#FF69B4;
        color:#fff;
        border:none;
        padding:10px;
        border-radius:4px;
        cursor:pointer;
        font-size:1rem;
      }
      input[type="submit"]:hover {
        background-color:#FF1493;
        cursor:url('../images/pointer.cur'),pointer;
      }
      select {
        display:block;
        width:100%;
        padding:5px;
        margin-bottom:10px;
        border:1px solid #ccc;
        border-radius:3px;
        cursor:url('../images/default.cur'),default;
      }
      .messages {
        list-style:none;
        margin:0;
        padding:0;
      }
    input[type="email"],
      textarea {
        padding:10px;
        border:1px solid #ccc;
        border-radius:4px;
        margin-bottom:20px;
        font-size:1rem;
        cursor:url('../images/text.cur'),text;
      }
      .message {
        border:1px dashed #FF69B4;
        border-radius:4px;
        padding:10px;
        margin-bottom:20px;
      }
      .message:hover {
        border:1px solid #FF69B4;
      }
      .message__header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:10px;
      }
      .message__author {
        font-weight:bold;
        font-family:sq;
      }
      .message__date {
        color:#777;
        font-family:sq;
        font-size: 0.9rem;
      }
      .message__content {
        white-space:pre-wrap;
        font-family:sq;
      }
      .message__emoji {
        font-size:1.5rem;
        margin-top:5px;
      }
    </style>
    <script src='../static/js/jquery-3.7.0.min.js'></script>
	<script src='../static/js/load.js'></script>
  </head>
  <body>
    <div class="loaderbg">
		<div class="loading"></div>
		<p class="loadp">Loading</p>
	</div>
	<noscript>
		<style>
		.loaderbg {
			display: none;
		}
		</style>
	</noscript>
    <div class="container">
      <div style="background:rgba(255,255,255,0.7); border: 2px dashed #C0C0C0; min-height: 50px; font-size: 16px; line-height: 1.5; margin: 5px; border-radius: 0.8em;padding: 10px;">
      <div id="rin-bg"></div>
      <h1>萌言萌语</h1>
      <form id="message-form" method="post" action="save_message.php">
        <label for="name">昵称：</label>
        <input type="text" id="name" name="name" required />
        <label for="email">邮箱：</label>
        <input type="email" id="email" name="email" required />
        <label for="message">留言：</label>
        <textarea id="message" name="message" required></textarea>
        <font color="#606060" style="font-family:sq;">你想清楚了！好好说！╭(°A°`)╮</font>
        <label for="emoji">表情：</label>
        <select id="emoji" name="emoji">
          <option value="😁">😁 开心</option>
          <option value="😭">😭 伤心</option>
          <option value="😡">😡 生气</option>
          <option value="😂">😂 笑出泪</option>
          <option value="😍">😍 心动</option>
          <option value="🤔">🤔 思考</option>
          <option value="👀">👀 观察</option>
          <option value="👍">👍 点赞</option>
        </select>
        <input type="submit" value="Biu～发射！" />
      </form>
      <!-- 留言列表 -->
      <ul id="messages" class="messages">
        <?php
        // 创建数据库连接
        require"../config/config.php";
        $conn = new mysqli($servername, $username, $password, $dbname);
        // 检查连接是否成功
        if ($conn->connect_error) {
            die('数据库连接失败: ' . $conn->connect_error);
        }
        // 查询留言数据
        $sql = 'SELECT * FROM messages ORDER BY date DESC';
        $result = $conn->query($sql);

if ($result !== false) {
    // 处理查询结果
        // 输出留言列表
        if ($result !== false && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<li class="message">';
                echo '<div class="message__header">';
                echo '<span class="message__author">' . $row['name'] . '</span>';
                echo '<span class="message__date">' . $row['date'] . '</span>';
                echo '</div>';
                echo '<div class="message__content">' . $row['message'] . '</div>';
                echo '<span class="message__emoji">' . $row['emoji'] . '</span>';
                echo '</li>';
            }
        } else {
            echo '<li class="message">暂无留言，快来抢占沙发叭</li>';
        }
        }

        // 关闭数据库连接
        $conn->close();
        ?>
      </ul>
      </div>
      <center style="animation: shake 1s;animation-iteration-count: infinite;"><font color="#606060">¯\_(ツ)_/¯</font></center>
    </div>
    <script src="../static/js/ty.js"></script>
  </body>
</html>