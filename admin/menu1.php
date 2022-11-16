<?php
if(!isset($_SESSION['ses_u_id'])){
	header("location:../index.php");
}
?>
<div class="panel panel-primary">
      <div class="panel-heading">
        <h4 class="panel-title">
              <i class="fas fa-list" aria-hidden="true"></i> เมนูหลัก
        </h4>
      </div>
</div>
<div class="panel-group" id="accordion">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
              <i class="fa fa-cog" aria-hidden="true"></i> Administrator
          </a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
          <div class="panel-body">
              <a href="index_admin.php" class="btn btn-primary btn-block" href><i class="fas fa-home pull-left" aria-hidden="true"></i> หน้าหลัก</a>
              <a href="year.php" class="btn btn-primary btn-block" href><i class="fas fa-calendar-alt  pull-left" aria-hidden="true"></i> จัดการปีปฏิทิน-ทะเบียนเอกสาร</a>
              <a href="year-buy.php" class="btn btn-primary btn-block" href><i class="fas fa-calendar-alt  pull-left" aria-hidden="true"></i> จัดการปีปฏิทิน-ทะเบียนสัญญา</a>
              <a href="object.php" class="btn btn-primary btn-block" href><i class="fas fa-key pull-left"></i> วัตถุประสงค์ </a>
              <a href="speed.php" class="btn btn-primary btn-block"><i class="fas fa-paper-plane pull-left"></i> ชั้นความเร็ว</a>
              <a href="secret.php" class="btn btn-primary btn-block"><i class="fas fa-low-vision pull-left"></i> ชั้นความลับ</a>
              <a href="officeType.php" class="btn btn-primary btn-block"><i class="fas fa-building pull-left"></i> ประเภทหน่วยงาน</a>
              <a href="depart.php" class="btn btn-primary btn-block"><i class="fas fa-building pull-left"></i> หน่วยงานในจังหวัด</a>
              <a href="section.php" class="btn btn-primary btn-block"><i class="fa fa-sitemap pull-left"></i> กลุ่มงาน/สาขาย่อย</a>
              <a href="user_group.php" class="btn btn-primary btn-block"><i class="fas fa-users pull-left"></i> กลุ่มผู้ใช้งาน</a>
              <a href="user.php" class="btn btn-primary btn-block"><i class="fas fa-user pull-left"></i> ผู้ใช้งาน</a>
              <a href="boss.php" class="btn btn-primary btn-block"><i class="fas fa-user-circle pull-left"></i> ผู้บริหาร</a>
              <a href="server-status.php" class="btn btn-primary btn-block"><i class="fas fa-server pull-left"></i> เครื่องแม่ข่าย</a>   
              <a href="static.php" class="btn btn-primary btn-block"><i class="fas fa-chart-pie pull-left"></i> ข้อมูลทั่วไป</a> 
              <a href="backup.php" class="btn btn-primary btn-block"><i class="fas fa-database pull-left"></i> สำรองฐานข้อมูล</a> 
          </div>
      </div>
    </div>
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
              <i class="fa fa-credit-card" aria-hidden="true"></i> ทะเบียนทรัพย์สิน
          </a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
            <a class="btn btn-primary btn-block" href="manage_group.php"><i class="far fa-arrow-alt-circle-right  pull-left"></i> กลุ่มครุภัณฑ์ (Group)</a>
            <a class="btn btn-primary btn-block" href="manage_class.php" ><i class="far fa-arrow-alt-circle-right  pull-left"></i> ชนิดครุภํณฑ์ (Class)</a>
            <a class="btn btn-primary btn-block" href="manage_type.php" ><i class="far fa-arrow-alt-circle-right  pull-left"></i> ประเภทครุภัณฑ์ (Type)</a>
            <a class="btn btn-primary btn-block" href="project.php"><i class="far fa-arrow-alt-circle-right  pull-left"></i> จัดการโครงการ</a> 
        </div>
      </div>
    </div>
 </div>



