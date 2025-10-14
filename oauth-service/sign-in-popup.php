<html>
    <head>
      <style>

      </style>
      <script type = "text/javascript">   
        function sendDataToMainApp() {       
          var userData = <?php echo json_encode($params); ?>;
          window.opener.receiveUserSignedInData(userData);
          window.close();
        }
      </script>
    </head>
    <body onLoad="sendDataToMainApp()">
    </body>
</html>