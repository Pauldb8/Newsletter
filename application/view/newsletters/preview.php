<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NEWSLETTER</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
<table class="newsletter" style="width: 700px;color: #000000;
    font-family: Verdana,Arial,Helvetica,sans-serif;
    font-size: 14px;
    line-height: 1.3;">
    <tr>
        <td>
            <?php
            if(file_exists(ROOT . 'public/img/' . $newsletter->getBannerUrl())){
                ?>
                <img src="<?php echo URL . 'img/' . Helper::sanitize($newsletter->getBannerUrl()); ?>" alt="NOT FOUND" />
                <?php
            }else{
                ?>
                <img src="http://via.placeholder.com/700x250" alt="NOT FOUND" />
                <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <?php
            if(!empty($newsletter->getContent())){
                ?><?php echo $newsletter->getContent(); ?>
                <?php
            }
            ?>
        </td>
    </tr>
</table>
</div>
</body>
</html>
