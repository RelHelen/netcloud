<!--  Контракты пользователя -->

<div class="box  br-lt contract">

	<?php $i = 0;
	if (!empty($contracts)) : ?>
		<?php foreach ($contracts as $contract) :
			$i++;
			// debug($contract);
		?>
			<a class="link-shadow link-contracts" id="<?= $contract['contr_nomer'] ?>" data-title="<?= $contract['contr_nomer'] ?>" data-id="<?= $contract['id'] ?>" href="<?= PATH ?>/contracts/<?= $contract['contr_nomer'] ?>" id="<?= $contract['id'] ?>">
				<div class="contract-item">
					<h3 class="contract-header">
						Договор <?= $contract['contr_nomer'] ?> от <?= $contract['contr_date_st'] ?> </h3>
					<ul class="contract-detalies">
						<li class="contract-detalies-item">
							<span class="par par_cotract lbl">Адрес: </span>
							<span class="val val_contract rbl">
								<?= $contract['contr_adres_set'] ?> </span>
						</li>

						<li class="contract-detalies-item">
							<span class="par par_cotract lbl">Сумма аренды: </span>
							<span class="val val_contract rbl">
								<?php if (!empty($contract['cust'])) : ?>
									<?= $contract['cust'] ?>р/
								<?php endif; ?>

								<?php if (!empty($contract['period'])) : ?>
									<?= $contract['period']; ?>дней
								<?php endif; ?>

							</span>
						</li>

					</ul>
				</div>
			</a>
		<?php endforeach; ?>
	<?php endif; ?>
</div>