<!-- Navbar contents  -->
	   <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <div style="height:100%" class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>                        
            </button>
            <!--a class="navbar-brand" href="https://www.instagram.com/toylaa/" target="_blank" >SinForge.com</a-->

            <a class="navbar-brand" href="#" ><span class="glyphicon glyphicon-picture"></span> SinForge.com</a>

          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav ">
              <!--li><a href="index.php"><span></span>Home</a></li-->
             
            </ul>

            <ul class="nav navbar-nav navbar-right">              
              <li><a href="#"><span class="glyphicon glyphicon-send"></span> Contact</a></li>
              <li><a id="logoutBtn" href="#"><span class="glyphicon glyphicon-remove-sign"></span> Log Out</a></li>
            </ul>
          </div>
        </div>
      </nav>

      <script type="text/javascript">
        
        $(document).ready(function(){
          //swal("document/jquery loaded");
          $("#logoutBtn").click(function(){
                //Login button clicked                
                logout();
              });
        });

        function logout(){
          //swal("logout called!");
          window.location.href = "assets/logout.php";
        };

      </script>