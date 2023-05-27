<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->



    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
        <a href="{{ route('logout') }}" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
    </li>
    <!-- END SIGN OUT -->
    <!-- SEARCH -->
    <li class="xn-search pull-right">
        <form role="form">
            <input type="text" name="search" placeholder="Search..." />
        </form>
    </li>
    <!-- END SEARCH -->


    <li class="xn-title animated fadeIn pull-right">
        <div class="widget-big-int plugin-clock">00:00</div>
    </li>

    <li class="xn-title animated fadeIn pull-right">
        <div class="widget-subtitle plugin-date">Loading...</div>
    </li>



    <!-- MESSAGES -->
    <!-- <li class="xn-icon-button pull-right">
      <a href="#"><span class="fa fa-comments"></span></a>
      <div class="informer informer-danger">4</div>
      <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
              <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
              <div class="pull-right">
                  <span class="label label-danger">4 new</span>
              </div>
          </div>
          <div class="panel-footer text-center">
              <a href="pages-messages.html">Show all messages</a>
          </div>
      </div>
  </li> -->
    <!-- END MESSAGES -->

</ul>
<!-- END X-NAVIGATION VERTICAL -->
