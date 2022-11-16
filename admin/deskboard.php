 <link rel="stylesheet" href="../css/note.css">
 <div class="row">
    <div class="col-md-2">
        <?php  //ตรวจสอบสิทธิ์การใช้งานเมนู
        $menu = checkMenu($level_id);
        include $menu;

        // echo "is".$level_id;
        ?>
    </div>
    <div class="col-md-10">
        <div class="container-fluid" >
            <?php
            $sql = "SELECT COUNT(puid) AS pcount FROM paperuser WHERE confirm = 0 AND dep_id = $dep_id AND sec_id = $sec_id";
            $result = dbQuery($sql);
            $row = dbFetchArray($result);
            ?>
            <?php
            if ($level_id < 4) {
                ?>
            <div class="row" >
                <div class="col-md-3">
                    <div class="bg-danger">
                        <center>
                         <a href="#" data-toggle="tooltip1" title="เอกสารจากส่วนราชการต่าง ๆ!">
                            <i class="fas fa-envelope fa-4x"></i>
                            <h5>แผนพัฒนาจังหวัด <span class="badge"><?php //echo $row['pcount']; ?></span></h5>
                         </a>
                        </center>
                        </div>
                    </div>
                    <?php
                    $sql = "SELECT m.book_id,m.rec_id,d.book_no,d.title,d.sendfrom,d.sendto,d.date_in,d.date_line,d.practice,d.status,s.sec_code
                        FROM book_master m
                        INNER JOIN book_detail d ON d.book_id = m.book_id
                        INNER JOIN section s ON s.sec_id = m.sec_id
                        WHERE m.type_id=1 AND d.status ='' AND d.practice=$dep_id";
                $result = dbQuery($sql);
                $num = dbNumRows($result); ?>    
                <div class="col-md-3">
                    <div class="bg-danger">
                        <center>
                            <a href="#">
                                <i class="fas fa-book fa-4x"  ></i>
                                <h5>ข้อมูลจังหวัด</h5>
                            </a>
                        </center>   
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="bg-danger">
                        <center>
                            <a href="#">
                                <i class="fas fa-eye fa-4x"></i>
                                <h5>หนังสือเวียน</h5>
                            </a>
                        </center>   
                    </div>
                </div>    
                <div class="col-md-3">
                    <div class="bg-danger">
                        <center>
                            <a href="#">
                            <i class="fas fa-bell fa-4x"></i<i class="fas fa-book fa-4x"  ></i>
                            <h5>ประชาสัมพันธ์</h5>
                                </a>
                        </center>
                    </div>
                </div>
               </div>    
            <?php
            } ?>
                <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-danger">
                                    <div class="panel-heading">Shot Menu</div>
                                    <div class="panel-body">
                                        <div class="col-md-3">
                                            <div class="bg-success">
                                                <div class="panel-group">
                                                    <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" href="#menu1"><center><i class="fa fa-briefcase fa-2x text-center"></i><br> ทะเบียนทรัพย์สินจังหวัด</center></a>
                                                        </h4>
                                                    </div>
                                                    <div id="menu1" class="panel-collapse collapse">
                                                   
                                                        <ul class="list-group">
                                                        <!-- <li class="list-group-item"><a href="flow-resive-province.php" class="btn btn-primary">หนังสือรับจังหวัด</a> <i class="fas fa-thumbtack"></i><small> หนังสือถึงผู้ว่าราชการจังหวัด</small></li> -->
                                                        <!-- <li class="list-group-item"><a href="FlowResiveDepart.php" class="btn btn-primary">หนังสือรับหน่วยงาน</a> <i class="fas fa-thumbtack"></i><small>หนังสือเข้าส่วนราชการ/หน่วยงาน</small> </li> -->
                                                        <!-- <li class="list-group-item"><a href="flow-resive-group.php" class="btn btn-primary">หนังสือรับกลุ่มงาน/ฝ่าย</a> <i class="fas fa-thumbtack"></i><small>หนังสือเข้าระดับกลุ่ม/ฝ่าย</small> </li> -->
                                                        <!-- <li class="list-group-item"><a href="flow-resive-depart.php" class="btn btn-primary">หนังสือรับจากจังหวัด</a> <i class="fas fa-thumbtack"></i><small>หนังสือรับจากจังหวัด</small> </li> -->
                                                        <!-- <hr> -->
                                                        <li class="list-group-item"><a href="flow-circle.php" class="btn btn-primary ">เพิ่มโครงการ</a> 
                                                        <li class="list-group-item"><a href="flow-normal.php" class="btn btn-primary">คู่มือการออกเลขหมายเลขครุภัณฑ์</a> 
                                                        <li class="list-group-item"><a href="flow-command.php" class="btn btn-primary">คู่มือการใช้งานระบบ</a> 
                                                        </ul>
                                                    
                                                        <div class="panel-footer"></div>
                                                    </div>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="bg-success">
                                                <div class="panel-group">
                                                    <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" href="#menu2"><center><i class="fas fa-credit-card fa-2x"></i><br> ผลการเบิกจ่ายงบประมาณ</center></a>
                                                        </h4>
                                                    </div>
                                                    <div id="menu2" class="panel-collapse collapse">
                                                        <ul class="list-group">
                                                            <li class="list-group-item"><a href="hire.php" class="btn btn-primary">งบจังหวัด</a> 
                                                            <li class="list-group-item"><a href="buy.php" class="btn btn-primary">งบกลุ่มจังหวัด</a> 
                                                            <!-- <li class="list-group-item"><a href="announce.php" class="btn btn-primary">เอกสารประกวดราคา</a> <i class="fas fa-thumbtack"></i><small>ทะเบียนคุมเอกสารประกวดราคา</small> </li> -->
                                                        </ul>
                                                                                                            <div class="panel-footer"></div>
                                                    </div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                        
                                        <div class="col-md-3">
                                            <div class="bg-success">
                                                 <div class="panel-group">
                                                    <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" href="#menu4"><center><i class="fas fa-gopuram fa-2x"></i><br> eMENSCR</center></a>
                                                        </h4>
                                                    </div>
                                                    <div id="menu4" class="panel-collapse collapse">
                                                   
                                                        <ul class="list-group">
                                                        <li class="list-group-item"><a class="btn btn-primary" href="meet_index.php"><i class="fas fa-envelope  pull-left"></i>  อยู่ระหว่างการเชื่อมข้อมูล</a>
                                                        <li class="list-group-item"><a class="btn btn-primary" href="meet_index.php"><i class="far fa-envelope-open  pull-left"></i>  อยู่ระหว่างการเชื่อมข้อมู</a> 
                                                        <li class="list-group-item"><a class="btn btn-primary" href="meet_room_user.php"><i class="fas fa-folder-open  pull-left"></i>  อยู่ระหว่างการเชื่อมข้อมู</a> 
                                                        </ul>
                                                   
                                                        <div class="panel-footer"></div>
                                                    </div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="bg-success">
                                                 <div class="panel-group">
                                                    <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" href="#menu5"><center><i class="fas fa-address-book fa-2x"></i><br> สมุดโทรศัพท์จังหวัด</center></a>
                                                        </h4>
                                                    </div>
                                                    <div id="menu5" class="panel-collapse collapse">
                                                    
                                                        <ul class="list-group">
                                                        <li class="list-group-item"><a class="btn btn-primary" href="http://www.phone.phatthalung.go.th/" target="_news"><i class="fas fa-home  pull-left"></i>  สมุดโทรศัพท์จังหวัด</a>
                                                        <!-- <li class="list-group-item"><a class="btn btn-primary" href="phone_depart.php"><i class="fas fa-school  pull-left"></i>  ข้อมูลหน่วยงาน</a> -->
                                                        <!-- <li class="list-group-item"><a class="btn btn-primary" href="headoffice.php"><i class="far fa-user-circle  pull-left"></i>  ข้อมูลผู้บริหาร/เจ้าหน้าที่</a>  -->
                                                        <!-- <li class="list-group-item"><a class="btn btn-primary" href="excel.php"><i class="fas fa-file-export  pull-left"></i>  ส่งออกเป็น Excel</a>  -->
                                                        </ul>
                                                    
                                                        <div class="panel-footer"></div>
                                                    </div>
                                                    </div>
                                                </div>    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div> <!-- row -->

   

              
            </div> <!-- container  -->
        </div>

