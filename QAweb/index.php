<?php
    session_start();
    include "database/connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style type="text/css">
		li a:hover{
			background-color:#0000ff;
		}
		
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-sm" style="background-color:#00ffff">
		<div class="navbar-nav navbar-expand">
			<ul class="navbar-nav ml-md-5">
				<li class="nav-item p-2 ml-md-5">
					<a href="index.php"><img src="/QAweb/img/logouet.png" width="60px"></a>
				</li>
				<li class="nav-item p-2">
					<a href="index.php"><img src="/QAweb/img/logoqa.png" width="60px"></a>
				</li>
			</ul>
		</div>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style="background-color:#333333;color:white;height:50px">
	        MENU
        </button>
	 
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
	        <ul class="navbar-nav ml-auto">
	            <li class="nav-item m-1">
                    <?php
                        if(!isset($_SESSION['us_id'])){
                            echo "<a class='nav-link' href='login.php' > Dang Nhap </a>";
                        } else {
                            $id = $_SESSION['us_id'];
                            $sql = "SELECT u.name, u.user_id, r.role_name, u.role_id FROM users u INNER JOIN roles r ON r.role_id = u.role_id WHERE u.user_id = '$id'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo "
                                <a class='nav-link' href='' data-toggle='collapse' data-target='#quanly' 
                                        style='color:black;font-weight:bold;font-size: 20px'>
                                        <img src='/QAweb/img/user.png' width='30px'>
                                " . $row['name'] . "</a>
                            ";
                        }
                    ?>
	            </li>
	        </ul>
	    </div>
    </nav>


    
    <div class= "container-fluid collapse" id="quanly">
         <div class= "row justify-content-end">
            <div class ="col-md-3" style="background-color:#007fff">
            	<div class="card m-3" style="float:left;">
            		<img src="/QAweb/img/user.png" width="80px">	
            	</div>
            	<div class="card m-3" style="background-color:#e5e5e5">
            		<div class="row">
            			<div class="col-md-9">
            				<img src="/QAweb/img/user.png" width="30px"> <?php echo $row['name'] . " ( ". $row['user_id'] . " )";  ?>
            			</div>
            		</div>

            		<div class="row">
            			<div class="col-md-9">
            				<img src="/QAweb/img/mu.png" width="30px"> Vai tro : <?php echo $row['role_name']; ?>
            			</div>
            		</div>

            		<div class="row">
            			<div class="col-md-9">
							<img src="/QAweb/img/donghonguoc.png" width="30px"> 
							<a href="SuaThongTinNguoiDung.php">Cập nhập thông tin</a>
            			</div>
					</div>
                    <?php
                        if ($row['role_id'] <= 2){
                            echo "
                                <div class='row'>
                                    <div class='col-md-9'>
                                        <img src='/QAweb/img/donghonguoc.png' width='30px'> 
                                        <a href='teacher/'>Tư cách giao vien</a>
                                    </div>
                                </div>
                            ";
                        }
                    ?>

            		<div class="row">
            			<div class="col-md-9">
            				<img src="/QAweb/img/donghocat.png" width="30px"> <a href="logout.php">Dang xuat</a>
            			</div>
            		</div>
            	</div>
            </div>
         </div>
    </div>

    <div class="card">
    	<div class="card-body">
    		<div style="background-color:#e5e5e5;width:100%;height:800px;">

	    		<nav class="navbar navbar-expand-sm" style="background-color:gray;width:100%;">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#danhsachphienhoidap" style="background-color:#333333;color:white;height:50px">
				        Danh sách
				    </button>
	 
				    <div class="collapse navbar-collapse">
				        <ul class="navbar-nav mr-auto" style="background-color:#00ffff">
				            <li class="nav-item m-1">
				                <a class="nav-link" href="#" data-toggle="collapse" data-target="#danhsachphienhoidap" style="color:black;font-weight:bold;font-size: 20px">Danh sách phiên hỏi đáp <img src="/QAweb/img/danhsachqa.png" width="50px"></a>
				            </li>
				        </ul>
				    </div>

				    <ul class="navbar-nav ml-auto">
			           <li class="nav-item">
			              <input type="text" class="form-control" placeholder="Search">
			           </li>
			           <li class="nav-item">
			              <button type="submit"><img src="/QAweb/img/timkiem.png" width="30px"></button>
			           </li>
        		    </ul>

				</nav>

				<div class= "container-fluid collapse" id="danhsachphienhoidap">
			        <div class= "row justify-content-start">
                        <div class ="col-md-3" style="background-color:#00ff00">
                            <div >
				               	<a href="index.php">
				               		Tất cả các phiên
				               	</a>
                              </div>
                              <br>
			               <div >
				               	<a href="index.php?status=action">
				               		Phiên hỏi đáp đang hoạt động
				               	</a>
                              </div>
                              <br>
			               <div>
				               	<a href="index.php?status=close">
				               		Phiên hỏi đáp đã đóng
				               	</a>
			           	   </div>
			               <br>
			            </div>
			        </div>
                </div>

                <?php include('show_session.php'); ?>
            </div>
            
        </div>
        
    </div>

    
</body>

</html>