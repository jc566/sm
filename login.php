<?PHP include "pages/template/header.php"?>
<?PHP //include "pages/template/left_bar.php"?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <h1>
        General Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>-->

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Sunmint Login</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group " id="email_field_wrap">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10">
                    <input type="email" id="email" class="form-control"  placeholder="Email" required>
                     <span class="help-block" id="email_field_error" style="display:none;">Provide valid email.!</span>
                  </div>
                </div>

                <div class="form-group" id="password_field_wrap">
                  <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" id="password" class="form-control"  placeholder="Password" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
             <!--   <button type="submit" class="btn btn-default">Cancel</button>-->
                <button type="submit" class="btn btn-info pull-right login_btn">Sign in</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <?PHP include "pages/template/footer.php"?>
