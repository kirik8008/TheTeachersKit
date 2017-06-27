
        <div id="global">
            <div class="container-fluid cm-container-white">
                <h2 style="margin-top:0;">The Teacher's Kit</h2> 
                               <p>УчительскийКомплект - CMS для контроля выдачи оборудования учителям. </p>
                  <div class="alert alert-danger"><center>На стадии разработки!</center></div>
               <div class="alert alert-info"><center>Исходный код находится на <a href="https://github.com/kirik8008/TheTeachersKit" target="_blank">GitHub</a></center>
               </div>
               </div>
            <div class="container-fluid">
            	<div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Всего комплектов</div>
                            <div class="panel-body">
                                <div style="height:150px"><p style="font-size: 80px" align="center"><? if(!empty($all)) echo $all; else echo '#'; ?></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Комплекты на складе</div>
                            <div class="panel-body">
                                <div style="height:150px"><p style="font-size: 80px" align="center"><? if(!empty($in_stock)) echo $in_stock; else echo '#'; ?></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Не рабочее оборудование</div>
                            <div class="panel-body">
                                <div style="height:150px"><p style="font-size: 80px" align="center"><? if(!empty($nonworking)) echo $nonworking; else echo '#'; ?></P></div>
                            </div>
                        </div>
                    </div>
                </div>	 
            </div>
            
            