<?php
  global $con=mysqli_connect('localhost', 'root', '','poll');

  session_start();
  //If your session isn't valid, it returns you to the login screen for protection
  if(empty($_SESSION['member_id'])){
   header("location:access-denied.php");
  }
?>
<?php
// retrieving positions sql query
  $positions=mysqli_query($con,"SELECT * FROM tbPositions")
  or die("There are no records to display ... \n" . mysqli_error($con));
  ?>
  <?php
      // retrieval sql query
  // check if Submit is set in POST
   if (isset($_POST['Submit']))
   {
   // get position value
   $position = addslashes( $_POST['position'] ); //prevents types of SQL injection

   // retrieve based on position
   $result = mysqli_query($con,"SELECT * FROM tbCandidates WHERE candidate_position='$position'")
   or die(" There are no records at the moment ... \n");
   // redirect back to vote
   }
   else
   // do something
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Simple PHP Polling System:Voting Page</title>
    <link href="css/user_styles.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="js/user.js"></script>
    <script type="text/javascript">
      function getVote(int)
      {
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

      	if(confirm("Your vote is for "+int))
      	{
      	xmlhttp.open("GET","save.php?vote="+int,true);
      	xmlhttp.send();
      	}
      	else
      	{
      	alert("Choose another candidate ");
      	}

      }

      function getPosition(String)
      {
      if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
        }
      else
        {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

      xmlhttp.open("GET","vote.php?position="+String,true);
      xmlhttp.send();
      }
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
         var j = jQuery.noConflict();
          j(document).ready(function()
          {
              j(".refresh").everyTime(1000,function(i){
                  j.ajax({
                    url: "admin/refresh.php",
                    cache: false,
                    success: function(html){
                      j(".refresh").html(html);
                    }
                  })
              })

          });
         j('.refresh').css({color:"green"});
      });
    </script>
  </head>
  <body bgcolor="tan">
    <center>
    <b><font color = "brown" size="6">Simple PHP Polling System</font></b></center><br><br>
    <div id="page">
      <div id="header">
        <h1>CURRENT POLLS</h1>
        <a href="student.php">Home</a> | <a href="vote.php">Current Polls</a> | <a href="manage-profile.php">Manage My Profile</a> | <a href="logout.php">Logout</a>
      </div>
      <div class="refresh">
      </div>
      <div id="container">
        <table width="420" align="center">
          <form name="fmNames" id="fmNames" method="post" action="vote.php" onSubmit="return positionValidate(this)">
            <tr>
                <td>Choose Position</td>
                <td>
                  <SELECT NAME="position" id="position" onclick="getPosition(this.value)">
                  <OPTION VALUE="select">select
                  <?php
                  //loop through all table rows
                  while ($row=mysqli_fetch_array($positions)){
                  echo "<OPTION VALUE=$row[position_name]>$row[position_name]";
                  }
                  ?>
                  </SELECT>
                </td>
                <td><input type="submit" name="Submit" value="See Candidates" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
          </form>
        </table>
        <table width="270" align="center">
          <form>
            <tr>
                <th>Candidates:</th>
            </tr>
            <?php
            //loop through all table rows
                 if (isset($_POST['Submit']))
              {
                  while ($row=mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td>" . $row['candidate_name']."</td>";
                  echo "<td><input type='radio' name='vote' value='$row[candidate_name]' onclick='getVote(this.value)' /></td>";
                  echo "</tr>";
                  }
                  mysqli_free_result($result);
                  mysqli_close($link);
                  //}
                    }
                  else
                  // do nothing
                  ?>
            <tr>
                <h3>NB: Click a circle under a respective candidate to cast your vote. You can't vote more than once in a respective position. This process can not be undone so think wisely before casting your vote.</h3>
                <td>&nbsp;</td>
            </tr>
          </form>
        </table>
      </div>
      <div id="footer">
        <div class="bottom_addr">&copy; 2017 Simple PHP Polling System. All Rights Reserved</div>
      </div>
    </div>
  </body>
</html>
