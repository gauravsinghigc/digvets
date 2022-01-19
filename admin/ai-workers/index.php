<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "AI Worker";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
  <?php include '../../include/admin/header_files.php'; ?>

</head>

<body>
  <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <?php include '../../include/admin/header.php'; ?>

    <div class="boxed">
      <!--CONTENT CONTAINER-->
      <!--===================================================-->
      <div id="content-container">
        <div id="page-content">
          <!--====start content===============================================-->

          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="flex-s-b app-heading">
                    <h3 class="m-t-0 m-b-0"><?php echo $PageName; ?></h3>
                    <a href="add.php" class="btn btn-sm btn-default"><i class="fa fa-plus"></i> <?php echo $PageName ?></a>
                  </div>
                </div>
              </div>
              <div class="row m-t-10">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>SNo</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>EmailId</th>
                        <th>RegDate</th>
                        <th>UpdateDate</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $fetchaiworkers = FetchConvertIntoArray("SELECT * FROM aiworkers ORDER BY Aiworkersid ASC", true);
                      if ($fetchaiworkers != null) {
                        $Count = 0;
                        foreach ($fetchaiworkers as $data) {
                          $Count++;
                      ?>

                          <tr>
                            <td><?php echo $Count; ?></td>
                            <td>
                              <img src="<?php echo STORAGE_URL; ?>/workers/images/profile/<?php echo $data->AIWorkerProfile; ?>" title="<?php echo $data->AIWorkerName; ?>" alt="<?php echo $data->AIWorkerName; ?>" class="pro-img">
                            </td>
                            <td class="lh-1-0">
                              <a href="#" data-target="#view_details_<?php echo $data->Aiworkersid; ?>" data-toggle="modal" class="text-primary">
                                <?php echo $data->AIWorkerName; ?><br>
                                <span class="text-grey fs-12">
                                  <span class="w-50"><b>Qualifications :</b> <?php echo $data->AIWorkerQualification; ?></span>
                                  <span class="w-50 text-right"><b>Exp :</b> <?php echo $data->AIWorkerExperience; ?></span><br>
                                  <span><b>Specilisation: </b><?php echo SECURE($data->AIWorkerSpecilization, "d"); ?></span>
                                  <span><b>Expertise In: </b><?php echo SECURE($data->AIWorkerExpertiseIn, "d"); ?></span><br>
                                </span>
                              </a>
                            </td>
                            <td>
                              <span class="flex-s-b">
                                <span class="w-50"><b><i class="fa fa-phone text-primary"></i></b> <?php echo $data->AIWorkerMobileNumber; ?></span> <br>
                                <span class="w-50"><b><i class="fa fa-whatsapp text-success"></i></b> <?php echo $data->AIWorkerWhatsappNumber; ?></span>
                              </span>
                            </td>
                            <td>
                              <span><b><i class="fa fa-envelope text-danger"></i> </b><?php echo $data->AIWorkerEmail; ?></span>
                            </td>
                            <td>
                              <span><?php echo $data->AIWorkerCreatedAt; ?></span>
                            </td>
                            <td>
                              <span><?php echo ReturnValue($data->AIWorkerUpdatedAt); ?></span>
                            </td>
                            <td>
                              <?php echo StatusViewWithText($data->AIWorkerStatus); ?>
                            </td>
                            <td>
                              <a href="#" data-target="#view_details_<?php echo $data->Aiworkersid ?>" data-toggle="modal" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                              <a href="edit.php?viewid=<?php echo SECURE($data->Aiworkersid, 'e'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                          </tr>
                          <div id="view_details_<?php echo $data->Aiworkersid ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title app-heading" id="mySmallModalLabel">
                                    <img src="<?php echo STORAGE_URL; ?>/workers/images/profile/<?php echo $data->AIWorkerProfile; ?>" class="list-icon"> <?php echo $data->AIWorkerName; ?>
                                  </h4>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    <span class="flex-s-b">
                                      <span>RegisterationId</span>
                                      <span><?php echo $data->Aiworkersid; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Full Name</span>
                                      <span>Dr.<?php echo $data->AIWorkerName; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Mobile Number</span>
                                      <span><?php echo $data->AIWorkerMobileNumber; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Whatsapp Number</span>
                                      <span><?php echo $data->AIWorkerWhatsappNumber; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Telegram Number</span>
                                      <span><?php echo $data->AIWorkerTelegramNumber; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Email ID</span>
                                      <span><?php echo $data->AIWorkerEmail; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Qualifications</span>
                                      <span><?php echo $data->AIWorkerQualification; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Specialization</span>
                                      <span><?php echo SECURE($data->AIWorkerSpecilization, "d"); ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Work Experience</span>
                                      <span><?php echo $data->AIWorkerExperience; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Anima Expertise</span>
                                      <span><?php echo SECURE($data->AIWorkerExpertiseIn, "d"); ?></span>
                                    </span>

                                    <span class="flex-s-b">
                                      <span>Address</span>
                                      <span><?php echo SECURE($data->AIWorkerStreetAddress, "d"); ?> <?php echo SECURE($data->AIWorkerArea, "d"); ?><br>
                                        <?php echo $data->AIWorkerVillage; ?> <?php echo $data->AIWorkerTehsil; ?><br>
                                        <?php echo $data->AIWorkerCity; ?> <?php echo $data->AIWorkerDistrict; ?><br>
                                        <?php echo $data->AIWorkerState; ?> <?php echo $data->AIWorkerPincode; ?>
                                      </span>
                                    </span>

                                    <span class="flex-s-b">
                                      <span>Consulting Fee</span>
                                      <span>Rs.<?php echo $data->AIWorkerConsultaningFee; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Introduction</span>
                                      <span><?php echo SECURE($data->AIWorkerDescriptions, "d"); ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Profile Created at</span>
                                      <span><?php echo $data->AIWorkerCreatedAt; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Profile Update At</span>
                                      <span><?php echo $data->AIWorkerUpdatedAt; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Lisiting Status</span>
                                      <span><?php echo StatusViewWithText($data->AIWorkerStatus); ?></span>
                                    </span>
                                  </p>
                                </div>
                                <div class="modal-footer">
                                  <a href="<?php echo DOMAIN; ?>/controller/aiworkercontrollers.php?delete_aiworkers=<?php echo SECURE("true", "e"); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($data->Aiworkersid, "e"); ?>" class="btn btn-default float-left"><i class="fa fa-trash"></i></a>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      <?php }
                      } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!--End page content-->
        </div>

        <?php include '../../include/admin/sidebar.php'; ?>
      </div>
      <?php include '../../include/admin/footer.php'; ?>
    </div>


    <?php include '../../include/admin/footer_files.php'; ?>
</body>

</html>