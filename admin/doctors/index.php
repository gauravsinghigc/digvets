<?php

//required files
require '../../require/modules.php';
require '../../require/admin/access-control.php';
require '../../require/admin/sessionvariables.php';

//page variables
$PageName = "All Doctors";
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
                  <h3 class="app-heading"><?php echo $PageName; ?></h3>
                </div>
                <div class="col-md-12">
                  <?php include 'common.php'; ?>
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
                      $fetchdoctors = FetchConvertIntoArray("SELECT * FROM doctors ORDER BY Doctorsid ASC", true);
                      if ($fetchdoctors != null) {
                        $Count = 0;
                        foreach ($fetchdoctors as $data) {
                          $Count++;
                      ?>
                          <tr>
                            <td><?php echo $Count; ?></td>
                            <td>
                              <img src="<?php echo STORAGE_URL; ?>/doctors/images/profile/<?php echo $data->DoctorProfileImage; ?>" title="<?php echo $data->DoctorName; ?>" alt="<?php echo $data->DoctorName; ?>" class="pro-img">
                            </td>
                            <td class="lh-1-0">
                              <a href="#" data-target="#view_details_<?php echo $data->Doctorsid; ?>" data-toggle="modal" class="text-primary">
                                Dr. <?php echo $data->DoctorName; ?><br>
                                <span class="text-grey fs-12">
                                  <span class="w-50"><b>Qualifications :</b> <?php echo $data->DoctorQualifications; ?></span>
                                  <span class="w-50 text-right"><b>Exp :</b> <?php echo $data->DoctorWorkExperience; ?></span><br>
                                  <span><b>Specilisation: </b><?php echo SECURE($data->DoctorSpecilisation, "d"); ?></span>
                                  <span><b>Expertise In: </b><?php echo SECURE($data->DoctorExpertiseInAnimals, "d"); ?></span><br>
                                </span>
                              </a>
                            </td>
                            <td>
                              <span class="flex-s-b">
                                <span class="w-50"><b><i class="fa fa-phone text-primary"></i></b> <?php echo $data->DoctorMobileNumber; ?></span> <br>
                                <span class="w-50"><b><i class="fa fa-whatsapp text-success"></i></b> <?php echo $data->DoctorWhatsappNumber; ?></span>
                              </span>
                            </td>
                            <td>
                              <span><b><i class="fa fa-envelope text-danger"></i> </b><?php echo $data->DoctorEmailId; ?></span>
                            </td>
                            <td>
                              <span><?php echo $data->DoctorCreatedAt; ?></span>
                            </td>
                            <td>
                              <span><?php echo ReturnValue($data->DoctorUpdatedAt); ?></span>
                            </td>
                            <td>
                              <?php echo StatusViewWithText($data->DoctorStatus); ?>
                            </td>
                            <td>
                              <a href="#" data-target="#view_details_<?php echo $data->Doctorsid; ?>" data-toggle="modal" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                              <a href="edit.php?viewid=<?php echo SECURE($data->Doctorsid, 'e'); ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                          </tr>
                          <div id="view_details_<?php echo $data->Doctorsid; ?>" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title app-heading" id="mySmallModalLabel">
                                    <img src="<?php echo STORAGE_URL; ?>/doctors/images/profile/<?php echo $data->DoctorProfileImage; ?>" class="list-icon"> Dr. <?php echo $data->DoctorName; ?>
                                  </h4>
                                </div>
                                <div class="modal-body">
                                  <p>
                                    <span class="flex-s-b">
                                      <span>RegisterationId</span>
                                      <span><?php echo $data->Doctorsid; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Full Name</span>
                                      <span>Dr.<?php echo $data->DoctorName; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Mobile Number</span>
                                      <span><?php echo $data->DoctorMobileNumber; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Whatsapp Number</span>
                                      <span><?php echo $data->DoctorWhatsappNumber; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Telegram Number</span>
                                      <span><?php echo $data->DoctorTelegramNumber; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Email ID</span>
                                      <span><?php echo $data->DoctorEmailId; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Qualifications</span>
                                      <span><?php echo $data->DoctorQualifications; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Specialization</span>
                                      <span><?php echo SECURE($data->DoctorSpecilisation, "d"); ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Work Experience</span>
                                      <span><?php echo $data->DoctorWorkExperience; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Anima Expertise</span>
                                      <span><?php echo SECURE($data->DoctorExpertiseInAnimals, "d"); ?></span>
                                    </span>

                                    <span class="flex-s-b">
                                      <span>Address</span>
                                      <span><?php echo SECURE($data->DoctorStreetAddress, "d"); ?> <?php echo SECURE($data->DoctorAddressShopNo, "d"); ?><br>
                                        <?php echo $data->DoctorAddressCity; ?> <?php echo $data->DoctorAddressDistrict; ?><br>
                                        <?php echo $data->DoctorAddressState; ?> <?php echo $data->DoctorAddressPincode; ?>
                                      </span>
                                    </span>

                                    <span class="flex-s-b">
                                      <span>Consulting in Clinic Fee</span>
                                      <span>Rs.<?php echo $data->DoctorConsultanctFeeInClinic; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Visiting Fee</span>
                                      <span>Rs.<?php echo $data->DoctorVisitingFee; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Phone Consulting Fee</span>
                                      <span>Rs.<?php echo $data->DoctorFeeForPhoneConsultaning; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Introduction</span>
                                      <span><?php echo SECURE($data->DoctorBio, "d"); ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Profile Created at</span>
                                      <span><?php echo $data->DoctorCreatedAt; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Profile Update At</span>
                                      <span><?php echo $data->DoctorUpdatedAt; ?></span>
                                    </span>
                                    <span class="flex-s-b">
                                      <span>Lisiting Status</span>
                                      <span><?php echo StatusViewWithText($data->DoctorStatus); ?></span>
                                    </span>
                                  </p>
                                </div>
                                <div class="modal-footer">
                                  <a href="<?php echo DOMAIN; ?>/controller/doctorcontroller.php?delete_doctors=<?php echo SECURE("true", "e"); ?>&access_url=<?php echo SECURE(RUNNING_URL, "e"); ?>&control_id=<?php echo SECURE($data->Doctorsid, "e"); ?>" class="btn btn-default float-left"><i class="fa fa-trash"></i></a>
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