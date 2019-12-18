<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15-Mar-19
 * Time: 7:54 AM
 */

use yii\bootstrap\Modal;
use yii\helpers\Html;
?>
<?php Modal::begin([
    "header" => "<h2 id='" . $id . "Title'>$title</h2>",
    "headerOptions" => ["style" => "display: block", "class" => "bg-light"],
    "id" => $id
]); ?>

<div id="<?= $id ?>Content"></div>

<?php Modal::end(); ?>
