<?= $this->extend('metronic/main') ?>
<?= $this->section('main') ?>
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
	<!--begin::Page-->
	<div class="page d-flex flex-row flex-column-fluid">
		<!--begin::Aside-->
		<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
			<!--begin::Brand-->
			<div class="aside-logo flex-column-auto" id="kt_aside_logo">
				<!--begin::Logo-->
				<a href="index.html">
					<img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-15px logo" />
				</a>
				<!--end::Logo-->
				<!--begin::Aside toggler-->
				<div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
					<!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
					<span class="svg-icon svg-icon-1 rotate-180">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
								<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.5" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
							</g>
						</svg>
					</span>
					<!--end::Svg Icon-->
				</div>
				<!--end::Aside toggler-->
			</div>
			<!--end::Brand-->
			<!--begin::Aside menu-->
			<?= $this->renderSection('aside_menu')?>
			<!--end::Aside menu-->
			<!--begin::Footer-->
			<?= $this->renderSection('aside_footer')?>
			<!--end::Footer-->
		</div>
		<!--end::Aside-->
		<!--begin::Wrapper-->
		<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
			<!--begin::Header-->
			<div id="kt_header" style="" class="header align-items-stretch">
				<!--begin::Container-->
				<?= $this->renderSection('container')?>
				<!--end::Container-->
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
				<!--begin::Toolbar-->
				<?= $this->renderSection('toolbar')?>
				<!--end::Toolbar-->
				<!--begin::Post-->
				<?= $this->renderSection('post')?>
				<!--end::Post-->
			</div>
			<!--end::Content-->
			<!--begin::Footer-->
			<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
				<!--begin::Container-->
				<div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
					<!--begin::Copyright-->
					<div class="text-dark order-2 order-md-1">
						<span class="text-muted fw-bold me-1">2021©</span>
						<a href="" target="_blank" class="text-gray-800 text-hover-primary">Keenthemes</a>
					</div>
					<!--end::Copyright-->
					<!--begin::Menu-->
					<ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
						<li class="menu-item">
							<a href="https://keenthemes.com/faqs" target="_blank" class="menu-link px-2">About</a>
						</li>
						<li class="menu-item">
							<a href="https://keenthemes.com/support" target="_blank" class="menu-link px-2">Support</a>
						</li>
						<li class="menu-item">
							<a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a>
						</li>
					</ul>
					<!--end::Menu-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Footer-->
		</div>
		<!--end::Wrapper-->
	</div>
	<!--end::Page-->
</div>
<!--end::Root-->
<?= $this->include('metronic/drawers')?>
<?= $this->include('metronic/modals')?>
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
	<!--begin::Svg Icon | path: icons/duotone/Navigation/Up-2.svg-->
	<span class="svg-icon">
		<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
			<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				<polygon points="0 0 24 0 24 24 0 24" />
				<rect fill="#000000" opacity="0.5" x="11" y="10" width="2" height="10" rx="1" />
				<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
			</g>
		</svg>
	</span>
	<!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<?= $this->endSection() ?>

<?= $this->section('custom_script') ?>
	<!--begin::Page Custom Javascript(used by this page)-->
	<script src="<?= base_url() ?>/assets/js/custom/widgets.js"></script>
	<script src="<?= base_url() ?>/assets/js/custom/apps/chat/chat.js"></script>
	<script src="<?= base_url() ?>/assets/js/custom/modals/create-app.js"></script>
	<script src="<?= base_url() ?>/assets/js/custom/modals/upgrade-plan.js"></script>
	<?= $this->renderSection('script')?>
	<!--end::Page Custom Javascript-->
<?= $this->endSection() ?>