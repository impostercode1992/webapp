<html>
    <head>
      <script src="script.js"></script>
    </head>
    <body onload="initOnLoad()">      
      <h1>SITE TWO</h1>
      <header class="navHeader">
        <div id="mainMenuContainer">
          <ul>
            <li class="active"><a href="index.php">HOME</a></li>
            <li><a href="products.php">PRODUCTS</a></li>
            <li><a href="about.php">ABOUT</a></li>
          </ul>

        </div>
        <div id="myAccount">
          <a href="#" onclick="showModalPopUp()">Log-In</a>
        </div>        
        <a href="https://www.norsats.my/oauth-service/sign-in.php?site=norsats&page=index.php">kkk</a>
      </header>
      <div style="clear:both"></div>
      <p>This example shows the simplest way of authentication using popup window which is doing HTTP GET method and redirect the user to authentiaction provider, and back to this WEB site.</p>
    </body>
</html>
