<ul class="search_result"></ul>

<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-2">
        <h1>Гости</h1>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
        <form class="form-inline form_lite">
            <input type="text" class="form-control who" name="referal" placeholder="Фамилия гостя" autocomplete="off">
{#          <button type="submit" class="btn btn-default">Найти</button>
 #}     </form>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-5">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <h3 class="itog">{{ summnal|number_format(0, '.', ' ') }}р<span>Наличка</span> </h3>
            </div>
            <div class="col-xs-12 col-sm-4">
                <h3 class="itog">{{ summbez|number_format(0, '.', ' ') }}р<span>Безнал</span> </h3>
            </div>
            <div class="col-xs-12 col-sm-4">
                <h3 class="itog">{{ summpad|number_format(0, '.', ' ') }}р<span>Билетник</span> </h3>
            </div>
                        <div class="col-xs-12 col-sm-4">
                <h3 class="itog">{{ summpad|number_format(0, '.', ' ') }}р<span>GoodRepublic</span> </h3>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2">
        <a href="/persons/create" class="btn btn-primary mt20 pull-right">+ Создать гостя</a>
    </div>
</div>

<h2 class="air">В резиденции</h2>

<table class="table stacktable">
    <tr>
        <td>id</td>
        <td>ФИО</td>
        <td>Визит</td>
        <td>Начало</td>
        <td>В гостях</td>
        <td>Статус</td>
        <td>Группа</td>
        <td>Скидка</td>
        <!--td>К кому</td-->
        <td>Завершить</td>
        <!-- <td>Покупка</td> -->
        <td></td>
        <td></td>
    </tr>
    {% for row in inside %}
        <tr>
            <td>{{ row.id|e }}</td>
            <td><a href="/persons/view?id={{ row.id|e }}">{{ row.second_name|e }} {{ row.name|e }} {{ row.middle_name|e }}</a></td>
            <td>{{ row.visits|length }}</td>
            <td>{{ row.visits|last.start|date('H:i') }}</td>
            <input type="hidden" name="" class="in_time" value="{{ row.visits|last.start|date('Y/m/d H:i:s') }}">
            <td><span class="normal"></span></td>
            <td>{{ row.status|e }}</td>
            <td>{{ row.group|slice(0, 10) }}</td>
            <td>{{ row.discount|e }}%</td>
            <!--td>К Виталию</td-->
            <td>
                <form>
                    <input type="hidden" name="uid" class="uid" value="{{ row.id|e }}">
                    <input type="button" class="endvisit btn btn-primary" value="Завершить">
                </form>
            </td>
            <td>
                <form>
                    <input type="hidden" name="uid" class="uid" value="{{ row.id|e }}">
                    <input type="button" class="byticket btn btn-primary" value="Билет">
                </form>
            </td>
            <td>
                <form>
                    <input type="hidden" name="uid" class="uid" value="{{ row.id|e }}">
                    <input type="button" class="sells btn btn-primary" value="Покупка">
                </form>
            </td>
            <!--td><a class="btn btn-primary js_end2">Завершить</a></td-->
            <!-- <td><a class="btn btn-primary js_buy">Покупка</a></td> -->
        </tr>
    {% endfor %}
</table>






<h2 class="air">Все гости (не в резиденции)</h2>

<table class="table stacktable">
    <tr>
        <td>id</td>
        <td>ФИО</td>
        <td>Визит</td>
        <td>Последний</td>
        <td>В гостях</td>
        <td>Статус</td>
        <td>Группа</td>
        <td>Денег</td>
        <td>Скидка</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    {% for out in outs %}
        <tr>
            <td>{{ out.id|e }}</td>
            <td><a href="/persons/view?id={{ out.id|e }}">{{ out.second_name|e }} {{ out.name|e }} {{ out.middle_name|e }}</a></td>
            <td>{{ out.visits|length }}</td>
            <td>{{ out.visits|last.start|date('d.m H:i') }}</td>
            <input type="hidden" name="" class="in_time" value="{{ out.visits|last.start|date('Y/m/d H:i:s') }}">
            <td><span class="normal"></span></td>
            <td>{{ out.status|e }}</td>
            <td>{{ out.group|slice(0, 10) }}</td>
            <td>
                {% set i = 0 %}
                {% for visit in out.visits %}
                    {% set i = i + visit.money %}
                {% endfor %}
                {{ i }}
            </td>
            <td>{{ out.discount|e }}%</td>
            <td>
                <form method="get" action="/persons/visit">
                    <input type="hidden" name="" value="/persons/visit">
                    <input type="hidden" name="uid" value="{{ out.id|e }}">
                    <button type="submit" class="btn btn-primary">Тариф</button>
                </form>
            </td>
            <td>
                <form>
                    <input type="hidden" name="uid" class="uid" value="{{ out.id|e }}">
                    <input type="button" class="byticket btn btn-primary" value="Билет">
                </form>
            </td>
            <td>
                <form>
                    <input type="hidden" name="uid" class="uid" value="{{ out.id|e }}">
                    <input type="button" class="sells btn btn-primary" value="Покупка">
                </form>
            </td>
        </tr>
    {% endfor %}
</table>





<div class="popup sells popup_d">
    <h3>Дополнительная покупка</h3>
    <form class="form">

        <div class="row mini">
            <div class="col-xs-12 col-sm-5"><p>Наименование</p></div>
            <div class="col-xs-12 col-sm-2"><p>Кол-во</p></div>
            <div class="col-xs-12 col-sm-2"><p>Цена</p></div>
            <div class="col-xs-12 col-sm-2"><p>Сумма</p></div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-5">
                <select class="control-label" placeholder="Наименование">
                    <option>Чай в пакетике</option>
                    <option>Чай заворной</option>
                    <option>ЧКофе латте</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-2"><input type="text" name="" /></div> 
            <div class="col-xs-12 col-sm-2"><p>100p</p></div> 
            <div class="col-xs-12 col-sm-2"><p>300р</p></div>
            <div class="col-xs-12 col-sm-1"><a class="btn_del"></a></div>
        </div>
        <input type="text" name="" class="btn btn_grey pull-right" value="Добавить">

    </form>
</div>


<div class="popup end popup_d"></div>

<div class="overlay"></div>



<script type="text/javascript">

    $(function(){

        function timeleft(){
            $(".in_time").each(function(){
                var in_time = new Date($(this).val());
                var now = new Date();
                var diff = Math.floor((now - in_time)/1000/60);
                var result = (diff/60 | 0)+ ":" +(diff%60 | 0);
                $(this).next().find("span").html(result);
            });
        }

        timeleft();

        setInterval(timeleft, 50000);   


        $(".endvisit").click(function(){
            console.log($(this).prev(".uid").val());
            $.ajax({
                type: 'get',
                url: "/persons/formendvisit", //Путь к обработчику
                data: {'uid':$(this).prev(".uid").val()},
                response: 'text',
                success: function(data){
                    $(".end").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
            var myscrollpop = $(window).scrollTop();
            $('.popup.end').animate({'top': myscrollpop + 100, 'opacity': 1}, 500);
            $('.overlay').fadeIn();
        })

        $(".byticket").click(function(){
            console.log($(this).prev(".uid").val());
            $.ajax({
                type: 'get',
                url: "/persons/formticket", //Путь к обработчику
                data: {'uid':$(this).prev(".uid").val()},
                response: 'text',
                success: function(data){
                    $(".end").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
            var myscrollpop = $(window).scrollTop();
            $('.popup.end').animate({'top': myscrollpop + 100, 'opacity': 1}, 500);
            $('.overlay').fadeIn();
        })


        $(".sells").click(function(){
            $.ajax({
                type: 'get',
                url: "/persons/formsell", //Путь к обработчику
                data: {'uid':$(this).prev(".uid").val()},
                response: 'text',
                success: function(data){
                    $(".end").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
            var myscrollpop = $(window).scrollTop();
            $('.popup.end').animate({'top': myscrollpop + 100, 'opacity': 1}, 500);
            $('.overlay').fadeIn();
        })
    })

</script>




<script type="text/javascript">

    $(function(){

    //Живой поиск
    $('.who').bind("change keyup input click", function() {
        if(this.value.length >= 2){
            $.ajax({
                type: 'get',
                url: "/persons/personsfind", //Путь к обработчику
                data: {'name':this.value},
                response: 'text',
                success: function(data){
                    $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
                }
            })
            $(".overlay").fadeIn();
            $(".form_lite").css({'zIndex': 9000});

        }
    })

    $(".search_result").hover(function(){
        $(".who").blur(); //Убираем фокус с input
    })

    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result").on("click", "li", function(){
        s_user = $(this).text();
        //$(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $(".search_result, .overlay").fadeOut();
        $(".form_lite").css({'zIndex': 1000});

    })
    
})

</script>