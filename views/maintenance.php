<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo stripslashes($title); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="author" content="<?php echo esc_attr($author); ?>" />
	<meta name="description" content="<?php echo esc_attr($description); ?>" />
	<meta name="keywords" content="<?php echo esc_attr($keywords); ?>" />
	<meta name="robots" content="<?php echo esc_attr($robots); ?>" />
	<?php
	if (!empty($styles) && is_array($styles)) {
		foreach ($styles as $src) {
	?>
			<link rel="stylesheet" href="<?php echo $src; ?>">
	<?php
		}
	}
	if (!empty($custom_css) && is_array($custom_css)) {
		echo '<style>' . implode(array_map('stripslashes', $custom_css)) . '</style>';
	}

	// do some actions
	do_action('wm_head'); // this hook will be removed in the next versions
	do_action('wpmm_head');
	?>
</head>

<body class="<?php echo $body_classes ? $body_classes : ''; ?>">
	<?php do_action('wpmm_after_body'); ?>

	<div class="wrap">
		<?php if (!empty($heading)) { ?><h1><?php echo stripslashes($heading); ?></h1><?php } ?>

		<?php if (!empty($text)) { ?><?php echo stripslashes($text); ?><?php } ?>

		<?php if (!empty($this->plugin_settings['modules']['social_status']) && $this->plugin_settings['modules']['social_status'] == 1) { ?>
			<div class="social" data-target="<?php echo !empty($this->plugin_settings['modules']['social_target']) ? 1 : 0; ?>">
				<?php if (!empty($this->plugin_settings['modules']['social_twitter'])) { ?>
					<a class="tw" href="<?php echo stripslashes($this->plugin_settings['modules']['social_twitter']); ?>">twitter</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_facebook'])) { ?>
					<a class="fb" href="<?php echo stripslashes($this->plugin_settings['modules']['social_facebook']); ?>">facebook</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_instagram'])) { ?>
					<a class="instagram" href="<?php echo stripslashes($this->plugin_settings['modules']['social_instagram']); ?>">instagram</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_pinterest'])) { ?>
					<a class="pin" href="<?php echo stripslashes($this->plugin_settings['modules']['social_pinterest']); ?>">pinterest</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_github'])) { ?>
					<a class="git" href="<?php echo stripslashes($this->plugin_settings['modules']['social_github']); ?>">github</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_dribbble'])) { ?>
					<a class="dribbble" href="<?php echo stripslashes($this->plugin_settings['modules']['social_dribbble']); ?>">dribbble</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_google+'])) { ?>
					<a class="gplus" href="<?php echo stripslashes($this->plugin_settings['modules']['social_google+']); ?>">google plus</a>
				<?php } ?>

				<?php if (!empty($this->plugin_settings['modules']['social_linkedin'])) { ?>
					<a class="linkedin" href="<?php echo stripslashes($this->plugin_settings['modules']['social_linkedin']); ?>">linkedin</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>

	<script type='text/javascript'>
		var wpmm_vars = {
			"ajax_url": "<?php echo admin_url('admin-ajax.php'); ?>"
		};
	</script>

	<?php

	// Hook before scripts, mostly for internationalization
	do_action('wpmm_before_scripts');

	if (!empty($scripts) && is_array($scripts)) {
		foreach ($scripts as $src) {
	?>
			<script src="<?php echo $src; ?>"></script>
	<?php
		}
	}
	// Do some actions
	do_action('wm_footer'); // this hook will be removed in the next versions
	do_action('wpmm_footer');
	?>
	<?php if (!empty($this->plugin_settings['bot']['status']) && $this->plugin_settings['bot']['status'] === 1) { ?>
		<script type='text/javascript'>
			jQuery(function($) {
				startConversation('homepage', 1);
			});
		</script>
	<?php } ?>
</body>

</html>