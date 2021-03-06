@include('admin.partials.header')
      <div class="wrapper" id="app">
         <header class="main-header">
            <!-- Logo -->
            <a href="../../index2.html" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>A</b>LT</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>Ecommerce</b></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </a>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="{{ asset('/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
                  </div>
                  <div class="pull-left info">
                     <p>Ibrahim Khalil</p>
                     <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
               </div>
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu">
                  <li class="header">MAIN NAVIGATION</li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                        <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                     </ul>
                  </li>
                  <li>
                    <router-link to="/category"><i class="fa fa-th"></i> <span>Manage Category</span></router-link>
                  </li>
                  <li>
                    <router-link to="/brand"><i class="fa fa-th"></i> <span>Manage Brand</span></router-link>
                  </li>

                  <li>
                    <router-link to="/product"><i class="fa fa-th"></i> <span>Manage Product</span></router-link>
                  </li>

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Layout Options</span>
                     <span class="label label-primary pull-right">4</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                        <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                        <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                        <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="../widgets.html">
                     <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
                     </a>
                  </li>
                  <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Main content -->
            <router-view-component></router-view-component>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <footer class="main-footer">
            <div class="pull-right hidden-xs">
               <b>Version</b> 2.2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
         </footer>
      </div>
      <!-- ./wrapper -->
@include('admin.partials.footer')
