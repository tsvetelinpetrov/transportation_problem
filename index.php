<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link href="src/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/png" href="src/img/ico.png">
  <title>Транспортна задача</title>

  <style type="text/css">
    .logo{
      font-size: 25px;
      font-weight: 900;
      color: whitesmoke;
    }
    .logo-author{
      font-size: 15px;
      font-weight: bold;
      color: whitesmoke;
    }

    .table td, .table th {
        padding: .35rem;
    }

    .table{
      color: #212529;
      font-size: 15px;
      font-weight: bolder;
    }

    .fit{
      white-space: nowrap;
      width: 1%;
    }

    .error{
      color: red;
    }

    .table-bordered {
      border: 2px solid #414141;
    }

    .table-bordered td, .table-bordered th {
      border: 1px solid #414141;
    }

    .table-bordered thead td, .table-bordered thead th {
      border: 1px solid #414141;
    }

    .hatching{
      background-image: url(src/img/hatching-tex.png);
    }

    .cell{
      position: relative;
    }
    .cell-info{
      position: absolute;
      top: -3px;
      right: 0;
    }
    #file_upload {
      opacity: 0;
      position: absolute;
      z-index: -1;
    }
  </style>
</head>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <div>
        <div class="logo"><i class="fas fa-dolly"></i> Транспортна задача</div>
      <div class="logo-author">Реализирана от Цветелин Петров | Iб, СИТ</div></div>
      
    </nav>

    <main role="main" class="container">
      <div class="jumbotron">
        <form id="form1">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="exampleFormControlSelect2">Метод за НБР</label>
                <select class="form-control" id="method_select" name="method_select">
                  <option value="1">Метод на северозападния ъгъл</option>>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="optimalmethod_select">Определяне на оптималност</label>
                <select class="form-control" id="optimalmethod_select">
                  <option value="1">Разпределителен метод</option>>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="warehouse_select">Брой складове</label>
                <select class="form-control" id="warehouse_select">
                  <?php
                  for($i = 2; $i <= 50; $i++)
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  ?>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="factory_select">Брой заводи</label>
                <select class="form-control" id="factory_select">
                  <?php
                  for($i = 1; $i <= 50; $i++)
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <h5>Капацитети</h5>
              <div id="cap_list">
                <div class="form-group row">
                  <label for="cap1" class="col-sm-2 col-form-label">Склад 1</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="cap1" name="cap1" placeholder="Капацитет" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cap2" class="col-sm-2 col-form-label">Склад 2</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="cap2" name="cap2" placeholder="Капацитет" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <h5>Производство</h5>
              <div id="prod_list">
                <div class="form-group row">
                  <label for="prod1" class="col-sm-2 col-form-label">Завод 1</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="prod1" name="prod1" placeholder="Произв. количество" required>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div>
            <table class="table table-responsive table-borderless" id="ftbl">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col">Склад 1</th>
                  <th scope="col">Склад 2</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-right fit">Завод 1</td>
                  <td><input type="number" id="cost1-1" name="cost1-1" class="form-control" placeholder="Разход" required></td>
                  <td><input type="number" id="cost1-2" name="cost1-2" class="form-control" placeholder="Разход" required></td>
                </tr>
              </tbody>
            </table>
          </div>
          <hr>
          <div class="row">
            <div class="col-10">
              <label for="file_upload" class="btn btn-secondary mb-0" data-toggle="tooltip" data-placement="bottom" title="Зареждане на конфигурация от файл"><i class="fas fa-file-import"></i> Зареждане от файл</label>
              <input type="file" name="photo" id="file_upload" accept="application/JSON">
              <button type="button" id="download_file" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Запазване на зададената конфигурация във файл" data-obj=''><i class="fas fa-file-export"></i> Запазване във файл</button>
              <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Задаване на капацитети на складовете, капацитети на заводите и транспортните разходи на случаен принцип с числата между 1 и 100" onclick="random();"><i class="fas fa-random"></i> Случайни</button>
              <button type="button" class="btn btn-dark" onclick="random1();"><i class="fas fa-grimace"></i> Test</button>
            </div>
            <div class="col text-right">
              <button type="submit" class="btn btn-success"><i class="fas fa-calculator"></i> Решаване</button>
            </div>
          </div>
        </form>

        <div id="solution" style="display: none;">
          <hr class="mt-3">
          <h4>Решение:</h4>
          <h5>1) Определяне на типа на транспортната задача</h5>
          <p>Сумираме поотделно продукцията, произведена от заводите и капацитите на складовете и сравняваме двете суми.</p>
          <div id="solution1"></div>

          <h5>2) Създаване на математически модел</h5>
          <h6>Целева функция на общия транспортен разход</h6>
          <div id="solution2"></div>

          <h5>3) Определяне на начално базисно решение</h5>
          <div id="solution3"></div>


          <div id="solution4"></div>
        </div>
        <button type="button" id="export_doc" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom" title="" onclick="exportHTML();" style="display: none;"><i class="fas fa-file-word"></i> Запазване на решението в Word файл</button>

      </div>
      <div class="jumbotron">
      <div>
        Забелязани бъгове:
        <ul>
          <li>(<strong class="text-success"><i class="fas fa-check-square"></i> Фикснато</strong>)При по-големи размерности на масива с разходите, в случай, че се добави фиктивен склад/завод се получава дублиране на адресите. (X111 може да е X[1][11] и X[11][1]). Наблюдава се, когато взимам стойностите от полетата за разходите. |  Трябва да променя формата на адреса, за достъп до текстовите полета.</li>
          <li>(<strong class="text-warning"><i class="fas fa-exclamation-triangle"></i></strong>)Страницата стана леко тромава, след добавянето на tooltips към елементите на табличките. Това е удобство, което вероятно ще премахна, понеже при по-големи масиви, заредените елементи и данни в страницата стават стотици хилади и на браузъра му е трудно да ги обработва.</li>
          <li>(<strong class="text-warning"><i class="fas fa-exclamation-triangle"></i></strong>)Не всички css стилове са приложими в word при генериране на файл, съдържащ цялото решение. Ще ми отнеме седмици работа, за да проуча кое от хилядите стилове е приложимо и кое не.</li>
          <li>(<strong class="text-success"><i class="fas fa-check-square"></i> Фикснато</strong>)Сливане на долните индекси при числа, които включват повече от една цифра. | Всички такива вече са разделени с ','</li>
        </ul>
      </div>
    </div>
    </main>
    <footer class="bg-dark text-center text-lg-start text-light">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    Тази страничка и функциите към нея са създадени с учебни цели от Цветелин Петров<br>
    © 2020-2021 Copyright:
    <a class="text-light" href="https://www.facebook.com/ts.petrov5/" target="_BLANK">Tsvetelin Petrov</a>
  </div>
  <!-- Copyright -->
</footer>
</body>

  <script src="src/plugins/jquery/jquery-3.5.1.min.js"></script>
  <script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="src/plugins/fontawesome/js/all.min.js"></script>
  <script src="src/plugins/jquery-validation/jquery.validate.min.js"></script>

  <script type="text/javascript">

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

    $("#download_file").click(function() {
      if($('form[id="form1"]').valid() == false)
      {
        return;
      }
      var jsonToSave = new Array();

      var warehousesForFile = new Array();
      var factoriesForFile = new Array();
      var pricesForFile = new Array();
      for(var i = 1; i <= warehouse_count; i++)
      {
        warehousesForFile.push(parseInt($('#cap'+i).val()));
      }
      for(var i = 1; i <= factory_count; i++)
      {
        factoriesForFile.push(parseInt($('#prod'+i).val()));
        var tmp = new Array();
        for(var j = 1; j <= warehouse_count; j++)
        {
          tmp.push(parseInt($('#cost'+i+'-'+j).val()));
        }
        pricesForFile.push(tmp);
      }
      jsonToSave.push({"fcount":factory_count, "wcount":warehouse_count, "fprod":factoriesForFile, "wprod":warehousesForFile, "prices":pricesForFile});
      console.log(jsonToSave)
      $("#download_file").data('obj', jsonToSave)
      $("<a />", {
        "download": "transportna_zadacha.json",
        "href" : "data:application/json," + encodeURIComponent(JSON.stringify($(this).data().obj))
      }).appendTo("body")
      .click(function() {
         $(this).remove()
      })[0].click()
    });

    $('#file_upload').change(function(){
      var file = this.files[0];
      var fileContent;
      if (file) {
      var reader = new FileReader();
      reader.readAsText(file, "UTF-8");
      reader.onload = function (evt) {
        fileContent = jQuery.parseJSON(evt.target.result);
        $('#factory_select').val(fileContent[0].fcount).change();
        $('#warehouse_select').val(fileContent[0].wcount).change();
        for(var i = 1; i <= fileContent[0].wcount; i++)
        {
          $(`#cap${i}`).val(fileContent[0].wprod[i-1]);
        }
/*        for(var i = 1; i <= fileContent[0].fcount; i++)
        {
          $(`#prod${i}`).val(fileContent[0].fprod[i-1]);
        }*/

        for(var i = 1; i <= fileContent[0].fcount; i++)
        {
          $(`#prod${i}`).val(fileContent[0].fprod[i-1]);
          for(var j = 1; j <= fileContent[0].wcount; j++)
          {
            $(`#cost${i}-${j}`).val(fileContent[0].prices[i-1][j-1]);
          }
        }

        

      }
      reader.onerror = function (evt) {
          console.log('error');
      }
  }
      $('#file_upload').val('');
    });


    function random()
    {
      warehouse_count = parseInt($('#warehouse_select').val());
      factory_count = parseInt($('#factory_select').val());
      for(var i = 1; i<=parseInt($('#factory_select').val()); i++)
      {
        $(`#prod${i}`).val(Math.floor(Math.random() * 100)+1);
        for(var j = 1; j<=parseInt($('#warehouse_select').val()); j++)
        {
          $(`#cost${i}-${j}`).val(Math.floor(Math.random() * 100)+1);
        }
      }

      for(var i = 1; i <= parseInt($('#warehouse_select').val()); i++)
      {
        $(`#cap${i}`).val(Math.floor(Math.random() * 100)+1);
      }
    }

    function random1()
    {
      $('#factory_select').val("3").change();
      $('#warehouse_select').val("3").change();

      $(`#prod1`).val(60);
      $(`#prod2`).val(40);
      $(`#prod3`).val(20);

      $(`#cap1`).val(20);
      $(`#cap2`).val(50);
      $(`#cap3`).val(50);

      $(`#cost1-1`).val(1);
      $(`#cost1-2`).val(5);
      $(`#cost1-3`).val(3);

      $(`#cost2-1`).val(7);
      $(`#cost2-2`).val(6);
      $(`#cost2-3`).val(2);

      $(`#cost3-1`).val(8);
      $(`#cost3-2`).val(6);
      $(`#cost3-3`).val(4);
    }




    $('#warehouse_select, #factory_select').change(function(){
      $('#ftbl, #cap_list, #prod_list').html('');

      warehouse_count = parseInt($('#warehouse_select').val());
      factory_count = parseInt($('#factory_select').val());

      var d = `<thead><tr><th scope="col"></th>`;
      for(var i = 1; i <= warehouse_count; i++)
      {
        var cp_l = `<div class="form-group row">
                      <label for="cap${i}" class="col-sm-2 col-form-label">Склад ${i}</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" id="cap${i}" name="cap${i}" placeholder="Капацитет" required>
                      </div>
                    </div>`;
        $('#cap_list').append(cp_l);
        d+=`<th scope="col">Склад ${i}</th>`;
      }
      d+=`</thead></tr>`;

      for(var i = 1; i <= factory_count; i++)
      {
        d+=`<tr>`;
        for(var j = 0; j <= warehouse_count; j++)
        {
          if(j == 0)
            d+=`<td class="text-right fit">Завод ${i}</td>`;
          else
            d+=`<td><input type="number" id="cost${i}-${j}" name="cost${i}-${j}" class="form-control" placeholder="Разход" required></td>`;
        }
        d+=`</tr>`;

        var prod_l = `<div class="form-group row">
                        <label for="prod${i}" class="col-sm-2 col-form-label">Завод ${i}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="prod${i}" name="prod${i}" placeholder="Произв. количество" required>
                        </div>
                      </div>`;
        $('#prod_list').append(prod_l);
      }
      $('#ftbl').append(d);
    });

    

    $('form[id="form1"]').validate({
      submitHandler: function(form) {
        init();
      }
    });


    var factory_count = 0;
    var factory = new Array();

    var warehouse_count = 0;
    var warehouse = new Array();

    var quantityMatrix = new Array();
    var costs = new Array();

    function init()
    {
      $('#export_doc').show();
      factory_count = parseInt($('#factory_select').val());
      warehouse_count = parseInt($('#warehouse_select').val());

      $('#solution').show(800);
      step1(); // Opredelqne tipa na zadachata
      step2(); // Mat. model
      step3(); // Nachalno bazisno reshenie
      step4(); // Proverka za optimalnost

    }

    function step1() // Opredelqne tipa na zadachata
    {
      var total_production = 0;
      var total_space = 0;

      var toАppend = '<p class="mb-0">Общ бр. изделия: ';
      factory = new Array();
      for(var i = 1; i <= factory_count; i++)
      {
        total_production += parseInt($('#prod'+i).val());
        factory.push(parseInt($('#prod'+i).val()));
        toАppend += $('#prod'+i).val();
        if(i!=factory_count)
          toАppend += ' + ';
      }
      toАppend += ` = ${total_production}</p>`;

      toАppend += '<p>Общ капацитет: ';
      warehouse = new Array();
      for(var i = 1; i <= warehouse_count; i++)
      {
        total_space += parseInt($('#cap'+i).val());
        warehouse.push(parseInt($('#cap'+i).val()));
        toАppend += $('#cap'+i).val();
        if(i!=warehouse_count)
          toАppend += ' + ';
      }
      toАppend += ` = ${total_space}</p>`;

      var fictive = false;
      if(total_production > total_space)
      {
        warehouse.push(total_production - total_space);
        warehouse_count++;
        toАppend += `<p>Производството (${total_production}) е повече от капацитета на складовете (${total_space}) => Задачата е НЕБАЛАНСИРАНА и следва да добавим фиктивен склад (${warehouse_count}) с капацитет ${total_production - total_space}</p><p>! Транспортният разход от заводите към фиктивния склад е 0</p>`;
        toАppend += `<h6>Нова таблица на транспортния разход с добавен фиктивен склад</h6><table class="table table-responsive table-bordered"><thead><tr>`
        fictive = true;
      }
      else if(total_space > total_production)
      {
        factory.push(total_space - total_production);
        factory_count++;
        toАppend += `<p>Производството (${total_production}) е по-малко от капацитета на складовете (${total_space}) => Задачата е НЕБАЛАНСИРАНA и следва да добавим фиктивен завод (${factory_count}), който произвежда ${total_space - total_production} изделия</p><p>! Транспортният разход от фиктивния завод към складовете е 0</p>`;
        toАppend += `<h6>Нова таблица на транспортния разход с добавен фиктивен завод</h6><table class="table table-responsive table-bordered"><thead><tr>`
        fictive = true;
      }else{
        toАppend += `<p>Производството (${total_production}) е равно на капацитета на складовете (${total_space}) => Задачата е БАЛАНСИРАНА</p>`;
      }

      if(fictive)
      {
        for(var i = 0; i <= warehouse_count; i++)
        {
          if(i == 0)
          {
            toАppend += `<th scope="col"></th>`;
          }else{
            toАppend += `<th scope="col">Склад ${i} <small><span class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Капацитет на склад ${i}">(${warehouse[i-1]})</span></small></th>`;
          }
        }
      }

      toАppend += `</tr></thead><tbody>`;

      quantityMatrix = new Array();
      costs = new Array();
      for(var i = 1; i <= factory_count; i++)
      {
        if(fictive)
          toАppend += `<tr>`;

        var tmp1 = new Array();
        var tmp2 = new Array();
        for(var j = 0; j <= warehouse_count; j++)
        {
          if(j == 0){
            if(fictive)
              toАppend += `<td class="text-center fit m-3">Завод ${i} <small><span class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Производство от завод ${i}">(${factory[i-1]})</span></small></td>`;
          }else{
            var buff = ($(`#cost${i}-${j}`).length)? parseInt($(`#cost${i}-${j}`).val()):0;
            tmp1.push(buff);
            tmp2.push(0);

            if(fictive)
              toАppend += `<td class="text-center m-3"><span data-toggle="tooltip" data-placement="right" title="Единичен транспортен разход за превоз на изделие от завод ${i} до склад ${j}">${buff}</span></td>`;
          }
        }
        if(fictive)
          toАppend += `</tr>`;
        costs.push(tmp1);
        quantityMatrix.push(tmp2);
      }

      $('#solution1').html("").append(toАppend);
      $(function () {
        $('[data-toggle="tooltip"]').tooltip('dispose');
        $('[data-toggle="tooltip"]').tooltip()
      })
    }

    function step2() // Mat. model
    {
      var toАppend = `<p>Z = `;
      for(var i = 0; i < factory_count; i++)
      {
        toАppend += `(`
        for(var j = 0; j < warehouse_count; j++)
        {
          toАppend += `${costs[i][j]}*X<small>${i+1},${j+1}</small>`;
          if(j != warehouse_count-1)
            toАppend += ` + `;
        }
        toАppend += `) `;
        if(i != factory_count-1)
          toАppend += ` + `;
      }

      toАppend += `</p><ht><h6>Ограничения</h6><div class="row"><div class="col"><h7>Производство</h7><p>`;

      for(var i = 0; i < factory_count; i++)
      {
        for(var j = 0; j < warehouse_count; j++)
        {
          toАppend += `X<small>${i+1},${j+1}</small>`;
          if(j != warehouse_count-1)
            toАppend += ` + `;
        }
        toАppend += ` = ${factory[i]}<br>`;
      }

      toАppend += '</p></div><div class="col"><h7>Съхранение</h7><p>';

      for(var i = 0; i < warehouse_count; i++)
      {
        for(var j = 0; j < factory_count; j++)
        {
          toАppend += `X<small>${j+1},${i+1}</small>`;
          if(j != factory_count-1)
            toАppend += ` + `;
        }
        toАppend += ` = ${warehouse[i]}<br>`;
      }
      toАppend += `</p></div></div>`;
      toАppend += `<p>X<small>ij</small> ≥ 0,&nbsp;&nbsp;&nbsp; i = <span style="text-decoration: overline;">1-${(factory_count>warehouse_count)?factory_count:warehouse_count}</span>,&nbsp;&nbsp;&nbsp; j = <span style="text-decoration: overline;">1-${(factory_count>warehouse_count)?factory_count:warehouse_count}</span><br>X<small>ij</small> -> цяло число`;

      $('#solution2').html("").append(toАppend);
    }

    var factory_copy = new Array();
    var warehouse_copy = new Array();
    function step3() // Nachalno bazisno reshenie
    {
      var toАppend = '';
      var method = $('#method_select').val();

      factory_copy = factory.slice();
      warehouse_copy = warehouse.slice();

      if(method == 1)
      {
        toАppend += `<h6>Метод на северозападния ъгъл</h6><table class="table table-responsive table-bordered"><thead><tr>`;
        var northWest = 0;
        for(var i = 0; i < factory_count; i++)
        {
          for(var j = northWest; j < warehouse_count; j++)
          {
            quantityMatrix[i][j] = 0;
            var quantity = (factory[i] < warehouse[j])?factory[i]:warehouse[j];
            if(quantity > 0)
            {
              quantityMatrix[i][j] = quantity;
              factory[i]-=quantity;
              warehouse[j] -=quantity;

              if(factory[i] == 0)
              {
                northWest = j;
                break;
              }
            }
          }
        }

        for(var i = 0; i <= warehouse_count; i++)
        {
          if(i == 0)
          {
            toАppend += `<th scope="col" class="text-center">План 1</th>`;
          }else{
            toАppend += `<th scope="col">Склад ${i} <small><span class="text-secondary" data-toggle="tooltip" data-placement="bottom" title="Капацитет на склад ${i}">(${warehouse_copy[i-1]})</span></small></th>`;
          }
        }
        toАppend += `</tr></thead><tbody>`;

        for(var i = 0; i < factory_count; i++)
        {
          toАppend += `<tr>`;

          for(var j = -1; j < warehouse_count; j++)
          {
            if(j == -1)
            {
              toАppend += `<td class="text-left m-3 fit">Завод ${i+1} <small><span class="text-secondary" data-toggle="tooltip" data-placement="right" title="Изделия, произведени в завод ${i+1}">(${factory_copy[i]})</span></small></td>`;
            }else{
              toАppend += `<td class="text-center m-3 cell ${(quantityMatrix[i][j] == 0)?'hatching':''}"><span data-toggle="tooltip" data-placement="right" title="Изделия, транспортирани от завод ${i+1} към склад ${j+1}">${(quantityMatrix[i][j] != 0)?quantityMatrix[i][j]:''}</span><span class="cell-info text-danger">${costs[i][j]}</span></td>`;
            }
            $(function () {
              $('[data-toggle="tooltip"]').tooltip('dispose');
              $('[data-toggle="tooltip"]').tooltip()
            })
            
          }
          toАppend += `</tr>`;
        }

        toАppend += `</tbody></table>`;

        toАppend += `<p>Z = `;
        var sum = 0;
        for(var i = 0; i < factory_count; i++)
        {
          toАppend += `(`
          for(var j = 0; j < warehouse_count; j++)
          {
            sum += costs[i][j]*quantityMatrix[i][j];
            toАppend += `${costs[i][j]}*${quantityMatrix[i][j]}`;
            if(j != warehouse_count-1)
              toАppend += ` + `;
          }
          toАppend += `) `;
          if(i != factory_count-1)
            toАppend += ` + `;
        }
        toАppend += ` = <span data-toggle="tooltip" data-placement="right" title="Общата сума за транспортни разходи по плана">${sum}</span>`;
      }

      $('#solution3').html("").append(toАppend);

      $(function () {
        $('[data-toggle="tooltip"]').tooltip('dispose');
        $('[data-toggle="tooltip"]').tooltip()
      })
    }

    /*var paths = new Array();
    function step4()
    {
      var toАppend = '';
      var method = $('#optimalmethod_select').val();
      if(method == 1)
      {
        toАppend += `<h6>Разпределителен метод</h6>`;

        paths = new Array();
        for(var i = 0; i < factory_count; i++)
        {
          for(var j = 0; j < warehouse_count; j++)
          {
            if(quantityMatrix[i][j] != 0)
            {
              continue;
            }

            var path = new Array();
            path.push([i, j, 2, 2]);


            // Vyrtim cikyl za vseki edin element, koito e != 0
            for(var ii = 0; ii < factory_count; ii++)
            {
              for(var jj = 0; jj < warehouse_count; jj++)
              {
                if(quantityMatrix[ii][jj] == 0)
                {
                  continue;
                }

                var vertical = 0;
                var horizontal = 0;

                //console.log(quantityMatrix[ii][jj]);

                // vyrtim cikyl, za da proverim dali tekushtiq element moje da ima vryzka s druga kletka po vertikalata
                for(var iii = 0; iii < factory_count; iii++)
                {
                  if(quantityMatrix[iii][jj] != 0 && iii != ii)
                  {
                    vertical = 1;
                    break;
                  }
                }


                // vyrtim cikyl, za da proverim, dali rekushtiq element moje da ima vryzka s druga kletka po horizontalata
                for(var jjj = 0; jjj < warehouse_count; jjj++)
                {
                  if(quantityMatrix[ii][jjj] != 0 && jjj != jj)
                  {
                    horizontal = 1;
                    break;
                  }
                }

                if(ii == i)
                {
                  horizontal = 2;
                }

                if(jj == j)
                {
                  vertical = 2;
                }

                if(vertical != 0 && horizontal != 0)
                {
                  path.push([ii, jj, vertical, horizontal]);
                }



              }
            }
            

            var elem = 0;
            var chackelement = 1;
            var finish = false;
            do
            {
              if(chackelement < path.length)
              {
                if(path[elem][0] == path[chackelement][0] || path[elem][1] == path[chackelement][1])
                {
                  if(path[chackelement][2] == 2 || path[chackelement][3] == 2)
                  {
                    finish = true;
                    chackelement++;
                    elem++;
                  }
                }else{
                  path.push(path[chackelement]);
                  path[chackelement] = 0;
                }
                chackelement++;
              }
              
            }while(finish == false);
          }
        }
      }

      $('#solution4').html("").append(toАppend);
    }*/

    function step4()
    {
      var paths = new Array();
      var toАppend = '';
      var method = $('#optimalmethod_select').val();
      if(method == 1)
      {
        toАppend += `<h5>4) Проверка за оптималност на План 1</h5><h6>Разпределителен метод</h6>`;
        var paths = new Array();
        razpr_met_paths(paths);

        toАppend += '<p>Относителна оценка:</p>'
        var zeromark = 0;
        var badMarks = new Array();
        $.each( paths, function( key, value ) {
          var plus = '';
          var plusval = 0;
          var minus = '';
          var minusval = 0;
          
          $.each( value, function( key1, value1 ) {
            if(value1[2] == '+')
            {
              if(plus != ''){ plus += ' + '; }
              plus += `${costs[value1[0]][value1[1]]}`;
              plusval += costs[value1[0]][value1[1]];
            }
            if(value1[2] == '-')
            {
              if(minus != ''){ minus += ' + '; }
              minus += `${costs[value1[0]][value1[1]]}`;
              minusval += costs[value1[0]][value1[1]];
            }
          })
          var result = plusval - minusval;
          if(result == 0){ zeromark++; }
          else if(result < 0){ badMarks.push(1); }
          toАppend += `<p> <span>C<small>${value[0][0]+1},${value[0][1]+1}</small></span> -> (${plus}) - (${minus}) = ${result}${(result < 0)?` ≥ 0 <span class="text-danger"><i class="fas fa-window-close"></i></span>`:` ≥ 0 <span class="text-success"><i class="fas fa-check-square"></i></span>`}</p>`;
        });
        if(zeromark != 0)
        {
          toАppend += `<p>Наличието на нулеви оценки означава, че има алтернативен оптимум!</p>`;
        }
        if(badMarks.length > 0)
        {
          toАppend += `<p>Има налични отрицателни оценки => План 1 е неоптимален.</p><h5>5) Създаване на подобрен план</h5><h6 class="text-warning"> - Скоро - </h6>`;
        }else{
          toАppend += `<p>Всички относителни оценки удовлетворяват критерия за оптималност => План 1 е оптимален.</p>`;
        }
        
      }
      $('#solution4').html("").append(toАppend);
    }


    function razpr_met_paths(paths)
    {
        for(var i = 0; i < factory_count; i++)
        {
          for(var j = 0; j < warehouse_count; j++)
          {
            if(quantityMatrix[i][j] != 0)
            {
              continue;
            }

            var quantityMatrixCopy = new Array(factory_count);
              for (var copyi = 0; copyi < factory_count; ++copyi)
                quantityMatrixCopy[copyi] = quantityMatrix[copyi].slice(0);

            var deleted = false;
            var cpy = 0;
            do{
              cpy++;
              deleted = false;

              for(var row1 = 0; row1 < factory_count; row1++)
              {
                for(var col1 = 0; col1 < warehouse_count; col1++)
                {

                  if(quantityMatrixCopy[row1][col1] == 0)
                  {
                    continue;
                  }
                  var colOk = false;
                  var rowOk = false;

                  for(var row2 = 0; row2 < factory_count; row2++)
                  {
                    if(quantityMatrixCopy[row2][col1] != 0 && row2 != row1)
                    {
                      colOk = true;
                      break;
                    }
                  }

                  for(var col2 = 0; col2 < warehouse_count; col2++)
                  {
                    if(col2 != col1 && quantityMatrixCopy[row1][col2] != 0)
                    {
                      rowOk = true;
                      break;
                    }
                  }

                  if(row1 == i){ rowOk = true; }
                  if(col1 == j){ colOk = true; }

                  if(rowOk == false || colOk == false){
                    quantityMatrixCopy[row1][col1] = 0;
                    deleted = true;
                  }
                }
              }
            }while(deleted == true);

            //console.log(quantityMatrixCopy);

            var path = new Array();
            for(var t1 = 0; t1 < factory_count; t1++)
            {
              for(var t2 = 0; t2 < warehouse_count; t2++)
              {
                if(quantityMatrixCopy[t1][t2] != 0)
                {
                  path.push([t1, t2]);
                }
              }
            }

            var end = false;
            var elem = [i, j, '+'];
            var sorted_path = new Array();
            sorted_path.push(elem);
            do{
              $.each( path, function( key, value ) {
                if(value[0] != -1 && value[1] != -1)
                {
                  if(value[0] == elem[0] || value[1] == elem[1])
                  {
                    sorted_path.push([value[0], value[1], (elem[2] == '+')?'-':'+']);
                    elem = [value[0], value[1], (elem[2] == '+')?'-':'+'];
                    value[0] = -1;
                    value[1] = -1;
                  }
                }
                if(sorted_path.length == (path.length+1))
                {
                  end = true;
                }
              });
            }while(end == false);
            paths.push(sorted_path);
          }
        }
    }

    function exportHTML(){
       var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' "+
            "xmlns:w='urn:schemas-microsoft-com:office:word' "+
            "xmlns='http://www.w3.org/TR/REC-html40'>"+
            `<head><meta charset='utf-8'><title>Транспортна задача</title></head><body>`;
       var footer = "</body></html>";
       var sourceHTML = header+document.getElementById("solution").innerHTML+footer;
       
       var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
       var fileDownload = document.createElement("a");
       document.body.appendChild(fileDownload);
       fileDownload.href = source;
       fileDownload.download = 'transportna_zadacha.doc';
       fileDownload.click();
       document.body.removeChild(fileDownload);
    }
  </script>

</html>

