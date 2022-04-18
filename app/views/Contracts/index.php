<header class="main-header p-tl">
				<h2 class="main-header__h2">
					Договора
				</h2>
			</header>
			<section class="panel panel_view p-tl">
				<div class="box  br-lt contract">					
					<?php $i=0;  if (!empty($contracts)): ?>
						<?php foreach($contracts as $res): $i++;  ?>							
						<a class="link-shadow" href="?q=<?=$res['contr_nomer']?>" id="id-<?=$i;?>">  
							<div class="contract-item">				
									<h3 class="contract-header">
										Договор <?=$res['contr_nomer']?> от  <?=$res['contr_date_st']?> </h3>
									<ul class="contract-detalies">
										<li class="contract-detalies-item">
											<span class="par par_cotract lbl">Адрес: </span>
											<span class="val val_contract rbl">
												<?=$res['contr_adres_set']?>  </span>
										</li>
										<li class="contract-detalies-item">
											<span class="par par_cotract lbl">Сумма аренды: </span>
											<span class="val val_contract rbl">3800р/30дней</span>
										</li>
									</ul>
							</div>
						</a>
					    <?php endforeach; ?>
						<?php endif; ?>									 				
				</div>						
			</section>
