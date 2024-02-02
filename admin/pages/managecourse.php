<?php $selCourse = $conn->query("SELECT * FROM course_tbl ORDER BY cou_id DESC "); ?>
 <div class="app-main__outer">
    <div id="refreshData">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-config icon-gradient bg-plum-plate">
                            </i>
                        </div>
                        <div>Manage Courses</div>
                    </div> 
                </div>
            </div>
            <div class="scrollbar-container"></div>

            <div class="col-md-12">
                <nav class="" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="active breadcrumb-item" aria-current="page">Manage Courses</li>
                    </ol>
                </nav>
                <div class="mb-3 card">
                    <div class="card-header">Courses List
                        <span class="badge badge-pill badge-primary ml-2">
                            <?php echo $selCourse->rowCount();?>
                        </span>
                        <div class="btn-actions-pane-right">
                        <input type="text" id="searchInput_1" class="form-control form-control" onkeyup="SearchTabel(1)" placeholder="Search...">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList_1">
                            <thead>
                            <tr>
                                <th class="text-left pl-4">#</th>
                                <th class="text-left pl-4">Course Name</th>
                                <th class="text-left pl-4">Created Time</th>
                                <th class="text-left pl-4">Requests</th>
                                <th class="text-left pl-4">Admin</th>
                                <th class="text-center" width="30%">Setting</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                if($selCourse->rowCount() > 0)
                                {
                                    while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { 
                                        $i++; 
                                        $id_Req = $selCourseRow['cou_id'];
                                        $CountRequests = $conn->query("SELECT * FROM course_req WHERE cou_id='$id_Req' ORDER BY order_id desc");
                                    ?>
                                        <tr>
                                            <th class="pl-4"scope="row">#<?php echo $i; ?></th>    
                                            <td class="pl-4">
                                                <?php echo $selCourseRow['cou_name']; ?>
                                            </td>
                                            <td class="pl-4">
                                                <?php echo $selCourseRow['cou_created']; ?>
                                            </td>
                                            <td class="pl-4">
                                            <a href="home.php?page=course-requests&id=<?php echo $selCourseRow['cou_id']; ?>" class="btn btn-link"><span class="badge badge-pill badge-danger"><?php echo $CountRequests->rowCount(); ?></span></a>
                                            </td>
                                            <td class="pl-4">
                                                <?php
                                                $adminlecid = $selCourseRow['admin_created'];
                                                $GetAdminInfo = $conn->query("SELECT * FROM admin_acc WHERE admin_id='$adminlecid'")->fetch(PDO::FETCH_ASSOC);
                                                echo $GetAdminInfo['admin_name']; ?>
                                            </td>
                                            <td class="text-center">
                                                <a type="button" href="home.php?page=course-setting&id=<?php echo $selCourseRow['cou_id']; ?>" class="mr-1 btn btn-primary mb-1">Manage</a>
                                                <button href="#"  data-toggle="modal" data-target="#modalForUpdateCourse" id="GetCourseForUpdatefrm" type="button"  data-id='<?php echo $selCourseRow['cou_id']; ?>'  class="mr-1 btn btn-warning mb-1">Update</button>
                                                <button type="button" data-id='<?php echo $selCourseRow['cou_id']; ?>' id="deletecourse" class="mr-1 btn btn-danger mb-1">Delete</button>
                                            </td>
                                        </tr>
                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-6">No Course Found...</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="notFound_1"  class="pl-3 text-primary" style="display: none;"><legend>No Course found...</legend></div>
                </div>
            </div>

        </div>
    </div>