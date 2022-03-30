<?php
//echo 'index view Main    ';
?>
<nav class="panel-nav">
    <ul class="panel-menu">
        <li class="panel-menu-item" id="contracts">
            <a class="panel-menu-link" href="<?=PATH?>contracts">Договора</a>
        </li>
        <li class="panel-menu-item" id="<?=PATH?>devaces"><a class="panel-menu-link"  href="" >Объекты</a></li>
        <li class="panel-menu-item" id="<?=PATH?>operation"><a class="panel-menu-link"  href="">Операции по счету</a></li>
        <li class="panel-menu-item" id="<?=PATH?>personal"><a class="panel-menu-link"  href="">Личный кабинет</a></li>
    </ul>
</nav>
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
	

