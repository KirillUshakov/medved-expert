</main>

<?php wm_footer_blocks();
	$bIndexBot = ( isset( $_SERVER[ 'HTTP_ACCEPT_LANGUAGE' ] ) && strpos( $_SERVER[ 'HTTP_USER_AGENT' ], 'Lighthouse' ) !== false );
?>

<?php if( is_front_page() ) { ?>
	<section class="wt-custom-content">
		<div class="container">
			<div class="wt-custom-content-head">
				<h2 class="wt-custom-content-title">Вопрос - ответ</h2>
			</div>
			<div class="wt-custom-content-wrap wt-styles">
				<div class="acc">
					<link
							href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&amp;display=swap"
							rel="stylesheet">
					<div class="container">
						<div class="accordion v1">
							<div class="a-container">
								<div class="a-btn">Через сколько времени мастер прибудет на место?</div>
								<div class="a-panel">Уже через 15-20 минут после заявки наш специалист прибудет по указанному адресу и начнет работу.
									Он свяжется с вами по телефону, с которого был совершен вызов.
								</div>
							</div>
							<div class="a-container">
								<div class="a-btn">Будет ли повреждена дверь во время вскрытия?</div>
								<div class="a-panel">Каждый специалист нашей компании имеет большой опыт работы и высокий уровень квалификации.
									Используемые современные методы и инструменты обеспечивают аккуратное вскрытие замка без повреждения дверного
									полотна.
								</div>
							</div>
							<div class="a-container">
								<div class="a-btn">Сколько времени занимает вскрытие замка?</div>
								<div class="a-panel">Все зависит от типа дверного замка. К примеру, обычные запорные механизмы вскрываются за 10
									минут, тогда как более сложные разновидности моделей могут потребовать 20 минут и больше.
								</div>
							</div>
							<div class="a-container">
								<div class="a-btn">Выполняете ли вы замену замка на новый после вскрытия?</div>
								<div class="a-panel">Мы предлагаем полный спектр услуг, который включает вскрытие, демонтаж, установку и настройку
									нового замка. При этом мы используем современные модели от надежных производителей с защитой от открывания при
									помощи отмычек.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="wt-custom-content" style="padding: 0px 0 20px 0;">
		<div class="container">
			<div class="wt-custom-content-head">
				<h2 class="wt-custom-content-title">Способы оплаты услуг мастера</h2>
			</div>
			<div class="wt-custom-content-wrap wt-styles">
				<div class="money-card">
					<div class="group">
						<ul>
							<li><span>Банковские карты</span></li>
							<li>
								<div class="holder-img"><img src="/wp-content/uploads/payment/bg-21.png" alt="money-card">
								</div>
							</li>
							<li>
								<div class="holder-img"><img src="/wp-content/uploads/payment/bg-22.png" alt="money-card">
								</div>
							</li>
							<li>
								<div class="holder-img"><img src="/wp-content/uploads/payment/bg-23.png" alt="money-card">
								</div>
							</li>
						</ul>
						<ul>
							<li><span>Электронные деньги</span></li>
							<li>
								<div class="holder-img"><img src="/wp-content/uploads/payment/bg-24.png" alt="money-card">
								</div>
							</li>
							<li>
								<div class="holder-img"><img src="/wp-content/uploads/payment/bg-25.png" alt="money-card">
								</div>
							</li>
							<li>
								<div class="holder-img"><img src="/wp-content/uploads/payment/bg-26.png" alt="money-card">
								</div>
							</li>
						</ul>
						<ul>
							<li><span>Онлайн оплата или наличными</span></li>
							<li>
								<div class="holder-img"><img
											src="/wp-content/uploads/payment/bg-27.png"
											alt="money-card"></div>
							</li>
							<li>
								<div class="holder-img"><img
											src="/wp-content/uploads/payment/bg-28.png"
											alt="money-card"></div>
							</li>
							<li>
								<div class="holder-img"><img
											src="/wp-content/uploads/payment/bg-29.png"
											alt="money-card"></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="wt-triggers" style="background-color:#f8f9f9; display:none;">
		<div class="container">
			<h2 class="wt-items-title">Наши сотрудники</h2>
			<ul class="wt-items-row content-left">
				<li class="wt-items-col col-sm-6 col-md-3">
					<div class="wt-items-thumbnail" style="text-align: center;">
						<img width="768" height="432"
								src="https://medved-expert.ru/wp-content/uploads/worker/1.jpeg"
								class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 1"
								loading="lazy">
						<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Юрий</div>
						<a href="https://wa.me/79162680238?roistat_visit=182760" style="
                        color: #252525;
                        background: #eead0b;
                        background: linear-gradient(to bottom,#eead0b 0,#f2ca10 50%,#eead0b 100%);
                        background-size: auto 200%;
                        background-position: left bottom;
                        font-size: 16px;
                        padding: 19px;
                        text-align: center;" class="btn btn-default">Написать в Whatsapp</a>
					</div>
				</li>
				<li class="wt-items-col col-sm-6 col-md-3">
					<div class="wt-items-thumbnail" style="text-align: center;">
						<img width="768" height="432"
								src="https://medved-expert.ru/wp-content/uploads/worker/2.jpeg"
								class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 2"
								loading="lazy">
						<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Николай</div>
						<a href="https://wa.me/79162680238?roistat_visit=182760" style="
                        color: #252525;
                        background: #eead0b;
                        background: linear-gradient(to bottom,#eead0b 0,#f2ca10 50%,#eead0b 100%);
                        background-size: auto 200%;
                        background-position: left bottom;
                        font-size: 16px;
                        padding: 19px;
                        text-align: center;" class="btn btn-default">Написать в Whatsapp</a>
					</div>
				</li>
				<li class="wt-items-col col-sm-6 col-md-3">
					<div class="wt-items-thumbnail" style="text-align: center;">
						<img width="768" height="432"
								src="https://medved-expert.ru/wp-content/uploads/worker/3.jpeg"
								class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 3"
								loading="lazy">
						<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Александр</div>
						<a href="https://wa.me/79162680238?roistat_visit=182760" style="
                        color: #252525;
                        background: #eead0b;
                        background: linear-gradient(to bottom,#eead0b 0,#f2ca10 50%,#eead0b 100%);
                        background-size: auto 200%;
                        background-position: left bottom;
                        font-size: 16px;
                        padding: 19px;
                        text-align: center;" class="btn btn-default">Написать в Whatsapp</a>
					</div>
				</li>
				<li class="wt-items-col col-sm-6 col-md-3">
					<div class="wt-items-thumbnail" style="text-align: center;">
						<img width="768" height="432"
								src="https://medved-expert.ru/wp-content/uploads/worker/4.jpeg"
								class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 4"
								loading="lazy">
						<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Анатолий</div>
						<a href="https://wa.me/79162680238?roistat_visit=182760" style="
                        color: #252525;
                        background: #eead0b;
                        background: linear-gradient(to bottom,#eead0b 0,#f2ca10 50%,#eead0b 100%);
                        background-size: auto 200%;
                        background-position: left bottom;
                        font-size: 16px;
                        padding: 19px;
                        text-align: center;" class="btn btn-default">Написать в Whatsapp</a>
					</div>
				</li>
			</ul>
		</div>
	</section>

	<section class="wt-triggers wt-triggers-color-blue wt-triggers-btn-extra wt-triggers-slider wt-triggers-service"
			style="background-color:#f6f7f8;">
		<div class="container">
			<h3 class="wt-triggers-title">Наши сотрудники</h3>
			<div class="wt-triggers-wrap owl-carousel owl-loaded"
					data-options="[&quot;dots&quot;,&quot;arrows&quot;]" data-speed="1000"
					data-interval="5000" data-cols="4">
				<div class="wt-triggers-item" style="justify-content: center;">

					<div class="wt-triggers-content-description" style="text-align:center;">
						<img width="768" height="432"
								src="https://medved-expert.ru/wp-content/uploads/worker/1.jpeg"
								class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 1"
								loading="lazy">
						<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Юрий</div>
						<a href="https://wa.me/79162680238?roistat_visit=182760" class="call-worker">Написать в Whatsapp</a>
					</div>


				</div>
				<div class="wt-triggers-item" style="justify-content: center;">
					<img width="768" height="432"
							src="https://medved-expert.ru/wp-content/uploads/worker/2.jpeg"
							class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 2"
							loading="lazy">
					<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Николай</div>
					<a href="https://wa.me/79162680238?roistat_visit=182760" class="call-worker">Написать в Whatsapp</a>
				</div>
				<div class="wt-triggers-item" style="justify-content: center;">
					<img width="768" height="432"
							src="https://medved-expert.ru/wp-content/uploads/worker/3.jpeg"
							class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 3"
							loading="lazy">
					<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Александр</div>
					<a href="https://wa.me/79162680238?roistat_visit=182760" class="call-worker">Написать в Whatsapp</a>
				</div>
				<div class="wt-triggers-item" style="justify-content: center;">
					<img width="768" height="432"
							src="https://medved-expert.ru/wp-content/uploads/worker/4.jpeg"
							class="attachment-adaptive size-adaptive wp-post-image" alt="Сотрудник 4"
							loading="lazy">
					<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Анатолий</div>
					<a href="https://wa.me/79162680238?roistat_visit=182760" class="call-worker">Написать в Whatsapp</a>
				</div>
			</div>
		</div>
	</section>

	<?php if( !$bIndexBot ): ?>
		<!-- v3 -->
		<section class="wt-triggers wt-triggers-color-blue wt-triggers-btn-extra wt-triggers-slider wt-triggers-service"
				style="background-color:#f6f7f8;">
			<!-- <div class="container">
				<h2 class="wt-triggers-title">Видео отзывы</h2>
					<div class="wt-triggers-wrap owl-carousel owl-loaded"
						data-options="[&quot;dots&quot;,&quot;arrows&quot;]" data-speed="1000"
						data-interval="5000" data-cols="2">

					<div class="wt-triggers-item" style="justify-content: center; display: block;">
						<div class="wt-triggers-content-description" style="text-align:center;">
							<iframe width="100%" height="415" src="https://www.youtube.com/embed/j6jFpB2fo9A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<div class="wt-triggers-item" style="justify-content: center; display: block;">
						<div class="wt-triggers-content-description" style="text-align:center;">
							<iframe loading="lazy" width="100%" height="415" src="https://www.youtube.com/embed/YZbpegi0r8I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>


					<div class="wt-triggers-item" style="justify-content: center; display: block;">
						<div class="wt-triggers-content-description" style="text-align:center;">
							<iframe loading="lazy" width="100%" height="415" src="https://www.youtube.com/embed/RyI7UVkeQKA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<div class="wt-triggers-item" style="justify-content: center; display: block;">
						<div class="wt-triggers-content-description" style="text-align:center;">
							<iframe loading="lazy" width="100%" height="415" src="https://www.youtube.com/embed/i4zbSdEGbw8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
					<div class="wt-triggers-item" style="justify-content: center; display: block;">
						<div class="wt-triggers-content-description" style="text-align:center;">
							<iframe loading="lazy" width="100%" height="415" src="https://www.youtube.com/embed/gLV5-JHjqQs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div> -->
		</section>


	<?php endif; ?>

	<section class="wt-triggers wt-triggers-color-blue wt-triggers-btn-extra wt-triggers-slider wt-triggers-service2"
			style="background-color:#f6f7f8;">
		<div class="container">
			<h2 class="wt-triggers-title">ОТКРЫВАЕМ АВТОМОБИЛИ</h2>
			<div class="wt-triggers-wrap owl-carousel owl-loaded"
					data-options="[&quot;arrows&quot;,&quot;auto&quot;,&quot;loop&quot;]" data-speed="1000"
					data-interval="5000" data-cols="3">

				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="143"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/car_mercedes.png"
									class="attachment-adaptive size-adaptive" alt="car_mercedesмерседес" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/car_mercedes.png 330w, https://medved-expert.ru/wp-content/uploads/2022/03/car_mercedes-300x130.png 300w"
									sizes="(max-width: 330px) 100vw, 330px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Mercedes</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/bmw.png"
									class="attachment-adaptive size-adaptive" alt="bmwBMW" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/bmw.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/bmw-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">BMW</div>
						</div>
					</div>
				</div>
				<div class="owl-item active" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/audi.png"
									class="attachment-adaptive size-adaptive" alt="audiAudi" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/audi.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/audi-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Audi</div>
						</div>
					</div>
				</div>
				<div class="owl-item active" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/car_hyundai.png"
									class="attachment-adaptive size-adaptive" alt="car_hyundaiHyundai" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/car_hyundai.png 329w, https://medved-expert.ru/wp-content/uploads/2022/03/car_hyundai-300x133.png 300w"
									sizes="(max-width: 329px) 100vw, 329px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Hyundai</div>
						</div>
					</div>
				</div>
				<div class="owl-item active" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/volkswagen.png"
									class="attachment-adaptive size-adaptive" alt="volkswagenVolkswagen"
									loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/volkswagen.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/volkswagen-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Volkswagen</div>
						</div>
					</div>
				</div>
				<div class="owl-item active" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/ford.png"
									class="attachment-adaptive size-adaptive" alt="fordFord" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/ford.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/ford-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px">
							<div class="wt-triggers-content">
								<div class="wt-triggers-content-name">Ford</div>
							</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/renault.png"
									class="attachment-adaptive size-adaptive" alt="renaultRenault" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/renault.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/renault-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Renault</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/kia.png"
									class="attachment-adaptive size-adaptive" alt="kiaKia" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/kia.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/kia-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Kia</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/skoda.png"
									class="attachment-adaptive size-adaptive" alt="skodaSkoda" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/skoda.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/skoda-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Skoda</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/nissan.png"
									class="attachment-adaptive size-adaptive" alt="nissanNissan" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/nissan.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/nissan-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Nissan</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/opel.png"
									class="attachment-adaptive size-adaptive" alt="opelOpel" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/opel.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/opel-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Opel</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/mitsubishi.png"
									class="attachment-adaptive size-adaptive" alt="mitsubishiMitsubishi" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/mitsubishi.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/mitsubishi-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Mitsubishi</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/peugeot.png"
									class="attachment-adaptive size-adaptive" alt="peugeotPeugeot" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/peugeot.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/peugeot-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Peugeot</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/mazda.png"
									class="attachment-adaptive size-adaptive" alt="mazdaMazda" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/mazda.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/mazda-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Mazda</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/rover.png"
									class="attachment-adaptive size-adaptive" alt="roverRover" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/rover.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/rover-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Rover</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/volvo.png"
									class="attachment-adaptive size-adaptive" alt="volvoVolvo" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/volvo.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/volvo-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Volvo</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/honda.png"
									class="attachment-adaptive size-adaptive" alt="hondaHonda" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/honda.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/honda-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Honda</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/fiat.png"
									class="attachment-adaptive size-adaptive" alt="fiatFiat" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/fiat.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/fiat-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Fiat</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/citroen.png"
									class="attachment-adaptive size-adaptive" alt="citroenCitroen" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/citroen.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/citroen-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Citroen</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/chevrolet.png"
									class="attachment-adaptive size-adaptive" alt="chevroletChevrolet" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/chevrolet.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/chevrolet-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Chevrolet</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/infiniti.png"
									class="attachment-adaptive size-adaptive" alt="infinitiInfiniti" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/infiniti.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/infiniti-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Infiniti</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/lexus.png"
									class="attachment-adaptive size-adaptive" alt="lexusLexus" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/lexus.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/lexus-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Lexus</div>
						</div>
					</div>
				</div>
				<div class="owl-item" style="width: 262.5px;">
					<div class="wt-triggers-item">
						<div class="wt-triggers-icon"><img width="340" height="148"
									src="https://medved-expert.ru/wp-content/uploads/2022/03/porsche.png"
									class="attachment-adaptive size-adaptive" alt="porschePorsche" loading="lazy"
									srcset="https://medved-expert.ru/wp-content/uploads/2022/03/porsche.png 340w, https://medved-expert.ru/wp-content/uploads/2022/03/porsche-300x131.png 300w"
									sizes="(max-width: 340px) 100vw, 340px"></div>
						<div class="wt-triggers-content">
							<div class="wt-triggers-content-name">Porsche</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

<?php } ?>


<?php $phone = wt_options( 'phone' ); ?>
<section class="wt-triggers wt-triggers-color-blue wt-triggers-btn-extra wt-triggers-slider wt-triggers-service"
		style="background-color:#f6f7f8;">
	<div class="container">
		<h2 class="wt-triggers-title">Вскрываем замки самых разных видов и сложностей</h2>
		<div class="wt-triggers-wrap owl-carousel owl-loaded"
				data-options="[&quot;dots&quot;,&quot;auto&quot;,&quot;loop&quot;]" data-speed="1000"
				data-interval="5000" data-cols="1">
			<div class="wt-triggers-item">
				<div class="wt-triggers-icon">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trigger-1.jpg" alt="Вскрыть замок">
				</div>
				<div class="wt-triggers-content">
					<h3 class="wt-triggers-content-name">Вскрыть замок</h3>
					<div class="wt-triggers-content-description">Если вы потеряли ключи, сломался ключ в личинке или
						замок попросту заклинил и открытие двери становится невозможным, обратитесь за помощью в
						аварийную замочную службу “Медведь Эксперт”. Мы оказываем услуги по аварийному вскрытию замков
						любой сложности: оперативно и круглосуточно. Наши мастера проведут диагностику и какой бы ни
						была причина поломки, используют самые современные способы и методы аварийного вскрытия. Мы
						гарантируем проведение работ без повреждений.
					</div>
				</div>
				<div class="wt-action">
					<div class="wt-action-more">
						<a href="<?php echo $phone[ 'href' ]; ?>"
								class="btn btn-default me_phone"><?php echo $phone[ 'title' ]; ?></a>
					</div>
				</div>
			</div>
			<div class="wt-triggers-item">
				<div class="wt-triggers-icon">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trigger-2.jpg" alt="Вскрыть машину">
				</div>
				<div class="wt-triggers-content">
					<h3 class="wt-triggers-content-name">Вскрыть машину</h3>
					<div class="wt-triggers-content-description">Очень часто автовладельцы сталкиваются с проблемами с
						замками авто. Это может быть заклинивание замочного механизма, последствия попытки взлома
						злоумышленниками, повреждения ключа и другие причины. Тем не менее, не стоит паниковать — мы
						гарантируем, что любая проблема имеет решение. Вам необходимо лишь позвонить мастерам замочной
						службы “Медведь Эксперт”, и мы выполним работы по аварийному вскрытию замка авто без
						повреждений, качественно и оперативно.
					</div>
				</div>
				<div class="wt-action">
					<div class="wt-action-more">
						<a href="<?php echo $phone[ 'href' ]; ?>"
								class="btn btn-default me_phone"><?php echo $phone[ 'title' ]; ?></a>
					</div>
				</div>
			</div>
			<div class="wt-triggers-item">
				<div class="wt-triggers-icon">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trigger-3.jpg" alt="Вскрыть дверь">
				</div>
				<div class="wt-triggers-content">
					<h3 class="wt-triggers-content-name">Вскрыть дверь</h3>
					<div class="wt-triggers-content-description">Случаются ситуации, когда у вас не получается открыть
						дверь квартиры, дачи или любого другого помещения. Причины тому могут быть самые разнообразные,
						и чаще всего они связаны с полным или частичным выходом из строя замка. Чтобы решить проблему,
						не повредив при этом дверное полотно, необходимо вызвать профильных специалистов. Мастера
						замочной службы “Медведь Эксперт” помогут вскрыть дверь быстро и недорого. Кроме того, мы
						гарантируем проведение работ без сопутствующих повреждений.
					</div>
				</div>
				<div class="wt-action">
					<div class="wt-action-more">
						<a href="<?php echo $phone[ 'href' ]; ?>"
								class="btn btn-default me_phone"><?php echo $phone[ 'title' ]; ?></a>
					</div>
				</div>
			</div>
			<div class="wt-triggers-item">
				<div class="wt-triggers-icon">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trigger-4.jpg" alt="Вскрыть сейф">
				</div>
				<div class="wt-triggers-content">
					<h3 class="wt-triggers-content-name">Вскрыть сейф</h3>
					<div class="wt-triggers-content-description">Все самые важные документы, драгоценности и просто
						какие-то особенные вещи принято хранить в сейфах: это безопасно и надежно. Но что делать, если
						вы вдруг забыли комбинацию пароля или замок отказывается открываться по непонятным причинам? В
						этом случае лучшим решением станет вызов специалиста аварийной замочной службы “Медведь
						Эксперт”. Сейфовые замки обладают высокой степенью защиты, а значит вскрыть сейф самостоятельно
						практически невозможно. Кроме того, мастер обеспечит не только качественное вскрытие сейфа при
						помощи специальных инструментов, но и убережет ваше дорогостоящее хранилище от повреждений.
					</div>
				</div>
				<div class="wt-action">
					<div class="wt-action-more">
						<a href="<?php echo $phone[ 'href' ]; ?>"
								class="btn btn-default me_phone"><?php echo $phone[ 'title' ]; ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php if( !$bIndexBot ): ?>
	<section class="wt-custom-content">
		<div class="container">
			<div class="wt-page-row">
				<div class="wt-category-col col-sm-12 col-md-12">
					<h2 class="wt-triggers-title">Локации мастеров</h2>
				</div>
				<div class="wt-category-col col-sm-12 col-md-12">
					<div id="map"></div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>

<section class="scheme wt-custom-content scheme sal-animate" data-sal="fade" data-sal-delay="100" data-sal-duration="500"
		data-sal-easing="ease-in-out" style="margin-bottom: 50px;">
	<div class="container">
		<h2 class="wt-triggers-title">Этапы вскрытия дверных замков</h2>
		<div class="scheme-subtitle section-subtitle" style="font-size: 22px;color: #252525;">Cхема работы с нами</div>
		<div class="scheme-wrapper" style="margin-bottom: 20px;">
			<div class="scheme-inner right" id="scheme-steps">
				<ul class="scheme-steps">
					<li class="step-item">
						<div class="item-number">1</div>
						<div class="item-icon">
							<img src="/wp-content/uploads/scheme/scheme-step1.svg" alt="icon">
						</div>
						<div class="item-info">Подача заявки по номеру телефона или другим удобным способом</div>
					</li>
					<li class="step-item">
						<div class="item-number">2</div>
						<div class="item-icon">
							<img src="/wp-content/uploads/scheme/scheme-step2.svg" alt="icon">
						</div>
						<div class="item-info">Выезд мастера на объект в течение 15-20 минут</div>
					</li>
					<li class="step-item">
						<div class="item-number">3</div>
						<div class="item-icon">
							<img src="/wp-content/uploads/scheme/scheme-step2-2.png" alt="icon">
						</div>
						<div class="item-info">Подтверждение факта проживания или права собственности на объект</div>
					</li>
					<li class="step-item">
						<div class="item-number">4</div>
						<div class="item-icon">
							<img src="/wp-content/uploads/scheme/scheme-step3.svg" alt="icon">
						</div>
						<div class="item-info">Определение типа замка и его аккуратное вскрытие без повреждения двери</div>
					</li>
					<li class="step-item">
						<div class="item-number">5</div>
						<div class="item-icon">
							<img src="/wp-content/uploads/scheme/scheme-step4.svg" alt="icon">
						</div>
						<div class="item-info">Оплата услуги и консультация специалиста</div>
					</li>
				</ul>
				<div style="display:flex; position: absolute; width: 90%; margin-top: 25px;">
					<div style="flex: 2 1;"></div>
					<div id="prev-scheme-steps" style="flex: 2 1;"></div>
					<div style="flex: 2 1;"></div>
					<div id="next-scheme-steps" style="flex: 2 1;"></div>
					<div style="flex: 2 1;"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="wt-custom-content">
	<div class="container">
		<h2 class="wt-triggers-title">Какие документы необходимы для вскрытия?</h2>
		<div class="scheme-subtitle section-subtitle" style="margin-bottom: 30px; font-size: 18px;color: #252525;">Для гарантии законности вскрытия
			дверного замка, необходимо подтвердить право собственности на объект недвижимости или факт проживания. Для этого подойдут следующие
			документы:
		</div>
		<div class="wt-page-row" style="text-align: center;">
			<ul class="document-list">
				<li>
					<div class="holder-img">
						<img
								src="https://medved-expert.ru/wp-content/uploads/bg-34.png"
								alt="Паспорт гражданина с указанием прописки в квартире или доме">
					</div>
					<p style="margin: 0 20px 0 20px;">Паспорт <span>гражданина с указанием прописки в квартире или доме</span></p>
				</li>
				<li>
					<div class="holder-img"><img
								src="https://medved-expert.ru/wp-content/uploads/bg-35.png"
								alt="Свидетельство о праве собственности"></div>
					<p style="margin: 0 20px 0 20px;">Свидетельство о праве собственности<span>на объект и паспорт для подтверждения личности (или водительские права)</span>
					</p>
				</li>
				<li>
					<div class="holder-img"><img
								src="https://medved-expert.ru/wp-content/uploads/bg-36.png"
								alt="Заверенный договор"></div>
					<p style="margin: 0 20px 0 20px;">Заверенный договор<span>аренды с действующими датами</span></p>
				</li>
			</ul>
		</div>
		<div class="scheme-subtitle section-subtitle" style="margin-bottom: 30px; font-size: 18px;color: #252525;">В том случае, если нет ни одного
			подтверждающего документа, вскрытие осуществляется только в присутствии участкового или представителей правоохранительных органов.
		</div>
	</div>
</section>

<section class="law sal-animate" data-sal="fade" data-sal-delay="100" data-sal-duration="500" data-sal-easing="ease-in-out" style="display:none;">
	<div class="container">
		<h2 class="wt-triggers-title">Делаем все по закону</h2>
		<div class="law-subtitle section-subtitle">Наша служба вскрытия замков и дверей соблюдает законы. Поэтому подготовьте паспорт и<br> документы,
			которые подтверждают, что имущество принадлежит вам.
		</div>
		<div class="law-documents">
			<div class="row" style="text-align:center;">

				<div class="wt-category-col col-sm-6 col-md-4">
					<div class="documents-group">
						<div class="group-title">Вскрыть входную дверь в квартиру,<br> дом или офис</div>
						<ul class="group-list">
							<li class="group-item">
								<img src="/wp-content/uploads/law-documents/document1.jpg" alt="img">
								<span>Свидетельство о регистрации, выписки из<br> ЕГРП или договор аренды</span>
							</li>
							<li class="group-item">
								<img src="/wp-content/uploads/law-documents/document2.jpg" alt="img">
								<span>Паспорт</span>
							</li>
						</ul>
					</div>
				</div>

				<div class="wt-category-col col-sm-6 col-md-4">
					<div class="documents-group">
						<div class="group-title">Вскрыть дверь или багажник<br> автомобиля</div>
						<ul class="group-list">
							<li class="group-item">
								<img src="/wp-content/uploads/law-documents/document3.jpg" alt="img">
								<span>Паспорт транспортного средства или генеральная доверенность</span>
							</li>
							<li class="group-item">
								<img src="/wp-content/uploads/law-documents/document4.jpg" alt="img">
								<span>Водительские права или Паспорт</span>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<?php if( is_front_page() ) { ?>
	<section class="scheme wt-custom-content scheme sal-animate" data-sal="fade" data-sal-delay="100"
			data-sal-duration="500" data-sal-easing="ease-in-out" style="margin-bottom: 50px;">
		<div class="container">
			<h2 class="wt-triggers-title">О компании в цифрах</h2>
			<!-- <div class="scheme-subtitle section-subtitle" style="font-size: 22px;color: #252525;">Cхема работы с нами</div> -->
			<div class="scheme-wrapper" style="margin-bottom: 20px;">
				<div class="scheme-inner right" id="scheme-steps">
					<ul class="scheme-steps number-about-company">
						<li class="step-item">
							<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Мы работаем уже</div>
							<div style="text-align: center;margin: 5px; font-size: 45px; color: #efb40d; font-weight: bold;"
									class="wt-field wt-field-text">10 лет
							</div>
						</li>
						<li class="step-item">
							<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Штат мастеров</div>
							<div style="text-align: center;margin: 5px; font-size: 45px; color: #efb40d; font-weight: bold;"
									class="wt-field wt-field-text">35
							</div>
						</li>
						<li class="step-item">
							<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Открыто замков</div>
							<div style="text-align: center;margin: 5px; font-size: 45px; color: #efb40d; font-weight: bold;"
									class="wt-field wt-field-text">44 160
							</div>
						</li>
						<li class="step-item">
							<div style="text-align: center;margin: 5px;font-size: 24px;" class="wt-field wt-field-text">Установлено новых</div>
							<div style="text-align: center;margin: 5px; font-size: 45px; color: #efb40d; font-weight: bold;"
									class="wt-field wt-field-text">26 120
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<section class="wt-custom-content">
	<div class="container">
		<div id="calc">
			<div class="calc-wrap">
				<div class="col col1">
					<div class="bitem step1">
						<p class="titol"><span class="number">1</span> Выберите нужную услугу </p>
						<div class="selSpos">
                        <span class="item active">
                            <img src="https://medved-expert.ru/wp-content/uploads/kalkulyator/images/lock.png" alt="14 лет работы"
		                            style="display: inline;">
                            <br><br>
                            <a href="" class="blink">
                                <span>Установить замок</span>
                            </a>
                        </span>
							<span class="item">
                            <img src="https://medved-expert.ru/wp-content/uploads/kalkulyator/images/door.png" alt="14 лет работы"
		                            style="display: inline;">
                            <br><br>
                            <a href="" class="blink">
                                <span>Вскрыть дверь</span>
                            </a>
                        </span>
							<span class="item">
                            <img src="https://medved-expert.ru/wp-content/uploads/kalkulyator/images/strongbox.png" alt="14 лет работы"
		                            style="display: inline;">
                            <br><br>
                            <a href="" class="blink">
                                <span>Вскрыть сейф</span>
                            </a>
                        </span>
							<span class="item">
                            <img src="https://medved-expert.ru/wp-content/uploads/kalkulyator/images/car.png" alt="14 лет работы"
		                            style="display: inline;">
                            <br><br> <a href="" class="blink"><span>Вскрыть машину</span></a>
                        </span>
						</div>
					</div>
				</div>
				<div class="col col2">
					<div class="bitem step3">
						<p class="titol">
							<span class="number">2</span>Выберите Ваш район
						</p>
						<div class="mini-menu">
							<a class="active" value="mosc" id="mosc"><span>Москва</span></a>
							<a value="podmosc" class="" id="podmosc"><span>Подмосковье</span></a>
						</div>
						<div class="mosc rayon" style="display: block;">
							<ul>
								<li class="">ЦАО</li>
								<li class="">ВАО</li>
								<li>ЮЗАО</li>
								<li class="">САО</li>
								<li class="active">ЮВАО</li>
								<li>ЗАО</li>
								<li>СВАО</li>
								<li>ЮАО</li>
								<li>СЗАО</li>
							</ul>
						</div>
						<div class="podmosc rayon" style="display: none;">
							<div class="tsel">
								<p><b>Расстояние от Москвы:</b></p>
								<ul>
									<li class="active"> &lt; 10 км</li>
									<li>10-30 км</li>
									<li>30-50 км</li>
									<li> &gt; 50 км</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col col3" style="">
					<div class="bitem step4">
						<p class="titol">
							<span class="number">3</span>Время прибытия
						</p>
						<div class="time-clock" style="display: none;">
                        <span class="timer"> Пожалуйста подождите, идет
                            расчет времени <br>Осталось <span id="timer_inp">0</span> секунд...</span>
							<img src="https://medved-expert.ru/wp-content/uploads/kalkulyator/images/clock.gif" alt="загрузка">
						</div>
						<div class="time-pro" style="display: block;">
							<p>
                            <span class="time">00:<span class="time-r">24</span>
                            </span>
							</p>
							<p></p>
							<a class="recalculate bg-butt bg-butt-red submit" style="display: inline-block;">Пересчитать</a>
						</div>
						<p class="center">
							<button class="bg-butt bg-butt-red submit wow pulse animated animated" data-wow-delay="4000ms"
									style="visibility: visible; animation-delay: 4000ms; display: none;"> Рассчитать
							</button>
							<span class="error-hidden error" style="display: inline-block;"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="wt-top">
	<a href="#" class="btn-top"></a>
</div>

</div>

<footer class="wt-footer">
	<div class="wt-footer-main">
		<div class="container">
			<div class="wt-footer-main-box">
				<div class="wt-footer-action hidden-desktop">
					<a href="#" class="btn-top"><span>Наверх</span></a>
				</div>

			  	<div class="messenger">
				    <div title="Чат с менеджером" class="messenger-btn"><img src="/wp-content/themes/walnutmaker/img/icons/chat.svg" alt="Чат с менеджером" /></div>
				    <div id="messenger-links" class="messenger-links">
				      	<a title="Позвонить" href="tel:+74957603375"><img src="/wp-content/themes/walnutmaker/img/icons/phone-icon.svg" alt="Позвонить" /></a>
				      	<a title="Whatsapp" href="whatsapp://send?phone=79162680238"><img src="/wp-content/themes/walnutmaker/img/icons/whatsapp-icon.svg" alt="Whatsapp" /></a>
				      	<a title="Viber" href="viber://chat?number=%2B79162680238"><img src="/wp-content/themes/walnutmaker/img/icons/viber-icon.svg" alt="Viber" /></a>
				      	<a title="Telegram" href="https://t.me/medved_expert"><img src="/wp-content/themes/walnutmaker/img/icons/telegram-icon.svg" alt="Telegram" /></a>
				      	<!-- <a title="Вконтакте" href="https://vk.com"><img src="/wp-content/themes/walnutmaker/img/icons/vk-icon.svg" alt="Вконтакте" /></a> -->
				    </div>
				</div>


				<div class="wt-footer-wrap">
					<?php
						$description = get_bloginfo( 'description', 'display' );
						$phone = wt_options( 'phone' );
						$email = wt_options( 'email' );
						$callback = get_field( 'callback-link', wm_field_option() );
					?>
					<div class="wt-footer-brand wt-footer-brand-full">
						<?php if( wt_logo( 'footer_logo', true ) ) { ?>
							<div class="wt-footer-logo">
								<?php
									echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' . esc_url( home_url() ) . '" rel="home">' : '';
									echo wt_logo( 'footer_logo' );
									echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
								?>
							</div>
						<?php } ?>
						<div class="wt-footer-name">
							<p class="wt-footer-name-title">
								<?php
									echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '<a href="' . esc_url( home_url() ) . '" rel="home">' : '';
									echo get_field( 'site-name', wm_field_option() ) ? : get_bloginfo( 'name', 'display' );
									echo $_SERVER[ 'REQUEST_URI' ] != '/' ? '</a>' : '';
								?>
							</p>
						</div>
					</div>
					<?php
						global $wp_query;
						$pagename = $wp_query->get( 'pagename' );
						$is_cities = !in_array( $pagename, [ 'politika-konfidentsialnosti', 'liability' ] );
						if( $is_cities ) { ?>
							<div class="wt-footer-cities">
								<span>Ваш город:</span> <a href="#"
										class="wt-cities-name city-change-open"><?php bloginfo( 'name' ); ?></a>
							</div>
						<?php } ?>
					<?php if( ( $phone && $phone[ 'href' ] ) || ( $email && $email[ 'href' ] ) || $callback ) { ?>
						<div class="wt-footer-contacts">
							<div class="wt-footer-contacts-meta">
								<?php if( $phone && $phone[ 'href' ] ) { ?>
									<p class="wt-footer-contacts-phone">
										<a href="<?php echo $phone[ 'href' ]; ?>" <?php echo $phone[ 'target' ] ? 'target="_blank"' : ''; ?>
												class="me_phone">
											<?php echo $phone[ 'title' ]; ?>
										</a>
									</p>
								<?php } ?>
								<?php if( $email && $email[ 'href' ] ) { ?>
									<p class="wt-footer-contacts-email">
										<a href="<?php echo $email[ 'href' ]; ?>" <?php echo $email[ 'target' ] ? 'target="_blank"' : ''; ?>>
											<?php echo $email[ 'title' ]; ?>
										</a>
									</p>
								<?php } ?>
							</div>
							<?php get_template_part( 'parts/socials' ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

	<div class="wt-footer-bottom">
		<div class="container">
			<?php if( wt_options( 'weblink' ) ) { ?>
				<div class="wt-footer-weblink"><?php //echo wt_options( 'weblink' ); ?></div>
			<?php } ?>
			<div class="wt-footer-policy">
				<a href="https://medved-expert.ru/politika-konfidentsialnosti/" target="_blank">Политика
					конфиденциальности</a> <a href="https://medved-expert.ru/liability/" target="_blank">Ограничение
					ответственности</a> <a href="https://medved-expert.ru/sitemap/" target="_blank">Карта сайта</a>
			</div>
			<div class="wt-footer-copyright">
			</div>
		</div>
	</div>

</footer>

<?php get_template_part( 'parts/sidenav' ); ?>
<?php get_template_part( 'parts/modals/callback' ); ?>
<?php get_template_part( 'parts/modals/thanks' ); ?>
<?php $is_cities && get_template_part( 'parts/modals/city', 'change' ); ?>

<div class="wt-callback wt-callback-active wt-callback-animate">
	<?php if( ( $phone && $phone[ 'href' ] ) || ( $email && $email[ 'href' ] ) || $callback ) { ?>
		<?php if( $phone && $phone[ 'href' ] ) { ?>
			<a href="<?php echo $phone[ 'href' ]; ?>" class="me_phone-tel"<?php echo $phone[ 'target' ] ? ' target="_blank"' : ''; ?>><span
						class="visually-hidden">Позвонить</span></a>
		<?php } ?>
	<?php } ?>
</div>
<div class="wt-whatsapp">
	<a href="https://wa.me/79162680238"><span class="visually-hidden">Написать в Whatsapp</span></a>
</div>
<div class="wt-google-phone" style="display: none;"><a href="tel:+74998774904">+7 (499) 877-49-04</a></div>
<?php wp_footer(); ?>
<?php echo wt_options( 'code_counter' ); ?>
<!-- Google Tag Manager (noscript) -->
<noscript>
	<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KKV69GZ"
			height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div itemscope="" itemtype="https://schema.org/Organization" style="display:none;">
	<meta itemprop="name" content="Медведь Эксперт">
	<link itemprop="url" href="https://medved-expert.ru/">
	<link itemprop="logo" href="https://medved-expert.ru/wp-content/uploads/2021/12/Group-1.svg">
	<meta itemprop="description" content="Вскрытие замков любой сложности без повреждений в Москве и Московской области">
	<meta itemprop="email" content="info@medved-expert.ru">
	<div itemprop="address" itemscope="" itemtype="https://schema.org/PostalAddress">
		<meta itemprop="addressLocality" content="Москва, Россия">
		<span itemprop="streetAddress">Походный проезд, дом 4, строение 2</span>
	</div>
	<meta itemprop="telephone" content="+7 (495) 760-33-75">
</div>

<script>
  $('.owl-stage-outer').each(function(e) { $(this).css('height', '100%') });
  $(document).ready(function() {
    $('.owl-stage-outer').each(function(e) { $(this).css('height', '100%') });
  });

  var block_show = null;

  function scrollTracking() {
    var $loadMore = $('#load-more');
    if(!$loadMore.length) {
      return;
    }
    var wt = $(window).scrollTop();
    var wh = $(window).height();
    var et = $loadMore.offset().top;
    var eh = $loadMore.outerHeight();

    if(wt + wh >= et && wt + wh - eh * 2 <= et + (wh - eh)) {
      if(block_show == null || block_show == false) {
        console.log('Блок active в области видимости');
        $('.example-active:hidden').each(function(e) {
          if(e < 3) {
            $(this).show()
          }
        });
      }
      block_show = true;
    } else {
      if(block_show == null || block_show == true) {
        console.log('Блок active скрыт');
      }
      block_show = false;
    }
  }

  $(window).scroll(function() {
    scrollTracking();
  });

  $(document).ready(function() {
    scrollTracking();
  });
</script>

</body>
</html>
