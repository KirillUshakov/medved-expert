<?php get_header(); ?>
<?php the_post(); ?>
<?php $obj = get_queried_object(); ?>

	<div class="wt-page-head">
		<div class="container">
			<div class="wt-page-breadcrumbs hidden-xs">
				<?php wt_breadcrumbs(); ?>
			</div>
			<div class="wt-page-title">
				<?php $cats = wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ); ?>
				<h1 class="wt-page-title test1"><?php
						the_title();
						// echo $cats && in_array( 'Услуги', $cats ) ? ' без повреждений' : '';
					?><?php echo Declension(get_blog_details( array( 'blog_id' => $blog_id ) )->blogname); ?> </h1>
				<?php if( $cats && in_array( 'Услуги', $cats ) ) { ?>
					<p style="color: #eead0b; font-size: 1.2em; margin-top: 10px;"><strong>Мастер будет у Вас в течение 15 минут</strong></p>
				<?php } ?>
			</div>
		</div>
	</div>

	<div style="display:none;" id="1111">
		<?php echo $blog_id; ?>
	</div>

<?php if( get_the_content() || wm_have_blocks() || wm_have_sidebar_blocks() || get_post_format() == 'video' ) { ?>
	<div class="wt-single">
		<div class="container">

			<div class="wt-page-row">

				<?php if( get_field( 'layout', $obj ) == 'left' ) { ?>
					<div class="wt-sidebar wt-page-col col-md-3">

						<?php
							if( function_exists( 'dynamic_sidebar' ) ) {
								dynamic_sidebar( 'default-sidebar' );
							}
						?>

						<?php wm_sidebar_blocks(); ?>

					</div>
				<?php } ?>

				<div class="wt-content wt-page-col col-md-<?php echo get_field( 'layout', $obj ) == 'none' ? '12' :
					'9'; ?>">

					<?php get_template_part( 'parts/single/article', get_post_format() ); ?>
					<?php wm_content_blocks(); ?>

				</div>

				<?php if( get_field( 'layout', $obj ) == 'right' ) { ?>
					<div class="wt-sidebar wt-page-col col-md-3">

						<?php
							if( function_exists( 'dynamic_sidebar' ) ) {
								dynamic_sidebar( 'default-sidebar' );
							}
						?>

						<?php wm_sidebar_blocks(); ?>

					</div>
				<?php } ?>

			</div>

		</div>
	</div>
<?php } ?>

<!-- <section class="wt-form wt-form-color-blue wt-form-full inside-form" style="background-image:url(https://medved-expert.ru/wp-content/uploads/2018/04/shutterstock_479993083-min.jpg);">
	<div class="container"><div class="wt-form-wrap"><div class="wt-form-content">
		<div class="wt-form-title">Оставьте заявку и получите <span class="text-yellow">скидку 10%</span> на любую услугу</div>
		<div class="wt-form-description"><p>Наш менеджер свяжется с Вами в течение 1 минуты для уточнения деталей</p></div></div><div class="wt-form-fields"><div role="form" class="wpcf7" id="wpcf7-f6-p339-o1" lang="ru-RU" dir="ltr"><div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div><form action="/services/ustanovka-zamkov/#wpcf7-f6-p339-o1" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init"><div style="display: none;"><input type="hidden" name="_wpcf7" value="6"><input type="hidden" name="_wpcf7_version" value="5.5.6.1"><input type="hidden" name="_wpcf7_locale" value="ru_RU"><input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f6-p339-o1"><input type="hidden" name="_wpcf7_container_post" value="339"><input type="hidden" name="_wpcf7_posted_data_hash" value=""></div><div style="display:none;"><input type="hidden" name="wt-url" value="https://medved-expert.ru/services/ustanovka-zamkov/" class="wpcf7-form-control wpcf7-hidden"></div><p><span class="wpcf7-form-control-wrap wt-phone"><input type="tel" name="wt-phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Введите ваш телефон"></span><span class="wpcf7-form-control-wrap wt-service"><select name="wt-service" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Выберите нужную услугу">Выберите нужную услугу</option><option value="Вскрытие дверных замков">Вскрытие дверных замков</option><option value="Вскрытие замков авто">Вскрытие замков авто</option><option value="Вскрытие сейфов">Вскрытие сейфов</option><option value="Замена замков">Замена замков</option><option value="Врезка замков в деревянную дверь">Врезка замков в деревянную дверь</option><option value="Врезка замков в металлическую дверь">Врезка замков в металлическую дверь</option><option value="Замена личинки">Замена личинки</option><option value="Установка замков">Установка замков</option></select></span></p><p><input type="submit" value="Оставить заявку" class="wpcf7-form-control has-spinner wpcf7-submit btn btn-default"><span class="wpcf7-spinner"></span></p><div class="wpcf7-response-output" aria-hidden="true"></div></form></div><div class="wt-privacy">Нажимая на кнопку «Оставить заявку», <a href="/personal-agreement.pdf" target="_blank">я даю
согласие на обработку персональных данных</a></div></div></div></div></section> -->

<?php if( is_front_page() && $_SERVER['SERVER_NAME'] == 'medved-expert.ru') { ?>

    <section class="wt-form wt-form-color-blue wt-form-full short-form" style="background-image: url(https://medved-expert.ru/wp-content/uploads/2018/04/shutterstock_479993083-min.jpg);">
        <div class="container">
            <div class="wt-form-wrap">
                <div class="wt-form-content">
                    <div class="wt-form-title">Оставьте заявку и получите <span>скидку 10%</span> на любую услугу</div>
                    <div class="wt-form-description"><p>Наш менеджер свяжется с Вами в течение 1 минуты для уточнения деталей.</p></div>
                </div>
                <div class="wt-form-fields">
                    <div role="form" class="wpcf7" id="wpcf7-f6-p2-o1" lang="ru-RU" dir="ltr">
                        <div class="screen-reader-response">
                            <p role="status" aria-live="polite" aria-atomic="true"></p>
                            <ul></ul>
                        </div>
                        <form action="/#wpcf7-f6-p2-o1" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init">
                            <div style="display: none;">
                                <input type="hidden" name="_wpcf7" value="6" /><input type="hidden" name="_wpcf7_version" value="5.5.6.1" /><input type="hidden" name="_wpcf7_locale" value="ru_RU" />
                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f6-p2-o1" /><input type="hidden" name="_wpcf7_container_post" value="2" /><input type="hidden" name="_wpcf7_posted_data_hash" value="" />
                            </div>
                            <div style="display: none;"><input type="hidden" name="wt-url" value="https://medved-expert.ru/" class="wpcf7-form-control wpcf7-hidden" /></div>
                            <p>
                                <span class="wpcf7-form-control-wrap wt-phone">
                                    <input
                                        type="tel"
                                        name="wt-phone"
                                        value=""
                                        size="40"
                                        class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel"
                                        aria-required="true"
                                        aria-invalid="false"
                                        placeholder="Введите ваш телефон"
                                    />
                                </span>
                                <span class="wpcf7-form-control-wrap wt-service">
                                    <select name="wt-service" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false">
                                        <option value="Выберите нужную услугу">Выберите нужную услугу</option>
                                        <option value="Вскрытие дверных замков">Вскрытие дверных замков</option>
                                        <option value="Вскрытие замков авто">Вскрытие замков авто</option>
                                        <option value="Вскрытие сейфов">Вскрытие сейфов</option>
                                        <option value="Замена замков">Замена замков</option>
                                        <option value="Врезка замков в деревянную дверь">Врезка замков в деревянную дверь</option>
                                        <option value="Врезка замков в металлическую дверь">Врезка замков в металлическую дверь</option>
                                        <option value="Замена личинки">Замена личинки</option>
                                        <option value="Установка замков">Установка замков</option>
                                    </select>
                                </span>
                            </p>
                            <p><input type="submit" value="Оставить заявку" class="wpcf7-form-control has-spinner wpcf7-submit btn btn-default" /></p>
                            <div class="wpcf7-response-output" aria-hidden="true"></div>
                        </form>
                    </div>
                    <div class="wt-privacy">Нажимая на кнопку «Оставить заявку», <a href="/politika-konfidentsialnosti/" target="_blank">я даю согласие на обработку персональных данных</a></div>
                </div>
            </div>
        </div>
    </section>

	<?php } else { ?>

<?php // echo do_shortcode('[соntact-form-7 id="362" title="Заголовок"]');?>

    <!-- <section class="wt-form wt-form-color-blue wt-form-full" style="background-image:url(https://medved-expert.ru/wp-content/uploads/2018/04/shutterstock_479993083-min.jpg);"><div class="container"><div class="wt-form-wrap"><div class="wt-form-content"><div class="wt-form-title">Оставьте заявку и получите <span class="text-yellow">скидку 10%</span> на любую услугу</div><div class="wt-form-description"><p>Наш менеджер свяжется с Вами в течение 1 минут для уточнения деталей</p></div></div><div class="wt-form-fields"><div role="form" class="wpcf7" id="wpcf7-f290-p355-o1" lang="ru-RU" dir="ltr"><div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div><form action="/services/vskrytie-dvernyh-zamkov/#wpcf7-f290-p355-o1" method="post" class="wpcf7-form init" novalidate="novalidate" data-status="init"><div style="display: none;"><input type="hidden" name="_wpcf7" value="290"><input type="hidden" name="_wpcf7_version" value="5.5.6.1"><input type="hidden" name="_wpcf7_locale" value="ru_RU"><input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f290-p355-o1"><input type="hidden" name="_wpcf7_container_post" value="355"><input type="hidden" name="_wpcf7_posted_data_hash" value=""></div><div style="display:none;"><input type="hidden" name="wt-url" value="https://zelenograd.medved-expert.ru/services/vskrytie-dvernyh-zamkov/" class="wpcf7-form-control wpcf7-hidden"></div><p><span class="wpcf7-form-control-wrap wt-name"><input type="text" name="wt-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Введите ваше имя"></span><span class="wpcf7-form-control-wrap wt-phone"><input type="tel" name="wt-phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" placeholder="Введите ваш телефон"></span><span class="wpcf7-form-control-wrap wt-service"><select name="wt-service" class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" aria-required="true" aria-invalid="false"><option value="Выберите нужную услугу">Выберите нужную услугу</option><option value="Вскрытие дверных замков">Вскрытие дверных замков</option><option value="Вскрытие замков авто">Вскрытие замков авто</option><option value="Вскрытие сейфов">Вскрытие сейфов</option><option value="Замена замков">Замена замков</option><option value="Врезка замков в деревянную дверь">Врезка замков в деревянную дверь</option><option value="Врезка замков в металлическую дверь">Врезка замков в металлическую дверь</option><option value="Замена личинки">Замена личинки</option><option value="Установка замков">Установка замков</option></select></span></p><p><input type="submit" value="Оставить заявку" class="wpcf7-form-control has-spinner wpcf7-submit btn btn-default"><span class="wpcf7-spinner"></span></p><div class="wpcf7-response-output" aria-hidden="true"></div></form></div><div class="wt-privacy">Нажимая на кнопку «Оставить заявку», <a href="/personal-agreement.pdf" target="_blank">я даю
согласие на обработку персональных данных</a></div></div></div></div></section> -->

<?php } ?>

<div class="wt-single"><div class="container"><div class="wt-page-row"><div class="wt-content wt-page-col col-md-12">
<!-- <form id="add_review">
    <h2>Добавление отзыва:</h2>
    <input type="text" name="name" placeholder="Ваше Имя" required><br>
    <textarea name="message" placeholder="Ваше сообщение" required></textarea>
    <div class="rating__group">
        <input class="rating__star" type="radio" name="rating" value="1" aria-label="Ужасно">
        <input class="rating__star" type="radio" name="rating" value="2" aria-label="Сносно">
        <input class="rating__star" type="radio" name="rating" value="3" aria-label="Нормально">
        <input class="rating__star" type="radio" name="rating" value="4" aria-label="Хорошо">
        <input class="rating__star" type="radio" name="rating" value="5" aria-label="Отлично" checked>
    </div>
	<div class="g-recaptcha" data-sitekey="6LdFM9weAAAAAKNftQP0S3_qTKZf0QIcf2cEdl46" style="margin-top: 10px"></div>
	<div id="review-error" style="margin-top: 10px"></div>
	<input type="submit" value="Отправить" class="wpcf7-form-control has-spinner wpcf7-submit btn btn-default" style="border-color: transparent; margin-top: 10px;">
</form> -->

<section class="wt-triggers wt-triggers-color-blue wt-triggers-btn-extra wt-triggers-slider wt-triggers-service"
		style="background-color:#f6f7f8;">
	<div class="container">
		<div class="wt-triggers-title">Отзывы</div>
		<div class="wt-triggers-wrap owl-carousel owl-loaded"
			 data-options="[&quot;dots&quot;,&quot;arrows&quot;]" data-speed="1000"
			data-interval="5000" data-cols="2">
			<?php
			$mypost_Query = new WP_Query( array(
				'post_type'      => 'reviews', # тип записи
				'post_status'    => 'publish', # статус записи
				'posts_per_page' => -1,        # количество (-1 - все)
			) );

			if ( $mypost_Query->have_posts() ) {
				while ( $mypost_Query->have_posts() ) { $mypost_Query->the_post();

					get_template_part('./includes/loop-review'); // шаблон отзыва

				} wp_reset_postdata(); // "сброс"

			} else { echo '<p>Извините, пока нет отзывов...</p>'; } ?>
		</div>
	</div>
</section>



</div></div></div>



<?php get_footer(); ?>
