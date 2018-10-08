<?php 
  $foto = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE siswa_id = '$_SESSION[siswa_id]'");
  $f = mysqli_fetch_assoc($foto);
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($f['foto'] != '') { ?>
          <img data-toggle='modal' data-target='#modal' src="<?php echo $base_url ?>/imgs/profile/<?php echo $f['foto'] ?>" class="img-circle" alt="User Image">
          <?php } elseif($f['kelamin'] == 'Laki-Laki') { ?>
            <img data-toggle='modal' data-target='#modal' src="<?php echo $base_url; ?>/assets/lte/dist/img/male.png" class="img-circle" alt="User Image">
          <?php } else { ?>
            <img data-toggle='modal' data-target='#modal' src="<?php echo $base_url; ?>/assets/lte/dist/img/female.png" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo @$_SESSION['panggilan'] ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>

        <?php  
          
          $data = mysqli_query($conn, "SELECT * FROM ujian_menu WHERE menu_status = '1' AND menu_issiswa = 1 ORDER BY menu_id ASC");
          while($row=mysqli_fetch_assoc($data))
          {
            

            if($row['menu_url'] == '')
            { 
              $__data = mysqli_query($conn, "SELECT * FROM ujian_menu_detail WHERE menudetail_status = '1' AND menudetail_issiswa = '1' AND menudetail_menuid = '$row[menu_id]' ORDER BY menudetail_sort ASC");
              $__row=mysqli_fetch_assoc($__data);
          ?>

              <li class='treeview'>
                <a href="#">
                  <i class="<?php echo $row['menu_icon']; ?>"></i> <span><?php echo $row['menu_nama']; ?></span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                <?php  
                  $_data = mysqli_query($conn, "SELECT * FROM ujian_menu_detail WHERE menudetail_status = '1' AND menudetail_issiswa = '1' AND menudetail_menuid = '$row[menu_id]' ORDER BY menudetail_sort ASC");
                  while($_row=mysqli_fetch_assoc($_data))
                  {

                ?>
                  <li class='detail'><a href="<?php echo $_row['menudetail_url']; ?>"><i class="<?php echo $_row['menudetail_icon']; ?>"></i> <?php echo $_row['menudetail_nama']; ?></a></li>
                  <?php 
                  }
                   ?>
                </ul>
              </li>

          <?php 
            }
            else
            { 
          ?>
              <li class='<?php if($_GET['q'] == str_replace('?q=', '', $row['menu_url'])){ echo 'active'; } else { echo ''; } ?>'>
                <a href="<?php echo $row['menu_url']; ?>">
                  <i class="<?php echo $row['menu_icon']; ?>"></i> <span><?php echo $row['menu_nama']; ?></span>
                  <span class="pull-right-container">
                    <!-- <small class="label pull-right bg-green">new</small> -->
                  </span>
                </a>
              </li>
          <?php
            }
          }


        ?>
      </ul>
    </section>

    
    <!-- /.sidebar -->
  </aside>

  <script type="text/javascript">
    $(document).ready(function(){
      var treeview = $('.treeview');
      var detail = $('.detail');

      $(detail).click(function(){
          $(treeview).addClass("active");
      });

    });
  </script>