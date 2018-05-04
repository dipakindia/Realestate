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
      <li <?php if($menuTrigger == '4'){?>class="active"<?php }?>> <a href="manage_users.php" onclick="window.location='manage_users.php'"><i class="icon-users"></i> <span>Registered Users
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a> </li>
      <li <?php if($menuTrigger == '5' || $menuTrigger == '6'){?>class="active"<?php }?>> <a href="#"><i class="icon-volume-high"></i> <span>Speaker Records
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '5'){?>class="active"<?php }?>><a href="manage_speakers.php">All Speakers</a></li>
          <li <?php if($menuTrigger == '6'){?>class="active"<?php }?>><a href="add_speaker.php">Add Speaker</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == '7' || $menuTrigger == '8'){?>class="active"<?php }?>> <a href="#"><i class="icon-stack-star"></i> <span>Manage Sponsers
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '7'){?>class="active"<?php }?>><a href="manage_sponsers.php">All Sponsers</a></li>
          <li <?php if($menuTrigger == '8'){?>class="active"<?php }?>><a href="add_sponser.php">Add Sponser</a></li>
        </ul>
      </li>
      <li <?php if($menuTrigger == '9' || $menuTrigger == '10'){?>class="active"<?php }?>> <a href="#"><i class="icon-sphere"></i> <span>Manage Agenda
        <!--<span class="label bg-blue-400">1.3</span>-->
        </span></a>
        <ul>
          <li <?php if($menuTrigger == '9'){?>class="active"<?php }?>><a href="manage_agenda.php">All Agenda</a></li>
          <li <?php if($menuTrigger == '10'){?>class="active"<?php }?>><a href="add_agenda.php">Add Agenda</a></li>
        </ul>
      </li>
	    <li <?php if($menuTrigger == '11' || $menuTrigger == '12'){?>class="active"<?php }?>> <a href="#"><i class="icon-lan"></i> <span>Manage ANCE Refral</span></a>
        <ul>
          <li <?php if($menuTrigger == '11'){?>class="active"<?php }?>><a href="manage_refral.php">All ANCE Refral</a></li>
          <li <?php if($menuTrigger == '12'){?>class="active"<?php }?>><a href="add_refral.php">Add ANCE Refral</a></li>
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
