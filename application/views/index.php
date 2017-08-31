
        <div id="global">
            <div class="container-fluid cm-container-white">
                <table WIDTH="100%">
                <tr><td><h2 style="margin-top:0;">The Teacher's Kit</h2> 
                               <p>УчительскийКомплект - CMS для контроля выдачи оборудования учителям. </p>
<<<<<<< HEAD
                  <div class="alert alert-info"><center>Актуальные версии на GitHub</center></div>
              </td><td WIDTH="10%"><center><i style="font-size: 100px">β</i></center></td>
=======
                  <div class="alert alert-info"><center>Версия для демонстрации функций CMS (170725-13)</center></div>
              </td><td WIDTH="10%"><center><i style="font-size: 100px">α</i></center></td>
>>>>>>> master
               </tr>
               </table>
               </div>
            <div class="container-fluid">
            	<div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Всего комплектов</div>
                            <div class="panel-body">
                                <div style="height:70px"><p style="font-size: 50px" align="center"><? if(!empty($all)) echo $all; else echo '#'; ?></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Комплекты на складе</div>
                            <div class="panel-body">
                                <div style="height:70px"><p style="font-size: 50px" align="center"><? if(!empty($in_stock)) echo $in_stock; else echo '#'; ?></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Не рабочее оборудование</div>
                            <div class="panel-body">
                                <div style="height:70px"><p style="font-size: 50px" align="center"><? if(!empty($nonworking)) echo $nonworking; else echo '#'; ?></P></div>
                            </div>
                        </div>
                    </div>
                </div>	
                
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Всего преподователей</div>
                            <div class="panel-body">
                                <div style="height:70px"><p style="font-size: 50px" align="center"><? if(!empty($allteacher)) echo $allteacher; else echo '#'; ?></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Временные (без/с оборуд.)</div>
                            <div class="panel-body">
                                <div style="height:70px"><p style="font-size: 50px" align="center"><? if(!empty($nojob)) echo $nojob; else echo '#'; ?></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">Постоянные (без/с оборуд.)</div>
                            <div class="panel-body">
                                <div style="height:70px"><p style="font-size: 50px" align="center"><? if(!empty($job)) echo $job; else echo '#'; ?></P></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                 
            </div>
            
            