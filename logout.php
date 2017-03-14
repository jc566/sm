<?PHP 
session_start();
include "config/config.php";
include "models/solarModel.php";
//$objSolarModel->pageAccess();
$objSolarModel->logout();
$objSolarModel->redirection(admin_url);
?>

