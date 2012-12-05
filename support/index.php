<html>
  <head>
    <title>Feedback Form</title>
    <style>
      body {
        margin: auto;
        margin-top: 10%;
        font-family: helvetica;
        background-color: #1d3045;
      }
      form {
        margin: auto;
        padding-left: 20px;
        padding-bottom: 20px;
        border: 1px outset grey;
        background-color: #ddd;
        -webkit-border-radius: 5px;
        width: 325px;
      }
      h1 {
        text-shadow: 1px 1px 0px #fff;
      }
      #thanks {
        color: white;
        text-align: center;
        font-size: 50px;
      }
      #button {
        width: 300px;
        font-size: 50px;
        padding: 5px;
      }
    </style>
  </head>
  <body>
    <?php
if (isset($_REQUEST['email']))
//if "email" is filled out, send email
  {
  //send email
  $email = $_REQUEST['email'] ;
  $subject = $_REQUEST['subject'] ;
  $message = $_REQUEST['message'] ;
  mail("nashma4@gmail.com", "$subject",
  $message, "From:" . $email);
    echo "<div id='thanks'>Thank you!</div>";
  }
else
//if "email" is not filled out, display the form
  {
    echo "<form method='post'>
    <h1>HTMLTIE Feedback</h1>
    Email: <input name='email' size='45px' autofocus required type='text' /><br /><br/>
    Subject: <input name='subject' size='43px' type='text' /><br /><br/>
    Message:<br />
    <textarea name='message' rows='5' cols='40'></textarea><br />
    <input id='button' type='submit' />
    </form>";
  }
?>

</body>
</html>