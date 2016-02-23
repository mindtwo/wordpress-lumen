<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodesBootstrap extends ShortcodeModule {

	/**
	 * Register ShortcodesBootstrapModule
	 */
	public function register() {
		$register_shortcodes = array(
			'bs_notification'   => 'bs_notice',
			'bs_button'         => 'bs_button',
			'bs_collapse'       => 'bs_collapse',
			'bs_citem'          => 'bs_citem',
			'row'               => 'bs_row',
			'bs_label'          => 'bs_labels' ,
			'bs_lead'           => 'bs_lead',
			'bs_tabs'           => 'bs_tabs',
			'bs_thead'          => 'bs_thead',
			'bs_tab'            => 'bs_tab',
			'bs_dropdown'       => 'bs_dropdown',
			'bs_tcontents'      => 'bs_tcontents',
			'bs_tcontent'       => 'bs_tcontent',
			'bs_tooltip'        => 'bs_tooltip',
			'bs_well'           => 'bs_well',
			'col'               => 'bs_span',
			'bs_icon'           => 'bs_icons',
		);

		foreach ( $register_shortcodes as $key => $value ) {
			add_shortcode( $key, array( $this, $value ) );
		}
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_notice( $params, $content=null ) {
		extract( shortcode_atts( array(
			'type' => 'unknown'
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result =  '<div class="alert alert-'.$type.' alert-dismissable">';
		$result .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_buttons( $params, $content=null ) {
		extract(shortcode_atts(array(
			'size' => 'default',
			'type' => 'default',
			'value' => 'button',
			'href' => "#"
		), $params ) );

		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<a class="btn btn-' . $size . ' btn-' . $type . '" href="' . $href . '">' . $value . '</a>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_collapse( $params, $content=null ){
		extract( shortcode_atts( array(
			'id'=>''
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<div class="panel-group" id="' . $id . '"  role="tablist" aria-multiselectable="true">';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_citem( $params, $content=null ){
		extract( shortcode_atts( array(
			'id'=> '',
			'title'=> 'Collapse title',
			'parent' => '',
			'headline' => 'h4',
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result  =  '<div class="panel panel-default accordion_wrapper"><div class="panel-heading" role="tab" id="heading_' . $id . '"><'.$headline.' class="panel-title">';
		$result .= '<a class="accordion-toggle collapsed" data-toggle="collapse" aria-controls="heading_' . $id . '" data-parent="#' . $parent . '" href="#' . $id . '">';
		$result .= $title;
		$result .= '</a></'.$headline.'></div>';
		$result .= '    <div id="' . $id . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_' . $id . '">';
		$result .= '        <div class="panel-body">';
		$result .= do_shortcode( $content );
		$result .= '        </div>';
		$result .= '    </div>';
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_row( $params, $content=null ) {
		extract( shortcode_atts( array(
			'class' => 'row'
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<div class="' . $class . '">';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_span( $params, $content=null ) {
		extract( shortcode_atts( array(
			'class' => 'col-md-6'
		), $params ) );

		$result = '<div class="' . $class . '">';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_icons( $params, $content=null ) {
		extract(shortcode_atts(array(
			'name' => 'default'
		), $params));

		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<i class="' . $name . '"></i>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_labels( $params, $content=null ) {
		extract( shortcode_atts( array(
			'type' => 'default'
		), $params ) );

		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<span class="label label-' . $type . '">' . $content . '</span>';
		return force_balance_tags( $result );
	}


	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_lead( $params, $content=null ){

		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<div class="lead">';
		$result .= do_shortcode( $content );
		$result .= '</div>';

		return force_balance_tags( $result );
	}

	/*--------------
	[bs_tabs]
		[bs_thead]
			[bs_tab href="#link" title="title"]
			[bs_dropdown title="title"]
				[bs_tab href="#link" title="title"]
			[/bs_dropdown]
		[/bs_thead]
		[bs_tcontents]
			[bs_tcontent id="link"]
			[/bs_tcontent]
		[/bs_tcontents]
	[/bs_tabs]
	---------------*/
	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_tabs( $params, $content=null ){
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<div class="tab_wrap">';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_thead( $params, $content=null) {
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<ul class="nav nav-tabs">';
		$result .= do_shortcode( $content );
		$result .= '</ul>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_tab( $params, $content=null ) {
		extract( shortcode_atts( array(
			'href' => '#',
			'title' => '',
			'class' => ''
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );

		$result = '<li class="' . $class . '">';
		$result .= '<a data-toggle="tab" href="' . $href . '">' . $title . '</a>';
		$result .= '</li>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_dropdown( $params, $content=null ) {
		global $bs_timestamp;
		extract( shortcode_atts( array(
			'title' => '',
			'id' => '',
			'class' => '',
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<li class="dropdown">';
		$result .= '<a class="' . $class . '" id="' . $id . '" class="dropdown-toggle" data-toggle="dropdown">' . $title . '<b class="caret"></b></a>';
		$result .= '<ul class="dropdown-menu">';
		$result .= do_shortcode( $content );
		$result .= '</ul></li>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_tcontents( $params, $content=null ) {
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result = '<div class="tab-content">';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_tcontent( $params, $content=null ) {
		extract(shortcode_atts(array(
			'id' => '',
			'class'=>'',
		), $params ) );
		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$class = ($class=='active')? 'active in': '';
		$result = '<div class="tab-pane fade ' . $class . '" id=' . $id . '>';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_tooltip( $params, $content=null ) {
		extract( shortcode_atts( array(
			'placement' => 'top',
			'trigger' => 'hover',
			'href' => "#"
		), $params ) );

		$placement = (in_array( $placement, array( 'top', 'right', 'bottom', 'left' ) ))? $placement: 'top';
		$content = preg_replace('/<br class="nc".\/>/', '', $content);
		$title = explode( '\n', wordwrap( $content, 20, '\n' ) );
		$result = '<a href="#" data-toggle="tooltip" title="' . $title[0] . '" data-placement="' . esc_attr( $placement ) . '" data-trigger="' . esc_attr( $trigger ) . '">' . esc_attr( $content ) . '</a>';
		return force_balance_tags( $result );
	}

	/**
	 * @param      $params
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function bs_well( $params, $content=null ) {
		extract( shortcode_atts( array(
			'size' => 'unknown'
		), $params));

		$content = preg_replace( '/<br class="nc".\/>/', '', $content );
		$result =  '<div class="well well-' . $size . '">';
		$result .= do_shortcode( $content );
		$result .= '</div>';
		return force_balance_tags( $result );
	}

}