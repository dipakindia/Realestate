<div class="user-account-box">
                    <div class="header clearfix">
                        <div class="edit-profile-photo">
                            <img src="img/profile-my-property.jpg" alt="agent-1" class="img-responsive">
                            <div class="change-photo-btn">
                                <div class="photoUpload">
                                    <span><i class="fa fa-upload"></i> Upload Photo</span>
                                    <input type="file" class="upload">
                                </div>
                            </div>
                        </div>
                        <h3><?=$_SESSION['userData']['first_name'].' '.$_SESSION['userData']['last_name'];?></h3>
                        <p><?=$_SESSION['userData']['email'];?></p>
                    </div>
                    <div class="content">
                        <ul>
                            <li>
                                <a href="user-profile.php" class="active">
                                    <i class="flaticon-social"></i>Profile
                                </a>
                            </li>
							<?php if($_SESSION['isAgent']){?>
                            <li>
                                <a href="my-properties.php">
                                    <i class="flaticon-apartment"></i>My Properties
                                </a>
                            </li>
                            <li>
                                <a href="submit-property.php">
                                    <i class="fa fa-plus"></i>Submit New Property
                                </a>
                            </li>
							<?php } ?>
                            <li>
                                <a href="change-password.php">
                                    <i class="flaticon-security"></i>Change Password
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="flaticon-sign-out-option"></i>Log Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>