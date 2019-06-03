
        <div id="global">
            <div class="container-fluid">
            <? if(!empty($error)) echo $error; ?>
                <div class="row">
                  <div class="col-xs-4" >
                    <div class="panel panel-default pre-scrollable mv100" style="min-height: 75vh; max-height: 75vh">
                        <div class="panel-heading">Диалоги <i class="fa fa-plus-circle"></i></div>
                        <div class="panel-body" id="dialogs">

                            <div class="row" onmouseover="this.style.backgroundColor='#eeeeee'" onmouseout="this.style.backgroundColor=''">
                              <div class="col-xs-2"><p><i class="fa fa-plus-circle"></i></p></div>
                              <div class="col-xs-8"><p>Иванов Иван</p></div>
                              <div class="col-xs-2"><p><input type="checkbox" name="user_1"></p></div>
                            </div>

                        </div>
                    </div>
                  </div>
                  <div class="col-xs-8" >
                    <div class="panel panel-default pre-scrollable" style="min-height: 75vh; max-height: 75vh">
                        <div class="panel-body" id="message">
                            <p>Выберите или создайте новый диалог.</p>
                            

                        </div>
                    </div>
                  </div>
            </div>
