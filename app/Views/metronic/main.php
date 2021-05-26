
<!DOCTYPE html>
<!--
Product Name: thinkFrame 
Purchase: 
Contact: 
Follow: 
Dribbble: 
Like: 
License:
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>ThinkFrame</title>
		<meta name="keywords" content="ThinkFrame, Codeigniter4, Metronic, bootstrap, bootstrap 5" />
		<link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="<?= base_url() ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?= base_url() ?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
        <script src="<?= base_url() ?>/libs/jquery/jquery-3.6.0.min.js"></script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
		<!--begin::Main-->
        <?= $this->renderSection('main')?>
		<!--end::Main-->
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="<?= base_url() ?>/assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?= base_url() ?>/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
        <?= $this->renderSection('custom_script')?>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>