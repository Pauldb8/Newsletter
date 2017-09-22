<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 9/19/2017
 * Time: 4:04 PM
 */

class AlertManager
{
    const PRIMARY = "alert-primary";
    const SECONDARY = "alert-secondary";
    const SUCCESS = "alert-success";
    const DANGER = "alert-danger";
    const WARNING = "alert-warning";
    const INFO = "alert-info";

    static public function add($message, $type){
        if(isset($_SESSION['easy_errors']))
            $errors = $_SESSION['easy_errors'];
        else
            $errors = Array();

        if(isset($_SESSION['easy_errors_type']))
            $errors_type = $_SESSION['easy_errors_type'];
        else
            $errors_type = Array();

        array_push($errors, $message);
        array_push($errors_type, $type);

        $_SESSION['easy_errors'] = $errors;
        $_SESSION['easy_errors_type'] = $errors_type;
    }

    static public function show(){
        if(isset($_SESSION['easy_errors'])){
            $i = 0;
            foreach($_SESSION['easy_errors'] as $error){
                ?>
                <div class="alert <?php echo $_SESSION['easy_errors_type'][$i]; ?>" role="alert">
                    <?php
                    switch($_SESSION['easy_errors_type'][$i]){
                        case self::SUCCESS:
                            echo '<i class="fa fa-check"></i>&nbsp;';
                            break;
                        case self::DANGER:
                            echo '<i class="fa fa-exclamation"></i>&nbsp;';
                            break;
                        case self::INFO:
                            echo '<i class="fa fa-info"></i>anbsp;';
                            break;
                        case self::WARNING:
                            echo '<i class="fa fa-exclamation"></i>&nbsp;';
                            break;
                        default:
                            echo '<i class="fa fa-info"></i>&nbsp;';
                            break;
                    }
                    ?>
                    <?php echo Helper::sanitize($error); ?>
                </div>
                <?php
                $i++;
            }
            unset($_SESSION['easy_errors']);
            unset($_SESSION['easy_errors_type']);
        }else{
        }
    }
}