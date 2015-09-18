<?php

/**
 * @file
 * Contains the grid style plugin.
 */

/**
 * Style plugin to render each item in a grid cell.
 *
 * @ingroup views_style_plugins
 */
class pikachoose_slider_plugin_slider extends views_plugin_style {

  /**
   * Set default options
   */
  function option_definition() {
    $options = parent::option_definition();

    $options['speed'] = array('default' => 1000);
    $options['pause'] = array('default' => 3000);
    $options['transition'] = array('default' => 'fade');
    $options['auto'] = array('default' => TRUE);
    $options['preload'] = array('default' => 'visible');
    $options['adaptiveHeight'] = array('default' => FALSE);
    $options['captions'] = array('default' => FALSE);
    $options['pager'] = array('default' => FALSE);

    return $options;
  }

  /**
   * Render the given style.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    $form['preload'] = array(
        '#type' => 'select',
        '#title' => t('Preload'),
        '#options' => array('visible' => 'visible', 'all' => 'all'),
        '#default_value' => $this->options['preload']
    );

    $form['transition'] = array(
        '#type' => 'select',
        '#title' => t('Transition'),
        '#default_value' => $this->options['transition'],
        '#options' => array('fade' => 'fade', 'horizontal' => 'horizontal', 'vertical' => 'vertical', 'kenburns' => 'kenburns')
    );

    $form['auto'] = array(
        '#type' => 'checkbox',
        '#title' => t('Auto Start'),
        '#default_value' => $this->options['auto'],
    );

    $form['pause'] = array(
        '#type' => 'textfield',
        '#title' => t('Pause Time'),
        '#default_value' => $this->options['pause'],
    );

    $form['adaptiveHeight'] = array(
        '#type' => 'checkbox',
        '#title' => t('Adaptive Height'),
        '#default_value' => $this->options['adaptiveHeight'],
    );

    $form['speed'] = array(
        '#type' => 'textfield',
        '#title' => t('Slide delay'),
        '#default_value' => $this->options['speed'],
    );

    $form['pager'] = array(
        '#type' => 'checkbox',
        '#title' => t('Pager'),
        '#default_value' => $this->options['pager'],
    );

    $form['captions'] = array(
        '#type' => 'checkbox',
        '#title' => t('Show caption'),
        '#default_value' => $this->options['captions'],
    );
  }

}
