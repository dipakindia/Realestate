<html>
<head>
<title>HTML email</title>
</head>
<body>
<table>
  <tbody>
    <tr>
      <td>Dear '.$first_name.',</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>Congratulations! You have successfully regitered.</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>For confermation of your Account: &nbsp;<a href="http://realestate.indiainfosystem.com/verify-email.php?user-email=<?php echo md5($_GET['email']);?>" >click here </a>.</td>
    </tr>
    <tr>
      <td><br></td>
    </tr>
    <tr>
      <td>Regards,</td>
    </tr>
    <tr>
      <td><strong>Canada Latting </strong></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>