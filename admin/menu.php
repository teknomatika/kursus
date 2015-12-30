<?php

?>
<li>
                            <a href="."><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
<?php
switch ($_SESSION['level']) {
                	case 'Admin':
?>                	
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Program Super<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=super&act=ubah">Tambah Program</a>
                                </li>
                                <li>
                                    <a href="?p=super">Data Program</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Program Reguler<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=program&act=ubah">Tambah Program</a>
                                </li>
                                <li>
                                    <a href="?p=program">Data Program</a>
                                </li>
                            </ul>
                        </li>
                		<li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=user&act=ubah">Tambah User</a>
                                </li>
                                <li>
                                    <a href="?p=user">Data User</a>
                                </li>
                            </ul>
                        </li>
<?php                		
                		break;
                	
                	default:
                		# code...
                		break;
                        }
?>                                                
                        <!--li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                        </li-->