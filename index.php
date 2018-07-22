<!DOCTYPE html>
<html>
<title>Modeule 3  Vertical Software Prototype </title>
 <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link href="css/my.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">


<body>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Search tool</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.html">Home</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li><a href="http://lamp.cse.fau.edu/~pabraham2015/cen-4010/"><span class="glyphicon glyphicon-user"></span> Find Users</a></li>

      </ul>
       
      
   
    

  </nav>
<div class="entra2">
 <div class="intro-message">
  <h6>FAU</h6>
  <div class="container">
      <div class="row">
        <div class="col-sm-10"></div>
        <hr class="section-heading-spacer"></div>        
        <h6>Campus Snapshots</h6>
      </div>
</div>
</div> 

  <section class="content-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-11">
            <hr class="section-heading-spacer">
            <h2 class="section-heading">Vertical Software Prototype</h2>
            
            <p class="lead">This is the vertical prototype, which is the code that exercises full deployment stack from browser, via middleware, to DB and back-end, including your chosen framework. It has been deployed from the team account, in the same way that the final product will be deployed. In this prototype we are performing searches in our main database on the GENERAL_USER table </p>
              
              <p>Enter names that you want to look for on our databe and if the name exist it will return username, role, phone number  and email:</p>
              <p>Ex: Names that exist on the database:</p>
              <p>Peter</p>
              <p>Mary</p>
              
              <p></p>
              <p></p>


                <?php
$output = NULL;
if(isset($_POST['submit'])){
$mysqli = NEW MySQLi("localhost", "nfoster2016", "Not my password", "nfoster2016");
$search = $_POST['search'];
$resultSet = $mysqli->query("SELECT * FROM GENERAL_USER WHERE UserName LIKE '$search%' ");
    if($resultSet->num_rows > 0)
    {
        while($rows = $resultSet->fetch_assoc())
        {
            $UserID = $rows['UserID'];
            $Email = $rows['Email'];
            $UserName = $rows['UserName'];
            $Role = $rows['Role'];
            $Phone = $rows['Phone'];
            $output = "UserName: $UserName <br/> Email: $Email<br/> Role: $Role <br/> Phone: $Phone";
        }
    }
    else{
        echo "No Results found.";
    }

}
?>
    <form method="POST">
    <input type="TEXT" name="search"/>
    <input type="SUBMIT" name="submit" value="Search"/>
    </form>
<?php echo $output;  ?>
              
      <div class="container">
        <div class="row">
          <div class="col-lg-11">
            <hr class="section-heading-spacer">
             <p class="lead">Find All Users or Admin on Campus Snapshots</p>
              <p>Click on the button below to find all the users on the GENERAL_USER table according to their roles:</p>
              <p></p>
              
             <div class="container-fluid text-left">
                 <p></p>
            <a href="http://lamp.cse.fau.edu/~pabraham2015/cen-4010/"class="btn btn-warning" class=btn>Database Search tool</a> 
              
                 
          </div>
            </div>
          </div>          
        </div>
            <div class="container-fluid text-right">
                <div class="starter-template">
                    <br>
                    <a href="https://time.is/United_States" id="time_is_link" rel="nofollow" style="font-size:24px;color:rgb(193, 110, 27)">Current time:</a>
                    <span id="United_States_z161" style="font-size:36px "></span>
                    <script src="//widget.time.is/t.js"></script>
                    <script>
                        time_is_widget.init({United_States_z161:{}});
                    </script>
                </div>
            </div>
  
      
    </section>

        

<footer class="container-fluid text-center">
  
  <p>Module 3 from CEN4010 Vertical software prototype </p> 
  <p>Group Members:</p>    
  <p>Prince Abraham</p>    
  <p>Naiara Foster</p>
  <p>Christian Coronel</p> 
  <p>Alina Tutuianu</p>       
    
</footer>


<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>

    <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>
</html>
