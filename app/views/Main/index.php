<?php
//echo 'index view Main    ';
?>
<!-- <nav class="panel-nav">
    <ul class="panel-menu">
        <li class="panel-menu-item" id="contracts">
            <a class="panel-menu-link" href="<?=PATH?>contracts">Договора</a>
        </li>
        <li class="panel-menu-item" id="devaces"  >
                 <a href="<?=PATH?>devaces" class="panel-menu-link"  >Объекты</a></li>
        <li class="panel-menu-item" id="operation">
                <a  href="<?=PATH?>operation" class="panel-menu-link"  >Операции по счету</a></li>
        <li class="panel-menu-item" id="personal">
                <a  href="<?=PATH?>personal" class="panel-menu-link"  >Личный кабинет</a>
        </li>
    </ul>
</nav> -->
<?php if(!empty($menu)):?>
		<nav class="panel-nav">
			
		    <ul class="panel-menu">
		    	<?php foreach($menu as $list): ?>
		        <li class="panel-menu-item" id="<?=$list['title']?>">
		            <a class="panel-menu-link" href="<?=$list['title']?>"><?=$list['header']?></a>
		        </li>
		   		<?php endforeach;?>
		    </ul>
			
		</nav>
    <?php endif;?>
<div>
<button class="btn" id="btn-send">
    кнопка
</button>
</div>
<div id="answer"></div>

  <script src="/freimwork/js/test111.js"></script> 
<script>
    $(function(){
        $('#btn-send').click(function(){
            //отправляем ajax запрос
            $.ajax({
                url: '/freimwork/main/test', //куда идет запрос - на конторллер main, action- test
                type: 'post',
                data: {'id':2},

                success: function(res){
                    //let data=JSON.parse(res);
                    //$('#answer').html('<p><b>JSON</b>||Ответ: '+data.answer+'|| Код ответа: '+data.kod+' </p>')
                    $('#answer').html(res);//вывод результата
                     console.log(res);

                },
                error: function(){
                    console.log('error');
                }
            });
        });
});
</script>  
	

