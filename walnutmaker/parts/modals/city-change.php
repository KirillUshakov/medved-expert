<div id="wt-modal-city-change" class="wt-modal wt-modal-city-change" data-selectable="true" style="display: none;">
	<div class="wt-modal-title">Выберите город</div>
	<div class="wt-modal-cities">
		<ul class="wt-modal-row">
			<?php
				global $wp;
				$current_url = home_url( $wp->request ) . '/';
			?>
			<?php foreach( get_cities() as $city ) { ?>
				<li class="wt-modal-col col-sm-4">
					<button
						type="button"
						data-city-change
						data-city-id="<?= $city['id'] ?>"
						onclick="ym(48605087, 'reachGoal', 'CHANGE_CITY'); return true;"
						class="wt-modal-city-current <?= is_cur_city($city) ? 'wt-modal-city-current-name' : '' ?>"
					>
						<?php echo $city[ 'name' ]; ?>
					</button>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
