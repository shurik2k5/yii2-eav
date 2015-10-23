<?php

use yii\helpers\Html;
use yii\helpers\Url;  
?>

<h2>EAV Fields constructor</h2>

<table class="table">
<caption>Descriptions</caption>
   <tr>
    <th>№</th>
    <th>Route</th>
    <th>Description</th>
    <th>Operations</th>
   </tr>
   
   <tr>
    <td>1</td>
    <td>admin/attribute/index</td>
    <td>Fields constructor</td>
    <td>
    <?= Html::a('Create', ['admin/attribute/create'])?>&nbsp;
    <?= Html::a('List', ['admin/attribute/index'])?>
    </td>
   </tr>

   <tr>
    <td>2</td>
    <td>admin/option/index</td>
    <td>Options constructor</td>
    <td>
    <?= Html::a('Create', ['admin/option/create'])?>&nbsp;
    <?= Html::a('List', ['admin/option/index'])?>
    </td>
   </tr>   

   <tr>
    <td>3</td>
    <td>admin/type/index</td>
    <td>Types constructor</td>
    <td>
    <?= Html::a('Create', ['admin/type/create'])?>&nbsp;
    <?= Html::a('List', ['admin/type/index'])?>
    </td>
   </tr>

   <tr>
    <td>3</td>
    <td>admin/entity/index</td>
    <td>Entities constructor</td>
    <td>
      <?= Html::a('Create', ['admin/entity/create'])?>&nbsp;
      <?= Html::a('List', ['admin/entity/index'])?>
    </td>
   </tr>
   
</table>