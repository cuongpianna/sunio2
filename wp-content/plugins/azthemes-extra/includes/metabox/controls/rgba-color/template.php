<label>
	<div class="sunio-mb-desc">
		<# if ( data.label ) { #>
			<span class="butterbean-label">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="butterbean-description">{{{ data.description }}}</span>
		<# } #>
	</div>

	<div class="sunio-mb-field alpha-true">
		<input class="widefat butterbean-color-picker" {{{ data.attr }}} value="<# if ( data.value ) { #>{{ data.value }}<# } #>" data-alpha="true" />
	</div>
</label>
