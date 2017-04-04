<?php
use yii\helpers\Html;

$this->title = "Profile";
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('assets/c1a6917c/jquery.js');
$this->registerJsFile('js/order.js');
?>

<div class='row'>
    <div class="col-lg-2">

    </div>
    <div class="col-lg-8">
        <h3 class="text-center text-muted"><span class="label">My Orders</span></h3>
        <p class="text-center">
        <ul class="nav nav-tabs text-center" role="tablist">
            <li  class="active"><a href="#myOrders" aria-controls="myOrders" data-toggle="tab">My orders</a></li>
            <li><a href="#inProcOrders" aria-controls="inProcOrders" role="tab" data-toggle="tab">Orders in process</a></li>
            <li><a href="#requestOrders" aria-controls="requestOrders" data-toggle="tab">Your requests</a></li>
        </ul>
        </p>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="myOrders">
                <?php
                if(isset($myOrders)){
                foreach($myOrders as $order){?>
                    <div class="panel panel-default" <?= ($ordersReqNum[$order->id] && $order->orders_users->status != 1) ? 'style="border: 1px solid red"' : null?> >
                        <div class="panel-body">
                            <div class="text-primary" style="font-size: 20px;"><a href="?r=orders%2Forder&orderId=<?= $order->id;?>" ><?= Html::encode($order->Title)?></a>
                                <div class="dropdown" style="float:right;">
                                    <?php if($ordersReqNum[$order->id] && $order->orders_users->status != 1){ ?><span class="badge"><?= $ordersReqNum[$order->id] ?></span> <? } ?>
                                    <?php if($order->orders_users == null){ ?>
                                    <span class="glyphicon glyphicon-cog" id="orderOper"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </span>
                                    <ul class="dropdown-menu" aria-labelledby="orderOper">
                                        <li>
                                            <!-- Modal button -->
                                            <?= Html::a('Delete', '?r=orders%2Fdelete', ['class' => 'orderDelButton', 'data-id' => $order->id,  'data-toggle' => 'modal', 'data-target' => '#myModal']); ?>


                                        </li>
                                        <li>
                                            <?=Html::a('Edit', '?r=orders%2Fedit_order&orderId='.$order->id)?>
                                        </li>
                                    </ul>
                                    <?php }elseif($order->orders_users->status == null){ ?>
                                        <p class="pull-right">In Process</p>
                                    <?}else{ ?>
                                        <p class="pull-right">Done</p>
                                    <?} ?>
                                </div>
                            </div>
                            <hr>
                            <div><?= $order->description ?></div>
                            <hr><div>
                            <?= \Yii::$app->formatter->asDatetime($order->timePosted); ?>
                            <span class="pull-right text-success">Price : <?= isset($order->price) ? $order->price : 'Negotiable' ?></span>
                            </div>
                        </div>
                    </div>
                <? }
                }
                ?>
            </div>
            <!-- Order Delete Modal -->
            <div class="modal fade" id="myModal" role="dialog" style="position:fixed;">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Order delete</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this order?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <?= Html::a('Delete', '?r=orders%2Fdelete', ['class' => 'btn btn-danger modalDeleteButton']) ?>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Order Delete Modal -->
            <div class="modal fade" id="requestDeleteModal" role="dialog" style="position:fixed;">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Request delete</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this request?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <?= Html::a('Delete', '?r=orders%2Fdelete_request', ['class' => 'btn btn-danger modalDeleteRequestButton']) ?>
                        </div>
                    </div>

                </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="inProcOrders">
                <?php
                if(isset($ordersInProc)){
                    foreach($ordersInProc as $order){?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-primary" style="font-size: 20px;"><a href="?r=orders%2Forder&orderId=<?= $order->id;?>" ><?= Html::encode($order->Title)?></a></div>
                                <div class="shortDescription">asdsd </div>
                                <?= \Yii::$app->formatter->asDatetime($order->timePosted); ?>
                            </div>
                        </div>
                    <? }
                }

                ?>
                </div>
            <div role="tabpanel" class="tab-pane fade" id="requestOrders">
                <?php
                if(isset($requestOrders)){
                    foreach($requestOrders as $order){?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-primary" style="font-size: 20px;"><a href="?r=orders%2Forder&orderId=<?= $order->id;?>" ><?= Html::encode($order->Title)?></a>
                                    <?= Html::a('&times', '?r=orders%2Fdelete_request', ['class' => 'requestDelButton close', 'data-id' => $order->id,  'data-toggle' => 'modal', 'data-target' => '#requestDeleteModal']); ?>
                                </div>
                                <div class="shortDescription">asdsd </div>
                                <?= \Yii::$app->formatter->asDatetime($order->timePosted); ?>
                            </div>
                        </div>
                    <? }
                }

                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-2">

    </div>
</div>