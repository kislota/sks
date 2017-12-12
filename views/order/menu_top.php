
<a href="/order/add" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Добавить</a>  
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" title="фильтр по статусу">
        <span class="glyphicon glyphicon-filter"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <?php $status = status(); ?>
        <?php foreach ($status as $stat): ?>
        <li><a href="/order/status/<?=$stat['id_status']?>"><?=$stat['status_name']?></a></li>
        <?php endforeach;?>
    </ul>
</div>
<div class="btn-group">
    <a href="/order/media/2" class="btn btn-default" title="заявоки JOTO"><span class="glyphicon">JOTO</span></a>
    <a href="/order/help/1" class="btn btn-default" title="Вызов специалиста"><span class="glyphicon">Вызовы</span></a>
    <a href="/order/payment" class="btn btn-default" title="Оплата"><span class="glyphicon">Оплата</span></a>
</div>