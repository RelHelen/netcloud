<header class="panel-header">
					<ul class="panel-status">
						<li class="panel-status-item panel-balance panel-balance_limit">
							<span class="panel-par">Баланс:</span>
							<span class="panel-value panel-value_currency">			<?php
								if(!empty($balanse)){
									echo $balanse;
								};
								?>
							</span>	
						</li>
						<li class="panel-status-item panel-date panel-date_limit">
							<span class="panel-par">Дата списания:</span>
							<span class="panel-value">28.03.21</span>	
						</li>
					</ul>	
					<div class="ctl-count">			
						<form action="#" class="ctl-count-form">
							<button type="submit"class="ctl-count-btn" id="ctl-count-btn"><span>Пополнить счет</span></button>
						</form>
					</div>
				</header>    