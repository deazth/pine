@if (config('backpack.base.show_powered_by') || config('backpack.base.developer_link'))
    <div class="ml-auto mr-auto">
      @if (config('backpack.base.developer_link') && config('backpack.base.developer_name'))
      <span style="color: #000">{{ trans('backpack::base.handcrafted_by') }}</span> <a class="text-success" target="_blank" href="{{ config('backpack.base.developer_link') }}">{{ config('backpack.base.developer_name') }}</a>.
      @endif
      @if (config('backpack.base.show_powered_by'))
      {{ trans('backpack::base.powered_by') }} <a target="_blank" href="http://backpackforlaravel.com?ref=panel_footer_link">Backpack for Laravel</a>.
      @endif
    </div>
@endif
