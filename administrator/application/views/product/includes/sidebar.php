<div class="sidebar-category sidebar-category-visible">
  <div class="category-content no-padding">
    <ul class="navigation navigation-main navigation-accordion">
      <!-- Main -->
      <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
      <li <?php if($menuTrigger == '1'){?>class="active"<?php }?>><a href="index.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
      <li <?php if($menuTrigger == '2' || $menuTrigger == '3'){?>class="active"<?php }?>> <a href="#"><i class="icon-stack2"></i> <span>Feeds
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '2'){?>class="active"<?php }?>><a href="manage_events.php">ANCE Feeds</a></li>
          <li <?php if($menuTrigger == '3'){?>class="active"<?php }?>><a href="add_event.php">Add Feed</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == '4'){?>class="active"<?php }?>> <a href="manage_users.php" onclick="window.location='manage_users.php'"><i class="icon-users"></i> <span>ANCE Users
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a> </li>
      <li <?php if($menuTrigger == '5' || $menuTrigger == '6'){?>class="active"<?php }?>> <a href="#"><i class="icon-volume-high"></i> <span>ANCE Speakers
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '5'){?>class="active"<?php }?>><a href="manage_speakers.php">Speakers</a></li>
          <li <?php if($menuTrigger == '6'){?>class="active"<?php }?>><a href="add_speaker.php">Add Speaker</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == '7' || $menuTrigger == '8'){?>class="active"<?php }?>> <a href="#"><i class="icon-stack-star"></i> <span>ANCE Sponsors/Exhibitors
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '7'){?>class="active"<?php }?>><a href="manage_sponsers.php">Sponsors/Exhibitors</a></li>
          <li <?php if($menuTrigger == '8'){?>class="active"<?php }?>><a href="add_sponser.php">Add Sponser</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == '9' || $menuTrigger == '10'){?>class="active"<?php }?>> <a href="#"><i class="icon-sphere"></i> <span>ANCE Agenda
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '9'){?>class="active"<?php }?>><a href="manage_agenda.php">All Agenda</a></li>
          <li <?php if($menuTrigger == '10'){?>class="active"<?php }?>><a href="add_agenda.php">Add Agenda</a></li>
        </ul>
      </li>
	    <li <?php if($menuTrigger == '11' || $menuTrigger == '12'){?>class="active"<?php }?>> <a href="#"><i class="icon-lan"></i> <span>ANCE Raffle</span></a>
        <ul>
          <li <?php if($menuTrigger == '11'){?>class="active"<?php }?>><a href="manage_refral.php">All ANCE Raffle</a></li>
          <li <?php if($menuTrigger == '12'){?>class="active"<?php }?>><a href="add_refral.php">Add ANCE Raffle</a></li>
        </ul>
      </li>
	  	    <li <?php if($menuTrigger == '15' || $menuTrigger == '16'){?>class="active"<?php }?>> <a href="#"><i class="icon-lan"></i> <span>ANCE Awards</span></a>
        <ul>
          <li <?php if($menuTrigger == '15'){?>class="active"<?php }?>><a href="manage_awards.php"> ANCE Awards</a></li>
          <li <?php if($menuTrigger == '16'){?>class="active"<?php }?>><a href="add_awards.php">Add Award</a></li>
        </ul>
      </li>
	  	    <li <?php if($menuTrigger == '13' || $menuTrigger == '14'){?>class="active"<?php }?>> <a href="#"><i class="icon-lan"></i> <span>Manage Blogs</span></a>
        <ul>
          <li <?php if($menuTrigger == '13'){?>class="active"<?php }?>><a href="manage_blogs.php">All Blogs</a></li>
  <?php /*?>        <li <?php if($menuTrigger == '14'){?>class="active"<?php }?>><a href="add_blog.php">Add Blog</a></li><?php */?>
        </ul>
      </li>
    </ul>
  </div>
</div>
