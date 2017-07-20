<html>
  <head>
    <title>Google recapcha demo - Codeforgeek</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body>
  	{{ content() }}
    <h1>Google reCAPTHA Demo</h1>
    <form id="comment_form" action=<?php echo $this->url->get('captcha/save') ?> method="post">
      <input type="email" placeholder="Type your email" size="40"><br><br>
      <textarea name="comment" rows="8" cols="39"></textarea><br><br>
      <div class="g-recaptcha" data-sitekey="6LfsMhkUAAAAAIsEzU0hnwXfwDoEH-WrfF0P9U8n"></div></br>
      <input type="submit" name="submit" value="Post comment"><br><br>  
    </form>
  </body>
</html>
