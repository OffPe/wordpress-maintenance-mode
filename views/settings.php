<div class="wrap">
    <h2 class="wpmm-title"><?php echo get_admin_page_title(); ?></h2>

    <?php if (!empty($_POST)) { ?>
        <div class="updated settings-error" id="setting-error-settings_updated">
            <p><strong><?php _e('Settings saved.', $this->plugin_slug); ?></strong></p>
        </div>
    <?php } ?>

    <div class="wpmm-wrapper">
        <div id="content" class="wrapper-cell">
            <div class="nav-tab-wrapper">
                <a class="nav-tab nav-tab-active" href="#general"><?php _e('General', $this->plugin_slug); ?></a>
                <a class="nav-tab" href="#design"><?php _e('Design', $this->plugin_slug); ?></a>
                <a class="nav-tab" href="#modules"><?php _e('Modules', $this->plugin_slug); ?></a>
            </div>

            <div class="tabs-content">
                <div id="tab-general" class="">
                    <form method="post">
                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][status]"><?php _e('Status', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <label><input type="radio" value="1" name="options[general][status]" <?php checked($this->plugin_settings['general']['status'], 1); ?>> <?php _e('Activated', $this->plugin_slug); ?></label> <br />
                                        <label><input type="radio" value="0" name="options[general][status]" <?php checked($this->plugin_settings['general']['status'], 0); ?>> <?php _e('Deactivated', $this->plugin_slug); ?></label>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][bypass_bots]"><?php _e('Bypass for Search Bots', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[general][bypass_bots]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['bypass_bots'], 1); ?>><?php _e('Yes', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['bypass_bots'], 0); ?>><?php _e('No', $this->plugin_slug); ?></option>
                                        </select>
                                        <p class="description"><?php _e('Allow Search Bots to bypass maintenance mode?', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][backend_role][]"><?php _e('Backend Role', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[general][backend_role][]" multiple="multiple" class="chosen-select" data-placeholder="<?php _e('Select role(s)', $this->plugin_slug); ?>">
                                            <?php
                                            foreach ($wp_roles->roles as $role => $details) {
                                                if ($role == 'administrator') {
                                                    continue;
                                                }
                                            ?>
                                                <option value="<?php echo esc_attr($role); ?>" <?php echo wpmm_multiselect((array) $this->plugin_settings['general']['backend_role'], $role); ?>><?php echo $details['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="description"><?php _e('Which user role is allowed to access the backend of this blog? Administrators will always have access.', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][frontend_role][]"><?php _e('Frontend Role', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[general][frontend_role][]" multiple="multiple" class="chosen-select" data-placeholder="<?php _e('Select role(s)', $this->plugin_slug); ?>">
                                            <?php
                                            foreach ($wp_roles->roles as $role => $details) {
                                                if ($role == 'administrator') {
                                                    continue;
                                                }
                                            ?>
                                                <option value="<?php echo esc_attr($role); ?>" <?php echo wpmm_multiselect((array) $this->plugin_settings['general']['frontend_role'], $role); ?>><?php echo $details['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="description"><?php _e('Which user role is allowed to access the frontend of this blog? Administrators will always have access.', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][meta_robots]"><?php _e('Robots Meta Tag', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[general][meta_robots]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['meta_robots'], 1); ?>>noindex, nofollow</option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['meta_robots'], 0); ?>>index, follow</option>
                                        </select>
                                        <p class="description"><?php _e('The robots meta tag lets you use a granular, page-specific approach to control how an individual page should be indexed and served to users in search results.', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][redirection]"><?php _e('Redirection', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['general']['redirection'])); ?>" name="options[general][redirection]" />
                                        <p class="description"><?php _e('If you want to redirect a user (with no access to Dashboard/Backend) to a URL (different from WordPress Dashboard URL) after login, then define a URL (incl. http://)', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][exclude]"><?php _e('Exclude', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <textarea rows="7" name="options[general][exclude]" style="width: 625px;"><?php
                                                                                                                    if (!empty($this->plugin_settings['general']['exclude']) && is_array($this->plugin_settings['general']['exclude'])) {
                                                                                                                        echo implode("\n", stripslashes_deep($this->plugin_settings['general']['exclude']));
                                                                                                                    }
                                                                                                                    ?></textarea>
                                        <p class="description"><?php _e('Exclude feed, pages, archives or IPs from maintenance mode. Add one slug / IP per line!', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][notice]"><?php _e('Notice', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[general][notice]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['notice'], 1); ?>><?php _e('Yes', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['notice'], 0); ?>><?php _e('No', $this->plugin_slug); ?></option>
                                        </select>
                                        <p class="description"><?php _e('Do you want to see notices when maintenance mode is activated?', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[general][admin_link]"><?php _e('Dashboard link', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[general][admin_link]">
                                            <option value="1" <?php selected($this->plugin_settings['general']['admin_link'], 1); ?>><?php _e('Yes', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['general']['admin_link'], 0); ?>><?php _e('No', $this->plugin_slug); ?></option>
                                        </select>
                                        <p class="description"><?php _e('Do you want to add a link to the dashboard on your maintenance mode page?', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php wp_nonce_field('tab-general'); ?>
                        <input type="hidden" value="general" name="tab" />
                        <input type="submit" value="<?php _e('Save settings', $this->plugin_slug); ?>" class="button button-primary" name="submit" />
                        <input type="button" value="<?php _e('Reset settings', $this->plugin_slug); ?>" class="button button-secondary reset_settings" data-tab="general" name="submit">
                    </form>
                </div>
                <div id="tab-design" class="hidden">
                    <form method="post">
                        <h3>&raquo; <?php _e('Content', $this->plugin_slug); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][title]"><?php _e('Title (HTML tag)', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['title'])); ?>" name="options[design][title]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][heading]"><?php _e('Heading', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['heading'])); ?>" name="options[design][heading]" />
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['heading_color'])); ?>" name="options[design][heading_color]" data-default-color="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['heading_color'])); ?>" class="color_picker_trigger" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][text]"><?php _e('Text', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <?php
                                        wp_editor(stripslashes($this->plugin_settings['design']['text']), 'options_design_text', array(
                                            'textarea_name' => 'options[design][text]',
                                            'textarea_rows' => 8,
                                            'editor_class' => 'large-text',
                                            'media_buttons' => false,
                                            'wpautop' => false,
                                            'default_editor' => 'tinymce',
                                            'teeny' => true
                                        ));
                                        ?>
                                        <br />
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['text_color'])); ?>" data-default-color="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['text_color'])); ?>" name="options[design][text_color]" class="color_picker_trigger" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h3>&raquo; <?php _e('Background', $this->plugin_slug); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[design][bg_type]"><?php _e('Choose type', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[design][bg_type]" id="design_bg_type">
                                            <option value="color" <?php selected($this->plugin_settings['design']['bg_type'], 'color'); ?>><?php _e('Custom color', $this->plugin_slug); ?></option>
                                            <option value="custom" <?php selected($this->plugin_settings['design']['bg_type'], 'custom'); ?>><?php _e('Uploaded background', $this->plugin_slug); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top" class="design_bg_types <?php echo $this->plugin_settings['design']['bg_type'] != 'color' ? 'hidden' : ''; ?>" id="show_color">
                                    <th scope="row"><label for="options[design][bg_color]"><?php _e('Choose color', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo $this->plugin_settings['design']['bg_color']; ?>" data-default-color="<?php echo $this->plugin_settings['design']['bg_color']; ?>" name="options[design][bg_color]" class="color_picker_trigger" />
                                    </td>
                                </tr>
                                <tr valign="top" class="design_bg_types <?php echo $this->plugin_settings['design']['bg_type'] != 'custom' ? 'hidden' : ''; ?>" id="show_custom">
                                    <th scope="row"><label for="options[design][bg_custom]"><?php _e('Upload background', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['design']['bg_custom'])); ?>" name="options[design][bg_custom]" class="upload_image_url" />
                                        <input type="button" value="Upload" class="button" id="upload_image_trigger" />
                                        <p class="description"><?php _e('Backgrounds should have 1920x1280 px size.', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php wp_nonce_field('tab-design'); ?>
                        <input type="hidden" value="design" name="tab" />
                        <input type="submit" value="<?php _e('Save settings', $this->plugin_slug); ?>" class="button button-primary" name="submit">
                        <input type="button" value="<?php _e('Reset settings', $this->plugin_slug); ?>" class="button button-secondary reset_settings" data-tab="design" name="submit">
                    </form>
                </div>
                <div id="tab-modules" class="hidden">
                    <form method="post">

                        <h3>&raquo; <?php _e('Social Networks', $this->plugin_slug); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_status]"><?php _e('Show social networks?', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[modules][social_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['social_status'], 1); ?>><?php _e('Yes', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['social_status'], 0); ?>><?php _e('No', $this->plugin_slug); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_target]"><?php _e('Links target?', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[modules][social_target]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['social_target'], 1); ?>><?php _e('New page', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['social_target'], 0); ?>><?php _e('Same page', $this->plugin_slug); ?></option>
                                        </select>
                                        <p class="description"><?php _e('Choose how the links will open.', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_github]">Github</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_github'])); ?>" name="options[modules][social_github]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_dribbble]">Dribbble</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_dribbble'])); ?>" name="options[modules][social_dribbble]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_twitter]">Twitter</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_twitter'])); ?>" name="options[modules][social_twitter]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_facebook]">Facebook</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_facebook'])); ?>" name="options[modules][social_facebook]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_instagram]">Instagram</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_instagram'])); ?>" name="options[modules][social_instagram]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_pinterest]">Pinterest</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_pinterest'])); ?>" name="options[modules][social_pinterest]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_google+]">Google+</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_google+'])); ?>" name="options[modules][social_google+]" />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][social_linkedin]">Linkedin</label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['social_linkedin'])); ?>" name="options[modules][social_linkedin]" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h3>&raquo; <?php _e('Google Analytics', $this->plugin_slug); ?></h3>

                        <table class="form-table">
                            <tbody>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][ga_status]"><?php _e('Use Google Analytics?', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[modules][ga_status]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['ga_status'], 1); ?>><?php _e('Yes', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['ga_status'], 0); ?>><?php _e('No', $this->plugin_slug); ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][ga_anonymize_ip]"><?php _e('Enable IP anonymization?', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <select name="options[modules][ga_anonymize_ip]">
                                            <option value="1" <?php selected($this->plugin_settings['modules']['ga_anonymize_ip'], 1); ?>><?php _e('Yes', $this->plugin_slug); ?></option>
                                            <option value="0" <?php selected($this->plugin_settings['modules']['ga_anonymize_ip'], 0); ?>><?php _e('No', $this->plugin_slug); ?></option>
                                        </select>
                                        <p class="description"><?php _e(sprintf('Read about IP anonymization on <a href="%s" rel="noreferrer" target="_blank">Google Analytics</a> docs.', 'https://support.google.com/analytics/answer/2763052'), $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><label for="options[modules][ga_code]"><?php _e('Tracking code', $this->plugin_slug); ?></label></th>
                                    <td>
                                        <input type="text" value="<?php echo esc_attr(stripslashes($this->plugin_settings['modules']['ga_code'])); ?>" name="options[modules][ga_code]" />
                                        <p class="description"><?php _e('Allowed formats: UA-XXXXXXXX, UA-XXXXXXXX-XXXX. Eg: UA-12345678-1 is valid', $this->plugin_slug); ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php wp_nonce_field('tab-modules'); ?>
                        <input type="hidden" value="modules" name="tab" />
                        <input type="submit" value="<?php _e('Save settings', $this->plugin_slug); ?>" class="button button-primary" name="submit">
                        <input type="button" value="<?php _e('Reset settings', $this->plugin_slug); ?>" class="button button-secondary reset_settings" data-tab="modules" name="submit">
                    </form>
                </div>
            </div>
        </div>

        <?php include_once('sidebar.php'); ?>
    </div>
</div>