<?PHP
//file uploader and directory maker 
function UPLOAD_FILES($dir, $checkfile = false, $pre, $ref, $NewFile)
{
 if ($checkfile == true) {
  if (file_exists("$dir/$checkfile")) {
   unlink("$dir/$checkfile");
  }
 }

 if (!file_exists("$dir/")) {
  mkdir("$dir/", 0777, true);
 }

 $Folder = "$dir/";
 $temp = explode(".", $_FILES["$NewFile"]["name"]);
 $newfilename = "$pre" . "_" . $ref . "_" . date("d_M_Y_h_m_s") . '.' . end($temp);
 move_uploaded_file($_FILES["$NewFile"]['tmp_name'], $Folder . $newfilename);

 return $newfilename;
}

//upload multiple files
function UPLOAD_MULTIPLE_FILES($path, $prename, $refname, $postfilename)
{
 for ($i = 0; $i < count($_FILES["$postfilename"]['name']); $i++) {

  $pre = $prename;
  $ref = $refname;
  $path = "../storage/gallery/";
  $ext = explode('.', basename($_FILES["$postfilename"]['name'][$i]));
  $path = $path .  md5(uniqid()) . "." . $ext[count($ext) - 1];
  $temp = explode(".", $_FILES["$postfilename"]['tmp_name'][$i]);
  $newfilename = "$pre" . "_" . $ref . "_" . date("d_M_Y_h_m_s") . '.' . end($temp);

  $filestatus = move_uploaded_file($_FILES["$postfilename"]['tmp_name'][$i], $path);

  if ($filestatus == true) {
   die($newfilename);
   return $newfilename;
  } else {
   return false;
  }
 }
}
