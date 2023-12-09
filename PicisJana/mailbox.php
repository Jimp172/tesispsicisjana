
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Admin Dashboard</title>
        <!-- style css php -->
        <?php include_once 'css_style/style.php';?>
        <link href="css/profile_style.css" rel="stylesheet">
		<!-- end style css php -->
	<body>
		<div id="wrapper">
            <!-- nav -->
            <?php include_once 'sidebar/nav_dashboard.php';?>
			<!-- end nav -->
			<div id="page-wrapper" class="gray-bg dashbard-1">
                <!-- navbar -->
                <?php include_once 'sidebar/navbar.php';?>
                <!-- end navbar -->
				<div class="wrapper wrapper-content">
                    <div class="row wrapper border-bottom white-bg page-heading">
                        <div class="col-lg-10">
                            <h2>Mailbox</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="welcome.php">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a>Extra Pages</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    <strong>mailbox</strong>
                                </li>
                            </ol>
                        </div>
                    </div>
                    <br>
                    
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="ibox ">
                                    <div class="ibox-content mailbox-content">
                                        <div class="file-manager">
                                            <a class="btn btn-block btn-primary compose-mail" href="mail_compose.php">Compose Mail</a>
                                            <div class="space-25"></div>
                                            <h5>Folders</h5>
                                            <ul class="folder-list m-b-md" style="padding: 0">
                                                <li><a href="mailbox.php"> <i class="fa fa-inbox "></i> Inbox <span class="label label-warning float-right">16</span> </a></li>
                                                <li><a href="mailbox.php"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                                                <li><a href="mailbox.php"> <i class="fa fa-certificate"></i> Important</a></li>
                                                <li><a href="mailbox.php"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger float-right">2</span></a></li>
                                                <li><a href="mailbox.php"> <i class="fa fa-trash-o"></i> Trash</a></li>
                                            </ul>
                                            <h5>Categories</h5>
                                            <ul class="category-list" style="padding: 0">
                                                <li><a href="#"> <i class="fa fa-circle text-navy"></i> Work </a></li>
                                                <li><a href="#"> <i class="fa fa-circle text-danger"></i> Documents</a></li>
                                                <li><a href="#"> <i class="fa fa-circle text-primary"></i> Social</a></li>
                                                <li><a href="#"> <i class="fa fa-circle text-info"></i> Advertising</a></li>
                                                <li><a href="#"> <i class="fa fa-circle text-warning"></i> Clients</a></li>
                                            </ul>
                                            <h5 class="tag-title">Labels</h5>
                                            <ul class="tag-list" style="padding: 0">
                                                <li><a href=""><i class="fa fa-tag"></i> Family</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Work</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Home</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Children</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Holidays</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Music</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Photography</a></li>
                                                <li><a href=""><i class="fa fa-tag"></i> Film</a></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 animated fadeInRight">
                                <div class="mail-box-header">
                                    <form method="get" action="index.html" class="float-right mail-search">
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-sm" name="search" placeholder="Search email">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    <h2> Inbox (16)</h2>
                                    <div class="mail-tools tooltip-demo m-t-md">
                                        <div class="btn-group float-right">
                                            <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                                            <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>
                                        </div>
                                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as read"><i class="fa fa-eye"></i> </button>
                                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Mark as important"><i class="fa fa-exclamation"></i> </button>
                                        <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>

                                    </div>
                                </div>
                                <div class="mail-box">
                                    <table class="table table-hover table-mail">
                                        <tbody>
                                            <tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Anna Smith</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Lorem ipsum dolor noretek imit set.</a></td>
                                                <td class=""><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">6.10 AM</td>
                                            </tr>
                                            <tr class="unread">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks" checked>
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Jack Nowak</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Aldus PageMaker including versions of Lorem Ipsum.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">8.22 PM</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Facebook</a> <span class="label label-warning float-right">Clients</span> </td>
                                                <td class="mail-subject"><a href="mail_detail.php">Many desktop publishing packages and web page editors.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Jan 16</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Mailchip</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">There are many variations of passages of Lorem Ipsum.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Mar 22</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Alex T.</a> <span class="label label-danger float-right">Documents</span></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Lorem ipsum dolor noretek imit set.</a></td>
                                                <td class=""><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">December 22</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Monica Ryther</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">The standard chunk of Lorem Ipsum used.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Jun 12</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Sandra Derick</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Contrary to popular belief.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">May 28</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Patrick Pertners</a> <span class="label label-info float-right">Adv</span></td>
                                                <td class="mail-subject"><a href="mail_detail.php">If you are going to use a passage of Lorem </a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">May 28</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Michael Fox</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Humour, or non-characteristic words etc.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Dec 9</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Damien Ritz</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Oor Lorem Ipsum is that it has a more-or-less normal.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Jun 11</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Anna Smith</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Lorem ipsum dolor noretek imit set.</a></td>
                                                <td class=""><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">6.10 AM</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Jack Nowak</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Aldus PageMaker including versions of Lorem Ipsum.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">8.22 PM</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Mailchip</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">There are many variations of passages of Lorem Ipsum.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Mar 22</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Alex T.</a> <span class="label label-warning float-right">Clients</span></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Lorem ipsum dolor noretek imit set.</a></td>
                                                <td class=""><i class="fa fa-paperclip"></i></td>
                                                <td class="text-right mail-date">December 22</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Monica Ryther</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">The standard chunk of Lorem Ipsum used.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Jun 12</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Sandra Derick</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Contrary to popular belief.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">May 28</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Patrick Pertners</a> </td>
                                                <td class="mail-subject"><a href="mail_detail.php">If you are going to use a passage of Lorem </a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">May 28</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Michael Fox</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Humour, or non-characteristic words etc.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Dec 9</td>
                                            </tr>
                                            <tr class="read">
                                                <td class="check-mail">
                                                    <input type="checkbox" class="i-checks">
                                                </td>
                                                <td class="mail-ontact"><a href="mail_detail.php">Damien Ritz</a></td>
                                                <td class="mail-subject"><a href="mail_detail.php">Oor Lorem Ipsum is that it has a more-or-less normal.</a></td>
                                                <td class=""></td>
                                                <td class="text-right mail-date">Jun 11</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
                <!-- foodter -->
                <?php include_once 'foodter/foodter.php';?>
				<!-- end foodter -->
			</div>
            <!-- chart -->
            <?php include_once 'chart/chart.php'; ?>
            <!-- end chart -->
		</div>
        <!-- <script> js php import</script> -->
        <?php include_once 'script/js.php';?>
        <!-- <script>Library</script> -->
		<!-- <script> import</script> -->
	</body>
</html>